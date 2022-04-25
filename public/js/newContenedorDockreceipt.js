
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
    var listaSelect
    var limiteFilas=9;

aduanaCom.change(function(){
    getEnviosValidos();
    vaciarTabla();
});
yardaCom.change(function(){
    getEnviosValidos();
    vaciarTabla();
});
getEnviosValidos(); //PreCarga en caso de un fallo reinicializar 

$(".tablaAutosFiltrados").on('focusout', function(){
    vari = $(this);
    var j=parseInt(vari[0].id.substr(28,1));
    var columna=  vari[0].id.substr(30,vari[0].id.length);
    perderFoco(j, columna);
    updatePeso();
});
function perderFoco(j, columna){
    var celda= document.getElementById("contenedor_envioContenedors_"+j+"_"+columna);
    comboListaAutos= $("#contenedor_listaAutos"); 
    comboListaAutos[0];
    comboListaAutos= $("#contenedor_listaAutos");
    var envio=$('#contenedor_envioContenedors_'+j+'_envio').val( );
    var position=null;  
    for(var i=0; comboListaAutos.length; i++){ 
        if(comboAutos[0][i].value== envio){
            console.log(i); console.log(comboListaAutos[0][i].value);
            var ttt= comboListaAutos[0][i]; 
            console.log( celda );
            ttt.setAttribute('data-'+columna, celda.value);
            break;
        }
    }  
}
contenedorCom.change(function(){
    updatePeso();
});
function updatePeso(){
   
    if(typeof listaSelect !== 'undefined' && comboAutos !== 'undefined' ){
        listaSelect= comboAutos.find(':selected');
        pesoAutos=0;
        for( i=0; i<listaSelect.length; i++ ){
            if( typeof listaSelect[i].dataset.peso !== 'undefined'){
                pesoAutos= pesoAutos+ parseFloat(listaSelect[i].dataset.peso);
            }    
        }
        for( i=0; i<9; i++ ){
            var campo= "#contenedor_refacciones_"+i+"_peso";
            var pesoi= $(campo).val();
            if( typeof pesoi !== 'undefined'){
                pesoAutos= pesoAutos+ parseFloat( pesoi );
            }  
        }
    }
    if(contenedorCom[0].options[contenedorCom[0].selectedIndex ].dataset.peso==''){
        listaSelect[i].dataset.peso=0;
    }
    var pesoCombo= contenedorCom[0].options[contenedorCom[0].selectedIndex ].dataset.peso;
    var totalPeso= parseFloat(pesoCombo) + parseFloat(pesoAutos);
    $("#capacidadPeso").empty();
    $("#capacidadPeso").append(totalPeso);
}
document.getElementById('contenedor_listaAutos').innerHTML = "<option value>Seleccione Yarda y Aduana</option>";

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
                    //$("#contenedor_listaAutos").append('<option value> Seleccione los autos ...</option>'); //+ $("#contenedor_listaAutos").find("option:selected").text() + 
                    for (  i = 0 ; i < data.length; i++){ //cuenta la cantidad de registros
                        var fecha= data[i].creacion.date.substring(0,10);
                        var nuevafila= 
                        '<option value="'+data[i].id    +'" data-lote="'+data[i].lote+'" data-vin="'+data[i].vin
                        +'" data-modelo="'+data[i].modelo  +'" data-marca="'+data[i].marca 
                        +'">' +data[i].identificador +'-'+data[i].modelo+'-'+fecha+"</option>";
                        $("#contenedor_listaAutos").append(nuevafila);
                        console.log( 'cargando pedidos222' );
                    }
                    comboAutos= $('#contenedor_listaAutos' ).select2();
                    comboAutos.on("change", function (e) { 
                        listaSelect= comboAutos.find(':selected');
                        llenarTabla();
                        selectedValuesTEMP= [];
                        listaSelect.each(function(){
                            selectedValuesTEMP.push($(this).val()); 
                        });
                    });
                    console.log('ajax');
                    //vaciarTabla()
                }
            },
            error: function (err) {
                alert(err);
            }
        });
    }
};

