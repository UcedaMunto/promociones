const linkedit = document.querySelectorAll('.edicheque');


var vectorTablas= Array();
var comboVector= Array();
var comboVector2= Array();
var bandera= true;
var arrayIdTablas= Array();


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


function escanerElements(){// ESCANEA EL CUERPO DE LA PANTALLA PARA BUSCAR LOS SELECT A Y LAS TABLAS CON ID='tabla_' para darles formato
    var children = document.getElementById('layoutSidenav_content').getElementsByTagName('*');
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

linkedit.forEach(el => el.addEventListener('click', event => { event.preventDefault();
    $.ajax({
        url: event.target.getAttribute("href"),
        headers: {banderaHeader: 1},
        type: "POST",
        dataType: 'json',
        success:function(data) {
            document.getElementById("editform").innerHTML=data.htm;
            formatElements('editform');

            document.getElementById('btnChequesNew').onclick = function(event) {
                event.preventDefault();                
                nuevoCheque();
            };
            if(data.exito==1){
              /*  formatElements("chequesForm");
                document.getElementById("btnChequesNew").onclick = function(event) {
                    event.preventDefault()
                    nuevoCheque();
                }; */
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
  }));


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
            "scrollY":        "500px",
            "scrollCollapse": true,
            "paging":         true,
            "sScrollX": "100%",
            columnDefs: [
                {
                    "targets": [ 0 ],
                    "visible": true,
                    "searchable": false
                },{
                    "targets": [ 1 ],
                    "visible": false
                },{
                    "targets": [ 2 ],
                    "visible": false,
                    "searchable": false
                },{
                    "targets": [ 3 ],
                    "visible": false,
                    "searchable": false
                },{
                    "targets": [ 4 ],
                    "visible": false,
                    "searchable": false
                }

            ],
        
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
            document.getElementById("editform").innerHTML=data.htm;

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
            formatElements("chequesForm");
        }
    });
}