// Selectores
const formulario = document.querySelector('#formulario');
const listaTareas = document.querySelector('#lista-tareas');
const tareaInput = document.querySelector('#tarea');

// Array de tareas
let tareas = [];

// Eventos
document.addEventListener('DOMContentLoaded', cargarTareasLocalStorage);
formulario.addEventListener('submit', agregarTarea);
listaTareas.addEventListener('click', eliminarTarea);

// --- FUNCIONES ---

// Agregar tarea
function agregarTarea(e) {
  e.preventDefault();
  const texto = tareaInput.value.trim();

  // Validaciones
  if (texto === '') {
    mostrarError('❌ El campo no puede estar vacío');
    return;
  }

  if (texto.length > 30) {
    mostrarError('❌ La tarea no puede tener más de 30 caracteres');
    return;
  }

  const existe = tareas.some(t => t.toLowerCase() === texto.toLowerCase());
  if (existe) {
    mostrarError('❌ Esa tarea ya existe');
    return;
  }

  // Agregar al array y mostrar
  tareas.push(texto);
  tareaInput.value = '';
  pintarTareas();
  guardarTareasLocalStorage();
}

// Pintar todas las tareas en pantalla
function pintarTareas() {
  limpiarHTML();
  tareas.forEach(tarea => {
    const div = document.createElement('div');
    div.classList.add('tarea-item');
    div.style.marginLeft = '10%'; // opcional como indica el enunciado
    div.innerHTML = `
      <p>${tarea}</p>
      <span class="borrar-tarea" style="color:red; cursor:pointer; font-weight:bold;">X</span>
    `;
    listaTareas.appendChild(div);
  });
}

// Eliminar tarea
function eliminarTarea(e) {
  if (e.target.classList.contains('borrar-tarea')) {
    const texto = e.target.previousElementSibling.textContent;
    tareas = tareas.filter(t => t !== texto);
    pintarTareas();
    guardarTareasLocalStorage();
  }
}

function mostrarError(mensaje) {
  const existente = document.querySelector('.error');
  if (existente) existente.remove();

  const divError = document.createElement('div');
  divError.textContent = mensaje;
  divError.classList.add('error');
  divError.style.color = 'white';
  divError.style.backgroundColor = 'red';
  divError.style.padding = '8px';
  divError.style.marginTop = '10px';
  divError.style.textAlign = 'center';
  divError.style.borderRadius = '5px';

  formulario.appendChild(divError);

  setTimeout(() => {
    divError.remove();
  }, 3000);
}

function guardarTareasLocalStorage() {
  localStorage.setItem('tareas', JSON.stringify(tareas));
}

function cargarTareasLocalStorage() {
  const tareasLS = JSON.parse(localStorage.getItem('tareas')) || [];
  tareas = tareasLS;
  pintarTareas();
}

function limpiarHTML() {
  listaTareas.innerHTML = '';
}
