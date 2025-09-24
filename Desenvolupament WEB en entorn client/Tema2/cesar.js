const texto = prompt("Introduce un texto para cifrarlo con el cifrado César:");
let desplazamiento = parseInt(prompt("Introduce el numero de desplazamientos"));
desplazamiento = desplazamiento.toFixed(0);

do{

    if (isNaN(desplazamiento)) {
        desplazamiento = parseInt(prompt("Introduce el numero de desplazamientos"));
    } else{
        break;
    }

}while (true);

let total = texto.charCodeAt(0) + desplazamiento;
window.alert