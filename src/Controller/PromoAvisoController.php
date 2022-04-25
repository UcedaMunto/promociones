<?php

namespace App\Controller;

use App\Entity\PromoAviso;
use App\Form\PromoAvisoType;
use App\Repository\PromoAvisoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Archivo;
use App\Controller\Helper\Helper;

/**
 * @Route("/promo/aviso")
 */
class PromoAvisoController extends AbstractController
{
    /**
     * @Route("/", name="promo_aviso_index", methods={"GET"})
     */
    public function index(PromoAvisoRepository $promoAvisoRepository): Response
    {
        return $this->render('promo_aviso/index.html.twig', [
            'promo_avisos' => $promoAvisoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="promo_aviso_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $promoAviso = new PromoAviso();
        $form = $this->createForm(PromoAvisoType::class, $promoAviso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $helper= new Helper();
            $file1 = $form['archivoLogoTemp']['rutaTemp']->getNormData();
                if($file1 !=null){
                    $saveResult = $helper->saveFile(
                        $form['archivoLogoTemp']['rutaTemp']->getNormData(),
                        $form['archivoLogoTemp']['rutaTemp']->getNormData()->guessExtension(),
                        array('jpg', 'jpeg'),
                        $this->getParameter('RUTA_AVISO'),
                        new Archivo()
                    );
                    if($saveResult['exito'] == true && $file1 !=null ){ 
                        $promoAviso->setArchivoLogo( $saveResult['archivo']);
                    }else{ $respuesta= ['exito'=> false, 'message'=> 'saveFile no logro guardar el archivo' ]; }
                }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promoAviso);
            $entityManager->flush();

            return $this->redirectToRoute('promo_aviso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_aviso/new.html.twig', [
            'promo_aviso' => $promoAviso,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promo_aviso_show", methods={"GET"})
     */
    public function show(PromoAviso $promoAviso): Response
    {
        return $this->render('promo_aviso/show.html.twig', [
            'promo_aviso' => $promoAviso,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="promo_aviso_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PromoAviso $promoAviso): Response
    {
        $form = $this->createForm(PromoAvisoType::class, $promoAviso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $helper= new Helper();
            $file1 = $form['archivoLogoTemp']['rutaTemp']->getNormData();
                if($file1 !=null){
                    $saveResult = $helper->saveFile(
                        $form['archivoLogoTemp']['rutaTemp']->getNormData(),
                        $form['archivoLogoTemp']['rutaTemp']->getNormData()->guessExtension(),
                        array('jpg', 'jpeg'),
                        $this->getParameter('RUTA_AVISO'),
                        new Archivo()
                    );
                    if($saveResult['exito'] == true && $file1 !=null ){ 
                        $promoAviso->setArchivoLogo( $saveResult['archivo']);
                    }else{ $respuesta= ['exito'=> false, 'message'=> 'saveFile no logro guardar el archivo' ]; }
                }
                
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promo_aviso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_aviso/edit.html.twig', [
            'promo_aviso' => $promoAviso,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promo_aviso_delete", methods={"POST"})
     */
    public function delete(Request $request, PromoAviso $promoAviso): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promoAviso->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($promoAviso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('promo_aviso_index', [], Response::HTTP_SEE_OTHER);
    }
}