function llenarTabla() {
    selectedValues= [];
    listaSelect.each(function(){
        selectedValues.push($(this).val()); 
    });
    console.log(selectedValuesTEMP);
    console.log(selectedValues);
    if(selectedValuesTEMP.length>selectedValues.length){ 
        var difference = $.grep(selectedValuesTEMP, (item) => $.inArray(item, selectedValues) === -1);
        console.log(difference);
        for(var i=0; i<limiteFilas && difference.length>0; i++){
            if($('#contenedor_envioContenedors_'+i+'_submodelo').val=difference[0]){
            $('#contenedor_envioContenedors_'+i+'_envio').val('');
                vaciarFila(i);
            } 
        }
    };
   
    if( listaSelect.length>0 ){
        pesoAutos=0;
        for( i=0; i<listaSelect.length; i++ ){
            $('#contenedor_envioContenedors_'+i+'_envio').val( listaSelect[i].value); 
            $('#contenedor_envioContenedors_'+i+'_lote').val( listaSelect[i].dataset.lote);
            $('#contenedor_envioContenedors_'+i+'_vin').val( listaSelect[i].dataset.vin);
            $('#contenedor_envioContenedors_'+i+'_vehiculo').val(listaSelect[i].dataset.marca+'-'+listaSelect[i].dataset.modelo );
            $('#contenedor_envioContenedors_'+i+'_aes').val(listaSelect[i].dataset.aes ); 
            $('#contenedor_envioContenedors_'+i+'_submodelo').val(listaSelect[i].dataset.submodelo ); 
            $('#contenedor_envioContenedors_'+i+'_peso').val(listaSelect[i].dataset.peso ); 
            $('#contenedor_envioContenedors_'+i+'_color').val(listaSelect[i].dataset.color );  
        }
        updatePeso(  );
    }

    llenarComboboxs();
};
function llenarComboboxs(  ){
    listaSelect= comboAutos.find(':selected');
    var contentChoiceOptions="<option value>Seleccione un vin o lote</option>";
    if( listaSelect.length>0 ){
        for( i=0; i<listaSelect.length; i++ ){
            contentChoiceOptions= contentChoiceOptions+"<option value="+listaSelect[i].value+">"+listaSelect[i].dataset.lote+"-"+listaSelect[i].dataset.vin+"</option>";
        }
    }
    var contentChoice="";
    for( i=0; i<9; i++ ){
        contentChoice= 
            "<select id='contenedor_refacciones_"+i+"_autoRecipiente' name='contenedor[refacciones]["+i+"][autoRecipiente]'>"+
            contentChoiceOptions+
            "</select>";
        posicion="#comboRefac"+i;
        $(posicion).html('');
        $(posicion).html(contentChoice);
        var id= "#contenedor_refacciones_"+i+"_autoRecipiente";
        $( id ).select2();

    }
}

function corrigiendoRequireds(){
    for( i=0; i<9; i++ ){
        var elemento="#contenedor_refacciones_"+i+"_autoRecipiente";
        $(elemento).prop('required',false);    
    } 
}
corrigiendoRequireds();

function vaciarFila(i){
    console.log('vaciado fila');
    $('#contenedor_envioContenedors_'+i+'_submodelo').val( '' ); 
    $('#contenedor_envioContenedors_'+i+'_peso').val( '' ); 
    $('#contenedor_envioContenedors_'+i+'_aes').val( '' );
    $('#contenedor_envioContenedors_'+i+'_color').val( '' ); 
    $('#contenedor_envioContenedors_'+i+'_envio').val( '' ); 
    $('#contenedor_envioContenedors_'+i+'_lote').val( '' );
    $('#contenedor_envioContenedors_'+i+'_vin').val( '' );
    $('#contenedor_envioContenedors_'+i+'_vehiculo').val( '' ); 
}

function vaciarTabla(){
    for(var i=0; i<limiteFilas; i++){
       vaciarFila(i); 
    }
}


function oyentes(){
    
    for(var j=0; j<limiteFilas; j++){
        var PREDATA= '#contenedor_envioContenedors_'+j;
        var submodelo=$(PREDATA+'_submodelo');
        var peso=$(PREDATA+'_peso');
        var aes=$(PREDATA+'_aes');
        var color=$(PREDATA+'_color');
    } 
}

//object.onfocusout = function(){myScript};