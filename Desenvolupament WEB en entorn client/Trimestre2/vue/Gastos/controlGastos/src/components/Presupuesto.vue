<script setup>
import { ref } from 'vue'
import Alerta from './Alerta.vue'

const presupuestoInicial = ref(0)
const error = ref('')

const emit = defineEmits(['definir-presupuesto'])

const validarPresupuesto = () => {
  if (!presupuestoInicial.value || presupuestoInicial.value <= 0) {
    error.value = 'EL PRESUPUESTO DEBE SER UN NÚMERO VÁLIDO'
    setTimeout(() => {
      error.value = ''
      presupuestoInicial.value = 0
    }, 3000)
    return
  }

  emit('definir-presupuesto', presupuestoInicial.value)
}
</script>

<template>
  <form class="presupuesto" @submit.prevent="validarPresupuesto">
    <div class="campo">
      <label for="nuevo-presupuesto">Definir Presupuesto</label>
      <input
        id="nuevo-presupuesto"
        class="nuevo-presupuesto"
        placeholder="Indica tu presupuesto"
        type="number"
        v-model.number="presupuestoInicial"
      />
    </div>
    <input type="submit" value="Aceptar" />
  </form>

  <Alerta v-if="error">
    {{ error }}
  </Alerta>
</template>

<style scoped>
.presupuesto {
  width: 100%;
}

.campo {
  display: grid;
  gap: 2rem;
}

.presupuesto label {
  font-size: 2.2rem;
  text-align: center;
  color: var(--azul);
}

.presupuesto input[type="number"] {
  background-color: var(--gris-claro);
  border-radius: 1rem;
  padding: 1rem;
  border: none;
  font-size: 2.2rem;
  text-align: center;
}

.presupuesto input[type="submit"] {
  background-color: var(--azul);
  border: none;
  padding: 1rem;
  font-size: 2rem;
  text-align: center;
  margin-top: 2rem;
  color: var(--blanco);
  font-weight: 900;
  width: 100%;
  transition: background-color 300ms ease;
}

.presupuesto input[type="submit"]:hover {
  background-color: #1048A4;
  cursor: pointer;
}
</style>