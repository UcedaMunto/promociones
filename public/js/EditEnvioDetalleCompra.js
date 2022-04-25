var tipoCompra= $("#envio_detalleCompra_compra_tipoCompra");


var envio_GruaPrecio= $("#envio_GruaPrecio");
var envio_precioFlete= $("#envio_precioFlete"); //envio_precioBL //envio_storageCostos
var envio_precioBL= $("#envio_precioBL");
var envio_cantidad= $("#envio_cantidad"); 

ocultarCampos();

tipoCompra.change(function(){
    ocultarCampos();
    comboVector[0][1].selectize.setValue(-1, false); //REINICIAR LOS VALORES DE COMBOBOX DEALER, IMPORTADOR, CLIENTE
    comboVector[0][2].selectize.setValue(-1, false);
    comboVector[0][3].selectize.setValue(-1, false);
});

function ocultarCampos(){
    if(tipoCompra.val()=="1"){
        $("#importador").removeClass("intangible");
        $("#dealer").addClass("intangible");
        $("#subimportador").addClass("intangible");
    }
    if(tipoCompra.val()=="2"){
        $("#dealer").addClass("intangible");
        $("#subimportador").removeClass("intangible");
        $("#importador").removeClass("intangible");
    }
    if(tipoCompra.val()=="3"){
        $("#dealer").removeClass("intangible");
        $("#subimportador").removeClass("intangible");
        $("#importador").removeClass("intangible");
    }
    if(tipoCompra.val()=="4"){
        $("#dealer").addClass("intangible");
        $("#subimportador").removeClass("intangible");
        $("#importador").addClass("intangible");
    }
    if(tipoCompra.val()=="5"){
        $("#dealer").addClass("intangible");
        $("#subimportador").removeClass("intangible");
        $("#importador").addClass("intangible");
    }
}

var envio_flete= $("#envio_flete");
envio_flete.change(function(){
    var t= $("#envio_flete").text(); t=t.split('- $');
    //alertify.alert('El precio aproximado de flete es: '+t[1] );
    calcularCantidad();
});
tipoCompra.change(function(){
    if(tipoCompra.val()=='5')alertify.success( 'Recuerde seleccionar tipo flete grua interna');
});

var envio_detalleCompra_zonaSucursal= $("#envio_detalleCompra_zonaSucursal");
envio_detalleCompra_zonaSucursal.change(function(){
    var t= $("#envio_detalleCompra_zonaSucursal").text(); t=t.split('- $');
    
    //alertify.alert('El precio aproximado de grua es de: '+t[1] );
    calcularCantidad();
});

var envio_ciudad= $("#envio_detalleCompra_zonaGrua");
envio_ciudad.change(function(){
    var t= $("#envio_detalleCompra_zonaGrua").text(); t=t.split('- $');

    alertify.alert('El precio aproximado es de: '+t[1] );
    calcularCantidad();
});

tipoCompra.change(function(){
    ocultarCampos();
    comboVector[0][1].selectize.setValue(-1, false); //REINICIAR LOS VALORES DE COMBOBOX DEALER, IMPORTADOR, CLIENTE
    comboVector[0][2].selectize.setValue(-1, false);
    comboVector[0][3].selectize.setValue(-1, false);
});

envio_GruaPrecio.change(function(){ calcularCantidad(); });
envio_precioFlete.change(function(){ calcularCantidad(); });
envio_precioBL.change(function(){ calcularCantidad(); });

function calcularCantidad(){
    var dato=0;
    if ( !isNaN(  parseFloat( envio_GruaPrecio.val() ))) {
        dato= parseFloat( envio_GruaPrecio.val() );
    }
    if ( !isNaN(   parseFloat( envio_precioFlete.val() ))) {
        dato= dato+ parseFloat( envio_precioFlete.val() );
    }
    if ( !isNaN(  parseFloat( envio_precioBL.val() ))) {
        dato= dato+ parseFloat( envio_precioBL.val() );
    }
    envio_cantidad.val("Total: "+dato);
}


/**______________________validaciones valladares_______________________*/


var x = document.getElementById("envio_dato");
x.envio_detalleCompra_lote.addEventListener("blur", myBlurFunction, true);

tipoCompra.change(function(){                   
    if(tipoCompra.val()=="3"){
        $('#envio_detalleCompra_compra_dealer').prop('required', true);         //para que cuando se escoja el tipo de compra dealer sea necesario poner el nombre del dealer      
    } else {
        //alertify.error('Error message');       
        $('#envio_detalleCompra_compra_dealer').prop('required', false);        //quita el required del campo dealer cuando no se selecciona dealer
    }
    if(tipoCompra.val()=="5"){

        $('#enio_flete').prop('hidden', true);
        //alertify.error('Error message');     
        //$("#envio_flete option[value=10000]").attr('selected', true);           //cuando se seleccione servicio sin grua automaticante este campo va a cambiar a flete degrua interna $0
    }
    
});


$('#envio_dato').submit(function() {            //para que no se enie el formulario dos veces seguidas
$(':submit').attr('disabled', 'disabled');  
});

function myBlurFunction() {
    //this.style.backgroundColor = ""; 
 $algo =  $('#envio_detalleCompra_lote').val();

 if ( $algo.length < 8 ) 
    
   alertify.error('El LOTE debe contener al menos 8 caracteres');   

}
    
/**_________________________________fin___________________________________*/


$("#btnEditar").click(function(event){        
    event.preventDefault();      
    if(!document.getElementById('envio_dato').reportValidity()){
        console.log('validacion del formulario fallo') 
    } else {
   // $('#GruaPrecio44').checkValidity();  
    edit();
}
});


function edit() 
{   
    if (fileValidation() != false) {
        var formularioCliente= document.getElementsByName('envio');
        var parametros = new FormData($("#envio_dato")[0]);
        console.log(formularioCliente[0].action);

        
        $.ajax({
            url: formularioCliente[0].action,
            type: "POST",
            headers: {
                
            },
            data: parametros,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforesend: function(){

            },
            success: function(data){
               
                if(data.mensajes[0]!='') {
                    alertify.error('Error: ' + '\n' + data.mensajes[0]);
                
                } else {
                    alertify.success('Se guardo con extio');
                    document.getElementById("factura").innerHTML = data.htm;  
                
                    //ruta = formularioCliente[0].action.substring(0, ruta.length - 4);
                    //console.log(ruta);
                    //window.location.replace(ruta);

                }
                
            },
            error: function (err) {
               alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
            
            }
        });
        

    } else {
        alert('Problemas al intentar subir algun archivo');
    }
}



function fileValidation(){
    var fileInput = document.getElementById('envio_detalleCompra_compra_facturas');
    var filePath = fileInput.value;

    console.log(filePath);
    if(filePath != ''){
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif|.pdf|.PDF|.PNG|.heic)$/i;   
    if(!allowedExtensions.exec(filePath)){
        alert('Debe subir un archivo con extension .jpeg/.jpg/.png/.gif/.pdf/.heic');
        fileInput.value = '';
        document.getElementById("btnenvio").onclick = function(event) {
            event.preventDefault();
            validarEnvioNew();
        };
        return false;
    } else {
        return true;
    }
} else {
    alert('No se ha subido archivo');
    return true;
}
    
}