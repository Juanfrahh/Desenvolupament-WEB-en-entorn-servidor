
let texto = prompt("Introduce un texto para cifrarlo con el cifrado César:");
let desplazamiento = parseInt(prompt("Introduce el numero de desplazamientos"));
do{
if (isNaN(desplazamiento)) {
    desplazamiento = parseInt(prompt("Introduce el numero de desplazamientos"));
} else{
    break;
}
}while (true);