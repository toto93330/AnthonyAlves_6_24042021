<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Entity\Contributor;

use Doctrine\ORM\EntityManagerInterface;
use Egulias\EmailValidator\Validation\Exception\EmptyValidationList;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TrickController extends AbstractController
{
    private $entityManager;
    private $messagelimite = 5;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * TRICKS ROUTE (ROLES [ALL])
     * @Route("/trick/{slug}", name="trick")
     */
    public function index($slug, Request $request): Response
    {
        //1. TAKE TRICK
        $trick = $this->entityManager->getRepository(Trick::class)->findBy(array('slug' => $slug));

        if (empty($trick)) {
            $this->addFlash('notify_error', 'This tricks, dont exist!');
            return $this->redirectToRoute('home');
        }

        //2. TAKE CONTRIBUTOR
        $contributors = $this->entityManager->getRepository(Contributor::class)->findBy(array('trick' => $trick));
        $contributor = [];

        for ($i = 0; $i < count($contributors); $i++) {
            $data = $this->entityManager->getRepository(User::class)->findBy(array('id' => $contributors[$i]->getUser()->getId()));
            $contributor += [$i => $data[0]];
        }

        $numberofcontributors  = (count($contributors));

        //3. TAKE MEDIAS
        $videos = $this->entityManager->getRepository(Video::class)->findBy(array('trick' => $trick));
        $images = $this->entityManager->getRepository(Image::class)->findBy(array('trick' => $trick));

        //4.ADD NEW COMMENT
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $today = new \DateTime('NOW');
            $message = $form->get('content')->getData();
            $comment->setContent($message);
            $comment->setUser($this->getUser());
            $comment->setTrick($trick[0]);
            $comment->setCreatedAt($today);
            $comment->setActived(0);

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return $this->redirectToRoute('trick', array(
                'slug' => $trick[0]->getSlug(),
            ));
        }

        //5.TAKE COMMENT
        $maxresult = 5;
        $comments = $this->entityManager->getRepository(Comment::class)->findByMaxResult($maxresult, $trick[0]);
        $numberofcomments = count($this->entityManager->getRepository(Comment::class)->findBy(['trick' => $trick, 'actived' => 1]));

        //4.TAKE COMMENT
        $numberofcontributors  = (count($contributors));

        //4.TAKE COMMENT
        $numberofcontributors  = (count($contributors));


        return $this->render('trick/index.html.twig', [
            'tricks' => $trick,
            'images' => $images,
            'videos' => $videos,

            'form' => $form->createView(),
            'contributors' => $contributor,
            'comments' => $comments,
            'numberofcomments' => $numberofcomments,

            'contributors' => $contributor,

            'numberofcontributors' => $numberofcontributors,
        ]);
    }

    /**
     * AJAX REQUEST FOR MORECOMMENTS BTN (ROLES [ALL])
     * @Route("/ajax/message/{morecomments}/trick/{slug}", name="morecomments" ) 
     */
    public function morecomments($morecomments, $slug)
    {

        $trick = $this->entityManager->getRepository(Trick::class)->findBy(array('slug' => $slug));

        $morecomments = $this->messagelimite * $morecomments;


        $comments = $this->entityManager->getRepository(Comment::class)->findByMaxResult($morecomments, $trick[0]);

        $encoders = [new JsonEncoder()]; // If no need for XmlEncoder
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        // Serialize your object in Json
        $jsonObject = $serializer->serialize($comments, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }

        ]);

        // For instance, return a Response with encoded Json
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }
}
