<?php

namespace App\Controller;

use App\Entity\CtlTipoArchivo;
use App\Form\CtlTipoArchivoType;
use App\Repository\CtlTipoArchivoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ctl/tipo/archivo")
 */
class CtlTipoArchivoController extends AbstractController
{
    /**
     * @Route("/", name="ctl_tipo_archivo_index", methods={"GET"})
     */
    public function index(CtlTipoArchivoRepository $ctlTipoArchivoRepository): Response
    {
        return $this->render('ctl_tipo_archivo/index.html.twig', [
            'ctl_tipo_archivos' => $ctlTipoArchivoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ctl_tipo_archivo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctlTipoArchivo = new CtlTipoArchivo();
        $form = $this->createForm(CtlTipoArchivoType::class, $ctlTipoArchivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctlTipoArchivo);
            $entityManager->flush();

            return $this->redirectToRoute('ctl_tipo_archivo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ctl_tipo_archivo/new.html.twig', [
            'ctl_tipo_archivo' => $ctlTipoArchivo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ctl_tipo_archivo_show", methods={"GET"})
     */
    public function show(CtlTipoArchivo $ctlTipoArchivo): Response
    {
        return $this->render('ctl_tipo_archivo/show.html.twig', [
            'ctl_tipo_archivo' => $ctlTipoArchivo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ctl_tipo_archivo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtlTipoArchivo $ctlTipoArchivo): Response
    {
        $form = $this->createForm(CtlTipoArchivoType::class, $ctlTipoArchivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ctl_tipo_archivo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ctl_tipo_archivo/edit.html.twig', [
            'ctl_tipo_archivo' => $ctlTipoArchivo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ctl_tipo_archivo_delete", methods={"POST"})
     */
    public function delete(Request $request, CtlTipoArchivo $ctlTipoArchivo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctlTipoArchivo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctlTipoArchivo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ctl_tipo_archivo_index', [], Response::HTTP_SEE_OTHER);
    }
}
