columnas = parseInt(prompt("Introduce el numero de columnas:"));
filas = parseInt(prompt("Introduce el numero de filas:"));

document.write("<table border='1'>");
for (let i = 0; i < filas; i++) {
    document.write("<tr>");
    for (let j = 0; j < columnas; j++) {
        document.write("<td>Fila " + (i + 1) + " Columna " + (j + 1) + "</td>");
    }
}