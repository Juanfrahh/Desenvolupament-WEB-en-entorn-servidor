<script setup>
import { formatearCantidad, formatearFecha } from '../helpers'
import IconoAhorro from '../assets/ahorro.svg'
import IconoComida from '../assets/comida.svg'
import IconoCasa from '../assets/casa.svg'
import IconoOcio from '../assets/ocio.svg'
import IconoSalud from '../assets/salud.svg'
import IconoSuscripciones from '../assets/suscripciones.svg'
import IconoGastos from '../assets/gastos.svg'

const diccionarioIconos = {
  ahorro: IconoAhorro,
  comida: IconoComida,
  casa: IconoCasa,
  ocio: IconoOcio,
  salud: IconoSalud,
  suscripciones: IconoSuscripciones,
  gastos: IconoGastos
}

const props = defineProps({
  gasto: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['seleccionar-gasto'])
</script>

<template>
  <div class="gasto sombra">
    <div class="contenido">
      <img 
        :src="diccionarioIconos[gasto.categoria]"
        alt="Icono gasto"
        class="icono"
      />
      
      <div class="detalles">
        <p class="categoria">{{ gasto.categoria }}</p>
        <p 
          class="nombre"
          @click="$emit('seleccionar-gasto', gasto.id)"
        >
          {{ gasto.nombre }}
        </p>
        <p class="fecha">
          Fecha: <span>{{ formatearFecha(gasto.fecha) }}</span>
        </p>
      </div>
    </div>

    <p class="cantidad">{{ formatearCantidad(gasto.cantidad) }}</p>
  </div>
</template>

<style scoped>
.gasto {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.contenido {
  display: flex;
  align-items: center;
  gap: 2rem;
}

.icono {
  width: 5rem;
}

.detalles p {
  margin: 0 0 1rem 0;
}

.categoria {
  color: var(--gris);
  font-size: 1.2rem;
  text-transform: uppercase;
  font-weight: 900;
}

.nombre {
  color: var(--gris-oscuro);
  font-size: 2.4rem;
  font-weight: 700;
  cursor: pointer;
}

.fecha {
  color: var(--gris-oscuro);
  font-size: 1.6rem;
  font-weight: 900;
}

.fecha span {
  font-weight: 400;
}

.cantidad {
  font-size: 3rem;
  font-weight: 900;
  margin: 0;
}
</style>