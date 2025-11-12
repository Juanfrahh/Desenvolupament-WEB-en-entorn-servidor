//código js para prueba 1ª evaluación
const CategoriaSelect = document.querySelector('#moneda'); // Select con la moneda fiat





// Función que maneja el submit del formulario
function submitFormulario(e) {
  e.preventDefault(); // Prevenimos el comportamiento por defecto (recargar la página)

  const moneda = CategoriaSelect.value; // Obtenemos la moneda seleccionada
  const cripto = criptomonedasSelect.value; // Obtenemos la cripto seleccionada

  if (moneda === '' || cripto === '') {
    mostrarError('Debes seleccionar ambas opciones'); // Validamos que se seleccione todo
    return;
  }

  consultarAPI(moneda, cripto); // Llamamos a la API con los valores seleccionados
}