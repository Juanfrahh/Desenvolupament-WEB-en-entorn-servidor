//código js para prueba 1ª evaluación
async function obtenerCriptomonedas() {
  const url = 'https://www.themealdb.com/api.php';
  try {
    const respuesta = await fetch(url); // Petición a la API
    const data = await respuesta.json(); // Parseamos la respuesta JSON

    const criptos = data.Data; // Obtenemos el array de criptomonedas

    llenarSelectCriptos(criptos); // Llenamos el select con las opciones
  } catch (error) {
    mostrarError('Error al cargar las criptomonedas'); // Mostramos error si falla la petición
    console.error(error);
  }
}