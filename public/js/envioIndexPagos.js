
var vectorTablas= Array();
var comboVector= Array();
var integridadEnvio=true;
var visibleFiltroFecha=false;
var htmdat;
var error;
combosBoxs();
datepik();
    document.getElementById("filtroFechaButton").onclick = function() {
        verFiltro();
    };
    document.getElementById("validar").onclick = function(event) {
        event.preventDefault()
        validar();
    };
    document.getElementById("getFormularioShow").onclick = function(event) {
        event.preventDefault()
        solicitarInforme();
    };
    document.getElementById("getReporteDinamico").onclick = function(event) {
        event.preventDefault()
        solicitarInformeDinamico();
    };
    function inicializarBtnDownloadExcel(){
        document.getElementById("downloadReporte").onclick = function(event) {
            descargar();
            event.preventDefault()
        };
    }
    inicializarBtnDownloadExcel();
    document.getElementById("btnChequesNew").onclick = function(event) {
        event.preventDefault()
        nuevoCheque(event);
    };




//##############################################################
var comboGrueros= $('#cheques_gruero').selectize({
        create: function(nombreenBuscador) {
        nuevoGruero(nombreenBuscador);
        return 0;
    }
});

function nuevoGruero(nombre){
    alertify.confirm('Crear gruero: '+nombre, 'Si', 
                        function(){ crear(); }
                        ,function(){  console.log('cancelado'); }
    );
    function crear(){
        $.ajax({
            url: event.path[0].href,
            type: "POST",
            headers: {
                'banderaHeader':'5'
            },
            data: {'nombre': nombre },
            dataType: 'json',
            success:function(data) {
                if(data.mensajes[0]==''){
                    comboGrueros.data().selectize.addOption({value: data.value, text: data.value}); 
                    comboGrueros.data().selectize.addItem( data.value ); 
                    alertify.success('Listo!');
                }else{
                    alertify.error('Error! : ' + data.mensajes[0] );
                }
            },
            error: function (err) {
                error= err;
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
      if(e.keyCode == 13) {
        e.preventDefault();
      }
    }))
  });

//##############################################################
function getFormEditCheque(event){
    console.log('getFormEditCheque');
    $.ajax({
        url: event.path[0].href,
        type: "POST",
        headers: {
            'banderaHeader':'3'
        },
        data: {'0': 0},
        dataType: 'json',
        success:function(data) {
            document.getElementById("cheques").innerHTML=data.htm;
            if(data.exito==1){
                formatElements("chequesForm");
                document.getElementById("btnChequesNew").onclick = function(event) {
                    event.preventDefault()
                    nuevoCheque();
                };
                formatElements("chequesForm");
                alertify.success('Listo!');
            }else{
                alertify.error('error!');
            }
        },
        error: function (err) {
            error= err;
            alertify.error('error en la respuesta del servidor');
        },
        complete: function (xhr, status) {
            
        }
    });
}

//##############################################################
function getFormCheque(event){
    console.log('getFormCheque');
    $.ajax({
        url: event.path[0].href,
        type: "POST",
        headers: {
            'banderaHeader':'0'
        },
        data: {'0': 0},
        dataType: 'json',
        success:function(data) {
            document.getElementById("cheques").innerHTML=data.htm;
            if(data.exito==1){
                formatElements("chequesForm");
                document.getElementById("btnChequesNew").onclick = function(event) {
                    event.preventDefault()
                    nuevoCheque();
                };
                comboGrueros= $('#cheques_gruero').selectize({
                        create: function(nombreenBuscador) {
                        nuevoGruero(nombreenBuscador);
                        return 0;
                    }
                });
                alertify.success('Listo!');
            }else{
                alertify.error('error!');
            }
        },
        error: function (err) {
            error= err;
            alertify.error('error en la respuesta del servidor');
        },
        complete: function (xhr, status) {
            
        }
    });
}

