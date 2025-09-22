do{
const text1 = prompt ("Dame la primera cadena de texto");
const texto2 = prompt ("Dame la segunda cadena de texto");

window.alert(""texto1);
window.alert(texto2);
    if (text1.trim.localcompare(texto2.trim)){
        window.alert("El texto " + texto1 + " y " + texto2 + "son iguales");
    }else{
        window.alert("El texto " + texto1 + " y " + texto2 + "no son iguales");
    }

}while(confirm((window.alert("Quieres comparar otras cadenas?"))));