<?php
namespace App\Herramientas;

use App\Entity\Envio;
use App\Repository\DetalleCompraRepository;


trait validadores
{
    public function validarEnvioIngresoDatos( $param, $edicion, Envio $envio, $mensajes, DetalleCompraRepository $detalleCompraRepo){

        
       $detalleCompra = $envio->getDetalleCompra();

        
        $detalleRepetido= $detalleCompraRepo->findOneRepetido( 
            $envio->getDetalleCompra()->getVin(),
            $envio->getDetalleCompra()->getLote()
        ); // retorna una lista con los autos del mismo lote o vin
  
        $countRepe=count($detalleRepetido);//Cantidad de autos con el mismo lote y/o vin
        if($edicion){ // si estamos editando 
            if($countRepe>1){ //si es más de un auto entonces los dos se repiten en distintos carros
                $mensajes['0']= $mensajes['0']. "/ lote o vin repetido";
            }else if($countRepe==1 ){ // si es solo uno entonces solo el lote o el vin ya están en el sistema
                if( $detalleCompra->getId()!=$detalleRepetido[0]->getId()){ //si el auto con vin o lote rpetido no es el mismo que editamos
                    $mensajes['0']= $mensajes['0']. "/ lote o vin repetido";
                }
            }
        }
        if(!$edicion){ // si es un carro nuevo entonces el vin y el lote no deben existir en el
            if($countRepe>0){
                $mensajes['0']= $mensajes['0']. "/ lote o vin repetido";
            }
        }

        $importador =$envio->getDetalleCompra()->getCompra()->getImportador();
        if( is_null($envio->getDetalleCompra()->getAnio()) ){
            $mensajes['0'] = "/ Año obligatorio ";
        }
        $aduana=$envio->getAduana();
        if( $aduana != null){
            if(!$envio->getRepuestos() && $envio->getDetalleCompra()->getAnio()<2013 && $aduana->getDepartamento()->getPais()->getId()==1){
                $mensajes['0']= $mensajes['0']. "/ Este auto es muy viejo para entrar al pais"; 
            }
            if( $importador!= NULL && $envio->getAduana()->getDepartamento()->getPais()->getId()==1 ){
                if( $importador->getSubasta()->getId() == 3 ){
                    $mensajes['0']= $mensajes['0']."/ Este importador no ha sido corregido favor buscar por buyer y asignar la subasta correcta";
                }
            }
        }
        if( $importador!= NULL){
            if($importador->getSubasta()->getId() == 3 ){
                $mensajes['0']= $mensajes['0']. "/ Este importador no ha sido corregido favor buscar por buyer y asignar la subasta correcta";
            }
            if($importador->getEstado()->getId()!=1 ||  $importador->getPersonaCliente()->getEstado()->getId()!=1){
                $mensajes['0']= $mensajes['0']. "/ El importador esta invalidado, podría ser por datos erroneos de importador o de dui en datos personales";
            }
        }
        
        if( $envio->getDetalleCompra()->getTitulo()==null || $envio->getDetalleCompra()->getLlave()==null ){
            $mensajes['0']= $mensajes['0']. "/ Titulo o llave debería almenos ser marcado como pendiente";
        }

        if( $envio->getDetalleCompra()->getCompra()->getTipoCompra()->getId() == 1){
            if($envio->getDetalleCompra()->getCompra()->getImportador() != null) {
                if($envio->getDetalleCompra()->getCompra()->getDealer()!=null 
                || $envio->getDetalleCompra()->getCompra()->getPersonaCliente() !=null )
                $mensajes['0']= $mensajes['0']. "/ El tipo de compra con importador no necesita cliente o dealer";               
            
            } else {
                $mensajes['0']= $mensajes['0']. "/ El tipo de compra con importador necesita que seleccione un importador";
            }
        }
        if ($envio->getDetalleCompra()->getCompra()->getTipoCompra()->getId() == 2){
            if($envio->getDetalleCompra()->getCompra()->getImportador() != null && $envio->getDetalleCompra()->getCompra()->getPersonaCliente() != null) {
                $envio->getDetalleCompra()->getCompra()->setDealer(null);
            }else{
                $mensajes['0']= $mensajes['0']. "/ El tipo de compra con Subimportador necesita que seleccione un importador y un Cliente final";
            }
        }
        if ($envio->getDetalleCompra()->getCompra()->getTipoCompra()->getId() == 3){
            if($envio->getDetalleCompra()->getCompra()->getImportador() == null && $envio->getDetalleCompra()->getCompra()->getPersonaCliente() == null) {
                $mensajes['0']= $mensajes['0']. "/ Debe seleccionar al menos un cliente";
            }
        }
        if ($envio->getDetalleCompra()->getCompra()->getTipoCompra()->getId() == 4)
        {
            if($envio->getDetalleCompra()->getCompra()->getPersonaCliente() != null) {
                $envio->getDetalleCompra()->getCompra()->setDealer(null);
                $envio->getDetalleCompra()->getCompra()->setImportador(null);
            }else {
                $mensajes['0']= $mensajes['0']. "/ El tipo de compra Vehiculo particular necesita que seleccione un Cliente final";
            }
        }
        if( $envio->getDetalleCompra()->getCompra()->getTipoCompra()->getId() ==5){
            if($envio->getDetalleCompra()->getCompra()->getImportador() == null && 
                $envio->getDetalleCompra()->getCompra()->getPersonaCliente() == null ){
                $mensajes['0']= $mensajes['0']. "/ Por favor seleccione un cliente o un importador";  
            }
            $envio->getDetalleCompra()->getCompra()->setCompraEstado(20);
        }else{
            $envio->getDetalleCompra()->getCompra()->setCompraEstado(1);
        }
        if($envio->getDetalleCompra()->getLote() ==null && $envio->getDetalleCompra()->getVin() == null){
            $mensajes['0']= $mensajes['0']. "/ Es necesario insertar el numero de VIN o el LOTE al menos";
        }
        if($envio->getEnYarda() && $envio->getDetalleCompra()->getGrua() ){
            $mensajes['0']= $mensajes['0']. "/ Si el auto esta en yarda, para que necesita grua?";
        }
        if($envio->getEnYarda()){
            $envio->getDetalleCompra()->getCompra()->setCompraEstado(3);
        }

        if( $envio->getDetalleCompra()->getCompra()->getTipoCompra()->getId()==5 ){
            if( !$envio->getDetalleCompra()->getGrua()  ){
                $mensajes['0']= $mensajes['0']. "/ Las gruas internas obligatoriamente requieren grua";    
            }
            if($envio->getFlete()!=null){
                if( $envio->getFlete()->getId() != 10000 ){
                    $mensajes['0']= $mensajes['0']. "/ El tipo de flete debe ser grua interna";    
                }
            } 
            if( $envio->getAduana()!=null && $envio->getAduana()->getId()!= 8 ){
                $mensajes['0']= $mensajes['0']. "/ Las gruas internas no necesitan aduana de destino, selecciona la opción ninguna";    
            }
        }

        if( $envio->getAduana()==null &&  $envio->getDetalleCompra()->getCompra()->getTipoCompra()->getId()!=5 ){
            $mensajes['0']= $mensajes['0']. "/ Debe seleccionar una aduana si aun no tiene el dato seleccione 'ninguna'";    
        }
        if($envio->getEnCola()!=null ){
            $mensajes['0']= $this->validarEnvioColaCombinacion($envio, $mensajes, $detalleCompraRepo )['0'];
        }
        //$codi= $this->getParameter('CODIGO_DESCUENTOS_FLETE_GRUA');
        return $mensajes; 
    }

