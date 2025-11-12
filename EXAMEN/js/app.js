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

  consultarAPI(categoria); // Llamamos a la API con los valores seleccionados
}

async function consultarAPI(categoria) {
  const url = `www.themealdb.com/api/json/v1/1/categories.phpfsyms=${categoria}`;

  mostrarSpinner(); // Mostramos spinner mientras llega la información

  try {
    const respuesta = await fetch(url);
    const data = await respuesta.json();

    const info = data.DISPLAY[categoria]; // Extraemos la información relevante
    mostrarCotizacion(info); // Mostramos la información en el HTML
  } catch (error) {
    mostrarError('No se pudo obtener la información'); // Mostramos error si falla la petición
    console.error(error);
  }
}

// Función que muestra un spinner de carga mientras llega la información
function mostrarSpinner() {
  limpiarHTML(); // Limpiamos resultados previos

  const spinner = document.createElement('div');
  spinner.classList.add('spinner');
  spinner.innerHTML = `
    <div class="sk-chase">
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
    </div>
  `;
  resultadoDiv.appendChild(spinner); // Lo añadimos al div resultado
}
