<?php

// src/Controller/MailerController.php
namespace App\Controller;

use Symfony\Component\Mime\Email;
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
    public function sendEmail(MailerInterface $mailer)
    {

        if ($this->session->get('user-email')) {

            $userfirstname = $this->session->get('user-firstname');
            $useremail = $this->session->get('user-email');
            $userpassword = $this->session->get('user-password');

            $email = (new Email())
                ->from('snowtricks666@gmail.com')
                ->to($useremail)
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Thanks for your registration ' . $userfirstname)
                ->text('The snow must go on!')
                ->html('
	<div>
	<h1>Thanks for your registration</h1>
	<p>Hi ' . $userfirstname . ' and thank you for registering on snowtricks.com,<br> here are your login details :</p>	
	<p>Email :</p>
	<p>' . $useremail . '</p>
	<p>password :</p>
	<p>' . $userpassword . '</p>
	<footer>
		Copyright © 2021 | www.snowtricks.com
	</footer>
	</div>
');

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
}
