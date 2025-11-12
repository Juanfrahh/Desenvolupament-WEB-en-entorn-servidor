//código js para prueba 1ª evaluación

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

