<?php

namespace App\Controller;

use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/pages/{slug}", name="fast-navigation")
     */
    public function index($slug, PageRepository $page): Response
    {

        $page = $page->findBy(['slug' => $slug]);

        if (count($page) === 0) {
            $this->addFlash('notify_error', 'This page dont exist!');
            return $this->redirectToRoute('home');
        }

        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
            'title' => $page[0]->getTitle(),
            'content' => $page[0]->getContent(),
        ]);
    }
}
