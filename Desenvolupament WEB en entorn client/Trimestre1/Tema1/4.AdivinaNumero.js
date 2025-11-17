
let numAleat, resp, cont;
let volverAJugar = true;


do{
    cont = 0; //contador de intentos
    numAleat = parseInt(Math.random()*11);//num aleatorio del 0 al 10
    
        //Bucle de repetición de juego hasta que el nº sea ok o pulse cancelar
        do{
            resp = parseInt(prompt("Del 1 al 10... ¿Qué número entero crees estoy pensando?"));
                       
             //si no rellena, cancela o lo que pone no es un número
             //le damos otro oportunidad, sin que le cuente intento
            if ((resp === "") || (isNaN(resp))) {
                alert("El dato no es válido o has cancelado");
                if(confirm("¿Quieres seguir jugando?")){
                    volverAJugar = true;
                }else{
                    volverAJugar = false;
                }
               
            //si es un número pero no entra en el rango, le damos otra oportunidad
            //sin que le cuente el intento
            }else if  (resp < 0 || resp > 10) {
                alert("El dato introducido NO es válido: Se pide un número del 1 al 10");
               
            //si está en el rango, vemos si es mayor o menor
            //SI le cuenta el intento       
            }else if (numAleat > resp){
                cont++;
                alert(`Estás cerca, mi número es mayor, llevas ${cont} intentos`);
                
            }else if (numAleat < resp){
                cont++;
                alert(`Estás cerca, mi número es menor, llevas ${cont} intentos`);
                
            }else{
                cont++;
                alert("Enhorabuena!!! Has acertado, el número era " + numAleat+"\n"+"Lo has adivinado en " + cont+ " intentos");
                volverAJugar = false;
            }
        }while(volverAJugar==true);

    
}while(confirm("¿Quieres volver a jugar?"));