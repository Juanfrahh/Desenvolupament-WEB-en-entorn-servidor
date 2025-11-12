//código js para prueba 1ª evaluación
const CategoriaSelect = document.querySelector('#categoria'); // Select con la moneda fiat
const RecetasSelect = document.querySelector('#criptomonedas'); // Select con las criptomonedas





// Función que llena el select de criptomonedas
function llenarSelectCategorias(criptos) {
  criptos.forEach(cripto => {
    const { FullName, Name } = categoria.CoinInfo; // Obtenemos el nombre completo y el símbolo

    const option = document.createElement('option'); // Creamos un elemento option
    option.value = Name; // Valor será el símbolo de la cripto
    option.textContent = FullName; // Texto visible será el nombre completo
    CategoriaSelectSelect.appendChild(option); // Agregamos la opción al select
  });
}
// Función que maneja el submit del formulario
function submitFormulario(e) {
  e.preventDefault(); // Prevenimos el comportamiento por defecto (recargar la página)

  const categoria = CategoriaSelect.value; // Obtenemos la moneda seleccionada

  if (categoria === '') {
    mostrarError('Debes seleccionar ambas opciones'); // Validamos que se seleccione todo
    return;
  }

  consultarAPI(moneda, cripto); // Llamamos a la API con los valores seleccionados
}