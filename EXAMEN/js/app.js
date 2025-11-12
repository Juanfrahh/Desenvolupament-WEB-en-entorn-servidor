document.addEventListener('DOMContentLoaded', iniciarApp);

function iniciarApp() {
    const selectCategorias = document.querySelector('#categorias');
    const contenedorResultado = document.querySelector('#resultado');

    // 1️⃣ Cargar categorías al iniciar
    obtenerCategorias();

    // Evento cuando cambia el select
    selectCategorias.addEventListener('change', seleccionarCategoria);

    // Función para obtener categorías
    function obtenerCategorias() {
        const url = 'https://www.themealdb.com/api/json/v1/1/categories.php';
        fetch(url)
            .then(res => res.json())
            .then(datos => mostrarCategorias(datos.categories));
    }

    // Mostrar opciones en el select
    function mostrarCategorias(categorias = []) {
        categorias.forEach(categoria => {
            const option = document.createElement('option');
            option.value = categoria.strCategory;
            option.textContent = categoria.strCategory;
            document.querySelector('#categorias').appendChild(option);
        });
    }

    // 2️⃣ Cuando el usuario selecciona una categoría
    function seleccionarCategoria(e) {
        const categoria = e.target.value;
        if (categoria !== '-- Seleccione --') {
            obtenerRecetas(categoria);
        } else {
            contenedorResultado.innerHTML = ''; // limpiar
        }
    }

    // Obtener recetas por categoría
    function obtenerRecetas(categoria) {
        const url = `https://www.themealdb.com/api/json/v1/1/filter.php?c=${categoria}`;
        fetch(url)
            .then(res => res.json())
            .then(datos => mostrarRecetas(datos.meals));
    }

    // 3️⃣ Mostrar las recetas en tarjetas
    function mostrarRecetas(recetas = []) {
        contenedorResultado.innerHTML = ''; // limpiar resultados previos

        recetas.forEach(receta => {
            const { idMeal, strMeal, strMealThumb } = receta;

            const recetaDiv = document.createElement('div');
            recetaDiv.classList.add('col-md-4');

            recetaDiv.innerHTML = `
                <div class="card mb-4">
                    <img src="${strMealThumb}" alt="Imagen de ${strMeal}" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title mb-3">${strMeal}</h3>
                        <button 
                            class="btn btn-danger w-100"
                            data-id="${idMeal}"
                        >Ver Receta</button>
                    </div>
                </div>
            `;

            contenedorResultado.appendChild(recetaDiv);
        });
    }
}

// ahora cuando le des a ver receta abrira un ventana modal y nos muestra informacion de la receta concreta y la informacion que queremos es nombre, id