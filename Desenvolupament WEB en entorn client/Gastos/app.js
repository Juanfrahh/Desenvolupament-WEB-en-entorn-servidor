// Clase que maneja el presupuesto y los gastos
class Presupuesto {
  constructor(presupuesto) {
    this.presupuesto = Number(presupuesto); // Presupuesto total ingresado
    this.restante = Number(presupuesto); // Presupuesto restante (inicia igual que el total)
    this.gastos = []; // Lista de gastos
  }

  // Añade un nuevo gasto al array y recalcula el restante
  nuevoGasto(gasto) {
    this.gastos = [...this.gastos, gasto]; // Se usa spread para crear un nuevo array
    this.calcularRestante(); // Recalcula el dinero restante
  }

  // Calcula cuánto dinero queda restando lo gastado del presupuesto total
  calcularRestante() {
    const gastado = this.gastos.reduce((total, gasto) => total + gasto.cantidad, 0); // Suma las cantidades de todos los gastos
    this.restante = this.presupuesto - gastado; // Actualiza el restante
  }

  // Elimina un gasto por su ID y actualiza el restante
  eliminarGasto(id) {
    this.gastos = this.gastos.filter(gasto => gasto.id !== id); // Filtra para quitar el gasto con ese ID
    this.calcularRestante(); // Recalcula el restante
  }
}

// Clase que maneja toda la interfaz de usuario
class UI {
  // Muestra el presupuesto total y el restante en la interfaz
  imprimirPresupuesto(presupuestoObj) {
    const { presupuesto, restante } = presupuestoObj;
    document.querySelector('#total').textContent = presupuesto;
    document.querySelector('#restante').textContent = restante;
  }

  // Muestra mensajes de error o éxito en la pantalla
  imprimirAlerta(mensaje, tipo) {
    // Elimina cualquier alerta previa
    const alertaExistente = document.querySelector('.alert-mensaje');
    if (alertaExistente) alertaExistente.remove();

    // Crea el div de alerta
    const div = document.createElement('div');
    div.classList.add('text-center', 'alert', 'alert-mensaje');
    div.textContent = mensaje;

    // Añade clase según el tipo (éxito o error)
    if (tipo === 'error') {
      div.classList.add('alert-danger');
    } else {
      div.classList.add('alert-success');
    }

    // Inserta la alerta antes del formulario
    document.querySelector('.primario').insertBefore(div, document.querySelector('#agregar-gasto'));
  }

  // Muestra la lista de gastos en el HTML
  imprimirGastosListado(gastos) {
    this.limpiarHTML(); // Limpia la lista anterior
    const listado = document.querySelector('#gastos ul'); // Selecciona el contenedor de la lista

    gastos.forEach(gasto => {
      const { nombre, cantidad, id } = gasto;

      // Crea un elemento <li> para cada gasto
      const li = document.createElement('li');
      li.className = 'list-group-item d-flex justify-content-between align-items-center';
      li.dataset.id = id; // Guarda el id del gasto
      li.innerHTML = `
        ${nombre} 
        <span class="badge badge-primary badge-pill">${cantidad} €</span>
      `;

      // Crea el botón de borrar
      const btnBorrar = document.createElement('button');
      btnBorrar.classList.add('btn', 'btn-danger', 'borrar-gasto');
      btnBorrar.textContent = 'Borrar';
      btnBorrar.onclick = () => eliminarGasto(id); // Llama a la función eliminar

      // Añade el botón al li
      li.appendChild(btnBorrar);
      // Añade el li completo al listado
      listado.appendChild(li);
    });
  }

  // Elimina los elementos de la lista antes de volver a imprimirlos
  limpiarHTML() {
    const listado = document.querySelector('#gastos ul');
    while (listado.firstChild) {
      listado.removeChild(listado.firstChild);
    }
  }

  // Actualiza el valor del presupuesto restante en pantalla
  actualizarRestante(restante) {
    document.querySelector('#restante').textContent = restante;
  }

