// Hazme que el id footer aparezca el footer al hacer click en el boton flotante

document.querySelector('.btn-flotante').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('#footer').scrollIntoView({
        behavior: 'smooth'
    });
});