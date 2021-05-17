<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Category;
use App\Entity\Contributor;
use App\Form\AdminTrickType;
use App\Form\CreateTrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTrickController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * EDIT TRICKS FOR USER (ROLES [USER])
     * @Route("/admin/trick/{slug}", name="edit-trick")
     */
    public function index(Request $request, $slug): Response
    {

        //1. INIT

        $tricks = $this->entityManager->getRepository(Trick::class)->findBy(['slug' => $slug]);

        // VERIF IF TRICK EXIST
        if (!$tricks) {
            $this->addFlash('notify_error', 'This trick dont exist!');
            return $this->redirectToRoute('home');
        }

        $videos = $this->entityManager->getRepository(Video::class)->findBy(array('trick' => $tricks));
        $images = $this->entityManager->getRepository(Image::class)->findBy(array('trick' => $tricks));

        $category = $this->entityManager->getRepository(Category::class)->findAll();

        //2. INIT FORM
        $trick = new Trick();
        $form = $this->createForm(AdminTrickType::class, $trick);

        //3. INIT VALUE FORM FORM
        $form->get('title')->setData($tricks[0]->getTitle());
        $form->get('content')->setData($tricks[0]->getContent());
        $form->get('category')->setData($tricks[0]->getCategory());

        $form->handleRequest($request);

        //4. VERIF FORM IS VALID AND IS SUBMITTED FOR UPDATE TRICK
        if ($form->isSubmitted() && $form->isValid()) {

            $modify = false;

            //IF IMAGES NOT EMPTY
            if (!empty($form->get('images')->getData())) {

                for ($i = 0; $i < count($form->get('images')->getData()); $i++) {

                    $images = new Image();

                    $file = $form->get('images')->getData()[$i];

                    $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                    $file->move($this->getParameter('images_directory'), $fileName);

                    $images->setTrick($tricks[0]);
                    $images->setUser($this->getUser());
                    $images->setContent($fileName);

                    $this->entityManager->persist($images);
                    $this->entityManager->flush();
                    $modify = true;
                }
            }

            $form = $form->getData();
            $trick = $tricks[0];

            //IF TITLE IS CHANGED
            if ($form->getTitle() != $trick->getTitle()) {

                // VERIF IF NEW TITLE ALREADY EXIST
                $slugger = new AsciiSlugger();
                $slug = $slugger->slug($form->getTitle());
                $slugverif = $this->entityManager->getRepository(Trick::class)->findBy(['slug' => $slug]);
                if ($slugverif) {
                    $this->addFlash('notify_error', 'This trick name, allready exist!');
                    return $this->redirectToRoute('edit-trick', array(
                        'slug' => $trick->getSlug(),
                    ));
                }

                $trick->setTitle($form->getTitle());
                $trick->setSlug($slug);
                $this->entityManager->flush();
                $modify = true;
            }

            //IF IMAGE CARD IS CHANGED
            if (!empty($form->getImageCard())) {

                $file = $form->getImageCard();

                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move($this->getParameter('tricks_directory'), $fileName);
                $trick->setImageCard($fileName);
                $this->entityManager->flush();
                $modify = true;
            }

            //IF CONTENT IS CHANGED
            if ($form->getContent() != $trick->getContent()) {
                $trick->setContent($form->getContent());
                $this->entityManager->flush();
                $modify = true;
            }

            //IF CATEGORY IS CHANGED
            if ($form->getCategory() != $trick->getCategory()) {
                $trick->setCategory($form->getCategory());
                $this->entityManager->flush();
                $modify = true;
            }

            //IF CATEGORY IS CHANGED
            if ($form->getCategory() != $trick->getCategory()) {
                $trick->setCategory($form->getCategory());
                $this->entityManager->flush();
                $modify = true;
            }

            //IF VIDEO NOT EMPTY
            if (!empty($form->getVideos())) {

                for ($i = 0; $i < count($form->getVideos()); $i++) {

                    $videos = new Video();

                    $videos->setUser($this->getUser());
                    $videos->setTrick($trick);
                    $videos->setEmbed($form->getVideos()[$i]->getEmbed());

                    $this->entityManager->persist($videos);
                    $this->entityManager->flush();
                    $modify = true;
                }
            }

            if ($modify) {

                //5. ADD NEW CONTRIBUTOR IF TRICK IS MODIFY

                $verifContributor = $this->entityManager->getRepository(Contributor::class)->findBy(['user' => $this->getUser(), 'trick' => $trick]);

                if (!$verifContributor) {
                    $contributor = new Contributor();
                    $contributor->setUser($this->getUser());
                    $contributor->setTrick($trick);
                    $today = new \DateTime('NOW');
                    $contributor->setCreatedAt($today);
                    $this->entityManager->persist($contributor);
                    $this->entityManager->flush();
                }

                //6. EDIT TRICK FOR MORE INFOS
                $trick->setEdited(1);
                $today = new \DateTime('NOW');
                $trick->setEditedAt($today);
                $trick->setLastEditorId($this->getUser()->getId());
                $this->entityManager->flush();

                //7. FINALY ADD FLASH MESSAGE AND RETURN IN TRICK EDIT
                $this->addFlash('notify', $trick->getTitle() . ', is modified!');
                return $this->redirectToRoute('edit-trick', array(
                    'slug' => $trick->getSlug(),
                ));
            } else {
                return $this->redirectToRoute('edit-trick', array(
                    'slug' => $trick->getSlug(),
                ));
            }
        }


        return $this->render('admin_trick/index.html.twig', [
            'tricks' => $tricks,
            'videos' => $videos,
            'images' => $images,
            'categorys' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * CREATE TRICKS (ROLES [USER])
     * @Route("/add-new-trick", name="add-new-trick")
     */
    public function createTrick(Request $request): Response
    {
        //1.INIT FORM

        $trick = new Trick();
        $form = $this->createForm(CreateTrickType::class, $trick);
        $form->handleRequest($request);

        //2. VERIF FORM IS VALID AND IS SUBMITTED FOR CREATE TRICK
        if ($form->isSubmitted() && $form->isValid()) {

            // VERIF IF TITLE ALREADY EXIST
            $slugger = new AsciiSlugger();
            $slug = $slugger->slug($form->getData()->getTitle());
            $slugverif = $this->entityManager->getRepository(Trick::class)->findBy(['slug' => $slug]);
            if ($slugverif) {
                $this->addFlash('notify_error', 'This trick name, allready exist!');
                return $this->redirectToRoute('add-new-trick');
            }
            $trick->setTitle($form->getData()->getTitle());
            $trick->setSlug($slug);

            // AUTHOR 
            $trick->setAuthor($this->getUser());

            // UPLOAD IMAGE CARD
            $file = $form->get('image_card')->getData();

            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
            $file->move($this->getParameter('tricks_directory'), $fileName);
            $trick->setImageCard($fileName);

            // CONTENT
            $trick->setContent($form->getData()->getContent());

            //CATEGORY
            if (!$form->getData()->getCategory()) {
                $this->addFlash('notify_error', 'please, select an category!');
                return $this->redirectToRoute('add-new-trick');
            }
            $trick->setCategory($form->getData()->getCategory());

            //DATE
            $today = new \DateTime('NOW');
            $trick->setCreatedAt($today);

            //IS EDITED
            $trick->setEdited(0);
            $this->entityManager->persist($trick);
            $this->entityManager->flush();

            //TAKE TRICK FOR ADD MEDIA
            $trick = $this->entityManager->getRepository(Trick::class)->findBy(['slug' => $trick->getSlug()]);

            //IMAGE

            if ($form->get('images')->getData()) {
                $image = $form->get('images')->getData();

                for ($i = 0; $i < count($image); $i++) {

                    $images = new Image();

                    $file = $form->get('images')->getData()[$i];

                    $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                    $file->move($this->getParameter('images_directory'), $fileName);

                    $images->setTrick($trick[0]);
                    $images->setUser($this->getUser());
                    $images->setContent($fileName);

                    $this->entityManager->persist($images);
                    $this->entityManager->flush();
                }
            }

            //VIDEOS

            if ($form->get('videos')->getData()) {
                $image = $form->get('videos')->getData();

                for ($i = 0; $i < count($image); $i++) {

                    $videos = new Video();

                    $videos->setUser($this->getUser());
                    $videos->setTrick($trick[0]);
                    $videos->setEmbed($image[$i]->getEmbed());

                    $this->entityManager->persist($videos);
                    $this->entityManager->flush();
                }
            }

            //RETURN TO HOME AND SEND SUCCESS
            $this->addFlash('notify', $trick[0]->getTitle() . ', is Created!');
            return $this->redirectToRoute('home');
        }
        return $this->render('admin_trick/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * REMOVE TRICK WITH BTN (ROLES [USER])
     * @Route("/tricks/detail/{id}/delect", name="remove-trick")
     */
    public function removeTrick($id)
    {
        //1. Find if trick id exist 
        $remove = $this->entityManager->getRepository(Trick::class)->findBy(array('id' => $id));

        if (!empty($remove)) {

            //2. Find if author != user and return error message
            if ($remove[0]->getAuthor() != $this->getUser()) {
                $this->addFlash('notify_error', 'You are not allowed ! for remove this trick');
                return $this->redirectToRoute('home');
            }

            //3. Remove trick and return success message 
            $this->entityManager->remove($remove[0]);
            $this->entityManager->flush();

            $this->addFlash('notify', 'Your trick is removed!');
            return $this->redirectToRoute('home');
        } else {
            //4. Return error if trick dont exist
            $this->addFlash('notify_error', 'This trick dont exist!');
            return $this->redirectToRoute('home');
        }

        return $this->redirectToRoute('home');
    }


    /**
     * REMOVE TRICK WITH BTN (ROLES [USER])
     * @Route("/medias/type/{type}/{id}", name="remove-medias")
     */
    public function removeMedias($id, $type)
    {


        //1. IF AJAX REQUEST IS FOR IMAGE
        if ($type == 'image') {
            $images = $this->entityManager->getRepository(Image::class)->findBy(array('id' => $id));

            if (!empty($images)) {
                $this->entityManager->remove($images[0]);
                $this->entityManager->flush();
            } else {
                $this->addFlash('notify_error', 'Medias dont exist!');
                return $this->redirectToRoute('home');
            }
        }

        //2. IF AJAX REQUEST IS FOR VIDEO
        if ($type == 'video') {
            $videos = $this->entityManager->getRepository(Video::class)->findBy(array('id' => $id));

            if (!empty($videos)) {
                $this->entityManager->remove($videos[0]);
                $this->entityManager->flush();
            } else {
                $this->addFlash('notify_error', 'Medias dont exist!');
                return $this->redirectToRoute('home');
            }
        }
    }

    /**
     * GENERATE UNIQUE FILE NAME
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
