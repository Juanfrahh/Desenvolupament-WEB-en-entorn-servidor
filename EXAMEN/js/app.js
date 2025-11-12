//código js para prueba 1ª evaluación
const CategoriaSelect = document.querySelector('#moneda'); // Select con la moneda fiat





// Función que llena el select de criptomonedas
function llenarSelectCriptos(categoria) {
  categoria.forEach(categoria => {
    const { FullName, Name } = cripto.CoinInfo; // Obtenemos el nombre completo y el símbolo

    const option = document.createElement('option'); // Creamos un elemento option
    option.value = Name; // Valor será el símbolo de la cripto
    option.textContent = FullName; // Texto visible será el nombre completo
    criptomonedasSelect.appendChild(option); // Agregamos la opción al select
  });
}

// Función que maneja el submit del formulario
function submitFormulario(e) {
  e.preventDefault(); // Prevenimos el comportamiento por defecto (recargar la página)

  const categoria = CategoriaSelect.value; // Obtenemos la moneda seleccionada

  if (categoria === '') {
    mostrarError('Seleccione una categoria'); // Validamos que se seleccione todo
    return;
  }

  consultarAPI(categoria); // Llamamos a la API con los valores seleccionados
}