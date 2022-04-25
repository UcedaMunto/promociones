
document.getElementById("enviar").addEventListener("click", comprecionUpload);
var tt;
var files=[];
var imgs=[];
var fileList=[];var fileListHeif=[]; fileListHeic=[];
var max_width = 1024;
var max_height = 1024;
var combo1=document.getElementById("filtro_identificador_auto_listaAutos");
var combo2=document.getElementById("identificador");
var contador=0; var contador2=0; var contador3=0; var contador4=0;

function comprecionUpload(){
    fileList = document.getElementById('file').files;
    if(combo1.value=='' && combo2.value==''){
        alertify.error('select a car, or type a vin or lot');
        return 0;
    }
    if(fileList.length==0 ){
        alertify.error('I do not select files');
        return 0;
    }
    
    var result = new Promise( function(resolve,reject){
        reducir();
        resolve(1);
    });
    

    verificarCompress();
    return 1;
}
async function reducir(){
    contador=0;contador2=0; contador3=0;contador4=0;
    var numFiles = fileList.length;
    for (let i = 0;  i < numFiles; i++) {
        const file = fileList[i];
        if (file.name.split('.')[1]=='heif') {
            fileListHeif[contador2]=file;
            contador2++;
        }else if (file.name.split('.')[1]=='heic') {
            fileListHeic[contador3]=file;
            contador3++;
        }else if (file.name.split('.')[1]=='jpg' || file.name.split('.')[1]=='JPG' 
                    || file.name.split('.')[1]=='png' || file.name.split('.')[1]=='PNG' 
                    || file.name.split('.')[1]=='jpeg' || file.name.split('.')[1]=='JPEG') {
            imgs.push( new Image() );
            var objectUrl = window.URL.createObjectURL(file);
            imgs[contador].src = objectUrl;
            const imgTemp=imgs[contador];
            imgTemp.onload = function() {
                console.log('reducir: '+i+'----'+file.name.split('.')[1]+'--' + imgs.length);
                 resize_image(imgTemp, contador);
            }
            contador++;
        }else{
            contador4++;
        };
        
    }
    return 1;  
}
resize_image = async function(img, i){
    console.log('resize_image h '+ img.height+' w '+ img.width);
    const canvas = document.createElement('canvas');
    var ctx = canvas.getContext("2d");
    var canvasCopy = document.createElement("canvas");
    var copyContext = canvasCopy.getContext("2d");
    var ratio = 1;
    if(img.width > max_width)
        ratio = max_width / img.width;
    else if(img.height > max_height)
        ratio = max_height / img.height;
    canvasCopy.width = img.width;
    canvasCopy.height = img.height;
    copyContext.drawImage(img, 0, 0)
    canvas.width = img.width * ratio
    canvas.height = img.height * ratio
    ctx.drawImage(canvasCopy, 0, 0, canvasCopy.width, canvasCopy.height, 0, 0, canvas.width, canvas.height)
    files.push(canvas.toDataURL("image/png"));
    console.log('resize_image fin');
}

function cargar(id, valor){
    var t1=document.getElementById(id);
    t1.style.width=valor;
    t1.textContent=valor;
}

function verificarCompress(){
    if(imgs.length!=0){
         var v= files.length*100/imgs.length;
         cargar('compresion', v+'%');
    }else{
        cargar('compresion', '0%');
    }
    setTimeout(function(){
        console.log( files.length +'-'+ fileListHeif.length+'-'+fileListHeic.length+'-  = '+ imgs.length);
        if( files.length == imgs.length ){
            console.log('resuelta');
            cargar('compresion', '100%');
            if( imgs.length==0 ){
                alertify.error('Data not valid');
                return 0;
            }
            enviar();
        }else{
            verificarCompress();
        }
    }, 500);
}
function enviar(){
    console.log('enviando: '+files.length);
    var fd = new FormData ();
    files.forEach(function(item, index){
        fd.append ("img_"+index,  item); 
    });
    fileListHeif.forEach(function(item, index){
        fd.append ("heif_"+index,  item); 
        console.log(index+'-Heif');
    });
    fileListHeic.forEach(function(item, index){
        fd.append ("heic_"+index,  item); 
        console.log(index+'-Heic');
    });
    fd.append ("tipo", 1);
    fd.append ("idDetalleCompra", combo1.value);
    fd.append ("vin", combo2.value);
    fd.append ("cantidad", contador);
    fd.append ("cantidad2", contador2);
    fd.append ("cantidad3", contador3);
    fd.append ("vehiculo", 30);
   /* 
    var xhr = new XMLHttpRequest (); 
    xhr.open ("POST", window.location.href); 
    xhr.send (fd);
    */

    $.ajax({
        url: window.location.href,
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        xhr: function(){
            var xhr = new window.XMLHttpRequest();
            //Upload progress
            xhr.upload.addEventListener("progress", function(evt){
            if (evt.lengthComputable) {
              var percentComplete = evt.loaded*100/ evt.total;
              cargar('uploading', percentComplete+'%');
              }
            }, false);
            xhr.addEventListener("progress", function(evt){
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded*100/evt.total;
                cargar('uploading', percentComplete+'%');
              }
            }, false);
            return xhr;
        },
    }).done(function (e) {
        //console.log(e);
        if(e.exito == 1){
           finalizar();
        }
        cargar('compresion', '100%');
        cargar('uploading','100%');
    }).fail(function (e) {
        cargar('compresion', '0%');
        cargar('uploading','0%');
    });
    
    return 0;
}

function finalizar(){
    if(!alertify.errorAlert){
        //define a new errorAlert base on alert
        alertify.dialog('errorAlert',function factory(){
          return{
                    build:function(){
                        var header = '<em> Success </em>' ;
                        this.setHeader(header);
                        this.set({
                            onclosing:function(){  
                                location.reload();
                            }
                        })
                    },
                    
                    
              };
          },true,'alert');
      }
      //launch it.
      // since this was transient, we can launch another instance at the same time.
      alertify.errorAlert("Thanks! <br/>Upload more?<a href='"+window.location.href+"'> yes </a>");
}


function combosBoxs(){
    $('.myselect2' ).select2();
    $('.myselect' ).selectize(); 
}
combosBoxs();

