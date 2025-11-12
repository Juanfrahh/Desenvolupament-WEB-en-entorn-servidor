//código js para prueba 1ª evaluación
const monedaSelect = document.querySelector('#moneda'); // Select con la moneda fiat


document.addEventListener('DOMContentLoaded', obtenerCategoriasRecetas);

async function obtenerCategoriasRecetas() {
  const url = 'www.themealdb.com/api/json/v1/1/categories.php';
  try {
    const respuesta = await fetch(url); // Petición a la API
    const data = await respuesta.json(); // Parseamos la respuesta JSON

    const Recetas = data.Data; // Obtenemos el array de criptomonedas

    llenarSelectCriptos(Recetas); // Llenamos el select con las opciones
  } catch (error) {
    mostrarError('Error al cargar las criptomonedas'); // Mostramos error si falla la petición
    console.error(error);
  }
}

// Función que maneja el submit del formulario
function submitFormulario(e) {
  e.preventDefault(); // Prevenimos el comportamiento por defecto (recargar la página)

  const moneda = monedaSelect.value; // Obtenemos la moneda seleccionada
  const cripto = criptomonedasSelect.value; // Obtenemos la cripto seleccionada

  if (moneda === '' || cripto === '') {
    mostrarError('Debes seleccionar ambas opciones'); // Validamos que se seleccione todo
    return;
  }

  consultarAPI(moneda, cripto); // Llamamos a la API con los valores seleccionados
}