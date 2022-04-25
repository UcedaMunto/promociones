
var vectorTablas= Array();
var htmTablas= Array();
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
}

function escanerElements(){// ESCANEA EL CUERPO DE LA PANTALLA PARA BUSCAR LOS SELECT A Y LAS TABLAS CON ID='tabla_' para darles formato
    var children = document.getElementById('layoutSidenav_content').getElementsByTagName('*');
    for(var i = 0; i<children.length; i++){
        var t = children.item(i);
        if(children.item(i).tagName== "TABLE" && children.item(i).id.includes('tabla_')){
            htmTablas.push(children.item(i));//tables( children.item(i) );
        }
    }
    for(var i=0; i<htmTablas.length;i++ ){
        tables(htmTablas[i]); 
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
        /*    $(idTabla+' thead tr').clone(true).appendTo( idTabla+' thead' );
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
        /*
        //*---------------------------------- FIN BUSCADORES POR COLUMNA  */
        console.log(idTabla);
        var table= $(idTabla).DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": window.location.href,
                "type": "POST",
                "headers": {
                    'data':1
                }
            },
            "columns": [
                { "data": "envio_id" },
                { "data": "detalle_compra_id" },
                { "data": "compra_id" },
            ],
            "order": [[1, 'asc']],
           
            /*
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
            }*/
        });
        /*
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
   
        
        */

    vectorTablas[ vectorTablas.length ]= table;
    }(item, "parametro2"));
}


