<?php

namespace App\Controller;

use App\Entity\PromoCategoria;
use App\Form\PromoCategoriaType;
use App\Repository\PromoCategoriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Archivo;
use App\Controller\Helper\Helper;

/**
 * @Route("/promo/categoria")
 */
class PromoCategoriaController extends AbstractController
{
    /**
     * @Route("/", name="promo_categoria_index", methods={"GET"})
     */
    public function index(PromoCategoriaRepository $promoCategoriaRepository): Response
    {
        return $this->render('promo_categoria/index.html.twig', [
            'promo_categorias' => $promoCategoriaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="promo_categoria_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $promoCategorium = new PromoCategoria();
        $form = $this->createForm(PromoCategoriaType::class, $promoCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $helper= new Helper();
            $file1 = $form['archivoLogo']['rutaTemp'];
                if($file1->getNormData() !=null){
                    $saveResult = $helper->saveFile(
                        $file1->getNormData(),
                        $file1->getNormData()->guessExtension(),
                        array('jpg', 'jpeg'),
                        $this->getParameter('RUTA_CATEGORIA'),
                        new Archivo()
                    );
                    if($saveResult['exito'] == true && $file1 !=null ){ 
                        $promoCategorium->setArchivoLogo( $saveResult['archivo']);
                    }else{ $respuesta= ['exito'=> false, 'message'=> 'saveFile no logro guardar el archivo' ]; }
                }
            $file2 = $form['archivoBanner']['rutaTemp'];
                if($file2->getNormData() !=null ){
                    $saveResult2 = $helper->saveFile(
                        $file2->getNormData(),
                        $file2->getNormData()->guessExtension(),
                        array('jpg', 'jpeg'),
                        $this->getParameter('RUTA_CATEGORIA'),
                        new Archivo()
                    );
                    if($saveResult2['exito'] == true && $file2 !=null ){  
                        $promoCategorium->setArchivoBanner( $saveResult2['archivo']);
                    }else{ $respuesta= ['exito'=> false, 'message'=> 'saveFile no logro guardar el archivo' ]; }
                }

            $entityManager->persist($promoCategorium);
            $entityManager->flush();

            return $this->redirectToRoute('promo_categoria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_categoria/new.html.twig', [
            'promo_categorium' => $promoCategorium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promo_categoria_show", methods={"GET"})
     */
    public function show(PromoCategoria $promoCategorium): Response
    {
        return $this->render('promo_categoria/show.html.twig', [
            'promo_categorium' => $promoCategorium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="promo_categoria_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PromoCategoria $promoCategorium): Response
    {
        $form = $this->createForm(PromoCategoriaType::class, $promoCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $helper= new Helper();
            $file1 = $form['archivoLogo']['rutaTemp'];
                if($file1->getNormData() !=null){
                    $saveResult = $helper->saveFile(
                        $file1->getNormData(),
                        $file1->getNormData()->guessExtension(),
                        array('jpg', 'jpeg'),
                        $this->getParameter('RUTA_CATEGORIA'),
                        new Archivo()
                    );
                    if($saveResult['exito'] == true && $file1 !=null ){ 
                        $promoCategorium->setArchivoLogo( $saveResult['archivo']);
                    }else{ $respuesta= ['exito'=> false, 'message'=> 'saveFile no logro guardar el archivo' ]; }
                }
            $file2 = $form['archivoBanner']['rutaTemp'];
                if($file2->getNormData() !=null ){
                    $saveResult2 = $helper->saveFile(
                        $file2->getNormData(),
                        $file2->getNormData()->guessExtension(),
                        array('jpg', 'jpeg'),
                        $this->getParameter('RUTA_CATEGORIA'),
                        new Archivo()
                    );
                    if($saveResult2['exito'] == true && $file2 !=null ){  
                        $promoCategorium->setArchivoBanner( $saveResult2['archivo']);
                    }else{ $respuesta= ['exito'=> false, 'message'=> 'saveFile no logro guardar el archivo' ]; }
                }
                
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promo_categoria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('promo_categoria/edit.html.twig', [
            'promo_categorium' => $promoCategorium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="promo_categoria_delete", methods={"POST"})
     */
    public function delete(Request $request, PromoCategoria $promoCategorium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promoCategorium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($promoCategorium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('promo_categoria_index', [], Response::HTTP_SEE_OTHER);
    }
}
