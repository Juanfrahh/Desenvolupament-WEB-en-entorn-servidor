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
    const base = 300;
    let cantidad = base;

    // Gama del vehículo
    switch (this.tipo) {
      case 'baja':
        cantidad += base * 0.05;
        break;
      case 'media':
        cantidad += base * 0.15;
        break;
      case 'alta':
        cantidad += base * 0.3;
        break;
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