//##############################################################
function cargarTablaCheques(){
    $.ajax({
        url: 'http://inbakcar.tld/cheques/',
        type: "POST",
        headers: {
            'banderaHeader':'20'
        },
        data: {'0': 0},
        success:function(data) {
            document.getElementById("tablax_cheques").innerHTML=data;

        },
        error: function (err) {
            error= err;
            alertify.error('error en la respuesta del servidor');
        },
        complete: function (xhr, status) {
            $('#tabla_cheques_index').DataTable();
        }
    });
}
cargarTablaCheques();


//##############################################################
    function nuevoCheque(){
        console.log('nuevoCheque');
        var form=$("#chequesForm").clone();
        var url= form[0].action;
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'banderaHeader':'1'
            },
            data: form.serialize(),
            dataType: 'json',
            success:function(data) {
                document.getElementById("cheques").innerHTML=data.htm;

                if(data.exito==1){
                    document.getElementById("nuevoCheque").onclick = function(event) {
                        event.preventDefault()
                        getFormCheque(event);
                    };
                    document.getElementById("editarCheque").onclick = function(event) {
                        event.preventDefault()
                        getFormEditCheque(event);
                    };
                    alertify.success('Listo!');
                }else{
                    document.getElementById("btnChequesNew").onclick = function(event) {
                        event.preventDefault()
                        nuevoCheque();
                    };
                    alertify.error('error!. Revise los datos');
                }
            },
            error: function (err) {
                error= err;
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                cargarTablaCheques();
                formatElements("chequesForm");
            }
        });
    }
//################## DESCARGAR ARCHIVO DE EXCEL ############################################
    function descargar(){
        console.log('descargar');
        var form=$("#reporte_pago_gruas").clone();
        
        $.ajax({
            url: window.location.href,
            type: "POST",
            headers: {
                'banderaHeader':'4'
            },
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if(data.exito==1){
                    descargarYRegresar(data.ruta);
                }else{
                    alertify.error('error!. Revise los datos');
                }
            },
            error: function (err) {
                error= err;
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }
//############# abrir en otra pestania################
function descargarYRegresar(url) {
    // Abrir nuevo tab
    var win = window.open(url, '_blank');
    // Cambiar el foco al nuevo tab (punto opcional)
    win.focus();
}
//##############################################################
    function solicitarInformeDinamico(){
        console.log('solicitarInformeDinamico');
        var form=$("#reporte_pago_gruas").clone();
        form.append("<input name='bandera' type='integer' value=3 ></input>");
        $.ajax({
            url: window.location.href,
            type: "POST",
            headers: {
                'banderaHeader':'21'
            },
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if(data.exito==1){
                    document.getElementById("reporteActual").innerHTML=data.htmReporte;
                    inicializarBtnDownloadExcel();
                    $("#output").pivotUI($("#tabla_datos_pago_pivot"),{
                        rows: ["Correlativo - cheque", "Lote", "Yarda"],
                        cols: ["Tipo de pago"],
                        //aggregatorName: "Integer Sum",
                        rendererName: "Heatmap",
                        vals: ["Costo"],
                    });
                    alertify.success('Listo!');
                }else{
                    alertify.error('error!. Revise los datos');
                }
            },
            error: function (err) {
                error= err;
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                //formatElements("formulario");
            }
        });
        //console.log(arrayEnvios);
    }
//##############################################################

    function solicitarInforme(){
        console.log('solicitarInforme');
        var form=$("#reporte_pago_gruas").clone();
        form.append("<input name='bandera' type='integer' value=3 ></input>");
        $.ajax({
            url: window.location.href,
            type: "POST",
            headers: {
                'banderaHeader':'3'
            },
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if(data.exito==1){
                    document.getElementById("formulario_reporte").innerHTML=data.htm;
                    document.getElementById("reporteActual").innerHTML=data.htmReporte;
                    inicializarBtnDownloadExcel();
                    $('#lista_form_reporte_pago_gruas_preFactGruaUsa').selectize();
                    $('#tabla_datos_pago').DataTable();
                    $('#tabla_datos_pago_extras').DataTable();
                    document.getElementById("getFormularioShow").onclick = function(event) {
                        event.preventDefault()
                        solicitarInforme();
                    };
                    document.getElementById("getReporteDinamico").onclick = function(event) {
                        event.preventDefault()
                        solicitarInformeDinamico();
                    };
                    alertify.success('Listo!');
                    
                }else{
                    alertify.error('error!. Revise los datos');
                }
            },
            error: function (err) {
                error= err;
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                formatElements("formulario");
                formatearbotonesTablaCheque();
            }
        });
        //console.log(arrayEnvios);
    }
