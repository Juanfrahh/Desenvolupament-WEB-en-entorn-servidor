document.addEventListener('DOMContentLoaded', iniciarApp);

function iniciarApp() {
    const selectCategorias = document.querySelector('#categorias');
    const contenedorResultado = document.querySelector('#resultado');
    const main = document.querySelector('main');

    // Crear el mensaje de resultados dinámico
    const mensajeResultados = document.createElement('h2');
    mensajeResultados.className = 'text-clearInterval text-back my-5 text-center';
    main.insertBefore(mensajeResultados, contenedorResultado);

    // 1️⃣ Cargar categorías al iniciar
    obtenerCategorias();

    selectCategorias.addEventListener('change', seleccionarCategoria);

    // Función para obtener categorías
    function obtenerCategorias() {
        const url = 'https://www.themealdb.com/api/json/v1/1/categories.php';
        fetch(url)
            .then(res => res.json())
            .then(datos => mostrarCategorias(datos.categories));
    }

    // Mostrar categorías en el select
    function mostrarCategorias(categorias = []) {
        categorias.forEach(categoria => {
            const option = document.createElement('option');
            option.value = categoria.strCategory;
            option.textContent = categoria.strCategory;
            selectCategorias.appendChild(option);
        });
    }

    // 2️⃣ Cuando el usuario selecciona una categoría
    function seleccionarCategoria(e) {
        const categoria = e.target.value;
        if (categoria !== '-- Seleccione --') {
            obtenerRecetas(categoria);
        } else {
            contenedorResultado.innerHTML = '';
            mensajeResultados.textContent = '';
        }
    }

    // Obtener recetas por categoría
    function obtenerRecetas(categoria) {
        const url = `https://www.themealdb.com/api/json/v1/1/filter.php?c=${categoria}`;
        fetch(url)
            .then(res => res.json())
            .then(datos => mostrarRecetas(datos.meals, categoria));
    }

    // 3️⃣ Mostrar recetas y mensaje
    function mostrarRecetas(recetas = [], categoria) {
        contenedorResultado.innerHTML = ''; // limpiar anteriores

        if (!recetas || recetas.length === 0) {
            mensajeResultados.textContent = `No se encontraron recetas para la categoría "${categoria}".`;
            return;
        }

        mensajeResultados.textContent = ` ${recetas.length} Recetas de "${categoria}".`;

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


// ahora cuando le des a ver receta abrira un ventana modal y nos muestra informacion de la receta concreta y la informacion que queremos es nombre, id no lo guardamos pero si lo usaremo, ingredientes y foto  usaremos el div class modal fade