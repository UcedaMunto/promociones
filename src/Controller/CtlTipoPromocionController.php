<?php

namespace App\Controller;

use App\Entity\CtlTipoPromocion;
use App\Form\CtlTipoPromocionType;
use App\Repository\CtlTipoPromocionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ctl/tipo/promocion")
 */
class CtlTipoPromocionController extends AbstractController
{
    /**
     * @Route("/", name="ctl_tipo_promocion_index", methods={"GET"})
     */
    public function index(CtlTipoPromocionRepository $ctlTipoPromocionRepository): Response
    {
        return $this->render('ctl_tipo_promocion/index.html.twig', [
            'ctl_tipo_promocions' => $ctlTipoPromocionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ctl_tipo_promocion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctlTipoPromocion = new CtlTipoPromocion();
        $form = $this->createForm(CtlTipoPromocionType::class, $ctlTipoPromocion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctlTipoPromocion);
            $entityManager->flush();

            return $this->redirectToRoute('ctl_tipo_promocion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ctl_tipo_promocion/new.html.twig', [
            'ctl_tipo_promocion' => $ctlTipoPromocion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ctl_tipo_promocion_show", methods={"GET"})
     */
    public function show(CtlTipoPromocion $ctlTipoPromocion): Response
    {
        return $this->render('ctl_tipo_promocion/show.html.twig', [
            'ctl_tipo_promocion' => $ctlTipoPromocion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ctl_tipo_promocion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtlTipoPromocion $ctlTipoPromocion): Response
    {
        $form = $this->createForm(CtlTipoPromocionType::class, $ctlTipoPromocion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ctl_tipo_promocion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ctl_tipo_promocion/edit.html.twig', [
            'ctl_tipo_promocion' => $ctlTipoPromocion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ctl_tipo_promocion_delete", methods={"POST"})
     */
    public function delete(Request $request, CtlTipoPromocion $ctlTipoPromocion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctlTipoPromocion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctlTipoPromocion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ctl_tipo_promocion_index', [], Response::HTTP_SEE_OTHER);
    }
}
