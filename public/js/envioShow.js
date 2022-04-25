
var dat;

function getFotosYarda(cantidad){
        $.ajax({
                url: window.location.href,
                type: "POST",
                dataType: "JSON",
                data: {
                    page: 0,
                },
                success: function (data) {
                    dat=data;
                    llenarFotos('fotosYardaW', data, cantidad );
                },
                error: function (err) {
                    alert(err);
                }
        });
};

function getFotosGruas(cantidad){
    $.ajax({
            url: window.location.href,
            type: "POST",
            dataType: "JSON",
            data: {
                page: 2,
            },
            success: function (data) {
                dat=data;
                llenarFotos('fotosGruaW', data, cantidad );
            },
            error: function (err) {
                alert(err);
            }
    });
};
var cantidadYarda= $("#cantidadYarda");
var cantidadGruas= $("#cantidadGruas");

cantidadYarda.change(function(){
    getFotosYarda(cantidadYarda.val());
});
cantidadGruas.change(function(){
    getFotosGruas(cantidadGruas.val());
});

function llenarFotos(destino, data, cantidad){
    $nombre= "#"+destino;
    $($nombre).empty();
    if(data.fotos.length>0){
        //$("#contenedor_listaAutos").append('<option value> Seleccione los autos ...</option>'); //+ $("#contenedor_listaAutos").find("option:selected").text() + 
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        for (  i = 0 ; i < data.fotos.length; i++){ //cuenta la cantidad de registros
            var fecha= data.fotos[i].creacion.date.substring(0,10);
            var creacion = new Date( data.fotos[i].creacion.date );
            var nuevaImagen= 
            '<div class="col-md-4"><a class="example-image-link" href="'+data.host+'/'+data.fotos[i].name+'.'+data.fotos[i].extension+'" data-lightbox="example-set"'+
            ' data-title="'+fecha+'">'+
            '<div class="card mb-4 box-shadow">'+
            '<img class="card-img-top" data-src="'+data.host+'/'+data.fotos[i].name+'.'+data.fotos[i].extension+
            '" src="'+data.host+'/'+data.fotos[i].name+'.'+data.fotos[i].extension+'" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">'+
            '<div class="card-body">'+data.fotos[i].name+
            '<p class="card-text">'+creacion.toLocaleDateString('es-ES', options)+' </p>'+
            '</div>'+
            '</div>'+
            '</a></div>';
            if(i<cantidad ){
                $($nombre).append(nuevaImagen);
            }
        }
    }
}

$('.btnAsignarCosto').on( 'click', function (e) {
    var url= this.dataset.link;
    alertify.prompt('Asignar un costo a este problema',"Ingrese el costo que tuvo este problema", "1.0",
    function(evt, value){
         $.ajax({ 
                url: url,
                type: "POST",
                dataType: "JSON",
                data: {
                    costo: value,
                },
                success: function (data) {
                    dat=data;
                    if(data.exito==1){
                        alertify.success('Asignado correctamente');
                    }else if(data.exito==0){
                        alertify.error('error al mandar, parece que ya se le dio un valor o fue mal digitado');
                    }
                },
                error: function (err) {
                    console.log(err);
                    alertify.error('error al enviar');
                }
        });
    },
    function(){
        alertify.error('Cancel');
    })
    ;
});