class Poliza {
  constructor(gama, year, tipo) {
    this._gama = gama;
    this._year = year;
    this._tipo = tipo;
    this._importe = 300;
  }

  calcularSeguro() {
    let total = this._importe;

    // Gama del vehículo
    switch (this._gama) {
      case '1': total += total * 0.05; break;
      case '2': total += total * 0.15; break;
      case '3': total += total * 0.30; break;
    }

    // Antigüedad
    const yearActual = new Date().getFullYear();
    const antiguedad = yearActual - this._year;
    total += total * (antiguedad * 0.03);

    // Tipo de seguro
    total += total * (this._tipo === 'Básico' ? 0.3 : 0.5);

    this._importe = Math.round(total);
  }

  mostrarInfoHTML() {
    modalTitle.textContent = 'RESUMEN DE PÓLIZA';
    modalBody.innerHTML = `
      <p class="font-bold">Tipo de gama: ${this.obtenerGamaTexto()}</p>
      <p class="font-bold">Año del vehículo: ${this._year}</p>
      <p class="font-bold">Cobertura: ${this._tipo}</p>
      <p class="font-bold">Importe total: ${this._importe} €</p>
    `;

    modalFooter.innerHTML = '';
    const btnCerrar = document.createElement('button');
    btnCerrar.textContent = 'Cerrar';
    btnCerrar.classList.add('btn', 'btn-primary');
    btnCerrar.onclick = () => modal.hide();
    modalFooter.appendChild(btnCerrar);

    modal.show();
  }

  obtenerGamaTexto() {
    switch (this._gama) {
      case '1': return 'Gama Baja';
      case '2': return 'Gama Media';
      case '3': return 'Gama Alta';
      default: return '';
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  llenarSelectAnios();
});

function llenarSelectAnios() {
  const selectYear = document.querySelector('#year');
  const max = new Date().getFullYear();
  const min = max - 20;

  for (let i = max; i >= min; i--) {
    const option = document.createElement('option');
    option.value = i;
    option.textContent = i;
    selectYear.appendChild(option);
  }
}