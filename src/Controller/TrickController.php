<?php

namespace App\Controller;

use App\Entity\Trick;
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
     * @Route("/trick/{slug}", name="trick")
     */
    public function index($slug): Response
    {

        $trick = $this->entityManager->getRepository(Trick::class)->findBy(array('slug' => $slug));

        return $this->render('trick/index.html.twig', [
            'tricks' => $trick,
        ]);
    }
}