//#########################__ agrega eventos a los select de la tabla cheque para que cesy valide ####################################
function formatearbotonesTablaCheque(){
    var botonesTablaCheque= document.getElementsByClassName('opciones_cheque'); //buscamos los botones
    Array.prototype.forEach.call(botonesTablaCheque, function(el) { //agregamos los eventos
        el.addEventListener('change', (event) => {
            var optionSelected = event.srcElement.selectedOptions;
            var idCheque= optionSelected[0].dataset.id;
            var idMovimiento= optionSelected[0].dataset.movimiento;
            var tipo= optionSelected[0].dataset.tipo; // el tipo que se va a validar 1 grua, 2 storage...
            var valueSelect = optionSelected[0].value;
            if(valueSelect==1){
                verCheque( idCheque, event );
            }else if(valueSelect==2){
                validarCheque( idCheque, idMovimiento, tipo, event );
            }else if(valueSelect==3){
                noCobrado( idCheque, idMovimiento, valueSelect, event );
            }
            else if(valueSelect==4){
                noCobrado( idCheque, idMovimiento, valueSelect, event );
            }
        });
    });
}

//########################## funciones para ver y editar cheque #######################
function verCheque(idCheque, event){
    var ruta= document.getElementById('formulario_reporte').dataset.cheques_show;
    ruta= ruta.substr(0, ruta.length-1)+idCheque;
    window.open(ruta, '_blank');
    
    $.ajax({
        url: ruta,
        type: "POST",
        headers: {
            'banderaHeader':30
        },
        data: { 'idCheque': idCheque },
        success: function (data) {
          
        },
        error: function (err) {
            error= err;
            alertify.error('error en la respuesta del servidor');
        },
        complete: function (xhr, status) {
            formatElements("formulario");
        }
    });
}
//########################## funciones para ver y editar cheque #######################
function validarCheque(idCheque, idMovimiento, tipo, event){
    console.log('validarCheque' + idMovimiento );
    var ruta= document.getElementById('formulario_reporte').dataset.cheques_validar;
    $.ajax({
        url: ruta,
        type: "POST",
        headers: {
        },
        dataType: 'json',
        data: { 'idCheque': idCheque, 'tipo': tipo, 'idMovimiento':idMovimiento },
        success: function (data) {
            if(data.mensajes['0']==''){
                alertify.success( data.mensajes['1'] );
            }else{
                alertify.error( data.mensajes['0'] );
            }
        },
        error: function (err) {
            error= err;
            alertify.error('error en la respuesta del servidor');
        },
        complete: function (xhr, status) {
            formatElements("formulario");
        }
    });
}
//########################## funciones para ver y editar cheque #######################
function noCobrado(idCheque, idMovimiento, valueSelect, event){
    var ruta= document.getElementById('formulario_reporte').dataset.cheques_no_cobrado;
    
    $.ajax({
        url: ruta,
        type: "POST",
        headers: {
        },
        dataType: 'json',
        data: { 'idCheque': idCheque, 'especial': valueSelect }, //si especial es 4 si es especial
        success: function (data) {
            if(data.mensajes['0']==''){
                alertify.success( data.mensajes['1'] );
            }else{
                alertify.error( data.mensajes['0'] );
            }
        },
        error: function (err) {
            error= err;
            alertify.error('error en la respuesta del servidor');
        },
        complete: function (xhr, status) {
            formatElements("formulario");
        }
    });
}
//##############################################################
    function validar() {
        console.log('validar');
        seleccionados = vectorTablas[0].rows('.selected').data();
        listaEnvios="";
        for (var i = 0; i < seleccionados.length; i++) {
            listaEnvios = listaEnvios+seleccionados[i][1]+"," ;
            console.log(listaEnvios);
        }

        $.ajax({
            url: window.location.href,
            type: "POST",
            headers: {
                'banderaHeader':'1'
            },
            data: {
                datos: listaEnvios,
            },
            success: function (data) {
                document.getElementById("formulario").innerHTML=data.htm;
                $("#bodyGeneral").addClass("sidenav-toggled");
                alertify.success('Vaya al paso 2');
                
                for(var i =0 ; i< data.cantidadGruas; i++ ){
                    idForm='btnValidar_'+data.ids[i];
                    document.getElementById(idForm).onclick = function(event) {
                        event.preventDefault()
                        enviarFormPaso2(event);
                    };
                }
               
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                formatElements("formulario");
                document.querySelectorAll("a.recargarForm").forEach(item => {
                    item.addEventListener('click', event => {
                    event.preventDefault();
                        recargarForm(event);
                    })
                })
            }
        });

    }

