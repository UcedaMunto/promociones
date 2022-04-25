<?php

namespace App\Controller;

use App\Entity\Archivo;
use App\Form\ArchivoType;
use App\Repository\ArchivoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/archivo")
 */
class ArchivoController extends AbstractController
{
    /**
     * @Route("/", name="archivo_index", methods={"GET"})
     */
    public function index(ArchivoRepository $archivoRepository): Response
    {
        return $this->render('archivo/index.html.twig', [
            'archivos' => $archivoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="archivo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $archivo = new Archivo();
        $form = $this->createForm(ArchivoType::class, $archivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($archivo);
            $entityManager->flush();

            return $this->redirectToRoute('archivo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('archivo/new.html.twig', [
            'archivo' => $archivo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="archivo_show", methods={"GET"})
     */
    public function show(Archivo $archivo): Response
    {
        return $this->render('archivo/show.html.twig', [
            'archivo' => $archivo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="archivo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Archivo $archivo): Response
    {
        $form = $this->createForm(ArchivoType::class, $archivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('archivo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('archivo/edit.html.twig', [
            'archivo' => $archivo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="archivo_delete", methods={"POST"})
     */
    public function delete(Request $request, Archivo $archivo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$archivo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($archivo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('archivo_index', [], Response::HTTP_SEE_OTHER);
    }
}
