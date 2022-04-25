var comentarioActual=0;
recargarFormatoAcuerdo();
recargarFormatoReunion();
recargarAcuerdosLista();





/********************   Inicio de reunion   ****************************************** */
    /*************************************  Guardad reunion   *********************** */
        document.getElementById("btnReunion").onclick = function(event) {
            event.preventDefault();
            guardarReunion();
            
        };

        function guardarReunion() {
            console.log('guardarReunion');
            if(!document.getElementById('form_discusion').reportValidity()){
                 console.log('enviar')
            }
            else{        
            var formularioAcuerdo= document.getElementsByName('discusion_jefatura');
            var form= $("#form_discusion"); 
                       
            $.ajax({
                url: form[0].action,
                type: "POST",
                headers: {
                    'banderaHeader':'crearReunion'
                },
                data:  form.serialize(),
                dataType: 'json',
                success: function (data) {
                    
                    if(data.mensajes[0]!='') {
                        alertify.error('hubo un error');
                    } else {
                        alertify.success('Se guardo con extio');
                    }
                    document.getElementById("NuevaReunion").innerHTML=data.htm;
                    formatElements("NuevaReunion");
                    document.getElementById("listaReunionUltimo").innerHTML=data.htmu;
                    formatElements("listaReunionUltimo");
                    document.getElementById("listaReunionAll").innerHTML=data.htma;
                    formatElements("listaReunionAll");
                    
                    recargarFormatoReunion();
                    recargarTablaInicioReunion();
                    
                    document.getElementById("btnReunion").onclick = function(event) {
                        event.preventDefault();
                        guardarReunion();
                    };
                    $("#form_discusion")[0].reset();
                
                },
                error: function (err) {
                    if(form.find('#dj_titulo_add').val()===''){
                        alertify.alert("Campo vacio","Agregue un titulo", function(){
                            alertify.message('OK');
                        });
                       return false;
                    }
        
                    if(!document.getElementById('dp_estado_new').value){
                        alertify.alert("Campo vacio","Agregue al menos un departamento", function(){
                            alertify.message('OK');
                        });
                        return false;
                    }
                    if(form.find('#descripccion_add').val()===''){
                        alertify.alert("Campo vacio","Agruegue los temas a tratar", function(){
                            alertify.message('OK');
                        });
                       return false;
                    }else{
                        alertify.alert("Error al ingresar datos","Revise que los datos esten correctos", function(){
                            alertify.message('OK');
                        });
                    }
                    alertify.error('error en la respuesta del servidor');
                },
                complete: function (xhr, status) {
                
                }
            });
        }
        }
        /*************************************  tabla de reunion -mostar   *********************** */
        const mostarDJ = document.querySelectorAll('.mostrarDiscusiones');
        mostarDJ.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
            $.ajax({
                url: event.srcElement.href,
                type: "GET",
                headers:{

                },
                data:{},
                success: function (data){
                    
                    document.getElementById("infoDJ").innerHTML=data.htm;
                    formatElements("infoDJ");            
                },
                error: function (err) {
                    alertify.error('error en la respuesta del servidor');
                },
                complete: function (xhr, status) {
                    
                }
            });
        }))
        /*************************************  tabla de reunion -editar   *********************** */
        const editarDJ = document.querySelectorAll('.editarDiscusiones');
        editarDJ.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
            $.ajax({
                url: event.srcElement.href,
                type: "POST",
                headers: {
                    
                },
                data:  {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
                dataType: 'json',
                success: function (data) {
                    
                    document.getElementById("editDJ").innerHTML=data.htm;
                    formatElements("editDJ");
                    document.getElementById('btnEditarDiscusion').setAttribute("href", event.srcElement.href );
                    document.getElementById("btnEditarDiscusion").onclick = function(event) {
                        event.preventDefault();
                        editarReunion(event);
                    };
                },
                error: function (err) {
                    alertify.error('error en la respuesta del servidor');
                },
                complete: function (xhr, status) {
                    
                }
            });
        }))
        /*************************************  Editar reunion  *********************** */
        /*  document.getElementById("btnEditarDiscusion").onclick = function(event) {
            event.preventDefault();
            editarReunion(event);
        };*/

        function editarReunion(event) {

            if(!document.getElementById('form_discusion_edit').reportValidity()){
                
           }else{
            console.log('editarReunion');
            var form= $("#form_discusion_edit"); 
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
                   
                    document.getElementById("listaReunionUltimo").innerHTML=data.htmu;
                    formatElements("listaReunionUltimo");
                    document.getElementById("listaReunionAll").innerHTML=data.htma;
                    formatElements("listaReunionAll");
                    
                    recargarFormatoReunion();
                    recargarTablaInicioReunion();
                    document.getElementById("btnReunion").onclick = function(event) {
                        event.preventDefault();
                        guardarReunion();
                    };
                    recargarSelectAll();
                    $("#editarInfoDJ").modal("hide");   
                
                },
                error: function (err) {
                    if(form.find('#dj_titulo_add').val()===''){
                        alertify.alert("Campo vacio","Agregue un titulo", function(){
                            alertify.message('OK');
                        });
                       return false;
                    }
        

                    if(form.find('#descripccion_add').val()===''){
                        alertify.alert("Campo vacio","Agruegue los temas a tratar", function(){
                            alertify.message('OK');
                        });
                       return false;
                    }else{
                    alertify.alert("Error al ingresar datos","Revise que los datos esten correctos", function(){
                        alertify.error('OK');
                    });}
                    alertify.error('error en la respuesta del servidor');
                },
                complete: function (xhr, status) {
                
                }
            });
           }
        }




