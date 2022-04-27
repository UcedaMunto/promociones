<?php

namespace App\Controller;

use App\Entity\PersonaEmpleado;
use App\Entity\TipoEmpleado;
use App\Entity\UsuarioEmpleado;
use App\Form\PersonaEmpleadoType;
use App\Form\UsuarioEmpleadoType;
use App\Repository\AgendaRevisionRepository;
use App\Repository\ComentariosRepository;
use App\Repository\PersonaEmpleadoRepository;
use App\Repository\TipoEmpleadoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/personaEmpleado")
 */
class PersonaEmpleadoController extends AbstractController
{
    /**
     * @Route("/", name="persona_empleado_index", methods={"GET"})
     */
    public function index(PersonaEmpleadoRepository $personaEmpleadoRepository): Response
    {
        return $this->render('persona_empleado/index.html.twig', [
            'persona_empleados' => $personaEmpleadoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="persona_empleado_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personaEmpleado = new PersonaEmpleado();
        $form = $this->createForm(PersonaEmpleadoType::class, $personaEmpleado);
        $mensaje=['0'=> '', '1'=>''];
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $personaEmpleado->setActivacion(0);
            
            $entityManager->persist($personaEmpleado);
            $entityManager->flush();

            return $this->redirectToRoute('persona_empleado_index');
        }
        foreach ($form->getErrors() as $error) {
            $mensaje['0']= $mensaje['0']." ".$error->getMessage();  
        }

        return $this->render('persona_empleado/new.html.twig', [
            'persona_empleado' => $personaEmpleado,
            'form' => $form->createView(),
            'mensajes'=>$mensaje,
        ]);
    }

    /**
     * @Route("/{id}", name="persona_empleado_show", methods={"GET"})
     */
    public function show(Request $request, PersonaEmpleado $personaEmpleado, ComentariosRepository $comen, AgendaRevisionRepository $agendasRepo): Response
    {
        $comentariosEnSeguimiento = $comen->ComentariosPrincipalesPerfilOrdenesMovimientos( $personaEmpleado->getUsuarioEmpleado()->getId());
        
        $cuentaPersonal= false;
        if($this->getUser()->getId() == $personaEmpleado->getUsuarioEmpleado()->getId()){
            $cuentaPersonal=true;
        }
       
        return $this->render('persona_empleado/show.html.twig', [
            'persona_empleado' => $personaEmpleado,
            'banderaCuentaPropia'=> $cuentaPersonal, 
            'comentarios' => $comentariosEnSeguimiento,
            'agendas'=> $agendasRepo->tareasEmpleadoPendientesYnoResueltas( $personaEmpleado->getUsuarioEmpleado()->getId(),)
        ]);
    }

    /**
     * @Route("/{id}/edit", name="persona_empleado_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PersonaEmpleado $personaEmpleado): Response
    {
        $form = $this->createForm(PersonaEmpleadoType::class, $personaEmpleado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('persona_empleado_index');
        }

        return $this->render('persona_empleado/edit.html.twig', [
            'persona_empleado' => $personaEmpleado,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit/addUser", name="persona_empleado_edit_add_user", methods={"GET","POST"})
     */
    public function editAddUser(Request $request, PersonaEmpleado $personaEmpleado, TipoEmpleadoRepository $tipoEmpleadoRepo): Response
    {
        $usuario= new UsuarioEmpleado();
        $bandera=['0'=> ''];
        $personaEmpleado->setUsuarioEmpleado($usuario);
        $form = $this->createForm(UsuarioEmpleadoType::class, $usuario);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($request->request->all()); die;  //descomenta esta linea para que puedas ver como es la forma de tu request
            $dat= $request->request->all()['usuario_empleado']['rolesEmpleado']; //Esto me saca el listado de ids seleccionados de mi lista
            foreach($dat as $idRol){
                $rol= $tipoEmpleadoRepo->findOneBy(array('id'=> $idRol)); //obtengo los objetos correspondientes a esos ids 
                $usuario->addRolesEmpleado($rol); // utilizo el metodo add para ir enlazando los IDS
            }
            if( strlen(  $usuario->getUsuario() )<6 || strlen($usuario->getPassword())<6  ){
                $bandera=['0'=> 'Necesita almenos 6 caracteres en el usuario y la contraseña'];
            }else{
                $usuario->setPassword( password_hash( $usuario->getPassword(), PASSWORD_DEFAULT ));
            }
            if( $bandera['0']=="" ){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($usuario);
                $entityManager->flush();
                $parametros= $request->request->all();
                $bitacora->setNueva(json_encode (array('data'=>'estos datos no se guardan aca') ), $request->get('_route'), $this->getUser()->getId(), 'Ingreso de nuevo usuario');
                //$bitacora->setParametros(  );
                $entityManager->persist($bitacora);
                $entityManager->flush();
               // dump( $parametros );
               // die;
                return $this->redirectToRoute('persona_empleado_index');
            }
          
        }

        return $this->render('persona_empleado/addUser.html.twig', [
            'persona_empleado' => $personaEmpleado,
            'form' => $form->createView(),
            'bandera'=> $bandera,
        ]);
    }

 
}
