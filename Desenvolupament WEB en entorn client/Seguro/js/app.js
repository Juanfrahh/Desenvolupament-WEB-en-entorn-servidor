// app.js
// Módulo que exporta la clase Poliza y la función llenarSelectAnios
// Relación con HTML:
// - El select con id="year" será rellenado por llenarSelectAnios()
// - La clase Poliza se usa para calcular y devolver el resumen que se muestra en la modal

export class Poliza {
  constructor(gama, year, tipo) {
    this._gama = gama;
    this._year = Number(year);
    this._tipo = tipo;
    this._importe = 300; // base
  }

  // === GETTERS & SETTERS (requerido por la corrección) ===
  // Estos permiten acceder y modificar las propiedades desde fuera de la clase
  get gama() { return this._gama; }
  set gama(value) { this._gama = value; }

  get year() { return this._year; }
  set year(value) { this._year = Number(value); }

  get tipo() { return this._tipo; }
  set tipo(value) { this._tipo = value; }

  get importe() { return this._importe; }
  set importe(value) { this._importe = Number(value); }

  // === Lógica para calcular el importe del seguro ===
  calcularSeguro() {
    let total = this._importe;

    // Incremento según gama (valores: '1','2','3' desde el <select id="gama"> en el HTML)
    switch (this._gama) {
      case '1': total += total * 0.05; break; // 5% para gama baja
      case '2': total += total * 0.15; break; // 15% para gama media
      case '3': total += total * 0.30; break; // 30% para gama alta
      default: break;
    }

    // Antigüedad del vehículo: se aplica 3% por año de antigüedad (según enunciado)
    const yearActual = new Date().getFullYear();
    const antiguedad = yearActual - this._year;
    if (antiguedad > 0) {
      total += total * (antiguedad * 0.03);
    }

    // Tipo de cobertura: Básico (30%), Completo (50%)
    total += total * (this._tipo === 'Básico' ? 0.3 : 0.5);

    // Guardamos importe redondeado
    this._importe = Math.round(total);
  }

  // Convierte el código de gama a texto legible (se usa en la vista/modal)
  obtenerGamaTexto() {
    switch (this._gama) {
      case '1': return 'Gama Baja';
      case '2': return 'Gama Media';
      case '3': return 'Gama Alta';
      default: return '';
    }
  }

  // Devuelve un objeto resumen (útil para tests o JSON)
  toResumenObject() {
    return {
      gamaTexto: this.obtenerGamaTexto(),
      year: this._year,
      cobertura: this._tipo,
      importe: this._importe
    };
  }

  // Devuelve un HTML ya formateado para inyectar en la modal del HTML
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

// Rellena el <select id="year"> del HTML con los últimos 20 años
export function llenarSelectAnios() {
  const selectYear = document.querySelector('#year');
  if (!selectYear) return; // seguridad por si cambia el HTML

  const max = new Date().getFullYear();
  const min = max - 20;

  // Limpiamos y añadimos la opción por defecto tal como está en tu HTML
  selectYear.innerHTML = `<option value="">- Seleccionar -</option>`;

  for (let i = max; i >= min; i--) {
    const option = document.createElement('option');
    option.value = i;
    option.textContent = i;
    selectYear.appendChild(option);
  }
}
