//código js para prueba 1ª evaluación
// Selección de elementos del DOM
const criptomonedasSelect = document.querySelector('#criptomonedas'); // Select con las criptomonedas
const monedaSelect = document.querySelector('#moneda'); // Select con la moneda fiat
const formulario = document.querySelector('#formulario'); // Formulario donde se seleccionan las opciones
const resultadoDiv = document.querySelector('#resultado'); // Div donde se mostrará la información de la cotización

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

// Función que llena el select de criptomonedas
function llenarSelectCriptos(criptos) {
  criptos.forEach(cripto => {
    const { FullName, Name } = cripto.CoinInfo; // Obtenemos el nombre completo y el símbolo

    const option = document.createElement('option'); // Creamos un elemento option
    option.value = Name; // Valor será el símbolo de la cripto
    option.textContent = FullName; // Texto visible será el nombre completo
    criptomonedasSelect.appendChild(option); // Agregamos la opción al select
  });
}