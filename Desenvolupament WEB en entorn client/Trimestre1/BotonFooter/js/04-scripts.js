/******************************************************************
*************OBJETO DE TIPO EVENTO para index2.html****************
*******************************************************************/

const unh2 = document.querySelector('#uno');
const otroh2 = document.querySelector('#dos');

unh2.addEventListener("mouseenter", cambiaFondo);
otroh2.addEventListener("mouseenter", cambiaFondo);
unh2.addEventListener("mouseout", quitaFondo);
otroh2.addEventListener("mouseout", quitaFondo);

function cambiaFondo(e){
    if(e.target.id === "uno"){
        this.style.backgroundColor = "yellow";
    } else if (e.target.id === "dos"){
        this.style.backgroundColor = "green";
    }
}

function quitaFondo(){
    this.style.backgroundColor = "transparent";
}