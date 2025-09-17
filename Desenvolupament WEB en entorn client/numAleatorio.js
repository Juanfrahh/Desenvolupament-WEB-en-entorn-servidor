numRandom = parseInt(Math.random()*11);
intentos = 0;
window.alert(numRandom);
numUsuario = parseInt(prompt("Introduce un numero entre 1 y 10:"));

while (true){
    if (numUsuario == numRandom) {
        window.alert("Has acertado ");
        window.alert("Lo has conseguido en " + intentos + " intentos");
        break;
    } else if (isNaN(numUsuario)) {
        window.alert("No has introducido un numero");
        exit = prompt("Quieres seguir intentandolo?");
        if (exit.toLowerCase() == "si") {
    
        }  else {
            break;
        }
        numUsuario = parseInt(prompt("Introduce un numero entre 1 y 10:"));
    }else {
        window.alert("Has fallado");
        intentos++;
        numUsuario = parseInt(prompt("Introduce un numero entre 1 y 10:"));
    }
}