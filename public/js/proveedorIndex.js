/** Agregar proveedor */
document.getElementById("agregarProveedor").onclick = function(event) {
    $ruta= document.getElementById("agregarProveedor").getAttribute('href');
    console.log($ruta);
    $.ajax({
        url: $ruta,
        type: "POST",
        headers: {

        },
        data: {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
        dataType: 'json',
        success: function (data) {
            document.getElementById("proveedorDiv").innerHTML=data.htm;
            formatElements("proveedorDiv");

            //document.getElementById("btnComentReu").setAttribute("data-dismiss","modal");                
            document.getElementById("proveedorSave").onclick = function(event) {
                event.preventDefault();
                guardarProveedor();
            };
           // recargarComentariosRespuesta();
        },
        error: function (err) {
            alertify.error('error en la respuesta del servidor');
        },
        complete: function (xhr, status) {
            
        }
    });
    event.preventDefault();


};
    /** guardar proveedor */
function guardarProveedor(){
    console.log("Hora de guardado");
    if(!document.getElementById('form_proveedor').reportValidity()){
        console.log('No valido');
   }else{

        var form = $("#form_proveedor");   
        $.ajax({       

            url: form[0].action,
            type: "POST",
            headers: {

            },
            data:  form.serialize(), //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
            dataType: 'json',
            success: function (data) {
                if(data.mensajes[0]!=''){
                    alertify.error('hubo un error');
                    
                }else{
                    alertify.success('Se guardo con extio');
                }
                
                document.getElementById("proveedorDiv").innerHTML=data.htm;
                formatElements("proveedorDiv");
                document.getElementById("listadoProveedores").innerHTML=data.htmc;
                formatElements("listadoProveedores");
                recargarTabla();
                recargarAccion();
                $('#proveedorModal').modal('hide');
                $('#proveedorModal').modal('hide');
                
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });

   }
}

/** Mostrar informacion del proveedor */
    /*************************************  tabla de reunion -mostar   *********************** */
    const mostarPv = document.querySelectorAll('.mostrarProveedores');
    mostarPv.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
        $.ajax({
            url: event.srcElement.href,
            type: "GET",
            headers:{

            },
            data:{},
            success: function (data){
                
                document.getElementById("proveedorDivInfo").innerHTML=data.htm;
                formatElements("proveedorDivInfo");            
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }))

/** Editar proveedor  */
/*************************************  tabla de proveedor -editar   *********************** */
const editarDJ = document.querySelectorAll('.editarProveedores');
editarDJ.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
    $.ajax({
        url: event.srcElement.href,
        type: "POST",
        headers: {
            
        },
        data:  {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
        dataType: 'json',
        success: function (data) {
            
            document.getElementById("proveedorDiv").innerHTML=data.htm;
            formatElements("proveedorDiv");
            document.getElementById("proveedorSave").onclick = function(event) {
                event.preventDefault();
                editarProveedor(event);
            };
            document.getElementById('proveedorSave').setAttribute("href", event.srcElement.href );
        },
        error: function (err) {
            alertify.error('error en la respuesta del servidor');
        },
        complete: function (xhr, status) {
            
        }
    });
}))

function editarProveedor(event){
    if(!document.getElementById('form_proveedor').reportValidity()){
        console.log('No valido');
    }else{
        var form= $("#form_proveedor"); 
        $.ajax({
            url:  event.srcElement.getAttribute('href'),
            type: "POST",
            headers: {
                
            },
            data:  form.serialize(),
            dataType: 'json',
            success: function (data) {
                if(data.mensajes[0]!='') {
                    alertify.error('hubo un error');
                } else {
                    alertify.success('Se guardo con extio');
                }
               
                document.getElementById("listadoProveedores").innerHTML=data.htmu;
                formatElements("listadoProveedores");
                recargarTabla();
                recargarAccion();
                $("#proveedorModal").modal("hide");   
            
            },
            error: function (err) {
                
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
            
            }
        });
    }
}
recargarTabla();
function recargarTabla(){
    $('#listaproveedor').dataTable({
        "order": [[ 0, "desc" ]],
        "scrollX":        true,
        

    });
}

function recargarAccion(){
    /*************************************  tabla de reunion -mostar   *********************** */
    const mostarPv = document.querySelectorAll('.mostrarProveedores');
    mostarPv.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
        $.ajax({
            url: event.srcElement.href,
            type: "GET",
            headers:{

            },
            data:{},
            success: function (data){
                
                document.getElementById("proveedorDivInfo").innerHTML=data.htm;
                formatElements("proveedorDivInfo");            
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }))


    /*************************************  tabla de proveedor -editar   *********************** */
    const editarDJ = document.querySelectorAll('.editarProveedores');
    editarDJ.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
        $.ajax({
            url: event.srcElement.href,
            type: "POST",
            headers: {
                
            },
            data:  {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
            dataType: 'json',
            success: function (data) {
                
                document.getElementById("proveedorDiv").innerHTML=data.htm;
                formatElements("proveedorDiv");
                document.getElementById("proveedorSave").onclick = function(event) {
                    event.preventDefault();
                    editarProveedor(event);
                };
                document.getElementById('proveedorSave').setAttribute("href", event.srcElement.href );
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }))



}



