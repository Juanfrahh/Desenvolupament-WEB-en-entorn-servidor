do{
let text1 = prompt ("Dame la primera cadena de texto");
let texto2 = prompt ("Dame la segunda cadena de texto");

const comparacion = function(){
    if (text1 == texto2){
        window.alert("El texto " + texto1 + " y " + texto2 + "son iguales");
    }else{
        window.alert("El texto " + texto1 + " y " + texto2 + "no son iguales");
    }
} 
}while(confirm(("Quieres comparar otras cadenas?")));