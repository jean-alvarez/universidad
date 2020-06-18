function validar(){
    var nombre, apellido, telefono, mensaje;
    nombre = document.getElementById("nombre").value;
    apellido= document.getElementById("apellido").value;
    telefono = document.getElementById("telefono").value;
    mensaje= document.getElementById("mensaje").value;
    var exp = /[A-Za-z]/;
    var exp2=/9/;
    if (nombre ===""|| apellido ===""|| telefono ===""|| mensaje==="") {
        alert("Todos los campos son obligatorios");
        return false;
    }
    
    else if (!exp.test(nombre)) {
        alert("Solo puede ingresar letras");
        return false;
    }
    else if (!exp.test(apellido)) {
        alert("Solo se permiten letras");
        return false;
    }
    else if (noNumber(telefono)) {
        alert("Solo se pueden numeros");
        return false;
    }
    else if(){
        
    }
}
function validar2(){
    
}