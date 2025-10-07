 
 /****************index2.html*****************************
*************MANEJADOR DE EVENTOS EN LÍNEA*************************
*******************************************************************/

//La página la cargamos con el evento onload en la propia página web        
function cambiar(elem) {
	elem.innerHTML = "Eventos en HTML con función externa";
}
function alertar() {
	alert("Si return false --> NO vamos a Google");
}

function preguntar() {
	return confirm("¿Deseas ir a Google?");
}



/******************************************************************
*************MANEJADOR DE EVENTOS TRADICIONAL**********************
*******************************************************************/

//cargamos la página HTML e incluimos todos los eventos en la función de inicio
window.onload = function () {
	alert("La página ha cargado correctamente");
document.getElementById("trad").onclick = tradicional; //¡¡Sin paréntesis!!
document.getElementById("trad").onmouseover = tradicional1;
document.getElementById("trad2").onclick = tradicional2;
document.getElementById("trad2").onclick = tradicional3; 
}

function tradicional() {
    alert("Holaaaa");
    document.getElementById("trad").innerHTML = "Evento en JS, NO en etiqueta HTML (tradicional)";
	//si lo queremos desactivar para que lo ejecute una única vez
   // document.getElementById("trad").onclick = null;
}
function tradicional1(){
	document.getElementById("trad").style.color = "yellow";
}

function tradicional2() {
	document.getElementById("trad2").style.color = "green";
	document.getElementById("trad2").innerHTML = "No lo veré....";
}
function tradicional3() {
	document.getElementById("trad2").style.color = "red";
	document.getElementById("trad2").innerHTML = "Se ejecuta el último evento asignado";
}