/********************   Reunion  ****************************************** */
                /*************************************mostar las reunion segun con lo que seleccione****************  */
                var slcListaDiscusion =  $("#selectReunionBuscar");
                slcListaDiscusion.change(function(event){
                    console.log(slcListaDiscusion.val());
                    
                    $rutaAll = document.getElementById("selectReunionBuscar").getAttribute('href');                   
                    
                    $.ajax({
                        url: $rutaAll,
                        type: "POST",
                        headers: {
                            'banderaHeader' : slcListaDiscusion.val()
                        },
                        data:  {}, 
                        dataType: 'json',
                        success: function (data) {
                           
                            document.getElementById("listaReunionAll").innerHTML=data.htma;
                            //formatElements("listaReunionAll");
                            recargarTablaInicioReunion();
                            $('#listaReunion').dataTable({
                                "order": [[ 0, "desc" ]],
                            });
                            

                           
                        },
                        error: function (err) {
                            alertify.error('error en la respuesta del servidor');
                        },
                        complete: function (xhr, status) {
                            
                        }
                        
                    });
                });


                /*************************************  Finalizar-reunion   *********************** */
                const finalizarDJ = document.querySelectorAll('.finalizarDiscusionJ');
                finalizarDJ.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
                    $.ajax({
                        url: event.srcElement.href,
                        type: "GET",
                        headers:{
        
                        },
                        data:{},
                        success: function (data){
                            
                           /* document.getElementById("listaReunionUltimo").innerHTML=data.htmu;
                            formatElements("listaReunionUltimo");
                            document.getElementById("listaReunionAll").innerHTML=data.htma;
                            formatElements("listaReunionAll");
                            $('#listaReunion').dataTable({
                                "order": [[ 0, "desc" ]],
                            });
                            $('#listaReunionUltimas').dataTable({
                                "order": [[ 0, "desc" ]],
                            });  
                            recargarTablaInicioReunion();     */ 
                            document.getElementById('finalizadoModalLabel').innerHTML= '¿Desea finalizar la reunion?';
                            document.getElementById('btnSaveAccionDJ').setAttribute("href", event.srcElement.href );
                            document.getElementById("btnSaveAccionDJ").onclick = function(event){
                                guardarEstadoD(event);
                                event.preventDefault();
                  
                            }
                            
                        },
                        error: function (err) {
                            alertify.error('error en la respuesta del servidor');
                        },
                        complete: function (xhr, status) {
                            
                        }
                    });
                }))
                /*************************************  Bloquear-reunion   *********************** */
                const bloquearDJ = document.querySelectorAll('.bloquearDiscusionJ');
                bloquearDJ.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
                    $.ajax({
                        url: event.srcElement.href,
                        type: "GET",
                        headers:{
        
                        },
                        data:{},
                        success: function (data){
                            
                           /* document.getElementById("listaReunionUltimo").innerHTML=data.htmu;
                            formatElements("listaReunionUltimo");
                            document.getElementById("listaReunionAll").innerHTML=data.htma;
                            formatElements("listaReunionAll");
                            $('#listaReunion').dataTable({
                                "order": [[ 0, "desc" ]],
                            });
                            $('#listaReunionUltimas').dataTable({
                                "order": [[ 0, "desc" ]],
                            });  
                            recargarTablaInicioReunion();     */ 
                            document.getElementById('finalizadoModalLabel').innerHTML= '¿Desea bloquer la reunion?';
                            document.getElementById('btnSaveAccionDJ').setAttribute("href", event.srcElement.href );
                            document.getElementById("btnSaveAccionDJ").onclick = function(event){
                                guardarEstadoD(event);
                                event.preventDefault();
                            }
                            
                        },
                        error: function (err) {
                            alertify.error('error en la respuesta del servidor');
                        },
                        complete: function (xhr, status) {
                            
                        }
                    });
                }))
                /******************** Guardar el estado de la discusion  ***************************************** */
                document.getElementById("btnSaveAccionDJ").onclick = function(event){
                    
                    guardarEstadoD(event);
                    event.preventDefault();
                    
                }
                function guardarEstadoD(event){
                    
                    $.ajax({
                        url: event.srcElement.getAttribute('href'),
                        type: "POST",
                        headers: {
                            'banderaHeader':'guardarEstadoReunion',

                        },
                        data: {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
                        dataType: 'json',
                        success: function (data) {
    
                            console.log('estadoooo');
                            document.getElementById("listaReunionUltimo").innerHTML=data.htmu;
                            formatElements("listaReunionUltimo");
                            document.getElementById("listaReunionAll").innerHTML=data.htma;
                            formatElements("listaReunionAll");

                            recargarTablaInicioReunion();    

                            recargarFormatoReunion();
                            recargarSelectAll();
                            
                            document.getElementById("btnSaveAccionDJ").onclick = function(event){
                                
                                guardarEstadoD(event);
                                event.preventDefault();
                                
                            }
                            $("#mFinalizarDJ").modal("hide");
                            alertify.alert('Se guardo correctamente el estado', function(){alertify.success('confirmed'),1000});	
						

                        },
                        error: function (err) {
                            alertify.error('error en la respuesta del servidor');
                        },
                        complete: function (xhr, status) {
                            
                        }
                    });

                }

/********************   Comentarios   ********************************************************* */
    /****************** Seleccionar la discusion cambia la lista de comentarios a ver  *********************** */

    var slcDiscusionJef =  $("#seleccionable_reuniones_discusionJefatura");
    document.getElementById('btnAgregarComentReu').disabled=true;

    slcDiscusionJef.change(function(event){
        console.log(slcDiscusionJef.val());
        
        var ruta= event.currentTarget.dataset.ruta_lista_comentarios;// es necesario cambiar el /0 de la ruta que usamos y poner el /id
        ruta= ruta.substring(0, ruta.length - 1)+slcDiscusionJef.val(); //ruta corregida

        $.ajax({
            url: ruta,
            type: "POST",
            headers: {
                
            },
            data:  {}, 
            dataType: 'json',
            success: function (data) {
                if(data.estadoDJ != 1){
                    document.getElementById('btnAgregarComentReu').disabled=true;
                }else{
                    document.getElementById('btnAgregarComentReu').disabled=false;
                }
                document.getElementById("comentlits").innerHTML=data.htm;
                formatElements("comentlits");
                recargarComentariosRespuesta()
                document.getElementById("comentlits").disabled=true;
            }
            
        });
    });
    document.getElementById("btnAgregarComentReu").onclick = function(event) {
        $.ajax({
            url: event.srcElement.dataset.acuerdos_a,
            type: "POST",
            headers: {
                'banderaHeader':'crearFormularioComentario',
                'dJefatura': slcDiscusionJef.val(),
                'respuesta': 0
            },
            data: {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
            dataType: 'json',
            success: function (data) {
                document.getElementById("comentrespuesta").innerHTML=data.htm;
                formatElements("comentrespuesta");
                //document.getElementById("btnComentReu").setAttribute("data-dismiss","modal");                
                document.getElementById("btnComentReu").onclick = function(event) {
                    event.preventDefault();
                    guardarComentario();
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
     /************************* Agregar comentario  ********************************************************************************** */

    function guardarComentario(){
        if(!document.getElementById('form_comentario').reportValidity()){
            console.log('enviar')
       }
       else{        
        console.log(slcDiscusionJef.val());
        var formularioComentario= document.getElementsByName('comentario_reunion');
        
        var form = $("#form_comentario");
        
        $.ajax({
            
            url: form[0].action,
            type: "POST",
            headers: {
                'banderaHeader':'crearFormularioComentario',
                'dJefatura': slcDiscusionJef.val()
            },
            data:  form.serialize(), //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
            dataType: 'json',
            success: function (data) {
                if(data.mensajes[0]!=''){
                    alertify.error('hubo un error');
                    
                }else{
                    alertify.success('Se guardo con extio');
                }
                document.getElementById("comentrespuesta").innerHTML=data.htm;
                formatElements("comentrespuesta");
                document.getElementById("comentlits").innerHTML=data.htmc;
                formatElements("comentlits");
                $('#respuestaModal').modal('hide');
                //document.getElementById("btnComentReu").setAttribute("data-dismiss","modal");   
                document.getElementById("btnComentReu").onclick = function(event) {
                    event.preventDefault();
                    guardarComentario();
                };
                recargarComentariosRespuesta();
                $("#respuestaModal").modal("hide");
                $("#form_comentario")[0].reset();
            },
            error: function (err) {
                if(form.find('#comentario_reunion_tituloComent').val()===''){
                    alertify.alert("Campo vacio","Agregue un titulo", function(){
                        alertify.message('OK');
                    });
                   return false;
                }
                
                if(form.find('#comentario_reunion_mensaje').val()===''){
                    alertify.alert("Campo vacio","Agregue un mensaje", function(){
                        alertify.message('OK');
                    });
                   return false;
                }else{
                    alertify.alert("Error al ingresar datos","Revise que los datos esten correctos", function(){
                        alertify.message('OK');
                    });
                }
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }
    }

    /************************* boton respuesta comentario  ********************************************************************************** 
    const responderForm = document.querySelectorAll('.botonesResponder');
    responderForm.forEach(el => el.addEventListener('click', event => { event.preventDefault();

        $.ajax({
            url: event.srcElement.href,
            type: "POST",
            headers: {
                
            },
            data:  {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
            dataType: 'json',
            success: function (data) {
                console.log('exito')
                document.getElementById("comentrespuesta").innerHTML=data.htm;
                formatElements("comentrespuesta");
                document.getElementById('btnComentRespuesta').setAttribute("href", event.srcElement.href );
                document.getElementById("btnComentRespuesta").onclick = function(event) {
                    event.preventDefault();
                    guardarRespuesta(event);
                };
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }));*/

    /*******************************guardar respuesta comentario */
    document.getElementById("btnComentRespuesta").onclick = function(event) {
        event.preventDefault();
        guardarRespuesta(event);
    };

    function guardarRespuesta(event){
        if(!document.getElementById('form_respuesta').reportValidity()){
            console.log('enviar')
       }
       else{
        var form = $("#form_respuesta");
        console.log(form);
        $.ajax({
            
            url: event.srcElement.getAttribute('href'),
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
                document.getElementById("comentrespuesta").innerHTML=data.htm;
                formatElements("comentrespuesta");
                document.getElementById("comentlits").innerHTML=data.htmc;
                formatElements("comentlits");
                document.getElementById("btnComentRespuesta").onclick = function(event) {
                     event.preventDefault();
                     guardarRespuesta(event);
                 };
                recargarComentariosRespuesta();
                
                $('#respuestaModal').modal('hide');
            },
            error: function (err) {
                if(form.find('#comentario_reunion_mensaje').val()===''){
                    alertify.alert("Campo vacio","Agregue un mensaje", function(){
                        alertify.message('OK');
                    });
                   return false;
                }else{
                    alertify.alert("Error al ingresar datos","Revise que los datos esten correctos", function(){
                        alertify.message('OK');
                    });
                }
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }
    }

/*********************Nuevo acuerdo**************************************** */
    /***************************Guardar acuerdo *************************** */
    document.getElementById("btnAcuerdos").onclick = function(event) {
        event.preventDefault();
        guardarAcuerdo();
    };

    function guardarAcuerdo() {
        if(!document.getElementById('form_acuerdo').reportValidity()){
            console.log('enviar')
       }
       else{
        console.log('guardarAcuerdo');
        var formularioAcuerdo= document.getElementsByName('acuerdo');
        var form= $("#form_acuerdo"); //llamar al objeto con jquery, de preferencia usar el id
        

        $.ajax({
            url: formularioAcuerdo[0].action,
            type: "POST",
            headers: {
                'banderaHeader':'crearFormularioAcuerdo'
            },
            data:  form.serialize(), //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
            dataType: 'json',
            
            success: function (data) {
                if(data.mensajes[0]!=''){
                    alertify.error('hubo un error');
                }else{
                    alertify.success('Se guardo con extio');
                }
                document.getElementById("acuerdo").innerHTML=data.htm;
                formatElements("acuerdo");
                document.getElementById("ListaAcuerdo").innerHTML=data.htmu;/**/
                formatElements("ListaAcuerdo");
                recargarFormatoAcuerdo();
                
                recargarAcuerdosLista();

                document.getElementById("btnAcuerdos").onclick = function(event) {
                    event.preventDefault();
                    guardarAcuerdo();
                };
                //$("#form_acuerdo")[0].reset();
            },
            error: function (err) {
                if(!document.getElementById('dj_add').value){
                    alertify.alert("Campo vacio","Selecciona una discusion en la que se trato el acuerdo", function(){
                        alertify.message('OK');
                    });
                    return false;
                }

                if(form.find('#acuerdo_nombre').val()===''){
                    alertify.alert("Campo vacio","Agruegue un nombre al acuerdo", function(){
                        alertify.message('OK');
                    });
                   return false;
                }
                if(!document.getElementById('acuerdo_supervisor').value){
                    alertify.alert("Campo vacio","Selecciona a una persona que supervisara el acuerdo", function(){
                        alertify.message('OK');
                    });
                    return false;
                }
                if(form.find('#acuerdo_fechaVigencia').val()===''){
                    alertify.alert("Campo vacio","Agruegue fecha que entra en vigencia", function(){
                        alertify.message('OK');
                    });
                   return false;
                }
                if(!document.getElementById('acuerdo_descripcion').value){
                    alertify.alert("Campo vacio","Agregue una descripcion al acuerdo", function(){
                        alertify.message('OK');
                    });
                    return false;
                }
                if(!document.getElementById('dep_add').value){
                    alertify.alert("Campo vacio","Seleccione los departamentos que deben cumplirlo", function(){
                        alertify.message('OK');
                    });
                    return false;
                            
                   
                }else{
                    alertify.alert("Error al ingresar datos","Revise que los datos esten correctos", function(){
                        alertify.message('OK');
                    });
                }

                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }
    }
    /*************************************  tabla de acuerdo -mostar   *********************** */
    const mostarAcuerdo = document.querySelectorAll('.mostrarAcuerdo');
    mostarAcuerdo.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
        $.ajax({
            url: event.srcElement.href,
            type: "GET",
            headers:{

            },
            data:{},
            success: function (data){
                if(data.mensajes[0]!='') {
                    alertify.error('hubo un error');
                } else {
                    alertify.success('Se guardo con extio');
                }
                document.getElementById("infoAcuerdo").innerHTML=data.htm;
                formatElements("infoAcuerdo");            
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }))
    /*************************************  tabla de acuerdo -editar   *********************** */
    const editAcuerdo = document.querySelectorAll('.editarAcuerdo');
    editAcuerdo.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
        
        $.ajax({
            url: event.srcElement.href,
            type: "POST",
            headers: {
                
            },
            data:  {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
            dataType: 'json',
            success: function (data) {
                
                document.getElementById("editarAcuerdo").innerHTML=data.htm;
                formatElements("editarAcuerdo");
                document.getElementById('btnEditarAcuerdos').setAttribute("href", event.srcElement.href );
                document.getElementById("btnEditarAcuerdos").onclick = function(event) {
                    event.preventDefault();
                    editarAcuerdo(event);
                };

            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }))

    /******************** Guardar la edicion del acuerdo************************************* */
    /*document.getElementById("btnEditarAcuerdos").onclick = function(event) {
        event.preventDefault();
        editarAcuerdo(event);
    };*/

    function editarAcuerdo(event) {
        if(!document.getElementById('form_acuerdo_edit').reportValidity()){
            console.log('enviar')
       }
       else{
        
        var form= $("#form_acuerdo_edit"); 
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
                document.getElementById("editarAcuerdo").innerHTML=data.htm;
                formatElements("editarAcuerdo");
                document.getElementById("ListaAcuerdo").innerHTML=data.htmu;
                formatElements("ListaAcuerdo");
                recargarFormatoAcuerdo();
                recargarAcuerdosLista();

                document.getElementById("btnEditarAcuerdos").onclick = function(event) {
                    event.preventDefault();
                    editarAcuerdo(event);
                };  
                $("#editarInfoAcuerdo").modal("hide");          
            
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
            
            }
        });
    }
    }


/******************************otros****************** */
/****************************recargar formato tablas de reunion */
function recargarFormatoReunionAll(){

    $('#listaReunion').dataTable({
        "order": [[ 0, "desc" ]],
        
    });
}
/****************************recargar formato tablas de reunion */
function recargarFormatoReunion(){
    $('#listaReunion').dataTable({
         "order": [[ 0, "desc" ]],
         //"scrollX": true,
    });
    
    $('#listaReunionUltimas').dataTable({
        "order": [[ 0, "desc" ]],

    });
}


/**********************Recargar formato tabla acuerdo */
function recargarFormatoAcuerdo(){
    $('#listaAcuerdos').dataTable({
        "order": [[ 0, "desc" ]],

    });
}
function recargarSelectAll(){
                var slcListaDiscusion =  $("#selectReunionBuscar");
                console.log(slcListaDiscusion.val());
                
                $rutaAll = document.getElementById("selectReunionBuscar").getAttribute('href');                   
                if(slcListaDiscusion.val() != 'none'){
                    $.ajax({
                        url: $rutaAll,
                        type: "POST",
                        headers: {
                            'banderaHeader' : slcListaDiscusion.val()
                        },
                        data:  {}, 
                        dataType: 'json',
                        success: function (data) {
                        
                            document.getElementById("listaReunionAll").innerHTML=data.htma;
                            //formatElements("listaReunionAll");
                            $('#listaReunion').dataTable({
                                "order": [[ 0, "desc" ]],
                            });
                            recargarTablaInicioReunion();

                        
                        },
                        error: function (err) {
                            alertify.error('error en la respuesta del servidor');
                        },
                        complete: function (xhr, status) {
                            
                        }
                        
                    });
                }
               
}


function recargarTablaInicioReunion() {
        /*************************************  tabla de reunion -mostar   *********************** */
        const mostarDJ = document.querySelectorAll('.mostrarDiscusiones');
        mostarDJ.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
            $.ajax({
                url: event.srcElement.href,
                type: "GET",
                headers:{

                },
                data:{},
                success: function (data){
                    
                    document.getElementById("infoDJ").innerHTML=data.htm;
                    formatElements("infoDJ");            
                },
                error: function (err) {
                    alertify.error('error en la respuesta del servidor');
                },
                complete: function (xhr, status) {
                    
                }
            });
        }))
        /*************************************  tabla de reunion -editar   *********************** */
        const editarDJ = document.querySelectorAll('.editarDiscusiones');
        editarDJ.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
            $.ajax({
                url: event.srcElement.href,
                type: "POST",
                headers: {
                    
                },
                data:  {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
                dataType: 'json',
                success: function (data) {
                    
                    document.getElementById("editDJ").innerHTML=data.htm;
                    formatElements("editDJ");
                    document.getElementById('btnEditarDiscusion').setAttribute("href", event.srcElement.href );
                    document.getElementById("btnEditarDiscusion").onclick = function(event) {
                        event.preventDefault();
                        editarReunion(event);
                    };
                },
                error: function (err) {
                    alertify.error('error en la respuesta del servidor');
                },
                complete: function (xhr, status) {
                    
                }
            });
        }))
         /*************************************  Finalizar-reunion   *********************** */
         const finalizarDJ = document.querySelectorAll('.finalizarDiscusionJ');
         finalizarDJ.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
             $.ajax({
                 url: event.srcElement.href,
                 type: "GET",
                 headers:{
 
                 },
                 data:{},
                 success: function (data){
                     
                     document.getElementById('finalizadoModalLabel').innerHTML= '¿Desea finalizar la reunion?';
                     document.getElementById('btnSaveAccionDJ').setAttribute("href", event.srcElement.href );
                     document.getElementById("btnSaveAccionDJ").onclick = function(event){
                         guardarEstadoD(event);
                         event.preventDefault();
           
                     }
                 },
                 error: function (err) {
                     alertify.error('error en la respuesta del servidor');
                 },
                 complete: function (xhr, status) {
                     
                 }
             });
         }))
        /*************************************  Bloquear-reunion   *********************** */
        const bloquearDJ = document.querySelectorAll('.bloquearDiscusionJ');
        bloquearDJ.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
            $.ajax({
                url: event.srcElement.href,
                type: "GET",
                headers:{

                },
                data:{},
                success: function (data){
                    
                    document.getElementById('finalizadoModalLabel').innerHTML= '¿Desea bloquear la reunion?';
                    document.getElementById('btnSaveAccionDJ').setAttribute("href", event.srcElement.href );
                    document.getElementById("btnSaveAccionDJ").onclick = function(event){
                        guardarEstadoD(event);
                        event.preventDefault();
          
                    }       
                      
                },
                error: function (err) {
                    alertify.error('error en la respuesta del servidor');
                },
                complete: function (xhr, status) {
                    
                }
            });
        }))


      

}

function recargarComentariosRespuesta(){
     /************************* boton respuesta comentario  ********************************************************************************** */
     const responderForm = document.querySelectorAll('.botonesResponder');
     responderForm.forEach(el => el.addEventListener('click', event => { event.preventDefault();
 
         $.ajax({
             url: event.srcElement.href,
             type: "POST",
             headers: {
                 
             },
             data:  {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
             dataType: 'json',
             success: function (data) {
                 
                 document.getElementById("comentrespuesta").innerHTML=data.htm;
                 formatElements("comentrespuesta");
                 document.getElementById('btnComentRespuesta').setAttribute("href", event.srcElement.href );
                 document.getElementById("btnComentRespuesta").onclick = function(event) {
                     event.preventDefault();
                     guardarRespuesta(event);
                 };
             },
             error: function (err) {
                 alertify.error('error en la respuesta del servidor');
             },
             complete: function (xhr, status) {
                 
             }
         });
     }));

}

function recargarAcuerdosLista(){
    /*************************************  tabla de acuerdo -mostar   *********************** */
    const mostarAcuerdo = document.querySelectorAll('.mostrarAcuerdo');
    mostarAcuerdo.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
        $.ajax({
            url: event.srcElement.href,
            type: "GET",
            headers:{

            },
            data:{},
            success: function (data){
                
                document.getElementById("infoAcuerdo").innerHTML=data.htm;
                formatElements("infoAcuerdo");            
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }))
    /*************************************  tabla de acuerdo -editar   *********************** */
    const editAcuerdo = document.querySelectorAll('.editarAcuerdo');
    editAcuerdo.forEach(el => el.addEventListener ('click', event => {event.preventDefault();  
        $.ajax({
            url: event.srcElement.href,
            type: "POST",
            headers: {
                
            },
            data:  {}, //transforma los datos en una cadena y se mandan al servidor para que esto los reciva
            dataType: 'json',
            success: function (data) {
                
                document.getElementById("editarAcuerdo").innerHTML=data.htm;
                formatElements("editarAcuerdo");
                document.getElementById('btnEditarAcuerdos').setAttribute("href", event.srcElement.href );
                document.getElementById("btnEditarAcuerdos").onclick = function(event) {
                    event.preventDefault();
                    editarAcuerdo(event);
                };
            },
            error: function (err) {
                alertify.error('error en la respuesta del servidor');
            },
            complete: function (xhr, status) {
                
            }
        });
    }))


}

