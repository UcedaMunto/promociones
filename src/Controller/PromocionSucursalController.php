<?php

namespace App\Controller;

use App\Entity\PromocionSucursal;
use App\Form\PromocionSucursalType;
use App\Repository\PromocionSucursalRepository;
use App\Repository\PromoSucursalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/promocion/sucursal")
 */
class PromocionSucursalController extends AbstractController
{
    /**
     * @Route("/", name="promocion_sucursal_index", methods={"GET"})
     */
    public function index(PromocionSucursalRepository $promocionSucursalRepository): Response
    {
        return $this->render('promocion_sucursal/index.html.twig', [
            'promocion_sucursals' => $promocionSucursalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="promocion_sucursal_new", methods={"GET","POST"})
     */
    public function new(Request $request, PromoSucursalRepository $promoRepo): Response
    {
        $promocionSucursal = new PromocionSucursal();
        $form = $this->createForm(PromocionSucursalType::class, $promocionSucursal);
        $form->handleRequest($request);
        $parametros= $request->request->all();

        //dump($parametros['promocion_sucursal']['idSucursalTemp']); die; 

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $promocion = $promocionSucursal->getIdPromocion();
            $activo = $promocionSucursal->getActivo();
            
            $promos_por_sucursal = Array();
            foreach($parametros['promocion_sucursal']['idSucursalTemp'] as $index => $valor ){
                $sucursal =  $promoRepo->findOneBy(Array('id'=> intval($valor)));
                $promoSucTemp = new PromocionSucursal();
                $promoSucTemp->setActivo($activo);
                $promoSucTemp->setIdSucursal($sucursal);
                $promoSucTemp->setIdPromocion($promocion);
                array_push( $promos_por_sucursal, $promoSucTemp);
            }

            foreach( $promos_por_sucursal as $promoSucursal){
                $entityManager->persist($promoSucursal);
            }
            $entityManager->flush();

            return $this->redirectToRoute('promocion_sucursal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promocion_sucursal/new.html.twig', [
            'promocion_sucursal' => $promocionSucursal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promocion_sucursal_show", methods={"GET"})
     */
    public function show(PromocionSucursal $promocionSucursal): Response
    {
        return $this->render('promocion_sucursal/show.html.twig', [
            'promocion_sucursal' => $promocionSucursal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="promocion_sucursal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PromocionSucursal $promocionSucursal): Response
    {
        $form = $this->createForm(PromocionSucursalType::class, $promocionSucursal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promocion_sucursal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promocion_sucursal/edit.html.twig', [
            'promocion_sucursal' => $promocionSucursal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promocion_sucursal_delete", methods={"POST"})
     */
    public function delete(Request $request, PromocionSucursal $promocionSucursal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promocionSucursal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($promocionSucursal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('promocion_sucursal_index', [], Response::HTTP_SEE_OTHER);
    }
}
