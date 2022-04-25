var tipoPuertoUbicacion= $("#puertos_tipoPuerto");
ocultarCampos();

tipoPuertoUbicacion.change(function(){
    ocultarCampos();
    comboVector[0][1].selectize.setValue(-1, false);
    comboVector[0][2].selectize.setValue(-1, false);

});

function ocultarCampos(){
    if(tipoPuertoUbicacion.val()=="0"){
        $("#ciudad").show();
        $("#departamento").hide();

       //$("#ciudad").removeClass("intangible");
       // $("#departamento").addClass("intangible");
       
    }else{
        if(tipoPuertoUbicacion.val()=="1"){
            $("#ciudad").hide();
            $("#departamento").show();
          //  $("#ciudad").addClass("intangible");
            //$("#departamento").removeClass("intangible");
    
        }else{
            $("#ciudad").hide();
            $("#departamento").hide();
        }
    }


    
    
}