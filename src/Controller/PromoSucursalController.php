<?php

namespace App\Controller;

use App\Entity\PromoSucursal;
use App\Form\PromoSucursalType;
use App\Repository\PromoSucursalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PromoEstablecimiento;
use App\Repository\PromoEstablecimientoRepository;

/**
 * @Route("/promo/sucursal")
 */
class PromoSucursalController extends AbstractController
{
    /**
     * @Route("/", name="promo_sucursal_index", methods={"GET"})
     */
    public function index(PromoSucursalRepository $promoSucursalRepository): Response
    {
        return $this->render('promo_sucursal/index.html.twig', [
            'promo_sucursals' => $promoSucursalRepository->findAll(),
        ]);
    }
    

    /**
     * @Route("/new/{establecimiento}/establecimiento", name="promo_sucursal_new", methods={"GET","POST"})
     */
    public function new(Request $request, $establecimiento, PromoEstablecimientoRepository $establecimientoRepo ): Response
    {
        $promoSucursal = new PromoSucursal();
        $objPromoEstablecimiento = $establecimientoRepo->findOneBy(Array( 'id'=>$establecimiento ));
        
        if($objPromoEstablecimiento != null ){
            $promoSucursal->setIdEstablecimiento($objPromoEstablecimiento);
        }
        $form = $this->createForm(PromoSucursalType::class, $promoSucursal, array('establecimiento'=> $establecimiento) );
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            if($objPromoEstablecimiento != null ){
                $promoSucursal->setIdEstablecimiento($objPromoEstablecimiento);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promoSucursal);
            $entityManager->flush();

            return $this->redirectToRoute('promo_sucursal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_sucursal/new.html.twig', [
            'promo_sucursal' => $promoSucursal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promo_sucursal_show", methods={"GET"})
     */
    public function show(PromoSucursal $promoSucursal): Response
    {
        return $this->render('promo_sucursal/show.html.twig', [
            'promo_sucursal' => $promoSucursal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="promo_sucursal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PromoSucursal $promoSucursal): Response
    {
        $form = $this->createForm(PromoSucursalType::class, $promoSucursal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promo_sucursal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_sucursal/edit.html.twig', [
            'promo_sucursal' => $promoSucursal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promo_sucursal_delete", methods={"POST"})
     */
    public function delete(Request $request, PromoSucursal $promoSucursal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promoSucursal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($promoSucursal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('promo_sucursal_index', [], Response::HTTP_SEE_OTHER);
    }
}
