<?php

namespace App\Controller;

use App\Entity\PromoContactoEstablecimiento;
use App\Form\PromoContactoEstablecimientoType;
use App\Repository\PromoContactoEstablecimientoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\PromoEstablecimiento;
use App\Entity\PromoSucursal;
use App\Entity\PromoContactoSucursal;
use App\Form\PromoContactoSucursalType;

/**
 * @Route("/promo/contacto/establecimiento")
 */
class PromoContactoEstablecimientoController extends AbstractController
{
    /**
     * @Route("/", name="promo_contacto_establecimiento_index", methods={"GET"})
     */
    public function index(PromoContactoEstablecimientoRepository $promoContactoEstablecimientoRepository): Response
    {
        return $this->render('promo_contacto_establecimiento/index.html.twig', [
            'promo_contacto_establecimientos' => $promoContactoEstablecimientoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="promo_contacto_establecimiento_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $promoContactoEstablecimiento = new PromoContactoEstablecimiento();
        $form = $this->createForm(PromoContactoEstablecimientoType::class, $promoContactoEstablecimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promoContactoEstablecimiento);
            $entityManager->flush();

            return $this->redirectToRoute('promo_contacto_establecimiento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_contacto_establecimiento/new.html.twig', [
            'promo_contacto_establecimiento' => $promoContactoEstablecimiento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/add/contacto", name="promo_establecimiento_add_contacto", methods={"GET","POST"})
     */
    public function addContacto(Request $request, PromoEstablecimiento $promoEstablecimiento): Response
    {
        $promoContactoEstablecimiento = new PromoContactoEstablecimiento();
        $promoContactoEstablecimiento->setEstablecimiento($promoEstablecimiento);
         
        $form = $this->createForm(PromoContactoEstablecimientoType::class, $promoContactoEstablecimiento);
        $form->handleRequest($request);
        $promoContactoEstablecimiento->setEstablecimiento($promoEstablecimiento);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promoContactoEstablecimiento);
            $entityManager->flush();

            return $this->redirectToRoute('promo_establecimiento_show', ['id' =>$promoEstablecimiento->getId()  ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_contacto_establecimiento/new.html.twig', [
            'promo_contacto_establecimiento' => $promoContactoEstablecimiento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/add/contacto_sucursal", name="promo_sucursal_add_contacto", methods={"GET","POST"})
     */
    public function addContactoSucursal(Request $request, PromoSucursal $promoSucursal): Response
    {
        $promoContactoSucursal = new PromoContactoSucursal();
        $promoContactoSucursal->setSucursal($promoSucursal);
         
        $form = $this->createForm(PromoContactoSucursalType::class, $promoContactoSucursal);
        $form->handleRequest($request);
        $promoContactoSucursal->setSucursal($promoSucursal);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promoContactoSucursal);
            $entityManager->flush();

            return $this->redirectToRoute('promo_sucursal_show', ['id' =>$promoSucursal->getId()  ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_contacto_establecimiento/new.html.twig', [
            'promo_contacto_establecimiento' => $promoContactoSucursal,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="promo_contacto_establecimiento_show", methods={"GET"})
     */
    public function show(PromoContactoEstablecimiento $promoContactoEstablecimiento): Response
    {
        return $this->render('promo_contacto_establecimiento/show.html.twig', [
            'promo_contacto_establecimiento' => $promoContactoEstablecimiento,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="promo_contacto_establecimiento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PromoContactoEstablecimiento $promoContactoEstablecimiento): Response
    {
        $form = $this->createForm(PromoContactoEstablecimientoType::class, $promoContactoEstablecimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promo_contacto_establecimiento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_contacto_establecimiento/edit.html.twig', [
            'promo_contacto_establecimiento' => $promoContactoEstablecimiento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promo_contacto_establecimiento_delete", methods={"POST"})
     */
    public function delete(Request $request, PromoContactoEstablecimiento $promoContactoEstablecimiento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promoContactoEstablecimiento->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($promoContactoEstablecimiento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('promo_contacto_establecimiento_index', [], Response::HTTP_SEE_OTHER);
    }
}
