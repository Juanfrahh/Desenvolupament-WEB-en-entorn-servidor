<template>
  <div class="overlay">
    <div class="modal">
      <h2>AÑADIR GASTO</h2>

      <div v-if="error" class="alerta">
        {{ error }}
      </div>

      <form @submit.prevent="submitGasto">
        <div class="campo">
          <label>Nombre gasto</label>
          <input
            type="text"
            placeholder="Ej: Comida"
            v-model="nombre"
          />
        </div>

        <div class="campo">
          <label>Cantidad</label>
          <input
            type="number"
            placeholder="Ej: 50"
            v-model="cantidad"
          />
        </div>

        <input type="submit" value="Añadir gasto" />
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { defineEmits } from 'vue'

const emit = defineEmits(['guardar-gasto', 'ocultar-modal'])

const nombre = ref('')
const cantidad = ref('')
const error = ref('')
let timeoutId = null // 🔥 para limpiar el timeout si se repite

const submitGasto = () => {
  // Limpiar cualquier timeout anterior
  if (timeoutId) clearTimeout(timeoutId)
  error.value = ''

  if (nombre.value.trim() === '' || cantidad.value === '') {
    error.value = 'TODOS LOS CAMPOS SON OBLIGATORIOS'
    // Desaparece tras 3 segundos
    timeoutId = setTimeout(() => { error.value = '' }, 3000)
    return
  }

  if (Number(cantidad.value) <= 0) {
    error.value = 'LA CANTIDAD DEBE SER SUPERIOR A 0'
    timeoutId = setTimeout(() => { error.value = '' }, 3000)
    return
  }

  emit('guardar-gasto', {
    nombre: nombre.value,
    cantidad: Number(cantidad.value)
  })

  nombre.value = ''
  cantidad.value = ''
}
</script>


<style scoped>
.overlay {
  position: fixed;
  inset: 0;
  background-color: rgba(0, 0, 0, 0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.modal {
  padding: 3rem;
  border-radius: 1.2rem;
  width: 90%;
  max-width: 70rem;
}

.modal h2 {
  text-align: center;
  color: var(--blanco);
  margin-bottom: 2rem;
}

.alerta {
  background-color: var(--blanco);
  color: #B91C1C;
  font-weight: 900;
  text-transform: uppercase;
  padding: 1rem;
  margin-bottom: 2rem;
  border-left: 0.5rem solid #B91C1C;
  text-align: center;
}

.campo {
  margin-bottom: 2rem;
}

.campo label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 700;
  color: var(--blanco);
}

.campo input {
  width: 100%;
  padding: 1rem;
  font-size: 1.6rem;
  border-radius: 0.5rem;
  border: 1px solid var(--gris);
}

input[type="submit"] {
  width: 100%;
  padding: 1.2rem;
  font-size: 1.8rem;
  background-color: var(--azul);
  color: var(--blanco);
  border: none;
  border-radius: 0.5rem;
  font-weight: 900;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #1048A4;
}

</style>
