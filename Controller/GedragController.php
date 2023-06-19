<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GedragController extends AbstractController
{
    #[Route('/gedrag', name: 'app_gedrag')]
    public function index(): Response
    {
        return $this->render('gedrag/index.html.twig', [
            'controller_name' => 'GedragController',
        ]);
    }
}
