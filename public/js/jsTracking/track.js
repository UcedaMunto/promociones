
    var text; var textError;
    var jsonDat;
    var arr1ids= ["desc1","desc2","desc3","desc4","desc5","desc6",];
    var arr3ids= ["desc1E3","desc2E3","desc3E3","desc4E3","desc5E3","desc6E3",];
    var fechas1ids= ["fecha_1","fecha_2","fecha_3","fecha_4","fecha_5","fecha_6",]; //Fechas principales
    var fechas3ids= ["fecha3_1","fecha3_2","fecha3_3","fecha3_4","fecha3_5","fecha3_6",];
    var arr1ErroIds=['desc_prob_a_1', 'desc_prob_a_2', 'desc_prob_a_3', 'desc_prob_a_4', 'desc_prob_a_5', 'desc_prob_a_6', ];
    var arr1ButtonIds=['verDetalles1_p1', 'verDetalles1_p2', 'verDetalles1_p3', 'verDetalles1_p4', 'verDetalles1_p5', 'verDetalles1_p6', ];
    var arr3ErroIds=['desc_prob_c_1', 'desc_prob_c_2', 'desc_prob_c_3', 'desc_prob_c_4', 'desc_prob_c_5', 'desc_prob_c_6', ]; //id de mensajes de error
    var arr3ButtonIds=['verDetalles3_p1', 'verDetalles3_p2', 'verDetalles3_p3', 'verDetalles3_p4', 'verDetalles3_p5', 'verDetalles3_p6', ]; //id de boton para errores
    var fechasConte=['Sin datos aun','Sin datos aun', 'Sin datos aun','Sin datos aun','Sin datos aun', 'Sin datos aun',];

    text=[
        "- Ingreso de información del auto y el cliente al sistema Inbakcar. Iniciamos la logistica para mover el vehículos a la yarda. <strong>Obligatorio para continuar: Factura a cero</strong>",
        "- Su auto se está movilizando a la yarda, usando uno o varios servicios de gruas. Este paso puede demorarse por sucesos climáticos",
        "- Su auto se ha movido a un almecen mientras espera se le asigna un contenedor<strong> Obligatorio para continuar: titulo del vehículo o tramitarlo</strong>",
        "- Recolectamos la documentación de su auto, título, fotos de yarda, preparamos la documentación del contenedor en el que se traerá",
        "- El vehículo se coloca en un contenedor con otros vehículos para ser transportados. OJO: este dato es tentativo puede variar por condiciones climaticas o de pandemia",
        "- El contenedor con su auto se ha cargado en un barco y esta camino hacia la aduana ",
    ];
    textError=[
        "- Sin comentarios",
        "- Sin comentarios",
        "- Sin comentarios",
        "- Sin comentarios",
        "- Sin comentarios",
        "- Sin comentarios",
    ];
    //Contenidos
    arr1ids.forEach(llenar); 
    arr3ids.forEach(llenar);
    //Contenidos
    arr1ErroIds.forEach(llenarErrores);
    arr3ErroIds.forEach(llenarErrores);

    //escucha para los butones
    arr1ButtonIds.forEach(escuchar);
    fechas1ids.forEach(llenarFechas);
    fechas3ids.forEach(llenarFechas);
    

    function llenar(item, index) {
        document.getElementById(item).innerHTML = text[index];
    }
    function llenarFechas(item, index){
        document.getElementById(item).innerHTML = fechasConte[index];
        return 0;
    }
    function llenarErrores(item, index) {
        document.getElementById(item).innerHTML = textError[index];
    }
    function llenarErrores(item, index) {
        document.getElementById(item).innerHTML = textError[index];
    }

    function escuchar(item, index){
        document.getElementById(item).addEventListener("click", function(){
            
            var index= arr1ButtonIds.indexOf(item);
            var dat=document.getElementById(arr1ErroIds[index]);

            if(dat.classList.contains('intangible') ){
                document.getElementById(arr1ErroIds[index]).classList.remove("intangible");
            }else{
                document.getElementById(arr1ErroIds[index]).classList.add("intangible");
            }
            
        });
    }
    document.getElementById("verMas3").addEventListener("click", function(){
        arr3ErroIds.forEach(
            function(item, index){
                var dat=document.getElementById(item);
                if(dat.classList.contains('intangible') ){
                    document.getElementById(item).classList.remove("intangible");
                }else{
                    document.getElementById(item).classList.add("intangible");
                }
            }
        );
    });

    $("#formTrack").click(function (event) {
        event.preventDefault()
            getStatus( document.getElementById('filtro_tracking_vin').value, document.getElementById('filtro_tracking_lote').value  );
      })
    
    function inicializar(){
        if(document.getElementById('filtro_tracking_vin').value !='' ){
            getStatus( document.getElementById('filtro_tracking_vin').value, document.getElementById('filtro_tracking_lote').value  );
        }
    }

    function getStatus( vin, lote){
        //puertoTemp= parseInt( yardaCom.val());
        $.ajax({
                url: window.location,
                type: "POST",
                dataType: "JSON",
                data: {
                    vin: vin, lote: lote
                },
            success: function (data) {
                fechasConte=['Sin datos aun','Sin datos aun', 'Sin datos aun','Sin datos aun','Sin datos aun', 'Sin datos aun',];
                textError=["- Sin comentarios","- Sin comentarios","- Sin comentarios","- Sin comentarios","- Sin comentarios","- Sin comentarios", ];
                $("#contenedor_listaAutos").empty();
                jsonDat = data;
                //fechas principales
                document.getElementById('datosAuto').innerText=jsonDat.marca+' / '+jsonDat.modelo+' / '+jsonDat.anio;
                if( jsonDat.fechasPrincipales==3  ){
                    jsonDat.fechasPrincipales[2]=jsonDat.fechasPrincipales[1];
                    //jsonDat.fechasPrincipales[1]=jsonDat.fechasPrincipales[1];
                }
                console.log(jsonDat);
                jsonDat.fechasPrincipales.forEach( function(item, index){
                    var olas='';
                    console.log('estado recibido');
                    if( index+2 == jsonDat.estado && jsonDat.estado!=3){
                        olas='<div class="wave2"></div>';
                    }
                    var fechaEjemplo = new Date( item.date );
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    fechasConte[index]=  fechaEjemplo.toLocaleDateString('es-ES', options)+' '+ fechaEjemplo.getHours() +':'+ fechaEjemplo.getMinutes()+':'+ fechaEjemplo.getSeconds()+ olas;

                    console.log(jsonDat.enYarda);
                    if(jsonDat.enYarda){
                        fechasConte[1]='movido por el cliente';
                    }
                });

                

                fechas1ids.forEach(llenarFechas);
                fechas3ids.forEach(llenarFechas);
                //Paso 2 datos de gruas
                    var descripcionGruas='';
                    jsonDat.gruas.forEach( function(item, index){
                        var fechaGruas = new Date( jsonDat.fechasPrincipales[index].date );
                        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                        descripcionGruas= descripcionGruas+'grua:'+(index+1)+' '+fechaGruas.toLocaleDateString('es-ES', options)+'<br>';
                    });
                textError[1]=descripcionGruas; arr3ErroIds.forEach(llenarErrores);
                //Repartir comentarios
                var logoWhatsapp='<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="width: 20px;enable-background:new 0 0 512 512;height: 20px;" xml:space="preserve"><path style="fill:#4CAF50;" d="M256.064,0h-0.128l0,0C114.784,0,0,114.816,0,256c0,56,18.048,107.904,48.736,150.048l-31.904,95.104  l98.4-31.456C155.712,496.512,204,512,256.064,512C397.216,512,512,397.152,512,256S397.216,0,256.064,0z"></path><path style="fill:#FAFAFA;" d="M405.024,361.504c-6.176,17.44-30.688,31.904-50.24,36.128c-13.376,2.848-30.848,5.12-89.664-19.264  C189.888,347.2,141.44,270.752,137.664,265.792c-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624,26.176-62.304  c6.176-6.304,16.384-9.184,26.176-9.184c3.168,0,6.016,0.16,8.576,0.288c7.52,0.32,11.296,0.768,16.256,12.64  c6.176,14.88,21.216,51.616,23.008,55.392c1.824,3.776,3.648,8.896,1.088,13.856c-2.4,5.12-4.512,7.392-8.288,11.744  c-3.776,4.352-7.36,7.68-11.136,12.352c-3.456,4.064-7.36,8.416-3.008,15.936c4.352,7.36,19.392,31.904,41.536,51.616  c28.576,25.44,51.744,33.568,60.032,37.024c6.176,2.56,13.536,1.952,18.048-2.848c5.728-6.176,12.8-16.416,20-26.496  c5.12-7.232,11.584-8.128,18.368-5.568c6.912,2.4,43.488,20.48,51.008,24.224c7.52,3.776,12.48,5.568,14.304,8.736  C411.2,329.152,411.2,344.032,405.024,361.504z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';
                jsonDat.comentarios.forEach(
                    function(item, index){

                        var linkwhats= 
                        "https://api.whatsapp.com/send?phone="+  item.celular +"&text=Hola%20sobre%20el%20auto%20con%20vin%20"+jsonDat.vin+"%20lote%20"+
                            jsonDat.lote+"%20link%20https://"+window.location.host+"/envio/"+item.envio;

                        var fechaComentario = new Date( item.fechaCreacion.date );
                        /* ------------------REPARTIENDO LOS COMENTARIOS EN CADA FASE POR ORDEN DE FECHAS ------------------------- */
                        if( jsonDat.fechasPrincipales.length == 1){
                            textError[0]= 
                                textError[0]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                        }else{
                            var ultimo=jsonDat.fechasPrincipales.length-1;
                            if( fechaComentario> new Date( jsonDat.fechasPrincipales[ultimo].date) ){
                                textError[ultimo]= 
                                textError[ultimo]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';

                            }
                            for(var i=0;i<=ultimo-1 ;i++){
                                if( fechaComentario> new Date( jsonDat.fechasPrincipales[i].date) && fechaComentario<= new Date( jsonDat.fechasPrincipales[i+1].date)){
                                    textError[i]= 
                                    textError[i]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                                }
                            }
                        }

                        
                        /*if( jsonDat.fechasPrincipales.length == 1){
                            textError[0]= 
                                textError[0]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                        }else if(jsonDat.fechasPrincipales.length==2 ){
                            if( fechaComentario<= new Date( jsonDat.fechasPrincipales[1].date) ){
                                textError[0]= 
                                textError[0]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                            }else{
                                textError[1]= 
                                textError[1]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                            }
                        }else{
                            if( fechaComentario<= new Date(jsonDat.fechasPrincipales[1].date) ){
                                    textError[0]= 
                                    textError[0]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                            }
                            else if( new Date(jsonDat.fechasPrincipales[1].date)<fechaComentario && fechaComentario
                                        <= new Date(jsonDat.fechasPrincipales[2].date) ){
                                    textError[1]= 
                                    textError[1]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                            }
                            else if(jsonDat.fechasPrincipales.length > 3)
                                if( new Date(jsonDat.fechasPrincipales[2].date)<fechaComentario && fechaComentario
                                        <= new Date(jsonDat.fechasPrincipales[3].date) ){
                                    textError[2]= 
                                    textError[2]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                                }
                            else if(jsonDat.fechasPrincipales.length > 4)
                                if( new Date(jsonDat.fechasPrincipales[3].date)<fechaComentario && fechaComentario
                                        <= new Date(jsonDat.fechasPrincipales[4].date) ){
                                    textError[3]= 
                                    textError[3]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                                }
                            else if(jsonDat.fechasPrincipales.length > 5)
                                if( new Date(jsonDat.fechasPrincipales[4].date)<fechaComentario && fechaComentario
                                        <= new Date(jsonDat.fechasPrincipales[5].date) ){
                                    textError[4]= 
                                    textError[4]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                                }
                            else if(jsonDat.fechasPrincipales.length > 6)
                                if( new Date(jsonDat.fechasPrincipales[5].date)<fechaComentario && fechaComentario
                                        <= new Date(jsonDat.fechasPrincipales[6].date) ){
                                    textError[5]= 
                                    textError[5]+'<strong>- '+ item.titulo+': </strong>'+item.mensaje +' <a  target="_blank" href="'+linkwhats+'">' +logoWhatsapp+'</a> <br>';
                                }
                        }*/
                    }
                );
                arr1ErroIds.forEach(llenarErrores);
                arr3ErroIds.forEach(llenarErrores);
            },
            complete: function(){
                
                
            },
            error: function (err) {
                alertify.warning('No encontramos datos, intente ingresar tanto el vin como el lote o solo uno de ellos'); 
            }
        });
    };

    inicializar();


  

