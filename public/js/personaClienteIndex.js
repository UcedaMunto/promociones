
var vectorTablas= Array();
var comboVector= Array();
var comboVector2= Array();
var bandera= true;
var arrayIdTablas= Array();

var comentarios; getComentarios(); getRevisiones();

setInterval(getComentarios, 50000);

    //* gestion clientes *//
    $("#persona_cliente_tipoCliente").change(function(){
       // alert("Handled"); // alert is not fired up ...
        var select = document.getElementById("persona_cliente_tipoCliente");
        var selectedOption = select.options[select.selectedIndex].value;
        if(selectedOption=="2" || selectedOption=="4"){
            $("#datosExtraEmpresa").removeClass("intangible");
        }else{
            $("#datosExtraEmpresa").addClass("intangible");
        }
       
    });
    //* gestion clientes *//


function getComentarios(){
    $.ajax({
        type: "POST",
        processData: false,
        enctype: "multipart/form-data",
        contentType: false,
        dataType: 'json',
        url: host+'comentarios/wsrtvmbjgksjrtsasjas/',
        data: { },
        beforeSend: function() {
        
        },
        complete: function(data) {
            comentarios= data.responseJSON;
            console.log( data.responseJSON );
            var comentariosHtm="";
            var cantidad=  comentarios.creados.length + comentarios.etiquetado.length;
            
            for (i = 0; i < comentarios.creados.length; i++) {
                console.log(comentarios.creados[i][0]);
                comentariosHtm=comentariosHtm+
                                "<a class='dropdown-item dropdown-notifications-item' href='"+comentarios.ruta+ comentarios.creados[i]['envio']+"'>"+
                                    "<div class='dropdown-notifications-item-icon bg-danger'><svg class='svg-inline--fa fa-exclamation-triangle fa-w-18' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='exclamation-triangle' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512' data-fa-i2svg=''><path fill='currentColor' d='M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z'></path></svg></div>"+
                                    "<div class='dropdown-notifications-item-content'>"+
                                        "<div class='dropdown-notifications-item-content-details'>"+comentarios.creados[i].fechaCreacion.date+"</div>"+
                                        "<div class='dropdown-notifications-item-content-text'>"+comentarios.creados[i]['titulo']+"</div>"+
                                    "</div>"+
                                "</a>";
            }
            for (i = 0; i < comentarios.etiquetado.length; i++) {
                console.log(comentarios.etiquetado[i][0]);
                comentariosHtm=comentariosHtm+
                                "<a class='dropdown-item dropdown-notifications-item' href='"+comentarios.ruta+ comentarios.etiquetado[i]['envio']+"'>"+
                                    "<div class='dropdown-notifications-item-icon bg-warning'><svg class='svg-inline--fa fa-exclamation-triangle fa-w-18' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='exclamation-triangle' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512' data-fa-i2svg=''><path fill='currentColor' d='M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z'></path></svg></div>"+
                                    "<div class='dropdown-notifications-item-content'>"+
                                        "<div class='dropdown-notifications-item-content-details'>"+comentarios.etiquetado[i].fechaCreacion.date+"</div>"+
                                        "<div class='dropdown-notifications-item-content-text'>"+comentarios.etiquetado[i]['lote']+'-'+comentarios.etiquetado[i]['id']+"</div>"+
                                    "</div>"+
                                "</a>";
            }

            document.getElementById("etiquetas").innerHTML = comentariosHtm;
            document.getElementById("cantidadNotificaciones").innerHTML = cantidad;
                        
        },
        success: function() {
           
        },
        error: function(data) {
            console.log(data);
        }
    });
};

function getRevisiones(){
    $.ajax({
        type: "POST",
        processData: false,
        enctype: "multipart/form-data",
        contentType: false,
        dataType: 'json',
        url: host+'agenda/revision/dataLog',
        data: { },
        beforeSend: function() {
        
        },
        complete: function(data) {
            revisiones= data.responseJSON;
            console.log( data.responseJSON );
            var comentariosHtm="";
            var cantidad=  revisiones.creados.length;
            
            for (i = 0; i < revisiones.creados.length; i++) {
                console.log(revisiones.creados[i][0]);
                comentariosHtm=comentariosHtm+
                                "<a class='dropdown-item dropdown-notifications-item' href='"+revisiones.ruta+ revisiones.creados[i]['id']+"'>"+
                                    "<div class='dropdown-notifications-item-icon bg-danger'><svg class='svg-inline--fa fa-exclamation-triangle fa-w-18' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='exclamation-triangle' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512' data-fa-i2svg=''><path fill='currentColor' d='M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z'></path></svg></div>"+
                                    "<div class='dropdown-notifications-item-content'>"+
                                        "<div class='dropdown-notifications-item-content-details'>"+revisiones.creados[i].fechaCreacion.date+"</div>"+
                                        "<div class='dropdown-notifications-item-content-text'>"+revisiones.creados[i]['descripcion']+"</div>"+
                                    "</div>"+
                                "</a>";
            }
            document.getElementById("revisiones").innerHTML = comentariosHtm;
            document.getElementById("cantidadRevisiones").innerHTML = cantidad;
                        
        },
        success: function() {
           
        },
        error: function(data) {
            console.log(data);
        }
    });
};

function escanerElements(){// ESCANEA EL CUERPO DE LA PANTALLA PARA BUSCAR LOS SELECT A Y LAS TABLAS CON ID='tabla_' para darles formato
    var children = document.getElementById('layoutSidenav_content').getElementsByTagName('*');
    console.log('escaneando elementos');

    combosBoxs();
    datepik();
    
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
    //if(comboVector2.length>0){
        comboVector2[ comboVector2.length ]=$( '.myselect2' ).select2();
        comboVector[ comboVector.length ]=$('.myselect' ).selectize(); //GUARDA UN VECTOR CON TODOS LOS COMBOBOX PARA MANEJARLOS LUEGO - EN ORDEN DE ARRIBA A BAJO
    //}
   
}
function datepik(){
    console.log('datepicker');
    $( ".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd' }  );
}
function tables(item ){
    (function (item, dos,) {
        console.log('------------------------escuchar tabla');
        idTabla='#'+item.id;
        var table= $(idTabla);
        if( table[0].tagName == 'TABLE' && !arrayIdTablas.includes(idTabla) ){ //La librería recrea la tabla y durante el escaneo intenta dar formato mas veces asi que es necesario verificar si ya se le dio formato
            arrayIdTablas[ arrayIdTablas.length ]= idTabla;
            //*----------------------------------BUSCADORES POR COLUMNA  */
            $(idTabla+' thead tr').clone(true).appendTo( idTabla+' thead' );
            $(idTabla+' thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text"  placeholder="Search '+title+'" />' );
        
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
                select: true,
                "scrollY":        "500px",
                "scrollCollapse": true,
                "paging":         true,
                "sScrollX": "100%",
                "ordering": false,
                "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false,
                    }
                ],

            });

            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();
                var column = table.column( $(this).attr('data-column') );
                column.visible( ! column.visible() );
            } );
            vectorTablas[ vectorTablas.length ]= table;
           // bandera= !bandera;
        } 
    }(item, "parametro2"));
}