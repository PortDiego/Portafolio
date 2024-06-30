function comprobarCondiciones(form){
    if(document.getElementById("ID").value.trim() ===""){
        alert("No lo puedes dejar vacio");
        console.log("Campo ID está vacío. Evitando envío del formulario.");
        return false;
    }
}

function cambiarFormulario(destino){
    var formulario = document.getElementById("ruta");

    formulario.action = destino;

    formulario.submit();
}
