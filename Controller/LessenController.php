<?php

namespace App\Controller;

use App\Entity\Lessen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessenController extends AbstractController
{
    /**
     * @Route("/lessen", name="lessen")
     */
    public function showLessen(): Response
    {
        $lessen = $this->getDoctrine()->getRepository(Lessen::class)->findAll();

        return $this->render('lessen/index.html.twig', [
            'lessen' => $lessen,
        ]);
    }
}
