export class Poliza {
  constructor(gama, year, tipo) {
    this._gama = gama;
    this._year = Number(year);
    this._tipo = tipo;
    this._importe = 300;
  }

  get gama() { return this._gama; }
  set gama(value) { this._gama = value; }

  get year() { return this._year; }
  set year(value) { this._year = Number(value); }

  get tipo() { return this._tipo; }
  set tipo(value) { this._tipo = value; }

  get importe() { return this._importe; }
  set importe(value) { this._importe = Number(value); }

  calcularSeguro() {
    let total = this._importe;

    switch (this._gama) {
      case '1': total += total * 0.05; break;
      case '2': total += total * 0.15; break;
      case '3': total += total * 0.30; break;
      default: break;
    }

    const yearActual = new Date().getFullYear();
    const antiguedad = yearActual - this._year;
    if (antiguedad > 0) {
      total += total * (antiguedad * 0.03);
    }

    total += total * (this._tipo === 'Básico' ? 0.3 : 0.5);

    this._importe = Math.round(total);
  }

  obtenerGamaTexto() {
    switch (this._gama) {
      case '1': return 'Gama Baja';
      case '2': return 'Gama Media';
      case '3': return 'Gama Alta';
      default: return '';
    }
  }

  // Devuelve un objeto resumen o HTML para que lo muestre quien controle el DOM
  toResumenObject() {
    return {
      gamaTexto: this.obtenerGamaTexto(),
      year: this._year,
      cobertura: this._tipo,
      importe: this._importe
    };
  }

  toResumenHTML() {
    const r = this.toResumenObject();
    return `
      <p class="font-bold">Tipo de gama: ${r.gamaTexto}</p>
      <p class="font-bold">Año del vehículo: ${r.year}</p>
      <p class="font-bold">Cobertura: ${r.cobertura}</p>
      <p class="font-bold">Importe total: ${r.importe} €</p>
    `;
  }
}

/* Función para llenar el select de años */
export function llenarSelectAnios() {
  const selectYear = document.querySelector('#year');
  if (!selectYear) return;
  const max = new Date().getFullYear();
  const min = max - 20;

  // Limpiamos posibles opciones previas (por si se llamara dos veces)
  selectYear.innerHTML = `<option value="">- Seleccionar -</option>`;

  for (let i = max; i >= min; i--) {
    const option = document.createElement('option');
    option.value = i;
    option.textContent = i;
    selectYear.appendChild(option);
  }
}
