<?php

namespace App\Controller\Helper;

use App\Repository\ComentariosRepository;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Component\BrowserKit\Response;


class Helper{

    //ESTA FUNCION SE USA CUANDO SE MARCA COMO RESUELTO O NO RESUELTO UN COMENTARIO PARA PONER LOS DEMAS EN ESTADO RESUELTO
    public static function obtenerIds( int $idComentario, ComentariosRepository $comenRepo): array { //OBTIENE LOS ID DE LAS RESPUESTAS DE UN SOLO COMENTARIO
        $lista= $comenRepo->findByIdGetIdEtiquetas(  $idComentario ); // CONSULTA SOLO LOS ID DE RESPUESTAS
        $arrayNum=[];$contador=0;
        foreach( $lista as $respuesta){ //Convertir el array de elementos de la consulta en un array puro de enteros
            $arrayNum[$contador]=$respuesta['id'];
            $contador++;
        }
        return $arrayNum;
    }

    public function saveFile( $file, $extension, $arrayExtensionsPermited, $rute, $archivo){
        $nombre = '';
        $exito = true;
        if( $file !== null){
            if (!$extension || !in_array( $extension, $arrayExtensionsPermited)) {
                dump($extension); die;
                $exito = FALSE;
            }else{
                $nombre= $this->getAleatorio().".".$extension; 
                $file->move( $rute , $nombre );
                $archivo->setRuta( $rute.'/'.$nombre );
            }
        }else{
            $exito = FALSE;
            dump($file); die;
        }
        return Array( 'exito'=> $exito, 'ruta'=> $rute.'/'.$nombre, 'archivo'=> $archivo );
    }

    public function getAleatorio(){
        $carac="123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $nombrAleatorio=substr(str_shuffle($carac),0,10);
        return $nombrAleatorio;
    }


    
}

?>