//##############################################################
    function enviarFormPaso2(event){
        var formId= '#'+event.path[1].id;
        seleccionados = vectorTablas[0].rows('.selected').data();
        listaEnvios="";
        for (var i = 0; i < seleccionados.length; i++) {
            listaEnvios = listaEnvios+seleccionados[i][1]+"," ;
        }
        var form=$(formId).clone();
    
        $.ajax({
            url: window.location.href,
            type: "POST",
            data: form.serialize(),
            headers: {
                'banderaHeader':'2',
                'datos':listaEnvios
            },
            dataType: 'json',
            success: function (data) {
                var boton= "btnValidar_"+data.id;
                var idForm= "movimiento_"+data.id;
                var idRecargar="recargarMovimiento_"+data.id;
                
                if(data.exito==1){
                    document.getElementById(idForm).outerHTML=data.htm;
                    alertify.success('Listo!');
                    
                    document.getElementById(boton).onclick = function(event) {
                        event.preventDefault()
                        enviarFormPaso2(event);
                    };
                    document.getElementById(idRecargar).onclick = function(event) {
                        event.preventDefault()
                        recargarForm(event);
                    };

                }else{
                    document.getElementById(idForm).outerHTML=data.htm;
                    alertify.error('error!. Revise los datos');
                    document.getElementById(boton).onclick = function(event) {
                        event.preventDefault()
                        enviarFormPaso2(event);
                    };
                    document.getElementById(idRecargar).onclick = function(event) {
                        event.preventDefault()
                        recargarForm(event);
                    };
                    
                }
                formatElements(idForm);
            },
            error: function (err) {
                error= err;
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }
//#########################################################
    function recargarForm(eventoBoton){
        var idForm= eventoBoton.srcElement.dataset.movimiento;
        var idmov= eventoBoton.srcElement.dataset.idmov;
        console.log( idmov +" - " + idForm);
        $.ajax({
            url: window.location.href,
            type: "POST",
            data: { 'id': idmov },
            headers: {
                'banderaHeader':'-1',
            },
            dataType: 'json',
            success: function (data) {
                var boton= "btnValidar_"+data.id;
                var idForm= "movimiento_"+data.id;
                var idRecargar="recargarMovimiento_"+data.id;
                
                if(data.exito==1){
                    document.getElementById(idForm).outerHTML=data.htm;
                    alertify.success('Listo!');
                }else{
                    document.getElementById(idForm).outerHTML=data.htm;
                    alertify.error('error!. Revise los datos');
                }
                document.getElementById(boton).onclick = function(event) {
                    event.preventDefault()
                    enviarFormPaso2(event);
                };
                document.getElementById(idRecargar).onclick = function(event) {
                    event.preventDefault()
                    recargarForm(event);
                };

                formatElements(idForm);
            },
            error: function (err) {
                error= err;
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }
//##############################################################
    function verFiltro() {
        console.log('verFiltro');
        if(visibleFiltroFecha){
            visibleFiltroFecha=false;
            $("#filtroFecha").addClass("intangible");
        }else{ 
            visibleFiltroFecha=true;
            $("#filtroFecha").removeClass("intangible");
        }
    }
//##############################################################
    escanerElements();

    function escanerElements(){// ESCANEA EL CUERPO DE LA PANTALLA PARA BUSCAR LOS SELECT A Y LAS TABLAS CON ID='tabla_' para darles formato
        var children = document.getElementById('layoutSidenav_content').getElementsByTagName('*');
        for( var i = 0; i<children.length; i++){
            var t = children.item(i); 
            if(children.item(i).tagName== "TABLE" && children.item(i).id.includes('tabla_')){
                tables( children.item(i) );
            }
        }  
    }
//##############################################################

function formatElements($idElemento){
    var children = document.getElementById($idElemento).getElementsByTagName('*');
    for( var i = 0; i<children.length; i++){
        var t = children.item(i);
        var clases= children.item(i).classList;
        element= "#"+children.item(i).id;

        if(clases.contains('datepicker') && element!= "#"){
            $(element).datepicker( { dateFormat: 'yy-mm-dd' }  );
        }
        if(clases.contains('myselect') && element!= "#"){
            $(element).selectize();
        }

        if(clases.contains('myselect2') && element!= "#"){
            
            $(element).select2();
        }
    }
}
function combosBoxs(){
  comboVector[ comboVector.length ]=$('.myselect' ).selectize(); //GUARDA UN VECTOR CON TODOS LOS COMBOBOX PARA MANEJARLOS LUEGO - EN ORDEN DE ARRIBA A BAJO
}
function datepik(){
    $(".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd' } );
}
function tables(item ){
    (function (item, dos,) {
    idTabla="#"+item.id;
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
            "scrollY":        "500px",
            "scrollCollapse": true,
            "paging":         true,
            "sScrollX": "100%",
            columnDefs: [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                },{
                    "targets": [ 1 ],
                    "visible": false,
                    "searchable": false
                },{
                    "targets": [ 2 ],
                    "visible": false,
                    "searchable": false
                },{
                    "targets": [ 3 ],
                    "visible": true,
                    "searchable": true
                },{
                    "targets": [ 4 ],
                    "visible": true,
                    "searchable": true
                }

            ],
            "createdRow": function( row, data, dataIndex ) {
                if ( data[0] == 0 ) {
                  $(row).addClass( 'comp0' ); 
                }else if ( data[0] == 1 ) {
                    $(row).addClass( 'comp1' );
                }else if ( data[0] == 2 ) {
                    $(row).addClass( 'comp2' );
                }else if ( data[0] == 3 ) {
                    $(row).addClass( 'comp3' );
                }else if ( data[0] == 4 ) {
                    $(row).addClass( 'comp4' );
                }else if ( data[0] == 5 ) {
                    $(row).addClass( 'comp5' );
                }else if ( data[0] == 6 ) {
                    $(row).addClass( 'comp6' );
                }else if ( data[0] == 7 ) {
                    $(row).addClass( 'comp7' );
                }else if ( data[0] == 8 ) {
                    $(row).addClass( 'comp8' );
                }else if ( data[0] == 9 ) {
                    $(row).addClass( 'comp9' );
                }else if ( data[0] == 10 ) {
                    $(row).addClass( 'comp10' );
                }else if ( data[0] == 20 ) {
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
                    
            })
        })
      }(item, "parametro2"));
}

