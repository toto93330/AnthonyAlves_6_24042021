<?php

namespace App\Controller;

use App\Entity\Trick;
use ArrayAccess;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class HomeController extends AbstractController
{
    private $entityManager;
    private $limite = 10;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {


        $tricks = $this->entityManager->getRepository(Trick::class)->findByMaxResult($this->limite);

        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }

    /**
     * @Route("/ajax/{moretricks}", name="moretricks" ) 
     */
    public function moretricks($moretricks)
    {

        $moretricks = $this->limite * $moretricks;

        $tricks = $this->entityManager->getRepository(Trick::class)->findByMaxResult($moretricks);

        return $this->json($tricks);
    }
}
