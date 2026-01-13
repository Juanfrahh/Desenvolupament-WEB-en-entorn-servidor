<script setup>
import { ref } from 'vue'
import Alerta from './Alerta.vue'
import cerrarModal from '../assets/cerrar.svg'

const error = ref('')

const props = defineProps({
  modal: {
    type: Object,
    required: true
  },
  nombre: {
    type: String,
    required: true
  },
  cantidad: {
    type: [String, Number],
    required: true
  },
  categoria: {
    type: String,
    required: true
  },
  disponible: {
    type: Number,
    required: true
  },
  id: {
    type: [String, null],
    required: true
  }
})

const emit = defineEmits([
  'ocultar-modal', 
  'guardar-gasto', 
  'update:nombre', 
  'update:cantidad', 
  'update:categoria',
  'eliminar-gasto'
])

const agregarGasto = () => {
  if (!props.nombre || !props.cantidad || !props.categoria) {
    error.value = 'TODOS LOS CAMPOS SON OBLIGATORIOS'
    setTimeout(() => {
      error.value = ''
    }, 2000)
    return
  }

  if (props.cantidad < 1) {
    error.value = 'LA CANTIDAD DEBE SER SUPERIOR A 0'
    setTimeout(() => {
      error.value = ''
    }, 2000)
    return
  }

  if (props.id) {
    // Editando
    const cantidadAntigua = props.cantidad
    if (props.cantidad > cantidadAntigua + props.disponible) {
      error.value = 'HAS EXCEDIDO EL PRESUPUESTO'
      setTimeout(() => {
        error.value = ''
      }, 2000)
      return
    }
  } else {
    // Añadiendo
    if (props.cantidad > props.disponible) {
      error.value = 'HAS EXCEDIDO EL PRESUPUESTO'
      setTimeout(() => {
        error.value = ''
      }, 2000)
      return
    }
  }

  emit('guardar-gasto')
}
</script>

<template>
  <div class="modal">
    <div class="cerrar-modal">
      <img 
        :src="cerrarModal"
        alt="cerrar modal"
        @click="$emit('ocultar-modal')"
      />
    </div>

    <div 
      class="contenedor-formulario"
      :class="[modal.animar ? 'animar' : 'cerrar']"
    >
      <form class="nuevo-gasto" @submit.prevent="agregarGasto">
        <legend>{{ id ? 'Editar Gasto' : 'Añadir Gasto' }}</legend>

        <Alerta v-if="error">{{ error }}</Alerta>

        <div class="campo">
          <label for="nombre">Nombre Gasto</label>
          <input
            id="nombre"
            type="text"
            placeholder="Nombre del gasto"
            :value="nombre"
            @input="$emit('update:nombre', $event.target.value)"
          />
        </div>

        <div class="campo">
          <label for="cantidad">Cantidad</label>
          <input
            id="cantidad"
            type="number"
            placeholder="Cantidad del gasto: ej. 300"
            :value="cantidad"
            @input="$emit('update:cantidad', +$event.target.value)"
          />
        </div>

        <div class="campo">
          <label for="categoria">Categoría</label>
          <select
            id="categoria"
            :value="categoria"
            @input="$emit('update:categoria', $event.target.value)"
          >
            <option value="">-- Seleccione --</option>
            <option value="ahorro">Ahorro</option>
            <option value="comida">Cesta compra</option>
            <option value="casa">Casa</option>
            <option value="ocio">Ocio</option>
            <option value="salud">Salud</option>
            <option value="suscripciones">Suscripciones</option>
            <option value="gastos">Gastos Varios</option>
          </select>
        </div>

        <input 
          type="submit" 
          :value="id ? 'Guardar Cambios' : 'Añadir Gasto'"
        />
      </form>

      <button
        v-if="id"
        type="button"
        class="btn-eliminar"
        @click="$emit('eliminar-gasto')"
      >
        Eliminar Gasto
      </button>
    </div>
  </div>
</template>

<style scoped>
.modal {
  position: absolute;
  background-color: rgb(0 0 0 / 0.9);
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.cerrar-modal {
  position: absolute;
  right: 3rem;
  top: 3rem;
}

.cerrar-modal img {
  width: 3rem;
  cursor: pointer;
}

.contenedor-formulario {
  transition-property: all;
  transition-duration: 300ms;
  transition-timing-function: ease-in;
  opacity: 0;
}

.contenedor-formulario.animar {
  opacity: 1;
}

.contenedor-formulario.cerrar {
  opacity: 0;
}

.nuevo-gasto {
  margin: 10rem auto 0 auto;
  display: grid;
  gap: 2rem;
}

.nuevo-gasto legend {
  text-align: center;
  color: var(--blanco);
  font-size: 3rem;
  font-weight: 700;
}

.campo {
  display: grid;
  gap: 2rem;
}

.nuevo-gasto input,
.nuevo-gasto select {
  background-color: var(--gris-claro);
  border-radius: 1rem;
  padding: 1rem;
  border: none;
  font-size: 2.2rem;
}

.nuevo-gasto label {
  color: var(--blanco);
  font-size: 3rem;
}

.nuevo-gasto input[type="submit"] {
  background-color: var(--azul);
  color: var(--blanco);
  font-weight: 700;
  cursor: pointer;
}

.btn-eliminar {
  border-radius: 1rem;
  border: none;
  padding: 1rem;
  width: 100%;
  background-color: #ef4444;
  font-weight: 700;
  font-size: 2.2rem;
  color: var(--blanco);
  margin-top: 10rem;
  cursor: pointer;
}
</style>