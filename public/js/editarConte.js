

function edit($id) {    
        // var formularioAcuerdo= document.getElementsByName('envio_contenedor');
        var form= $("#movimiento_"+$id).serialize(); //llamar al objeto con jquery, de preferencia usar el id
                
        // El problema es que la segunda ves que se intenta serializar el formulario no funciona el metodo serializr()

       console.log(form);
        //event.preventDefault();  
        $.ajax({
            url: 'editarCuentas/'+$id+'/',
            type: "POST",
            headers: {
                'banderaHeader':'EditarC'
            },
            data:  form, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
            dataType: 'json',
            success: function (data) {

                if(data.mensajes[0]!=''){
                    alertify.error(data.mensajes[0], -1);                    
                   // document.getElementById("avisoerror").innerHTML=data.mensajes[0];
                } else {
                    alertify.success('Se guardo con extio');
                    
                    //$('#costoFlete'+$id).attr('data-campo', $('#costoFlete'+$id).val());
                    //$('#regis'+$id).html(data.htm).fadeIn();   

                   // console.log(data.htm);
                
                    document.getElementById("regis"+$id).innerHTML = data.htm;                    
                    recargar();                     

                    //alert( $('#costoFlete'+$id).val());
                    
                                   
                }

                /*
                document.getElementById("acuerdo").innerHTML=data.htm;
                formatElements("acuerdo");
                document.getElementById("ListaAcuerdo").innerHTML=data.htmu;
                formatElements("ListaAcuerdo");
                $('#tabla_acuerdos').dataTable({
                    "order": [[ 0, "desc" ]],
                });

                document.getElementById("btnAcuerdos").onclick = function(event) {
                    event.preventDefault();
                    guardarAcuerdo();
                };
                $("#form_acuerdo")[0].reset();
            */
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });        
        
    }

recargar();

    function recargar() {

        $(".botona").click(function(event){        
            event.preventDefault();  
            $id = this.id;
            if(!document.getElementById('movimiento_'+$id).reportValidity()){
        
            } else {
           // $('#GruaPrecio44').checkValidity();  
            edit($id);
        }
        });

        jQuery(document).ready(function()
{
   jQuery(".numerico").keypress(function(tecla)   
   {     
      if( tecla.charCode != 46 && (tecla.charCode < 48 || tecla.charCode > 57) )
      {
         return false;
      }
   });
});




jQuery(".numerico").click(function(tecla)
{
    var attr = $(this).attr('data-campo');

    if (typeof attr !== typeof undefined && attr !== false) {
    } else {
    $losdatos = $(this).val();
    $(this).attr('data-campo', $losdatos);
    }
    
});


$(".numerico").blur(function()
{    
    $dat = $(this).data('campo');
    $dato = $(this).val();

    if ($dat == $dato) {    
        $(this).removeClass('text-danger');   
    } else {               
        $(this).addClass('text-danger');
    }
});


}

    




    