
var ArrayEnvios= Array();
var ArraySubModelos= Array();
var yardaCom= $("#contenedor_yarda");
var aduanaCom= $("#contenedor_aduana");
var contenedorCom= $("#contenedor_tipoContenedor");
var pesoAutos=0
var comboAutos;
var aduanaTemp=0;
var puertoTemp=0;
    var selectedValues = [];
    var selectedValuesTEMP = [];
    var listaSelect;
    var comboListaAutos= $("#contenedor_listaAutos"); 
getEnviosValidos(); //PreCarga en caso de un fallo reinicializar 


function getEnviosValidos(){
    console.log( 'cargando pedidos' );
    puertoTemp= parseInt( yardaCom.val());
    aduanaTemp= parseInt( aduanaCom.val());
    if(puertoTemp>0 && aduanaTemp>0){
        $.ajax({
                url: window.location,
                type: "POST",
                dataType: "JSON",
                data: {
                    yarda: puertoTemp,
                    aduana: aduanaTemp
                },
            success: function (data) {
                $("#contenedor_listaAutos").empty();
                if(data.length>0){
                    $("#contenedor_listaAutos").append('<option value> Seleccione los autos ...</option>'); //+ $("#contenedor_listaAutos").find("option:selected").text() + 
                    for (  i = 0 ; i < data.length; i++){ //cuenta la cantidad de registros
                        var fecha= data[i].creacion.date.substring(0,10);
                        var nuevafila= 
                        '<option value="'+data[i].id    +'" data-lote="'+data[i].lote+'" data-vin="'+data[i].vin
                        +'" data-modelo="'+data[i].vehiculo 
                        +'">' +data[i].identificador +'-'+data[i].modelo+'-'+fecha+"</option>";
                        $("#contenedor_listaAutos").append(nuevafila);
                        console.log( 'cargando pedidos222' );
                    }
                    comboAutos= $('#contenedor_listaAutos' ).select2();
                    
                    console.log('ajax');
                }
            },
            error: function (err) {
                alert(err);
            }
        });
    }
};

comboListaAutos.change(function(){
    llenarTabla();
});

function llenarTabla() {
    console.log('asas');
    const els = document.querySelector('#contenedor_listaAutos');
    $('#envio_contenedor_envio').val(els.options[els.selectedIndex].value); 
    $('#envio_contenedor_lote').val( els.options[els.selectedIndex].dataset.lote);
    $('#envio_contenedor_vin').val( els.options[els.selectedIndex].dataset.vin);
    $('#envio_contenedor_vehiculo').val(els.options[els.selectedIndex].dataset.marca );
    $('#envio_contenedor_aes').val(els.options[els.selectedIndex].dataset.aes ); 
    $('#envio_contenedor_submodelo').val(els.options[els.selectedIndex].dataset.submodelo ); 
    $('#envio_contenedor_peso').val(els.options[els.selectedIndex].dataset.peso ); 
    $('#envio_contenedor_color').val(els.options[els.selectedIndex].dataset.color );  
};


//object.onfocusout = function(){myScript};