


document.getElementById("todosRecordatorios").onclick = function(event) {
    formatElements('recordatorios', 'todos');
};
document.getElementById("minFallidos").onclick = function(event) {
    formatElements('recordatorios', 'fallidos');
};
document.getElementById("minPendientes").onclick = function(event) {
    formatElements('recordatorios', 'pendientes');
};
function formatElements(idElemento, bandera){
    var children = document.getElementById(idElemento).getElementsByTagName('*');
    for( var i = 0; i<children.length; i++){
        var t = children.item(i);
        element= "#"+children.item(i).id;
        if(element!= "#"){
            if(bandera== 'todos'){
                ocultarRecordatorios(t.classList.contains('text-critic'), t.classList.contains('show'), element);
                ocultarRecordatorios(t.classList.contains('text-finish'), t.classList.contains('show'), element);
            }

            if(bandera== 'fallidos'){
                ocultarRecordatorios(t.classList.contains('text-finish'), t.classList.contains('show'), element);
            }
            if(bandera== 'pendientes'){
                ocultarRecordatorios(t.classList.contains('text-critic'), t.classList.contains('show'), element);
            }
            
        }  
    }
}
function ocultarRecordatorios(bandera, visible, elemento){
    if(bandera && visible){
        elemento= $(elemento);
        elemento.removeClass("show");//addClass()
    }
}