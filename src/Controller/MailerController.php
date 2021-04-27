<?php

// src/Controller/MailerController.php
namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerController extends AbstractController
{

    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/mail-register", name="mail-register")
     */
    public function sendEmailForRegistration(MailerInterface $mailer)
    {

        if ($this->session->get('user-email')) {

            $userfirstname = $this->session->get('user-firstname');
            $useremail = $this->session->get('user-email');
            $userpassword = $this->session->get('user-password');

            $email = (new TemplatedEmail())
                ->from('snowtricks666@gmail.com')
                ->to($useremail)
                ->subject('Thanks for your registration ' . $userfirstname)
                ->text('The snow must go on!')
                ->htmlTemplate('email/signup.html.twig');

            $mailer->send($email);

            //IMPORTANT : REMOVE SESSION VARIABLE
            $this->session->remove('user-email');
            $this->session->remove('user-password');
            $this->session->remove('user-firstname');
            //After redirect to route
            return $this->redirectToRoute('app_login');
        } else {
            return $this->redirectToRoute('home');
        }
    }


    /**
     * @Route("/mail-forgot-password", name="mail-forgot-password")
     */
    public function sendEmailForForgotPassword(MailerInterface $mailer)
    {

        if ($this->session->get('user-token')) {

            $userfirstname = $this->session->get('user-firstname');
            $useremail = $this->session->get('user-email');
            $usertoken = $this->session->get('user-token');
            $serverhost = $this->session->get('server-host');

            $email = (new TemplatedEmail())
                ->from('snowtricks666@gmail.com')
                ->to($useremail)
                ->subject('Hello ' . $userfirstname . ' you need new password ??')
                ->text('The snow must go on!')
                ->htmlTemplate('email/forgotpassword.html.twig');

            $mailer->send($email);

            //IMPORTANT : REMOVE SESSION VARIABLE
            $this->session->remove('user-email');
            $this->session->remove('user-token');
            $this->session->remove('user-firstname');
            $this->session->remove('server-host');

            return $this->redirectToRoute('forgot_password');
        } else {
            return $this->redirectToRoute('forgot_password');
        }
    }

    /**
     * @Route("/mail-new-password", name="mail-new-password")
     */
    public function sendEmailForNewPassword(MailerInterface $mailer)
    {

        if ($this->session->get('user-newpassword')) {

            $userfirstname = $this->session->get('user-firstname');
            $useremail = $this->session->get('user-email');
            $usernewpassword = $this->session->get('user-newpassword');

            $email = (new TemplatedEmail())
                ->from('snowtricks666@gmail.com')
                ->to($useremail)
                ->subject('Hello ' . $userfirstname . ' this is your new password ??')
                ->text('The snow must go on!')
                ->htmlTemplate('email/newpassword.html.twig');

            $mailer->send($email);


            //IMPORTANT : REMOVE SESSION VARIABLE
            $this->session->remove('user-email');
            $this->session->remove('user-newpassword');
            $this->session->remove('user-firstname');

            return $this->redirectToRoute('home');
        } else {
            return $this->redirectToRoute('forgot_password');
        }
    }
}
