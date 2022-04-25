<?php

namespace App\Controller;

use App\Entity\CtlTipoContacto;
use App\Form\CtlTipoContactoType;
use App\Repository\CtlTipoContactoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ctl/tipo/contacto")
 */
class CtlTipoContactoController extends AbstractController
{
    /**
     * @Route("/", name="ctl_tipo_contacto_index", methods={"GET"})
     */
    public function index(CtlTipoContactoRepository $ctlTipoContactoRepository): Response
    {
        return $this->render('ctl_tipo_contacto/index.html.twig', [
            'ctl_tipo_contactos' => $ctlTipoContactoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ctl_tipo_contacto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctlTipoContacto = new CtlTipoContacto();
        $form = $this->createForm(CtlTipoContactoType::class, $ctlTipoContacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctlTipoContacto);
            $entityManager->flush();

            return $this->redirectToRoute('ctl_tipo_contacto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ctl_tipo_contacto/new.html.twig', [
            'ctl_tipo_contacto' => $ctlTipoContacto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ctl_tipo_contacto_show", methods={"GET"})
     */
    public function show(CtlTipoContacto $ctlTipoContacto): Response
    {
        return $this->render('ctl_tipo_contacto/show.html.twig', [
            'ctl_tipo_contacto' => $ctlTipoContacto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ctl_tipo_contacto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtlTipoContacto $ctlTipoContacto): Response
    {
        $form = $this->createForm(CtlTipoContactoType::class, $ctlTipoContacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ctl_tipo_contacto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ctl_tipo_contacto/edit.html.twig', [
            'ctl_tipo_contacto' => $ctlTipoContacto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ctl_tipo_contacto_delete", methods={"POST"})
     */
    public function delete(Request $request, CtlTipoContacto $ctlTipoContacto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctlTipoContacto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctlTipoContacto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ctl_tipo_contacto_index', [], Response::HTTP_SEE_OTHER);
    }
}
