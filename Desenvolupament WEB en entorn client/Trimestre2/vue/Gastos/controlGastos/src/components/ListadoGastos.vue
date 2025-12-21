<template>
  <div class="listado-gastos">
    <h2>Gastos</h2>

    <p v-if="gastos.length === 0" class="sin-gastos">
      No hay gastos
    </p>

    <div v-else>
      <div v-for="gasto in gastos" :key="gasto.id" class="gasto">
        <div class="detalles">
          <p class="nombre">{{ gasto.nombre }}</p>
          <p class="fecha">{{ gasto.fecha || '---' }}</p>
        </div>
        <p class="cantidad">{{ formatoMoneda(gasto.cantidad) }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  gastos: {
    type: Array,
    required: true
  }
})

const formatoMoneda = (cantidad) => {
  return cantidad.toLocaleString('es-ES', {
    style: 'currency',
    currency: 'EUR'
  })
}
</script>

<style scoped>
.listado-gastos {
  margin-top: 2rem;
}

.listado-gastos ul {
  list-style: none;
  padding: 0;
}

.listado-gastos li {
  display: flex;
  justify-content: space-between;
  padding: 1rem;
  border-bottom: 1px solid #ccc;
}

.sin-gastos {
  text-align: center;
  color: var(--gris-oscuro);
  font-size: 2rem;
  font-weight: 700;
}

.gasto {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid #ccc;
}

.detalles {
  display: flex;
  flex-direction: column;
}

.nombre {
  font-weight: 700;
  font-size: 1.8rem;
}

.fecha {
  font-size: 1.4rem;
  color: var(--gris);
}

.cantidad {
  font-size: 1.8rem;
  font-weight: 900;
  color: var(--azul);
}
</style>
