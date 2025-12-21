<template>
  <form class="presupuesto" @submit.prevent="submitPresupuesto">
    <div class="campo">
      <label for="nuevo-presupuesto">Definir Presupuesto</label>
      <input
        id="nuevo-presupuesto"
        placeholder="Indica tu presupuesto"
        type="text"
        v-model="presupuestoInicial"
      />
    </div>

    <input type="submit" value="Aceptar" />

    <Alerta v-if="error">{{ error }}</Alerta>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import Alerta from './Alerta.vue'
import { defineEmits } from 'vue'

const emit = defineEmits(['definir-presupuesto'])

const presupuestoInicial = ref('')
const error = ref('')

const submitPresupuesto = () => {
  const cantidad = Number(presupuestoInicial.value)
  if (cantidad <= 0 || isNaN(cantidad)) {
    error.value = 'EL PRESUPUESTO NO ES VÁLIDO'
    setTimeout(() => error.value = '', 3000)
    return
  }
  emit('definir-presupuesto', cantidad)
  presupuestoInicial.value = ''
}
</script>


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
.presupuesto input[type="text"] { 
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
}
.presupuesto input[type="submit"]:hover { 
    background-color: #1048A4; 
    cursor: pointer; 
}
</style>
