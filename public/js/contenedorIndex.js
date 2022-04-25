var vectorTablas= Array();
var htmTablas= Array();
var comboVector= Array();
var visibleFiltroFecha=false;

const iconos = document.querySelectorAll('.icono');
const btnTrack = document.querySelectorAll('.track_contenedor');
document.getElementById("filtroFechaButton").onclick = function() {
    verFiltro();
};
document.getElementById("guardarFechas").onclick = function() {
    guardarFechas();
};
function guardarFechas(){
    
    $.ajax({
        url: document.getElementById('form_fechas').action,  // Se envia la peticion al controlador la funion 'show' porque es donde estamos a este punto
        type: "POST",               
        dataType: "JSON",           // El tipo de dato qe se va a recibir es un JSON
        data: $('#form_fechas').serialize(),
        success: function (data) {  // El metodo que ejecuta con lo que recibe del controlador
            alertify.success( data.mensajes[1] );
            
        },
        error: function (err) {                     // Si hay algun error y al enviar la peticion al controlador 
            alert(err);     
        }
    });
}

btnTrack.forEach(el => el.addEventListener('click', event => { 
    event.preventDefault();
    $.ajax({
        url: event.srcElement.href,  // Se envia la peticion al controlador la funion 'show' porque es donde estamos a este punto
        type: "POST",               
        dataType: "JSON",           // El tipo de dato qe se va a recibir es un JSON
        data: {
            page: 0,                // Es una bandera nomas para decirle al index del controlador que ejecute el codigo para retornarnos los datos de las imagenes que requerimos
        },
        success: function (data) {  // El metodo que ejecuta con lo que recibe del controlador 
            $('#gridSystemModal').modal('show');
            document.getElementById('contenido').innerHTML= data.htm;
            document.getElementById('gridModalLabel').innerText='Fechas de contenedor (booking: '+ data.booking +', id:'+ data.id+')';
            var recalcarPaso = document.querySelectorAll('.recalcarPaso');
            for(var i=0; i<recalcarPaso.length; i++){
                recalcarPaso[i].onchange = function(event){
                    document.getElementById('imagenDescriptiva').src=window.location.origin+'/images/trackContenedor/'+event.target.name+'.jpg';
                };
            }
            formatElements('contenido');
        },
        error: function (err) {                     // Si hay algun error y al enviar la peticion al controlador 
            alert(err);     
        }
    });
}));

function verFiltro() {
    if(visibleFiltroFecha){
        visibleFiltroFecha=false;
        $("#filtroFecha").addClass("intangible");
    }else{ 
        visibleFiltroFecha=true;
        $("#filtroFecha").removeClass("intangible");
    }
}


iconos.forEach(el => el.addEventListener('click', event => { 
    //console.log( event.srcElement.dataset.id_contenedor );
    //console.log( event.srcElement.dataset.estado );
    var estado= event.srcElement.dataset.estado;
    if(estado == 1){
        estado='cargando';
    }else if(estado == 2){
        estado='en camino';
    }else if(estado == 3){
        estado='en espera de descarga';
    }else if(estado == 4){
        estado='descargando';
    }else if(estado == 5){
        estado='descargado';
    }
    alertify.confirm(
        'CONFIRME', 'Si, marcar como '+ estado, 
        function(){ 
            marcar( event.srcElement.dataset.id_contenedor, event.srcElement.dataset.estado);
        }
        ,function(){ 
            alertify.error('CANCELADO', -1)
        }
    );
}));

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
function formatElements($idElemento){
    var children = document.getElementById($idElemento).getElementsByTagName('*');
    for( var i = 0; i<children.length; i++){
        var t = children.item(i);
        var clases= children.item(i).classList;
        element= "#"+children.item(i).id;
        if(clases.contains('datepicker') && element!= "#"){
            $(element).datepicker({
                    dateFormat: 'yy-mm-dd', numberOfMonths: 2,
                    showButtonPanel: true, changeMonth: true,
                    changeYear: true 
                }
            );
        }
        if(clases.contains('myselect') && element!= "#"){
            $(element).selectize();
        }

        if(clases.contains('myselect2') && element!= "#"){
            $(element).select2();
        }
    }
}

escanerElements();
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
        console.log(idTabla);
        var table= $(idTabla).DataTable({
            "order": [[ 0, "desc" ]],
            select: true,
            "scrollY":        "500px",
            "scrollCollapse": true,
            "paging":         true,
            "sScrollX": "100%",
            "createdRow": function( row, data, dataIndex ) {
                if (       data[19] == 0 ) {
                  $(row).addClass( 'comp0' ); 
                }else if ( data[19] == 1 ) {
                    $(row).addClass( 'comp1' );
                }else if ( data[19] == 2 ) {
                    $(row).addClass( 'comp2' );
                }else if ( data[19] == 3 ) {
                    $(row).addClass( 'comp3' );
                }else if ( data[19] == 4 ) {
                    $(row).addClass( 'comp4' );
                }else if ( data[19] == 5 ) {
                    $(row).addClass( 'comp5' );
                }else if ( data[19] == 6 ) {
                    $(row).addClass( 'comp6' );
                }else if ( data[19] == 7 ) {
                    $(row).addClass( 'comp7' );
                }
            }
        });
        table.on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });
   

      
      }(item, "parametro2"));
}
