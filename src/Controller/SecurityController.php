<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\ValidateUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }



    /**
     * LOGIN SYSTEM (ROLES [ALL])
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        //1. REDIRECT USER IF USER IS CONNECTED
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        //2. get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        //3. last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * LOG OUT USER (ROLES [USER])
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {

        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    /**
     * VALIDATE ACCOUNT WITH VALID TOKEN CREDENTIAL (ROLES [ALL])
     * @Route("/validate/account/token/{token}", name="validate-user")
     */
    public function securityValidateUser($token)
    {
        $validate = $this->entityManager->getRepository(ValidateUser::class)->findOneBy(['token' => $token]);

        // IF TOKEN DONT EXIST RETURN ERROR INFO
        if (empty($validate)) {
            $this->addFlash('notify_error', 'Your Token, is not valid!');
            return $this->redirectToRoute('home');
        }

        //1. Validate USER WITH TOKEN
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $validate->getUser()]);
        $user->setValidate(1);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        //2. DELECT TOKEN
        $this->entityManager->remove($validate);
        $this->entityManager->flush();

        //3. REDIRECT USER AND SEND INFO
        $this->addFlash('notify', 'Thanks you, ' . $user->getFirstname() . ' your account is now activated !');
        return $this->redirectToRoute('home');
    }
}
