class Poliza {
  constructor(gama, year, tipo) {
    this._gama = gama;
    this._year = year;
    this._tipo = tipo;
    this._importe = 300;
  }

  get gama() { return this._gama; }
  get year() { return this._year; }
  get tipo() { return this._tipo; }
  get importe() { return this._importe; }

  calcularSeguro() {
    let total = this._importe;

    switch (this._gama) {
      case '1': total += total * 0.05; break;
      case '2': total += total * 0.15; break;
      case '3': total += total * 0.30; break;
    }

    const yearActual = new Date().getFullYear();
    const antiguedad = yearActual - this._year;
    total += total * (antiguedad * 0.03);

    if (this._tipo === 'Básico') total += total * 0.30;
    else total += total * 0.50;

    this._importe = Math.round(total);
  }

  mostrarInfoHTML() {
    modalTitle.textContent = 'RESUMEN DE PÓLIZA';
    modalTitle.classList.add('header', 'col');
    modalBody.innerHTML = `
      <p class="font-bold">Tipo de gama: ${this.obtenerGamaTexto()}</p>
      <p class="font-bold">Año del vehículo: ${this._year}</p>
      <p class="font-bold">Cobertura: ${this._tipo}</p>
      <p class="font-bold">Importe total: ${this._importe} €</p>
    `;
    modalFooter.innerHTML = '';
    const btnCerrar = document.createElement('button');
    btnCerrar.textContent = 'Cerrar';
    btnCerrar.classList.add('btn', 'btn-primary', 'btn-raised', 'col');
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
