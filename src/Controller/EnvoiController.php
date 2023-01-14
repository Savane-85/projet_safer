<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnvoiController extends AbstractController
{
    #[Route('/envoi', name: 'app_envoi')]
    public function index(): Response
    {
        return $this->render('envoi/index.html.twig', [
            'controller_name' => 'EnvoiController',
        ]);
    }
}
