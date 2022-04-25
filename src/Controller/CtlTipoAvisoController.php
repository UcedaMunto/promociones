<?php

namespace App\Controller;

use App\Entity\CtlTipoAviso;
use App\Form\CtlTipoAvisoType;
use App\Repository\CtlTipoAvisoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ctl/tipo/aviso")
 */
class CtlTipoAvisoController extends AbstractController
{
    /**
     * @Route("/", name="ctl_tipo_aviso_index", methods={"GET"})
     */
    public function index(CtlTipoAvisoRepository $ctlTipoAvisoRepository): Response
    {
        return $this->render('ctl_tipo_aviso/index.html.twig', [
            'ctl_tipo_avisos' => $ctlTipoAvisoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ctl_tipo_aviso_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctlTipoAviso = new CtlTipoAviso();
        $form = $this->createForm(CtlTipoAvisoType::class, $ctlTipoAviso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctlTipoAviso);
            $entityManager->flush();

            return $this->redirectToRoute('ctl_tipo_aviso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ctl_tipo_aviso/new.html.twig', [
            'ctl_tipo_aviso' => $ctlTipoAviso,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ctl_tipo_aviso_show", methods={"GET"})
     */
    public function show(CtlTipoAviso $ctlTipoAviso): Response
    {
        return $this->render('ctl_tipo_aviso/show.html.twig', [
            'ctl_tipo_aviso' => $ctlTipoAviso,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ctl_tipo_aviso_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtlTipoAviso $ctlTipoAviso): Response
    {
        $form = $this->createForm(CtlTipoAvisoType::class, $ctlTipoAviso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ctl_tipo_aviso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ctl_tipo_aviso/edit.html.twig', [
            'ctl_tipo_aviso' => $ctlTipoAviso,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ctl_tipo_aviso_delete", methods={"POST"})
     */
    public function delete(Request $request, CtlTipoAviso $ctlTipoAviso): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctlTipoAviso->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctlTipoAviso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ctl_tipo_aviso_index', [], Response::HTTP_SEE_OTHER);
    }
}
