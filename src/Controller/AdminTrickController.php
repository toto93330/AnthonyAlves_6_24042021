<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTrickController extends AbstractController
{
    /**
     * @Route("/admin/trick/{slug}")
     */
    public function index(): Response
    {
        return $this->render('admin_trick/index.html.twig', [
            'controller_name' => 'AdminTrickController',
        ]);
    }
}
