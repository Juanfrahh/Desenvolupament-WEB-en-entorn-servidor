const comparaCadena = (cad1, cad2) => cad1.localeCompare(cad2, 'es');

do{
    let cadena1 = prompt("Escribe el primer texto:").trim();
    let cadena2 = prompt("Escribe el segundo texto").trim();

    //si el usuario cancela el prompt, detener el bucle
    if (cadena1 === null || cadena2 === null) {
        alert("Operación cancelada.");
        break;
    }

    if (comparaCadena(cadena1,cadena2) == 0){
        alert(`Los textos "${cadena1}" y "${cadena2}" son iguales`);
    }else{
         alert(`Los textos "${cadena1}" y "${cadena2}" NO son iguales`);
    }

}while (confirm("¿Quieres comparar otras cadenas?"));


