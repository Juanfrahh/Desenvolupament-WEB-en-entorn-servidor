
let num, i, j, contador;
let eleccion = prompt(`Elige una de estas dos opciones: Indica 1 ó 2\n   1. ¿Tu número es primo? \n   2. Primos hasta tu número`);

function numeroPrimo(num){
    if (num<=1) return false;
    for (i=2; i<num; i++){
        if(num % i === 0){
            return false;  
        }
    } 
    return true;
 }


if (eleccion == 1){
    num = Number(prompt("Dime un número para saber si es primo o no"));
    
    if ((num == 1) || (num == 2)) {
        alert ("El número " + num + " ES PRIMO!");
    }else{
        if(numeroPrimo(num)){
            alert("El número " + num + " ES PRIMO");
        }else{
            alert("El número " + num + " NO es primo");
        }
    }      
}else if (eleccion == 2){
    num = Number(prompt("Dime un número y te diré del 1 hasta tu número cuantos primos hay"));
    contador = 0;
        
    for (let j = 1; j<=num; j++){
        if(numeroPrimo(j)){
            contador++;
            console.log ("El número " + j + " es primo");
        }
    }

    console.log("Entre el número 1 y " + num + " hay " + contador + " números primos.")
}     
        
                
                
            
        
    
  







