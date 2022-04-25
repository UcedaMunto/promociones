<?php

namespace App\Controller;

use App\Entity\DatosPersona;
use App\Entity\PersonaCliente;
use App\Entity\PersonaEmpleado;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UsuarioRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\UsuarioCliente;
use App\Entity\UsuarioEmpleado;
use App\Form\DatosPersonaType;
use App\Form\paramLoginType;
use App\Repository\UsuarioClienteRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\PromoEstablecimientoRepository;
use App\Repository\PromoCategoriaRepository;
use App\Repository\PromoPromocionesRepository;


use App\Repository\PromoAvisoRepository;

class LoginController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="inicio", methods={"GET", "POST"})
     */
    public function inicio(Request $request, 
        PromoAvisoRepository $avisoRepo,
        PromoEstablecimientoRepository $establecimientoRepo,
        PromoCategoriaRepository $categoriaRepo,
        PromoPromocionesRepository $promocionesRepo
    )
    {
        //return $this->redirectToRoute('app_login');


        
        return $this->render('minsal.html.twig', [
            'controller_name' => 'LoginController',
            'avisos' => $avisoRepo->findBy(Array('activo'=> true)),
            'establecimiento' => $establecimientoRepo->findOne( ),
            'establecimientos' => $establecimientoRepo->findAll( ),
            'categorias_estab' => $categoriaRepo->findAll(),
            'promociones' => $promocionesRepo->findBy( Array( 'activo'=>true ) )
        ]);
    }

    /**
     * @Route("/ejemplos", name="ejemplos", methods={"GET", "POST"})
     */
    public function ejemplos(Request $request)
    {
       
        
        return $this->render('ejemplo.html.twig', [
            'controller_name' => 'LoginController'
        ]);
    }

    /**
     * @Route("/llfkoyirfpopoinhjgy/{id}", name="registro_cuenta_cliente_sistema", methods={"GET", "POST"})
     */
    public function registro(Request $request, PersonaCliente $persona )
    {
        $bandera=['0'=> ''];
        $form = $this->createForm(paramLoginType::class, ['action' => $this->generateUrl('inicio'),'method' => 'POST', ] );
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid() ) {
            $parametros= $request->request->all();
            $userOBJ = new UsuarioCliente();
            $cadenaPass= $parametros['param_login']['pass'];
            $cadenaUser= $parametros['param_login']['user'];
            $token=$parametros['param_login']['token'];
            if( $persona->getTokenRegistro() != $token){
                $bandera=['0'=> 'Su código es inválido'];
            }else{
                if( strlen(  $cadenaPass )<6 || strlen($cadenaUser)<6  ){
                    $bandera=['0'=> 'Necesita almenos 6 caracteres en el usuario y la contraseña'];
                }else{
                    $userTEMP = new UsuarioCliente();
                    $em = $this->getDoctrine()->getManager();
                    $repository = $em->getRepository(UsuarioCliente::class);
                    $userTEMP= $repository->findOneBy( array('usuario' => $cadenaUser  ) );
                    if($userTEMP!=NULL){
                        $bandera=['0'=> 'Este nombre de usuario ya esta ocupado'];
                    }
                }
            }

            if( $bandera['0']=="" ){
                $HASH= password_hash($cadenaPass, PASSWORD_DEFAULT );
                $userOBJ->setPassword($HASH);
                $userOBJ->setUsuario($cadenaUser);
                $persona->setUsuario($userOBJ);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($persona);
                $entityManager->flush();
                return $this->redirectToRoute('persona_cliente_index');
            }

        }

        return $this->render('login/indexRegistroCliente.html.twig', [
            'controller_name' => 'LoginController', 'bandera'=> $bandera,  'form'=> $form->createView(),
        ]);
    }

    /*
     * @Route("/login_simple", name="app_login", methods={"GET", "POST"})
    
    public function login(Request $request)
    {
        $bandera=0;
        $form = $this->createForm(paramLoginType::class, ['action' => $this->generateUrl('login'),'method' => 'POST', ] );
        $form ->remove('token');
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid() ) {
            $userOBJ = new UsuarioCliente();
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository(UsuarioCliente::class);
            $reposCliente = $em->getRepository(PersonaCliente::class);
            $repoDatos = $em->getRepository(DatosPersona::class);
            $parametros= $request->request->all();
            $userOBJ= $repository->findOneBy( array('usuario' => $parametros['param_login']['user']  ) );
            $usuario=null;
            //$usuario= $repositoryProfesor->findOneBy( array('usuario' => $userOBJ->getId() ) );
            if( $userOBJ!=null){
                //$jsonArray = array('success' => true, 'user' =>$userOBJ->getCorreo(), 'profesor' =>$profesor );
                $cliente= $reposCliente->findOneBy( array('usuario'=> $userOBJ->getId() ) );
                $pass= $userOBJ->getPassword();
                $valid=password_verify( $parametros['param_login']['pass']  , $pass );
                if($valid){
                    $bandera=3;
                }else{
                    $bandera=2;
                }
                if( $bandera==3 ){
                    $datos= $cliente->getDatos();
                    $this->session->set('correo',  $datos->getCorreo1() );
                    $this->session->set('cliente', 1 );
                    $this->session->set('id', $userOBJ->getId() );
                    return $this->redirectToRoute('inicioCliente');
                }else{
                    return $this->render('login/index.html.twig', [
                        'controller_name' => 'LoginController', 'bandera'=> $bandera,  'form'=> $form->createView(),
                    ]);
                }  
            }
            if( $userOBJ== null){
                $bandera=2;
                $jsonArray = array('success' => false, 'excusa' =>'No encontrado', 'data'=> 'dd' );
                return $this->render('login/index.html.twig', [
                    'controller_name' => 'LoginController', 'bandera'=> $bandera,  'form'=> $form->createView(),
                ]);
            }
        }else{
            return $this->render('login/index.html.twig', [
                'controller_name' => 'LoginController', 'bandera'=> $bandera,  'form'=> $form->createView(),
            ]);
        }
        
    } */


}
