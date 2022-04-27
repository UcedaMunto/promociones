<?php

namespace App\Controller;

use App\Entity\DatosPersona2;
use App\Form\DatosPersona2Type;
use App\Repository\DatosPersona2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/datos/persona2")
 */
class DatosPersona2Controller extends AbstractController
{
    /**
     * @Route("/", name="datos_persona2_index", methods={"GET"})
     */
    public function index(DatosPersona2Repository $datosPersona2Repository): Response
    {
        return $this->render('datos_persona2/index.html.twig', [
            'datos_persona2s' => $datosPersona2Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="datos_persona2_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $datosPersona2 = new DatosPersona2();
        $form = $this->createForm(DatosPersona2Type::class, $datosPersona2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($datosPersona2);
            $entityManager->flush();

            return $this->redirectToRoute('datos_persona2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('datos_persona2/new.html.twig', [
            'datos_persona2' => $datosPersona2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="datos_persona2_show", methods={"GET"})
     */
    public function show(DatosPersona2 $datosPersona2): Response
    {
        return $this->render('datos_persona2/show.html.twig', [
            'datos_persona2' => $datosPersona2,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="datos_persona2_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DatosPersona2 $datosPersona2): Response
    {
        $form = $this->createForm(DatosPersona2Type::class, $datosPersona2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('datos_persona2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('datos_persona2/edit.html.twig', [
            'datos_persona2' => $datosPersona2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="datos_persona2_delete", methods={"POST"})
     */
    public function delete(Request $request, DatosPersona2 $datosPersona2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$datosPersona2->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($datosPersona2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('datos_persona2_index', [], Response::HTTP_SEE_OTHER);
    }
}
