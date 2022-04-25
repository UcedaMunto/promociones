
/*  ESTE CODIGO SE EJECUTA AUTOMATICAMENTE CUANDO SE ACCEDE A LA PAGINA show DE ACTIVO */
    
    cantidad = 50;      // Maximo de fotos que se van a poder mostrar por articulo
    vartest=null;       // Variable solo para revisar los datos que se van a recibir del controlador mas abajo desde consola
    $.ajax({
            url: window.location.href,  // Se envia la peticion al controlador la funion 'show' porque es donde estamos a este punto
            type: "POST",               
            dataType: "JSON",           // El tipo de dato qe se va a recibir es un JSON
            data: {
                page: 0,                // Es una bandera nomas para decirle al index del controlador que ejecute el codigo para retornarnos los datos de las imagenes que requerimos
            },
            success: function (data) {  // El metodo que ejecuta con lo que recibe del controlador 
                vartest= data;
                llenarFotos('fotosactivos', data, cantidad );   // Aqui se inboca la funcion para llenar el div: 'fotosactivos' con lo que se recibio del controlador en el JSON 'data' y la el maximo de fotos a mostrar 'cantidad' 
            },
            error: function (err) {                     // Si hay algun error y al enviar la peticion al controlador 
                alert(err);     
            }
    });

/*       FIN DEL CODIGO AUTOMATICO                           */




    function llenarFotos(destino, data, cantidad){      // Metodo para usar el div 'fotosactivos' insertando todas las fotos o mejor dicho hasta el maximo que en este caso es dictado por el parametro cantidad 
        $nombre= "#"+destino;                           // Le agrega el simbolo # al principio porque asi se puede identificar el div por id en javascript
        $($nombre).empty();                             // Vacia el DIV si a caso hay algo
        if(data.fotos.length>0){                        
            //$("#contenedor_listaAutos").append('<option value> Seleccione los autos ...</option>'); //+ $("#contenedor_listaAutos").find("option:selected").text() + 
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };    // Creamos los parametros a utilizar abajo para darle formato a la fecha  
            for (  i = 0 ; i < data.fotos.length; i++){             // Vamos a recorrer el arreglo una cantidad de veces de acuerdo a la antidad de datos dentro del arreglo fotos dentro del JSON
                var fecha= data.fotos[i].creacion.date.substring(0,10);     // Aqui solo saca el string de la fecha sin hora
                var creacion = new Date( data.fotos[i].creacion.date );     // Aqui lo convierte en tipo fecha de nuevo
                var nuevaImagen=                                            // Aqui crea la cadena con los datos de cada foto a insertar dentro del div 
                '<div class="col-md-4"><a class="example-image-link" href="'+data.host+'/'+data.fotos[i].nombre+'" data-lightbox="example-set"'+
                ' data-title="'+fecha+'">'+                         
                '<div class="card mb-4 box-shadow">'+
                '<img class="card-img-top" data-src="'+data.host+'/'+data.fotos[i].nombre+
                '" src="'+data.host+'/'+data.fotos[i].nombre+'" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">'+
                '<div class="card-body">'+data.fotos[i].nombre+
                '<p class="card-text">'+creacion.toLocaleDateString('es-ES', options)+' </p>'+
                '</div>'+
                '</div>'+
                '</a></div>';
                if(i<cantidad ){
                    $($nombre).append(nuevaImagen);
                } else {
                    i = data.fotos.length+1;
                }
            }
        }
    }