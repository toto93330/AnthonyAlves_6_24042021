<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Comment;
use App\Entity\Category;
use App\Entity\ValidateUser;
use App\Entity\ForgotPassword;
use App\Controller\Admin\TrickCrudController;
use App\Entity\Page;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(TrickCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<a href="/">Admin Panel Snowtricks.com</a>');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Fast navigation', 'fas fa-igloo');
        yield MenuItem::linkToUrl('Home', null, '/');
        yield MenuItem::section('Users Utility', 'fas fa-users');
        yield MenuItem::linkToCrud('Users', '', User::class);
        yield MenuItem::linkToCrud('Forgot Password Tokens', '', ForgotPassword::class);
        yield MenuItem::linkToCrud('Validate users Tokens', '', ValidateUser::class);
        yield MenuItem::section('Tricks Utility', 'fas fa-snowboarding');
        yield MenuItem::linkToCrud('Tricks', '', Trick::class);
        yield MenuItem::linkToCrud('Categorys', '', Category::class);
        yield MenuItem::section('Comments Utility', 'fas fa-comment');
        yield MenuItem::linkToCrud('Comments', '', Comment::class);
        yield MenuItem::section('Medias Utility', 'fas fa-photo-video');
        yield MenuItem::linkToCrud('Images', '', Image::class);
        yield MenuItem::linkToCrud('Videos', '', Video::class);
        yield MenuItem::section('Pages Utility', 'fas fa-pen');
        yield MenuItem::linkToCrud('Pages', '', Page::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
