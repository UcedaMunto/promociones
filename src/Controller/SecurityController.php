<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/loginEmpleados", name="app_login")
     */
    public function loginEmpleados(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()!=null) {
             return $this->redirectToRoute('promocion_sucursal_index');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    
     /**
     * @Route("/login", name="loginBase", methods={"POST"})
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        $user = $this->getUser();

        if($user == null){
            $response = new Response(
                json_encode(
                    array(array(
                        'exito' =>0,
                    ))
                )
            );
        }else{
            $response = new Response(
                json_encode(
                    array(array(
                        'exito' =>1,
                        'id' => 0,
                        'user'  => $user->getUsername(),
                        'roles' => $user->getRoles(),
                        'yarda'  => 'yarda',
                        'session'  => 'session',
                    ))
                )
            );
        }
        
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    /**
     * @Route("/log/nuevo", name="loginNuevo", methods={"POST"})
     */
    public function loginAPP(Request $request)
    {
        $parametros= $request->request->all();
        if($parametros['ttr']="asd123ASD!@#JKLOIUYTZSERTYUIOP"){
            $response = new Response(
                json_encode(
                    array(array(
                        'exito' =>1,
                        'id' => 0,
                        'yarda'  => 'yarda',
                        'session'  => 'session',
                    ))
                )
            );
        }else{
            $response = new Response(
                json_encode(
                    array(array(
                        'exito' =>0,
                        'id' => 0,
                        'yarda'  => 0,
                        'session'  => 0,
                    ))
                )
            );
        }
        
        return $response;
    }


    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
