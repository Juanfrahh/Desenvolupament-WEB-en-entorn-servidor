/******************************************************************
********************MANEJADOR DE EVENTOS W3C**********************
*******************************************************************/
//cargamos la página 
//window.addEventListener("load",inicio);

/*
console.log(1);
document.addEventListener("load", () =>{
    console.log(2);
});	
console.log(3);
*/

document.addEventListener("DOMContentLoaded", inicio);	

function inicio(){
	document.querySelector('#w3c').addEventListener("click",saludar);	
	document.querySelector('#w3c').addEventListener("click",colorear);
    document.querySelector('h1:last-of-type').addEventListener("mouseenter",colorear);
    document.querySelector('h1:last-of-type').addEventListener("mouseout", quitarColor);
	document.querySelector('#w3canonim').addEventListener("dblclick",function(){
		this.innerHTML="Modificado con función anónima";
		this.style.backgroundColor = "yellow";
	})
	
}
function saludar(){
	alert("Holaaa, este método SI es bueno!!!!!!");
	//si solo queremos que lo ejecute una vez
	//this.removeEventListener("click",saludar);
}
function colorear(){
	this.style.color = "red";
}
function quitarColor(){
	this.style.color = "white";
}


