<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class AuthenticationController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(
        Request $request,
        AuthenticationUtils $authUtils
    ) {
        if ($this->getUser() instanceof UserInterface) {
            return $this->redirectToRoute('homepage');
        }

        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('main/login.html.twig', [
            'header' => 'Login',
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}

