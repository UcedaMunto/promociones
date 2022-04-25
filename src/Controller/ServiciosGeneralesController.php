<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiciosGeneralesController extends AbstractController
{
    /**
     * @Route("/servicios/generales", name="servicios_generales")
     */
    public function index(): Response
    {
        return $this->render('servicios_generales/index.html.twig', [
            'controller_name' => 'ServiciosGeneralesController',
        ]);
    }
}
