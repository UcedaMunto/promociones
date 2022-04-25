const select = document.querySelector('#comentarios_tipo');
select.addEventListener('change', (event) => {
     if(event.srcElement.value==3){
          alertify.error('Este tipo de mensaje se le mostrará al cliente en el tracking', 10);
          alertify.error('Este tipo de mensaje se le mostrará al cliente en el tracking', 10);
          alertify.error('Este tipo de mensaje se le mostrará al cliente en el tracking', 10);
     }
     if(event.srcElement.value==5 || event.srcElement.value==11   ){
          event.srcElement.value=null;
     }
});