/*********************index.html***********************************
*****************EVENTO RELACIONADO CON FORMULARIO*****************
*******************************************************************/
const formulario = document.querySelector('#formulario');

formulario.addEventListener('submit', (e) => {
    e.preventDefault();
    console.log(e.target);
    console.log(e.target.method);
    console.log(e.target.action);
});


/******************************************************************
*****************EVENTO RELACIONADO CON SCROLL*****************
*******************************************************************/

window.addEventListener('scroll', () => {
    const scrollPX = window.scrollY;
    console.log(scrollPX);
})


//Saber donde está exactamente un elemento
window.addEventListener('scroll', () => {
    const premium = document.querySelector('.premium');
    const ubicacion = premium.getBoundingClientRect();
    console.log(ubicacion);

    if (ubicacion.top < 750 && ubicacion.top > -500){
        console.log('El elemento ya está visible');
    } else {
        console.log('Aún no, da más scroll...');
    }
})
