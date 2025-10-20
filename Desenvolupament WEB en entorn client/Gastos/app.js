class Presupuesto {
  constructor(presupuesto) {
    this.presupuesto = Number(presupuesto);
    this.restante = Number(presupuesto);
    this.gastos = [];
  }

  // Añadir un nuevo gasto
  nuevoGasto(gasto) {
    this.gastos = [...this.gastos, gasto];
    this.calcularRestante();
  }

  // Calcular el restante actual
  calcularRestante() {
    const gastado = this.gastos.reduce((total, gasto) => total + gasto.cantidad, 0);
    this.restante = this.presupuesto - gastado;
  }

  // Eliminar gasto por id
  eliminarGasto(id) {
    this.gastos = this.gastos.filter(gasto => gasto.id !== id);
    this.calcularRestante();
  }
}

class UI {
  imprimirPresupuesto(presupuestoObj) {
    const { presupuesto, restante } = presupuestoObj;
    document.querySelector('#total').textContent = presupuesto;
    document.querySelector('#restante').textContent = restante;
  }

  imprimirAlerta(mensaje, tipo) {
    // Eliminar mensaje previo (si existe)
    const alertaExistente = document.querySelector('.alert-mensaje');
    if (alertaExistente) alertaExistente.remove();

    const div = document.createElement('div');
    div.classList.add('text-center', 'alert', 'alert-mensaje');
    div.textContent = mensaje;

    if (tipo === 'error') {
      div.classList.add('alert-danger');
    } else {
      div.classList.add('alert-success');
    }

    // Insertar en el DOM
    document.querySelector('.primario').insertBefore(div, document.querySelector('#agregar-gasto'));
  }

  imprimirGastosListado(gastos) {
    this.limpiarHTML();
    const listado = document.querySelector('#gastos ul');

    gastos.forEach(gasto => {
      const { nombre, cantidad, id } = gasto;
      const li = document.createElement('li');
      li.className = 'list-group-item d-flex justify-content-between align-items-center';
      li.dataset.id = id;
      li.innerHTML = `
        ${nombre} 
        <span class="badge badge-primary badge-pill">${cantidad} €</span>
      `;

      // Botón borrar
      const btnBorrar = document.createElement('button');
      btnBorrar.classList.add('btn', 'btn-danger', 'borrar-gasto');
      btnBorrar.textContent = 'Borrar';
      btnBorrar.onclick = () => eliminarGasto(id);

      li.appendChild(btnBorrar);
      listado.appendChild(li);
    });
  }

  limpiarHTML() {
    const listado = document.querySelector('#gastos ul');
    while (listado.firstChild) {
      listado.removeChild(listado.firstChild);
    }
  }

  actualizarRestante(restante) {
    document.querySelector('#restante').textContent = restante;
  }

  comprobarPresupuesto(presupuestoObj) {
    const { presupuesto, restante } = presupuestoObj;
    const restanteDiv = document.querySelector('.restante');

    // Quitar clases previas
    restanteDiv.classList.remove('alert-success', 'alert-warning', 'alert-danger');

    // Cambiar color según el nivel
    if (restante <= 0) {
      restanteDiv.classList.add('alert-danger');
      ui.imprimirAlerta('Has agotado el presupuesto', 'error');
      document.querySelector('button[type="submit"]').disabled = true;
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

const formulario = document.querySelector('#agregar-gasto');
let presupuesto;
const ui = new UI();

document.addEventListener('DOMContentLoaded', preguntarPresupuesto);
formulario.addEventListener('submit', agregarGasto);

function preguntarPresupuesto() {
  const presupuestoUsuario = prompt('¿Cuál es tu presupuesto semanal?');

  if (
    presupuestoUsuario === '' ||
    presupuestoUsuario === null ||
    isNaN(presupuestoUsuario) ||
    presupuestoUsuario <= 0
  ) {
    window.location.reload();
  }

  presupuesto = new Presupuesto(presupuestoUsuario);
  ui.imprimirPresupuesto(presupuesto);
  ui.imprimirAlerta('Presupuesto establecido correctamente', 'success');
}

function agregarGasto(e) {
  e.preventDefault();

  const nombre = document.querySelector('#gasto').value.trim();
  const cantidad = Number(document.querySelector('#cantidad').value);

  // Validaciones
  if (nombre === '' || cantidad === '') {
    ui.imprimirAlerta('Ambos campos son obligatorios', 'error');
    return;
  } else if (cantidad <= 0 || isNaN(cantidad)) {
    ui.imprimirAlerta('Cantidad no válida', 'error');
    return;
  }

  // Crear objeto gasto
  const gasto = { nombre, cantidad, id: Date.now() };

  // Añadir al presupuesto
  presupuesto.nuevoGasto(gasto);

  // Mostrar éxito
  ui.imprimirAlerta(`Gasto "${nombre}" añadido correctamente`, 'success');

  // Actualizar interfaz
  const { gastos, restante } = presupuesto;
  ui.imprimirGastosListado(gastos);
  ui.actualizarRestante(restante);
  ui.comprobarPresupuesto(presupuesto);

  // Limpiar formulario
  formulario.reset();
}

function eliminarGasto(id) {
  presupuesto.eliminarGasto(id);

  const { gastos, restante } = presupuesto;
  ui.imprimirGastosListado(gastos);
  ui.actualizarRestante(restante);
  ui.comprobarPresupuesto(presupuesto);
}
