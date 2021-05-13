<?php

namespace App\Controller;

use App\Entity\Contributor;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TrickController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * TRICKS ROUTE (ROLES [ALL])
     * @Route("/trick/{slug}", name="trick")
     */
    public function index($slug): Response
    {
        //1. TAKE TRICK
        $trick = $this->entityManager->getRepository(Trick::class)->findBy(array('slug' => $slug));

        //2. TAKE CONTRIBUTOR
        $contributors = $this->entityManager->getRepository(Contributor::class)->findBy(array('trick' => $trick));
        $contributor = [];

        for ($i = 0; $i < count($contributors); $i++) {
            $data = $this->entityManager->getRepository(User::class)->findBy(array('id' => $contributors[$i]->getUser()->getId()));
            $contributor += [$i => $data[0]];
        }
        //3. TAKE MEDIAS
        $videos = $this->entityManager->getRepository(Video::class)->findBy(array('trick' => $trick));
        $images = $this->entityManager->getRepository(Image::class)->findBy(array('trick' => $trick));

        //4.TAKE COMMENT
        $numberofcontributors  = (count($contributors));

        return $this->render('trick/index.html.twig', [
            'tricks' => $trick,
            'images' => $images,
            'videos' => $videos,
            'contributors' => $contributor,
            'numberofcontributors' => $numberofcontributors,
        ]);
    }
}
