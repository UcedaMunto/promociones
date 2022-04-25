alertify.set('notifier','position', 'top-center');
alertify.set('notifier','delay', -1);
var vectorTablas= Array();
var comboVector= Array();
var comboVector2= Array();
var bandera= true;
var arrayIdTablas= Array();

var comentarios;
//setInterval(getComentarios, 50000);

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

// ESCANEA EL CUERPO DE LA PANTALLA PARA BUSCAR LOS SELECT A Y LAS TABLAS CON ID='tabla_' para darles formato
function escanerElements(){
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

/* Para dar formato a los selects */
function combosBoxs(){
    //if(comboVector2.length>0){
        comboVector2[ comboVector2.length ]=$( '.myselect2' ).select2();
        comboVector[ comboVector.length ]=$('.myselect' ).selectize(); //GUARDA UN VECTOR CON TODOS LOS COMBOBOX PARA MANEJARLOS LUEGO - EN ORDEN DE ARRIBA A BAJO
    //}
   
}
/* Formato de fecha  */

function datepik(){
    console.log('datepicker');
    $( ".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd', numberOfMonths: 2,
    showButtonPanel: true, changeMonth: true,
    changeYear: true }  );
}

/**Que hace? */
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

function deserialize(idform, serializedString){
    var $form = $('#'+idform);
    $form[0].reset();    // (A) optional
    serializedString = serializedString.replace(/\+/g, '%20'); // (B)
    var formFieldArray = serializedString.split("&");
    // Loop over all name-value pairs
    $.each(formFieldArray, function(i, pair){
        var nameValue = pair.split("=");
        var name = decodeURIComponent(nameValue[0]); // (C)
        var value = decodeURIComponent(nameValue[1]);
        console.log(name);
        // Find one or more fields
        var $field = $form.find('[name="' + name + '"]');
        var contadorSelectMultiples=0;
        // Checkboxes and Radio types need to be handled differently
        if ($field[0].type == "radio" || $field[0].type == "checkbox") 
        {
            var $fieldWithValue = $field.filter('[value="' + value + '"]');
            var isFound = ($fieldWithValue.length > 0);
            // Special case if the value is not defined; value will be "on"
            if (!isFound && value == "on") {
                $field.first().prop("checked", true);
            } else {
                $fieldWithValue.prop("checked", isFound);
            } 
        } else { // input, textarea
            if(document.getElementsByName(name)[0].type=='text'){
                $field.val(value);
            }else if(document.getElementsByName(name)[0].type=='select-multiple'){
                var opt= document.getElementsByName(name)[0].options;
                for(var i=0; i<opt.length; i++){
                    if(opt[i].value== value){
                        opt[i].selected= true;
                    }}
            }else if(document.getElementsByName(name)[0].type=='select-one'){
                $field.val(value);
            }; 
        }
    });
    return this;
}

/**Validacion de persona cliente  */
if(document.getElementById("btnPersonaCliente")!=null){
    document.getElementById("btnPersonaCliente").onclick = function(event) {
        event.preventDefault();
        validarPerCliente();
        
    };
}


/**cliente */
function validarPerCliente() {
    console.log('guardarPersonaCliente');
    if(!document.getElementById('form_persona_client').reportValidity()){
         console.log('validar form') 
    }
    else{    
    

        if(fileValidation('persona_cliente_datos_file')!=false && fileValidation('persona_cliente_datos_file1')!=false && fileValidation('persona_cliente_datos_file2')!=false){
            var formularioCliente= document.getElementsByName('persona_cliente');
            var form= $("#form_persona_client"); 
    
            var parametros = new FormData($("#form_persona_client")[0]);
            $.ajax({
                url: formularioCliente[0].action,
                type: "POST",
                headers: {
                    'banderaHeader':'validarPCliente'
                },
                data: parametros,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforesend: function(){

                },
                success: function(data){
                    if(data.mensajes[0]!='') {
                        alertify.error('Error: ' + '\n' + data.mensajes[0]);
                        document.getElementById("btnPersonaCliente").onclick = function(event) {
                            event.preventDefault();
                            validarPerCliente();
                        };
                    
                    } else {
                        alertify.success('Se guardo con extio');
                        document.getElementById("formPersonaCambio").innerHTML=data.htm;
                        formatElements("formPersonaCambio");
                        document.getElementById("btnEditPersonaCliente").onclick = function(event) {
                            event.preventDefault();
                            editarPerCliente();
                        };

                    }
            

                },
                error: function (err) {


                    alertify.error('error en la respuesta del servidor');
                },
                complete: function (xhr, status) {
                
                }



            });
        }
     }
}

if(document.getElementById("btnEditPersonaCliente")!=null){
    document.getElementById("btnEditPersonaCliente").onclick = function(event) {
        event.preventDefault();
        editarPerCliente();
        
    };
}


function editarPerCliente(){
    if(!document.getElementById('form_edit_persona_client').reportValidity()){
        console.log('validar form') 
   }
   else{
    if(fileValidation('persona_cliente_datos_file')!=false && fileValidation('persona_cliente_datos_file1')!=false && fileValidation('persona_cliente_datos_file2')!=false){
        var formularioCliente= document.getElementsByName('persona_cliente');
        var form= $("#form_edit_persona_client"); 
        var parametros = new FormData($("#form_edit_persona_client")[0]);
        rutaEdit= document.getElementById("btnEditPersonaCliente").getAttribute('href');
        console.log(rutaEdit);
        $.ajax({
            url: rutaEdit,
            type: "POST",
            headers: {
                'banderaHeader':'validarPCliente'
            },
            data: parametros,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforesend: function(){

            },
            success: function(data){
                if(data.mensajes[0]!='') {
                    alertify.error('Error: '  + data.mensajes[0]);

                
                } else {
                    alertify.success('Se guardo con extio');
                    document.getElementById("formPersonaCambio").innerHTML=data.htm;
                    formatElements("formPersonaCambio");
                }
                document.getElementById("btnEditPersonaCliente").onclick = function(event) {
                    event.preventDefault();
                    editarPerCliente();
                    
                };
                

            },
            error: function (err) {


                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
            
            }
        });
    }
   }
}


function fileValidation(id){
    var fileInput = document.getElementById(id);
    var filePath = fileInput.value;
        if(filePath != ''){
        var allowedExtensions = /(.pdf|.PDF|.doc|.docx|.DOC|.DOCX)$/i;
        if(!allowedExtensions.exec(filePath)){
            alertify.error('Debe subir un archivo con extension .pdf/.doc/.docx');
            fileInput.value = '';

            return false;
        }else{
            return true;
        }
    }
    else{
        return true;
    }
}