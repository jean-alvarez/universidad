//SELECCION DEL FORMULARIO
var formulario = document.getElementById("formulario");
var formulario = document.forms[0];
var formulario = document.getElementByTagName("formulario")[0];

//SELECCIONAR ELEMENTOS DE UN FORMULARIO

windows.onload = iniciar;

function iniciar();{
	document.getElementById("enviar").addEventListener('click',validar,false);
}


function valida_nombre(){
	var elemento = document.getElementById("txt_nombre");
	if (elemento.value == "") {
		alert("El campo no puede ser vacio");
		return false;
	}
	return true;
}

function valida_apellido(){
	var elemento = document.getElementById("txt_apellido");
	if (elemento.value == "") {
		alert("El campo no puede ser vacio");
		return false;
	}
	return true;
}

function valida_telefono(){
	var elemento = document.getElementById("telefono");
	if (isNaN(elemento.value)) {
		alert("El campo telefono tiene que ser numerico");
		return false;
	}
	return true;
}

function valida_correo() {
	var elemento = document.getElementById("correo")
 if (elemento.value === "" || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(formulario.elemento.value))
  {
    return (true)
  }
    alert("Correo invalido, ingresa nuevamente");
    return (false)
}

function valida_mensaje(){
	var elemento = document.getElementById("mensaje")
	if (elemento.value == "") {
		alert("Ingresa un mensaje");
		return false;
	}
	return true;
}

function validar(e){
	if (valida_nombre() && valida_apellido() && valida_telefono() && valida_correo() && valida_mensaje() && confirm("Pulsa enviar"))
	{
		return true;
	}else{
		e.preventDefault();
		return false;
	}
}

function error(elemento){
	elemento.className"error";
	elemento.focus();
}

function limpiar_error(elemento){
	elemento.className="";
}
