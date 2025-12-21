<template>
  <div class="dos-columnas">
    <div class="contenedor-grafico">
    </div>
    <p class="porcentaje">{{ porcentajeGastado }}%</p>
     <CircleProgress
        :progress="porcentajeGastado"
        :size="150"
        :stroke="10"
        :color="'#3b82f6'"
        :empty-color="'#F5F5F5'"
        :animation-speed="500"
    />
    <p>Resumen del presupuesto</p>
    <div class="contenedor-presupuesto">
      <button type="button" class="reset-app" @click="$emit('reset-app')">
        Resetear app
      </button>

      <p>Presupuesto: <span>{{ formatoMoneda(presupuesto) }}</span></p>
      <p>Disponible: <span>{{ formatoMoneda(disponible) }}</span></p>
      <p>Gastado: <span>{{ formatoMoneda(gastado) }}</span></p>

      
    </div>

    <ListadoGastos 
    :gastos="gastos" 
    />

  </div>

</template>

<script setup>
import { defineProps } from 'vue'
import ListadoGastos from './ListadoGastos.vue'

defineProps({
  presupuesto: Number,
  disponible: Number,
  gastado: Number,
  gastos: Array
})

const formatoMoneda = (cantidad) => {
  return cantidad.toLocaleString('es-ES', {
    style: 'currency',
    currency: 'EUR'
  })
}

import { computed } from 'vue'
import CircleProgress from 'vue3-circle-progress'

// Computed para calcular el % gastado
const porcentajeGastado = computed(() => {
  if (!presupuesto) return 0
  return Math.round((gastado / presupuesto) * 100)
})

</script>


<style scoped>
.dos-columnas { 
    display: flex; 
    flex-direction: column; 
}

.dos-columnas > :first-child { 
    margin-bottom: 3rem; 
}

.contenedor-grafico { 
    display: flex; 
    flex-direction: column; 
    align-items: center; 
    margin-bottom: 2rem; 
}

.contenedor-grafico p { 
    margin-top: 1rem; 
    font-weight: 900; 
    font-size: 1.8rem; 
    color: #3b82f6; 
}

.contenedor-presupuesto { 
    width: 100%; 
}
.contenedor-presupuesto p { 
    font-size: 2.4rem; 
    text-align: center; 
    color: var(--gris-oscuro); 
}
.contenedor-presupuesto span { 
    font-weight: 900; 
    color: var(--azul); 
}

.reset-app { 
    background-color: #DB2777; 
    border: none; 
    padding: 1rem; 
    width: 100%; 
    color: var(--blanco); 
    font-weight: 900; 
    text-transform: uppercase; 
    border-radius: 1rem; 
}

.reset-app:hover { 
    cursor: pointer; 
    background-color: #c11d67; 
}

.porcentaje {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  font-size: 2rem;
  font-weight: 900;
  color: var(--gris-oscuro);
  z-index: 10;
}

</style>