    public function validarEnvioColaCombinacion(Envio $envio, $mensajes, DetalleCompraRepository $detalleCompraRepo){
        if($envio->getFlete() == null){
            $mensajes['0']=$mensajes['0'] . "/ selecciona la yarda de partida";
        }else
        if( $envio->getFlete()->getYarda() == null){
            $mensajes['0']=$mensajes['0'] . "/ para poner en cola debes: marcar la yarda de partida";
        }
        if( $envio->getDetalleCompra()->getVin() == null){
            $mensajes['0']=$mensajes['0'] . "/ para poner en cola en auto necesita vin";
        }
        if( $envio->getDetalleCompra()->getCompra()->getFacturas() == null){
            $mensajes['0']=$mensajes['0'] . "/ para poner en cola necesitas subir la factura";
        }
        if( is_null($envio->getGruaPrecio()) || is_null($envio->getPrecioFlete())){
            $mensajes['0']=$mensajes['0'] . "/ El precio de grua o flete debería ser almenos 0";
        }

        if( is_null ($envio->getDetalleCompra()->getVin()) || is_null($envio->getAduana()) ){
            $mensajes['0']=$mensajes['0'] . "/Al poner en cola los campos aduana, vin, factura, precio de grua y flete no pueden estan vacios ";
        }
        if( $envio->getDetalleCompra()->getCompra()->getCompraEstado() != 4 ){
            $mensajes['0']=$mensajes['0'] . "/El carro no está en estado 4 (en yarda) ";
        }

        return $mensajes; 
    }
}