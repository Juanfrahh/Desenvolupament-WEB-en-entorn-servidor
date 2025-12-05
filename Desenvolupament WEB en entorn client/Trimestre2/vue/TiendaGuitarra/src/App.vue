<script setup>
import { ref, watch, onMounted } from 'vue';
import { db } from './data/guitarras';
import Header from './components/Header.vue';
import Guitarra from './components/Guitarra.vue';

// States
const guitarras = ref([]);
const carrito = ref([]);
const guitarra = ref({});


onMounted(() => {
    guitarras.value = db;
    guitarra.value = db[3]; 
    
    
    const carritoLS = localStorage.getItem('carrito');
    if (carritoLS) {
        carrito.value = JSON.parse(carritoLS);
    }
});


watch(carrito, () => {
    guardarLocalStorage()
}, { deep: true })


const guardarLocalStorage = () => {
    localStorage.setItem('carrito', JSON.stringify(carrito.value));
};


const agregarCarrito = (guitarra) => {
    const existeEnCarrito = carrito.value.findIndex(producto => producto.id === guitarra.id);
    if (existeEnCarrito >= 0) {
        carrito.value[existeEnCarrito].cantidad++;
    } else {
        guitarra.cantidad = 1;
        carrito.value.push(guitarra);
    }
};

const incrementarCantidad = (id) => {
    const index = carrito.value.findIndex(item => item.id === id);
    if (index >= 0) {
        carrito.value[index].cantidad++;
    }
};

const decrementarCantidad = (id) => {
    const index = carrito.value.findIndex(item => item.id === id);
    if (index >= 0 && carrito.value[index].cantidad > 1) {
        carrito.value[index].cantidad--;
    }
};

const eliminarProducto = (id) => {
    carrito.value = carrito.value.filter(item => item.id !== id);
};

const vaciarCarrito = () => {
    carrito.value = [];
};
</script>

<template>
    <Header 
        :carrito="carrito"
        :guitarra="guitarra"
        @agregar-carrito="agregarCarrito"
        @incrementar-cantidad="incrementarCantidad"
        @decrementar-cantidad="decrementarCantidad"
        @eliminar-producto="eliminarProducto"
        @vaciar-carrito="vaciarCarrito"
    />

    <main class="container-xl mt-5">
        <h2 class="text-center">Nuestra Colección</h2>
        
        <div class="row mt-5">
            <Guitarra
                v-for="guitarra in guitarras"
                :key="guitarra.id"
                :guitarra="guitarra"
                @agregar-carrito="agregarCarrito"
            />
        </div>
    </main>

    <footer class="bg-dark mt-5 py-5">
        <div class="container-xl">
            <p class="text-white text-center fs-4 mt-4 m-md-0">
                GuitarLA - Todos los derechos Reservados
            </p>
        </div>
    </footer>
</template>