/******************************************************************
*************************EVENTOS DE TECLADO************************
*******************************************************************/

const busqueda = document.querySelector('.busqueda');
/*
busqueda.addEventListener('keydown', () => {
    console.log('presiono...');
});

busqueda.addEventListener('keyup', () => {
    console.log('suelto...');
});

busqueda.addEventListener('blur', () => {
    console.log('pierdo foco...');
});
*/

/******************************************************************
********************OBJETO DE TIPO EVENTO**********************
*******************************************************************/
/*
busqueda.addEventListener('input', (e) =>{
    console.log(e.target);
    console.log(e.type);
});
*/

busqueda.addEventListener('input', (e) =>{
    console.log(e.target.value);
});
    

	
