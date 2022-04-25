<?php

namespace App\Controller;

use App\Entity\PromoEstablecimiento;
use App\Form\PromoEstablecimientoType;
use App\Repository\PromoEstablecimientoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Archivo;
use App\Controller\Helper\Helper;

/**
 * @Route("/promo/establecimiento")
 */
class PromoEstablecimientoController extends AbstractController
{
    /**
     * @Route("/", name="promo_establecimiento_index", methods={"GET"})
     */
    public function index(PromoEstablecimientoRepository $promoEstablecimientoRepository): Response
    {
        return $this->render('promo_establecimiento/index.html.twig', [
            'promo_establecimientos' => $promoEstablecimientoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="promo_establecimiento_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $promoEstablecimiento = new PromoEstablecimiento();
        $form = $this->createForm(PromoEstablecimientoType::class, $promoEstablecimiento);
        $form->handleRequest($request);
        $respuesta= ['exito'=> null, 'message'=> null ];
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $helper= new Helper();
            //----------
            $file1 = $form['archivoLogoTemp']['rutaTemp']->getNormData();
                if($file1 !=null){
                    $saveResult = $helper->saveFile(
                        $form['archivoLogoTemp']['rutaTemp']->getNormData(),
                        $form['archivoLogoTemp']['rutaTemp']->getNormData()->guessExtension(),
                        array('jpg', 'jpeg'),
                        $this->getParameter('RUTA_ESTABLECIMIENTOS'),
                        new Archivo()
                    );
                    if($saveResult['exito'] == true && $file1 !=null ){ 
                        $promoEstablecimiento->setArchivoLogo( $saveResult['archivo']);
                    }else{ $respuesta= ['exito'=> false, 'message'=> 'saveFile no logro guardar el archivo' ]; }
                }
            $file2 = $form['archivoBannerTemp']['rutaTemp']->getNormData();
                if($file2 !=null ){
                    $saveResult2 = $helper->saveFile(
                        $file2,
                        $file2->guessExtension(),
                        array('jpg', 'jpeg'),
                        $this->getParameter('RUTA_ESTABLECIMIENTOS'),
                        new Archivo()
                    );
                    if($saveResult2['exito'] == true && $file2 !=null ){  
                        $promoEstablecimiento->setArchivoBanner( $saveResult2['archivo']);
                    }else{ $respuesta= ['exito'=> false, 'message'=> 'saveFile no logro guardar el archivo' ]; }
                }

            //-----------
            $entityManager->persist($promoEstablecimiento);
            $entityManager->persist($promoEstablecimiento);
            $entityManager->flush();

            return $this->redirectToRoute('promo_establecimiento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_establecimiento/new.html.twig', [
            'promo_establecimiento' => $promoEstablecimiento,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="promo_establecimiento_show", methods={"GET"})
     */
    public function show(PromoEstablecimiento $promoEstablecimiento): Response
    {
        return $this->render('promo_establecimiento/show.html.twig', [
            'promo_establecimiento' => $promoEstablecimiento,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="promo_establecimiento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PromoEstablecimiento $promoEstablecimiento): Response
    {
        $form = $this->createForm(PromoEstablecimientoType::class, $promoEstablecimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $helper= new Helper();
            //----------
            $file1 = $form['archivoLogoTemp']['rutaTemp']->getNormData();
                if($file1 !=null){
                    $saveResult = $helper->saveFile(
                        $form['archivoLogoTemp']['rutaTemp']->getNormData(),
                        $form['archivoLogoTemp']['rutaTemp']->getNormData()->guessExtension(),
                        array('jpg', 'jpeg'),
                        $this->getParameter('RUTA_ESTABLECIMIENTOS'),
                        new Archivo()
                    );
                    if($saveResult['exito'] == true && $file1 !=null ){ 
                        $promoEstablecimiento->setArchivoLogo( $saveResult['archivo']);
                    }else{ $respuesta= ['exito'=> false, 'message'=> 'saveFile no logro guardar el archivo' ]; }
                }
            $file2 = $form['archivoBannerTemp']['rutaTemp']->getNormData();
                if($file2 !=null ){
                    $saveResult2 = $helper->saveFile(
                        $file2,
                        $file2->guessExtension(),
                        array('jpg', 'jpeg'),
                        $this->getParameter('RUTA_ESTABLECIMIENTOS'),
                        new Archivo()
                    );
                    if($saveResult2['exito'] == true && $file2 !=null ){  
                        $promoEstablecimiento->setArchivoBanner( $saveResult2['archivo']);
                    }else{ $respuesta= ['exito'=> false, 'message'=> 'saveFile no logro guardar el archivo' ]; }
                }

            //-----------
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promo_establecimiento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_establecimiento/edit.html.twig', [
            'promo_establecimiento' => $promoEstablecimiento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promo_establecimiento_delete", methods={"POST"})
     */
    public function delete(Request $request, PromoEstablecimiento $promoEstablecimiento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promoEstablecimiento->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($promoEstablecimiento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('promo_establecimiento_index', [], Response::HTTP_SEE_OTHER);
    }
}
