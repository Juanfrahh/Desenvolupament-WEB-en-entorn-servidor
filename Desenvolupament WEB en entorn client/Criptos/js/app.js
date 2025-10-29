const criptomonedasSelect = document.querySelector('#criptomonedas');
const monedaSelect = document.querySelector('#moneda');
const formulario = document.querySelector('#formulario');
const resultadoDiv = document.querySelector('#resultado');

document.addEventListener('DOMContentLoaded', obtenerCriptomonedas);

formulario.addEventListener('submit', submitFormulario);

async function obtenerCriptomonedas() {
  const url = 'https://min-api.cryptocompare.com/data/top/mktcapfull?limit=10&tsym=USD';
  try {
    const respuesta = await fetch(url);
    const data = await respuesta.json();

    const criptos = data.Data;

    llenarSelectCriptos(criptos);
  } catch (error) {
    mostrarError('Error al cargar las criptomonedas');
    console.error(error);
  }
}

function llenarSelectCriptos(criptos) {
  criptos.forEach(cripto => {
    const { FullName, Name } = cripto.CoinInfo;

    const option = document.createElement('option');
    option.value = Name;
    option.textContent = FullName;
    criptomonedasSelect.appendChild(option);
  });
}

function submitFormulario(e) {
  e.preventDefault();

  const moneda = monedaSelect.value;
  const cripto = criptomonedasSelect.value;

  if (moneda === '' || cripto === '') {
    mostrarError('⚠️ Debes seleccionar ambas opciones');
    return;
  }

  consultarAPI(moneda, cripto);
}

async function consultarAPI(moneda, cripto) {
  const url = `https://min-api.cryptocompare.com/data/pricemultifull?fsyms=${cripto}&tsyms=${moneda}`;

  mostrarSpinner();

  try {
    const respuesta = await fetch(url);
    const data = await respuesta.json();

    const info = data.DISPLAY[cripto][moneda];
    mostrarCotizacion(info);
  } catch (error) {
    mostrarError('❌ No se pudo obtener la información');
    console.error(error);
  }
}

function mostrarCotizacion(info) {
  limpiarHTML();

  const { PRICE, HIGHDAY, LOWDAY, CHANGEPCT24HOUR, LASTUPDATE } = info;

  const precio = document.createElement('p');
  precio.classList.add('precio');
  precio.innerHTML = `💰 Precio actual: <span>${PRICE}</span>`;

  const maximo = document.createElement('p');
  maximo.innerHTML = `📈 Máximo del día: <span>${HIGHDAY}</span>`;

  const minimo = document.createElement('p');
  minimo.innerHTML = `📉 Mínimo del día: <span>${LOWDAY}</span>`;

  const variacion = document.createElement('p');
  variacion.innerHTML = `📊 Variación 24h: <span>${CHANGEPCT24HOUR}%</span>`;

  const actualizacion = document.createElement('p');
  actualizacion.innerHTML = `⏰ Última actualización: <span>${LASTUPDATE}</span>`;

  resultadoDiv.appendChild(precio);
  resultadoDiv.appendChild(maximo);
  resultadoDiv.appendChild(minimo);
  resultadoDiv.appendChild(variacion);
  resultadoDiv.appendChild(actualizacion);
}

function mostrarError(mensaje) {
  const existe = document.querySelector('.error');
  if (existe) existe.remove();

  const divError = document.createElement('div');
  divError.classList.add('error');
  divError.textContent = mensaje;
  divError.style.backgroundColor = 'red';
  divError.style.color = 'white';
  divError.style.padding = '8px';
  divError.style.textAlign = 'center';
  divError.style.marginTop = '10px';
  divError.style.borderRadius = '5px';

  formulario.appendChild(divError);

  setTimeout(() => divError.remove(), 2000);
}

function mostrarSpinner() {
  limpiarHTML();

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
  resultadoDiv.appendChild(spinner);
}

function limpiarHTML() {
  resultadoDiv.innerHTML = '';
}
