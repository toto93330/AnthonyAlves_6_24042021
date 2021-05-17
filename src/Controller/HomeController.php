<?php

namespace App\Controller;

use App\Entity\Trick;
use ArrayAccess;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
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
     * PAGE HOME (ROLES [ALL])
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        //IF USER LOGGED IS NOT VALIDATE REDIRECT USER ON LOG OUT FOR CLOSE USER SESSION 
        if ($this->getUser() && $this->getUser()->getValidate() == false) {
            //1. SEND INFO YOUR ACCOUNT IS NOT VALIDATE
            return $this->redirectToRoute('app_logout');
        }

        $tricks = $this->entityManager->getRepository(Trick::class)->findByMaxResult($this->limite);

        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }

    /**
     * AJAX REQUEST FOR MORETRICKS BTN (ROLES [ALL])
     * @Route("/ajax/{moretricks}", name="moretricks" ) 
     */
    public function moretricks($moretricks)
    {

        $moretricks = $this->limite * $moretricks;


        $tricks = $this->entityManager->getRepository(Trick::class)->findByMaxResult($moretricks);

        $encoders = [new JsonEncoder()]; // If no need for XmlEncoder
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        // Serialize your object in Json
        $jsonObject = $serializer->serialize($tricks, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 2_finish_entity
=======
>>>>>>> 1_make_uml
        // For instance, return a Response with encoded Json
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }
}
