
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
  comboVector[ comboVector.length ]=$('.myselect' ).selectize(); //GUARDA UN VECTOR CON TODOS LOS COMBOBOX PARA MANEJARLOS LUEGO - EN ORDEN DE ARRIBA A BAJO
}
function datepik(){
    $(".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd' } );
}
function tables(item ){
    (function (item, dos,) {
    idTabla='#'+item.id;

        //*----------------------------------BUSCADORES POR COLUMNA  */
           
        //*---------------------------------- FIN BUSCADORES POR COLUMNA  */
        var table= $(idTabla).DataTable({
            "order": [[ 0, "desc" ]],
            select: true,
            "scrollY":        "720px",
            "scrollCollapse": true,
            "paging":         true,
            
            columnDefs: [
               

            ]
        });

        $('a.toggle-vis').on( 'click', function (e) {
            e.preventDefault();
     
           
            // Get the column API object
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


