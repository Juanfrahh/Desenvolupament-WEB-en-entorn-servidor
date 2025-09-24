nombre = prompt("Introduce el nombre:");
salario = parseInt(prompt("Introduce el salario anual:"));
NumHijos = parseInt(prompt("Introduce el numero de hijos:"));
edad = parseInt(prompt("Introduce la edad:"));
total = salario;
/*
if (salario < 1000 && edad < 30 && NumHijos > 0) {
    total = 1200;
}
if (edad > 30 && edad < 45 && salario < 1250){
    if (NumHijos > 1 && NumHijos < 3){
        total = salario * 1.10;
    } else {
        total = salario * 1.15;
    }
}
if (edad > 45 && NumHijos == 0){
    total = salario * 1.15;
}*/

switch (true) {
    case
    case (salario < 1000 && edad < 30 && NumHijos > 0):
        total = 1200;
        break;
    case (edad > 30 && edad < 45 && salario < 1250 && NumHijos > 1 && NumHijos < 3):
        total = salario * 1.10;
        break
    case (edad > 30 && edad < 45 && salario < 1250):
        total = ssalario * 1.15;
        break;
    case (edad > 45 && NumHijos == 0):
        total = salario * 1.15;
        break;
    default:
        total = salario;
        break;
}

window.alert("Nombre: " + nombre + "\nSalario Actual: " + salario + "\nNuevo Salario: " + total);

