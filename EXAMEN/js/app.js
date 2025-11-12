document.addEventListener('DOMContentLoaded', iniciarApp);

function iniciarApp() {
    const selectCategorias = document.querySelector('#categorias');
    const contenedorResultado = document.querySelector('#resultado');
    const main = document.querySelector('main');
    const modal = new bootstrap.Modal('#modal', {});
    const modalTitle = document.querySelector('#modal .modal-title');
    const modalBody = document.querySelector('#modal .modal-body');
    const modalFooter = document.querySelector('#modal .modal-footer');

    // Crear el mensaje de resultados dinámico
    const mensajeResultados = document.createElement('h2');
    mensajeResultados.className = 'text-clearInterval text-back my-5 text-center';
    main.insertBefore(mensajeResultados, contenedorResultado);

    // 1️⃣ Cargar categorías al iniciar
    obtenerCategorias();

    selectCategorias.addEventListener('change', seleccionarCategoria);

    function obtenerCategorias() {
        const url = 'https://www.themealdb.com/api/json/v1/1/categories.php';
        fetch(url)
            .then(res => res.json())
            .then(datos => mostrarCategorias(datos.categories));
    }

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

    // 3️⃣ Mostrar recetas
    function mostrarRecetas(recetas = [], categoria) {
        contenedorResultado.innerHTML = ''; // limpiar anteriores

        if (!recetas || recetas.length === 0) {
            mensajeResultados.textContent = `No se encontraron recetas para la categoría "${categoria}".`;
            return;
        }

        mensajeResultados.textContent = `Se encontraron ${recetas.length} recetas en la categoría "${categoria}".`;

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

            const btn = recetaDiv.querySelector('button');
            btn.addEventListener('click', () => mostrarRecetaModal(idMeal));

            contenedorResultado.appendChild(recetaDiv);
        });
    }

    // 4️⃣ Mostrar información de una receta en el modal
    function mostrarRecetaModal(idMeal) {
        const url = `https://www.themealdb.com/api/json/v1/1/lookup.php?i=${idMeal}`;
        fetch(url)
            .then(res => res.json())
            .then(datos => {
                const receta = datos.meals[0];
                mostrarRecetaEnModal(receta);
            });
    }

    function mostrarRecetaEnModal(receta) {
        const { idMeal, strMeal, strInstructions, strMealThumb } = receta;

        // Título
        modalTitle.textContent = strMeal;

        // Imagen e instrucciones
        modalBody.innerHTML = `
            <img src="${strMealThumb}" alt="Imagen de ${strMeal}" class="img-fluid mb-3">
            <h3 class="my-3">Instrucciones</h3>
            <p>${strInstructions}</p>
            <h3 class="my-3">Ingredientes y Cantidades</h3>
        `;

        // Lista de ingredientes y cantidades
        const lista = document.createElement('ul');
        lista.classList.add('list-group', 'mb-3');

        for (let i = 1; i <= 20; i++) {
            const ingrediente = receta[`strIngredient${i}`];
            const cantidad = receta[`strMeasure${i}`];
            if (ingrediente && ingrediente.trim() !== '') {
                const li = document.createElement('li');
                li.classList.add('list-group-item');
                li.textContent = `${ingrediente} - ${cantidad ?? ''}`;
                lista.appendChild(li);
            }
        }

        modalBody.appendChild(lista);

        // Limpiar footer
        modalFooter.innerHTML = '';

        // Crear botones
        const btnFavorito = document.createElement('button');
        btnFavorito.classList.add('btn', 'btn-danger', 'col');
        btnFavorito.textContent = esFavorito(idMeal)
            ? 'Eliminar de Favoritos'
            : 'Agregar a Favoritos';

        const btnCerrar = document.createElement('button');
        btnCerrar.classList.add('btn', 'btn-secondary', 'col');
        btnCerrar.textContent = 'Cerrar';
        btnCerrar.setAttribute('data-bs-dismiss', 'modal');

        // Evento del botón de favoritos
        btnFavorito.addEventListener('click', () => {
            if (esFavorito(idMeal)) {
                eliminarFavorito(idMeal);
                btnFavorito.textContent = 'Agregar a Favoritos';
            } else {
                agregarFavorito({ idMeal, strMeal, strMealThumb });
                btnFavorito.textContent = 'Eliminar de Favoritos';
            }
        });

        // Agregar botones al footer
        modalFooter.appendChild(btnFavorito);
        modalFooter.appendChild(btnCerrar);

        // Mostrar el modal
        modal.show();
    }

    // 🧠 Funciones para manejar localStorage
    function obtenerFavoritos() {
        return JSON.parse(localStorage.getItem('favoritos')) || [];
    }

    function esFavorito(id) {
        const favoritos = obtenerFavoritos();
        return favoritos.some(fav => fav.idMeal === id);
    }

    function agregarFavorito(receta) {
        const favoritos = obtenerFavoritos();
        localStorage.setItem('favoritos', JSON.stringify([...favoritos, receta]));
    }

    function eliminarFavorito(id) {
        const favoritos = obtenerFavoritos().filter(fav => fav.idMeal !== id);
        localStorage.setItem('favoritos', JSON.stringify(favoritos));
    }
}