  // Cambia los colores del restante según el nivel de gasto
  comprobarPresupuesto(presupuestoObj) {
    const { presupuesto, restante } = presupuestoObj;
    const restanteDiv = document.querySelector('.restante');

    // Quita clases previas de color
    restanteDiv.classList.remove('alert-success', 'alert-warning', 'alert-danger');

    // Cambia color e imprime alerta según el porcentaje gastado
    if (restante <= 0) {
      restanteDiv.classList.add('alert-danger');
      ui.imprimirAlerta('Has agotado el presupuesto', 'error');
      document.querySelector('button[type="submit"]').disabled = true; // Desactiva el botón si no queda dinero
    } else if (restante <= presupuesto * 0.25) {
      restanteDiv.classList.add('alert-danger');
      ui.imprimirAlerta('Te queda menos del 25% del presupuesto', 'error');
    } else if (restante <= presupuesto * 0.5) {
      restanteDiv.classList.add('alert-warning');
      ui.imprimirAlerta('Has gastado más del 50% del presupuesto', 'error');
    } else {
      restanteDiv.classList.add('alert-success');
      ui.imprimirAlerta('Presupuesto en buen estado', 'success');
    }
  }
}

// Seleccionamos los elementos del DOM principales
const formulario = document.querySelector('#agregar-gasto'); // Formulario para añadir gastos
let presupuesto; // Variable global para almacenar el presupuesto
const ui = new UI(); // Instancia de la interfaz

// Eventos principales
document.addEventListener('DOMContentLoaded', preguntarPresupuesto); // Pide el presupuesto al cargar la página
formulario.addEventListener('submit', agregarGasto); // Maneja el envío del formulario

// Pide al usuario su presupuesto al cargar la página
function preguntarPresupuesto() {
  const presupuestoUsuario = prompt('¿Cuál es tu presupuesto semanal?');

  // Validaciones del valor ingresado
  if (
    presupuestoUsuario === '' ||
    presupuestoUsuario === null ||
    isNaN(presupuestoUsuario) ||
    presupuestoUsuario <= 0
  ) {
    window.location.reload(); // Si no es válido, recarga la página
  }

  // Crea una nueva instancia de Presupuesto
  presupuesto = new Presupuesto(presupuestoUsuario);
  ui.imprimirPresupuesto(presupuesto); // Muestra presupuesto total y restante
  ui.imprimirAlerta('Presupuesto establecido correctamente', 'success'); // Mensaje de éxito
}

// Función que maneja el evento de agregar un gasto
function agregarGasto(e) {
  e.preventDefault(); // Previene el comportamiento por defecto del formulario

  // Obtiene los valores del formulario
  const nombre = document.querySelector('#gasto').value.trim();
  const cantidad = Number(document.querySelector('#cantidad').value);

  // Validaciones de campos
  if (nombre === '' || cantidad === '') {
    ui.imprimirAlerta('Ambos campos son obligatorios', 'error');
    return;
  } else if (cantidad <= 0 || isNaN(cantidad)) {
    ui.imprimirAlerta('Cantidad no válida', 'error');
    return;
  }

  // Crea el objeto gasto con un ID único
  const gasto = { nombre, cantidad, id: Date.now() };

  // Lo añade al presupuesto
  presupuesto.nuevoGasto(gasto);

  // Mensaje de confirmación
  ui.imprimirAlerta(`Gasto "${nombre}" añadido correctamente`, 'success');

  // Actualiza la interfaz con los nuevos datos
  const { gastos, restante } = presupuesto;
  ui.imprimirGastosListado(gastos);
  ui.actualizarRestante(restante);
  ui.comprobarPresupuesto(presupuesto);

  // Limpia el formulario
  formulario.reset();
}

// Función que elimina un gasto según su ID
function eliminarGasto(id) {
  // Elimina el gasto del objeto Presupuesto
  presupuesto.eliminarGasto(id);

  // Actualiza el listado y el restante
  const { gastos, restante } = presupuesto;
  ui.imprimirGastosListado(gastos);
  ui.actualizarRestante(restante);
  ui.comprobarPresupuesto(presupuesto);
}
