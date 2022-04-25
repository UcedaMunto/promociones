//comboVector
var tt;
var nombre;
var arrayOps;
var numero;
comboVector.forEach(element => {
    this.onchange = function(event) {
        tt = event.target;
        buscar(tt);
    };
});
//desabilitarOpciones(); //desabilitar opciones de cilindrige para lograr filtrar
desabilitarCombos();
function buscar(tt){ //busca y habilita las opciones
    nombre =  tt.id;
    if(tt.id.substr(0,18)== 'cuadricula_envios_'){
        tt = tt.selectedOptions[tt.selectedIndex];//NPTipoVehiculo
        if( nombre.substr(-14,14) == 'NPTipoVehiculo'){
            numero = parseInt( nombre.substr(-16,1) );
            var combocilindrage= "cuadricula_envios_"+numero+"_cilindrage";//find("option[value='"+valor+"']").prop("disabled",true);
            console.log(tt.value);
            var tipo=tt.value;
            console.log('tp:'+tipo);
            arrayOps=combocilindrage.options;
            for(var i=0; i<comboVector2[0].length; i++ ){
                console.log('combo:'+combocilindrage);
                if(comboVector2[0][i].id == combocilindrage ){ //combo de la lista encontrado
                    comboVector2[0][i].disabled= false;
                    for(var j=0; j<comboVector2[0][i].options.length; j++ ){
                        
                        if(comboVector2[0][i].options[j].dataset.tipovehiculo != tipo ){
                            comboVector2[0][i].options[j].disabled=true;
                        }
                        if(comboVector2[0][i].options[j].dataset.tipovehiculo == tipo ){
                            comboVector2[0][i].options[j].disabled=false;
                            console.log('tpv:'+comboVector2[0][i].options[j].dataset.tipovehiculo+'tipo-----------:'+tipo);
                            console.log( comboVector2[0][i].options[j].disabled +'-' );
                        }   
                    }
                    $(comboVector2[0][i]).select2();
                }
            }
        }
    }
}

function desabilitarOpciones(){
    for(var i=0; i<comboVector2[0].length; i++ ){
        for(var j=0; j<comboVector2[0][i].options.length; j++ ){
            comboVector2[0][i].options[j].disabled=true;
        }
    }
}

function desabilitarCombos(){
    for(var i=0; i<comboVector2[0].length; i++ ){
        comboVector2[0][i].disabled= true;
    }
}


//$('#cuadricula_fechaSolicitud').datetimepicker();
