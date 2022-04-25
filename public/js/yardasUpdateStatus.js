var auto= $("#fotos_yardas_listaAutos");
var comboLlave= $("#fotos_yardas_keyEstatus");
var comboTitulo= $("#fotos_yardas_titleEstatus");

entorno();

auto.change(function(){
    //$("#autoSelecionado").addClass("intangible");
    entorno();
});

function entorno(){
    var select= auto.find(':selected');
    document.getElementById("datos").innerHTML= select.data('auto');
    comboLlave.val(select.data('key'));
    comboTitulo.val(select.data('titulo'));
    if( select.data('titulo')=='0'){
        
        document.getElementById("estatusTitulo").innerHTML="Status: title to upload";
        //$("#titleSection").removeClass("intangible");
    }
    if( select.data('titulo')=='1'){
        document.getElementById("estatusTitulo").innerHTML="Status: uploaded title(locked)";
        //$("#titleSection").addClass("intangible");
        //$("#sectionTitle").addClass("intangible");
    }
}


function entornoTitulo(){
    var select= comboTitulo.find(':selected');
    if(select.val()=='1'){
        //$("#sectionTitle").removeClass("intangible");
    }
    if(select.val()!='1'){
        //$("#sectionTitle").addClass("intangible");
    }
}
entornoTitulo();

comboTitulo.change(function(){
    entornoTitulo();
});