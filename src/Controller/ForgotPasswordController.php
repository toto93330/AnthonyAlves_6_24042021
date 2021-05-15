<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\ForgotPassword;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ForgotPasswordController extends AbstractController
{

    private $entityManager;
    private $session;
    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    /**
     * FORGOT PASSWORD SYSTEM (ROLES [ALL])
     * @Route("/forgot-password", name="forgot_password")
     */
    public function index(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        if ($request->get('email')) {
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $request->get('email')]);

            if (!$user) {
                $this->addFlash('notify_error', 'This email dont exist!');
                // Send email
                return $this->redirectToRoute('forgot_password');
            } else {


                // 1. add new token in database
                $forgot_password = new ForgotPassword();
                $forgot_password->setUser($user);
                $forgot_password->setToken(uniqid());
                $forgot_password->setCreatedAt(new \DateTime());
                $this->entityManager->persist($forgot_password);
                $this->entityManager->flush();

                //2. set variable on session for send email
                $this->session->set('user-email', $user->getEmail());
                $this->session->set('user-token', $forgot_password->getToken());
                $this->session->set('user-firstname', $user->getFirstname());
                $this->session->set('server-host', 'https://' . $_SERVER['HTTP_HOST'] . '/forgot-password/token/');

                // 3. notify success
                $this->addFlash('notify', 'An email has been sent to you, please click on the password reset link in email!');
                // 4. send email
                return $this->redirectToRoute('mail-forgot-password');
            }
        }

        return $this->render('forgot_password/index.html.twig');
    }

    /**
     * VERIF TOKEN FOR FORGOT PASSWORD (ROLES [ALL])
     * @Route("/forgot-password/token/{token}", name="forgot_password_update")
     */
    public function update($token, UserPasswordEncoderInterface $encoder)
    {
        $token = $this->entityManager->getRepository(ForgotPassword::class)->findOneBy(['token' => $token]);

        if ($token) {
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $token->getUser()]);

            //1. Verif expiration date
            $now = new \DateTime();

            if ($token->getCreatedDate()->modify('+ 24 hour') < $now) {
                $this->entityManager->remove($token);
                $this->entityManager->flush();
                $this->addFlash('notify_error', 'your token is expired!');
                return $this->redirectToRoute('forgot_password');
            }
            //2. Generate new password and update database 
            $password = uniqid();
            $newpassword = $encoder->encodePassword($user, $password);
            $user->setPassword($newpassword);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            //3. DELECT TOKEN
            $this->entityManager->remove($token);
            $this->entityManager->flush();
            //4. Set session variable
            $this->session->set('user-email', $user->getEmail());
            $this->session->set('user-newpassword', $password);
            $this->session->set('user-firstname', $user->getFirstname());
            //5. notify success
            $this->addFlash('notify', 'An email as been sended with your new password!');
            //6. Send email
            return $this->redirectToRoute('mail-new-password');
        } else {
            $this->addFlash('notify_error', 'Your token dont exist!');
        }
    }
}
