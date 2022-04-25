
var vectorTablas= Array();
var comboVector= Array();
var integridadEnvio=true;
var visibleFiltroFecha=false;

combosBoxs();
datepik();

    document.getElementById("filtroFechaButton").onclick = function() {
        verFiltro();
    };

function verFiltro() {
    if(visibleFiltroFecha){
        visibleFiltroFecha=false;
        $("#filtroFecha").addClass("intangible");
    }else{ 
        visibleFiltroFecha=true;
        $("#filtroFecha").removeClass("intangible");
    }
    console.log('precionado');
    
}

function listar(){
    var listaDetexto= $("#multi_select_car_lista"); 
        listaDetexto= listaDetexto.val();
    var ttt= listaDetexto.split(/\n/);
    return validar( ttt );
}
function validar( ttt ){
    lotes=vectorTablas[0].column(3).data().toArray();
    vines=vectorTablas[0].column(4).data().toArray();
    validos=[];
    invalidos=[];
    ttt.forEach(recorriendo);
    function recorriendo(element) {
        if( (lotes.includes(element) ||  vines.includes(element) ) && element !="" ){
            validos.push(element); 
        }else{
            if(element !=""){
                invalidos.push(element); 
            }  
        }
    }

    validos=[ validos, invalidos ];
    return validos;
}

/*
$(function () {
    var frm = $('#formularioLista');
    frm.submit(function (ev) {
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                alert('ok');
            }
        });
        ev.preventDefault();
    });
});*/

function sendLista(tipo){
    var frm = $('#formularioLista');
    var dataForm= [];
    dataForm.push({name: "tipo", value: tipo});
    dataForm.push({name: "multi_select_car", value: listar()});
    $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data:   $.param(dataForm) ,
        success: function (data) {
            if(data.exito==1){
                alertify.success('Listo!');
                if( data.mensajes[0]!='' ){
                    var contenedor= document.getElementById("msjExito");
                    contenedor.innerHTML= data.mensajes[1];

                    var contenedor2= document.getElementById("msjError");
                    contenedor2.innerHTML= data.mensajes[0];
                    $("#msjExito").removeClass("intangible");
                    $("#msjError").removeClass("intangible");
                }
            }else{
                alertify.error('Error en el sistema: 88459656232656!');
            }
        }
    });
}

$("#aYarda").click(function(ev){
    ev.preventDefault()// cancel form submission
    sendLista(2);
});
$("#enGrua").click(function(ev){
    ev.preventDefault()// cancel form submission
    sendLista(1);
});

function escanerElements(){// ESCANEA EL CUERPO DE LA PANTALLA PARA BUSCAR LOS SELECT A Y LAS TABLAS CON ID='tabla_' para darles formato
    var children = document.getElementById('layoutSidenav_content').getElementsByTagName('*');
    for( var i = 0; i<children.length; i++){
        var t = children.item(i); 
        if(children.item(i).tagName== "TABLE" && children.item(i).id.includes('tabla_')){
            console.log('tabla encontrada'+children.item(i).id);
            tables( children.item(i) );
        }
    }
    
}
escanerElements();

function combosBoxs(){
  $( '.myselect2' ).select2();
  comboVector[ comboVector.length ]=$('.myselect' ).selectize(); //GUARDA UN VECTOR CON TODOS LOS COMBOBOX PARA MANEJARLOS LUEGO - EN ORDEN DE ARRIBA A BAJO
}
function datepik(){
    $(".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd' } );
}
function tables(item ){
    (function (item, dos,) {
    idTabla='#'+item.id;

        //*----------------------------------BUSCADORES POR COLUMNA  */
            $(idTabla+' thead tr').clone(true).appendTo( idTabla+' thead' );
            $(idTabla+' thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                            
                    }
                } );
            } );
        //*---------------------------------- FIN BUSCADORES POR COLUMNA  */
        var table= $(idTabla).DataTable({
            "order": [[ 0, "desc" ]],
            select: true,
            "scrollY":        "400px",
            "scrollCollapse": true,
            "paging":         true,
            "sScrollX": "100%",
            columnDefs: [
            ],
            "createdRow": function( row, data, dataIndex ) {
                if ( data[5] == 0 ) {
                  $(row).addClass( 'comp0' ); 
                }else if ( data[5] == 1 ) {
                    $(row).addClass( 'comp1' );
                }else if ( data[5] == 2 ) {
                    $(row).addClass( 'comp2' );
                }else if ( data[5] == 3 ) {
                    $(row).addClass( 'comp3' );
                }else if ( data[5] == 4 ) {
                    $(row).addClass( 'comp4' );
                }else if ( data[5] == 5 ) {
                    $(row).addClass( 'comp5' );
                }else if ( data[5] == 6 ) {
                    $(row).addClass( 'comp6' );
                }else if ( data[5] == 7 ) {
                    $(row).addClass( 'comp7' );
                }else if ( data[5] == 8 ) {
                    $(row).addClass( 'comp8' );
                }else if ( data[5] == 9 ) {
                    $(row).addClass( 'comp9' );
                }else if ( data[5] == 10 ) {
                    $(row).addClass( 'comp10' );
                }else if ( data[5] == 20 ) {
                    $(row).addClass( 'comp20' );
                }
            }
        });

        $('a.toggle-vis').on( 'click', function (e) {
            e.preventDefault();
            var column = table.column( $(this).attr('data-column') );
            // Toggle the visibility
            column.visible( ! column.visible() );
        } );

        table.on('click', 'tr', function() {
            $(this).toggleClass('selected');
            //validarSeleccionados();
        });
   
        vectorTablas[ vectorTablas.length ]= table;

        document.querySelectorAll( tablaStr+' a' ).forEach(item => {
            item.addEventListener('click', event => {
            event.preventDefault();
            console.log("boton de tabla");
                    
            })
        })
      }(item, "parametro2"));
}
/*
function validarSeleccionados(){
    var ite = vectorTablas[0].rows('.selected').data(); //OBTENER EL VALOR DE LAS LINEAS SELECCIONADAS CON SUS IDS
    for (var i = 0; i < ite.length; i++) { //RECORRER LA LISTA BUSCADO SI UNA LINEA TIENE MAL SU PUERTO Y ADUANA
        if(i>0 && ite[i-1][3] != ite[i][3]){
            integridadEnvio=false;
            alertify.error('Uno de los vehículos no tiene la misma aduana');
            //break;
        }
        if(i>0 && ite[i-1][4] != ite[i][4]){
            integridadEnvio=false;
            alertify.error('Uno de los vehiculo no tiene el mismo puerto de salida');
            //break;
        }
        console.log( ite[i]  );
    }
    console.log( '------------------------------------------------------------------' );
}*/


