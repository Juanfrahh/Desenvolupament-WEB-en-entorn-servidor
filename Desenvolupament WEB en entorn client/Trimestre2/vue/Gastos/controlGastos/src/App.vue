<template>
  <header>
    <h1>Planificador de Gastos</h1>
  </header>

  <main>
    <div class="crear-gasto" @click="mostrarModal">
      <img src="" alt="icono nuevo gasto" />
    </div>
  </main>

  <div class="contenedor-header contenedor sombra">
    <Presupuesto
      v-if="presupuesto === 0"
      @definir-presupuesto="definirPresupuesto"
    />

    <ControlPresupuesto
      v-else
      :presupuesto="presupuesto"
      :disponible="disponible"
      :gastado="gastado"
      :gastos="gastos"
      @reset-app="resetearApp"
    />
  </div>
  
  <Modal
    v-if="modal.mostrar"
    @guardar-gasto="agregarGasto"
    @ocultar-modal="ocultarModal"
  />
</template>


<script setup>
import { ref, reactive } from 'vue'
import Presupuesto from './components/Presupuesto.vue'
import ControlPresupuesto from './components/ControlPresupuesto.vue'
import Modal from './components/Modal.vue'

const presupuesto = ref(0)
const gastos = ref([])
const gastado = ref(0)
const disponible = ref(0)

const definirPresupuesto = (cantidad) => {
  presupuesto.value = Number(cantidad)
  disponible.value = Number(cantidad)
}

// Función para resetear la app
const resetearApp = () => {
  presupuesto.value = 0
  gastos.value = []
  gastado.value = 0
  disponible.value = 0
}

// Función para agregar gasto desde el modal
const agregarGasto = (gasto) => {
  gasto.id = Date.now()
  gasto.cantidad = Number(gasto.cantidad)
  gastos.value.push(gasto)
  gastado.value += gasto.cantidad
  disponible.value = presupuesto.value - gastado.value
  ocultarModal()
}

// Modal
const modal = reactive({ mostrar: false, animar: false })

const mostrarModal = () => {
  modal.mostrar = true
  setTimeout(() => modal.animar = true, 500)
}

const ocultarModal = () => {
  modal.animar = false
  setTimeout(() => modal.mostrar = false, 500)
}
</script>

<style>
:root {
  --azul: #3b82f6;
  --blanco: #FFF;
  --gris-claro: #F5F5F5;
  --gris: #94a3b8;
  --gris-oscuro: #64748b;
  --negro: #000;
}

html {
  font-size: 62.5%;
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

body {
  font-size: 1.6rem;
  font-family: "Lato", sans-serif;
  background-color: var(--gris-claro);
}

h1 { 
  font-size: 4rem; 
}
header { 
  background-color: var(--azul); 
}
header h1 { 
  padding: 3rem 0; 
  margin: 0; 
  color: var(--blanco); 
  text-align: center; 
}

.contenedor { 
  width: 90%; 
  max-width: 80rem; 
  margin: 0 auto; 
}
.contenedor-header { 
  margin-top: -5rem; 
  transform: translateY(5rem); 
  padding: 5rem; 
}

.sombra { 
  box-shadow: 0px 10px 15px -3px rgba(0,0,0,0.1); 
  background-color: var(--blanco); 
  border-radius: 1.2rem; 
  padding: 5rem; 
}

.crear-gasto { 
  position: fixed; 
  bottom: 5rem; 
  right: 5rem; 
}

.crear-gasto img { 
  width: 5rem; 
  cursor: pointer; 
}
</style>
