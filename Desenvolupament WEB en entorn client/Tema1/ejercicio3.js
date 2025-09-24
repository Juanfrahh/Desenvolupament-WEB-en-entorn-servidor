
do{
num1 = parseInt(prompt("Introduce un numero:"));
num2 = parseInt(prompt("Introduce el numero de veces que quieras que se duplique el numero seleccionado:"));

document.write("El numero es "+num1 + " y se hallará " + num2 + " veces" );

if (num1 === "" || isNaN(num1) || num2 === "" || isNaN(num2) || num2 < 0) {
    alert("El dato no es válido o has cancelado");
} else {
    
}

document.write("<table border='1'>");
for ( let i = 0; i < num2; i++) {
    document.writeln("<br>"+ (num1 = num1 * 2));
}
}while(true);