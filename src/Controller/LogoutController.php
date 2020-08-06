<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    /**
     * Simple Controller para cerrar la session del Cliente y redirección al login
     * @Route ("/logout", name="logout", methods={"GET"})
     */
    public function logout(SessionInterface $session){
        $session->set("client", null);

        return $this->redirectToRoute("login");
    }
}