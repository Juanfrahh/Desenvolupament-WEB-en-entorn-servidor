document.addEventListener('DOMContentLoaded', iniciarApp);

function iniciarApp() {
    const contenedorResultado = document.querySelector('#resultado');
    const selectCategorias = document.querySelector('#categorias');
    const modal = new bootstrap.Modal('#modal', {});
    const modalTitle = document.querySelector('#modal .modal-title');
    const modalBody = document.querySelector('#modal .modal-body');
    const modalFooter = document.querySelector('#modal .modal-footer');

    // Detectar página actual
    const esInicio = document.querySelector('main h2')?.textContent.includes('Inicio');
    const esFavoritos = document.querySelector('main h2')?.textContent.includes('Favoritos');

    if (esInicio) {
        inicializarInicio();
    } else if (esFavoritos) {
        inicializarFavoritos();
    }

    function inicializarInicio() {
        const main = document.querySelector('main');

        // Crear mensaje dinámico de resultados
        const mensajeResultados = document.createElement('h2');
        mensajeResultados.className = 'text-clearInterval text-back my-5 text-center';
        main.insertBefore(mensajeResultados, contenedorResultado);

        // Cargar categorías
        obtenerCategorias();
        selectCategorias.addEventListener('change', seleccionarCategoria);

        function obtenerCategorias() {
            fetch('https://www.themealdb.com/api/json/v1/1/categories.php')
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

        function seleccionarCategoria(e) {
            const categoria = e.target.value;
            if (categoria !== '-- Seleccione --') {
                obtenerRecetas(categoria);
            } else {
                contenedorResultado.innerHTML = '';
                mensajeResultados.textContent = '';
            }
        }

        function obtenerRecetas(categoria) {
            fetch(`https://www.themealdb.com/api/json/v1/1/filter.php?c=${categoria}`)
                .then(res => res.json())
                .then(datos => mostrarRecetas(datos.meals, categoria));
        }

        function mostrarRecetas(recetas = [], categoria) {
            contenedorResultado.innerHTML = '';

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
                            <button class="btn btn-danger w-100" data-id="${idMeal}">Ver Receta</button>
                        </div>
                    </div>
                `;

                recetaDiv.querySelector('button').addEventListener('click', () => mostrarRecetaModal(idMeal));
                contenedorResultado.appendChild(recetaDiv);
            });
        }
    }

// Pagina de Favoritos

    function inicializarFavoritos() {
        mostrarFavoritos();

        function mostrarFavoritos() {
            const favoritos = obtenerFavoritos();
            contenedorResultado.innerHTML = '';

            if (favoritos.length === 0) {
                contenedorResultado.innerHTML = `
                    <p class="text-center fs-4 mt-5">No tienes recetas en Favoritos</p>
                `;
                return;
            }

            contenedorResultado.textContent = `<p class="text-center fs-4 mt-5">Tienes ${favoritos.length} recetas Favoritas`

            favoritos.forEach(receta => {
                const { idMeal, strMeal, strMealThumb } = receta;

                const divReceta = document.createElement('div');
                divReceta.classList.add('col-md-4');

                divReceta.innerHTML = `
                    <div class="card mb-4">
                        <img src="${strMealThumb}" alt="${strMeal}" class="card-img-top">
                        <div class="card-body">
                            <h3 class="card-title mb-3">${strMeal}</h3>
                            <button class="btn btn-danger w-100 mb-2" data-id="${idMeal}">Ver Receta</button>
                            <button class="btn btn-secondary w-100" data-id="${idMeal}">Eliminar de Favoritos</button>
                        </div>
                    </div>
                `;

                const btnVer = divReceta.querySelector('.btn-danger');
                const btnEliminar = divReceta.querySelector('.btn-secondary');

                btnVer.addEventListener('click', () => mostrarRecetaModal(idMeal));
                btnEliminar.addEventListener('click', () => {
                    eliminarFavorito(idMeal);
                    mostrarFavoritos();
                });

                contenedorResultado.appendChild(divReceta);
            });
        }
    }

    function mostrarRecetaModal(idMeal) {
        fetch(`https://www.themealdb.com/api/json/v1/1/lookup.php?i=${idMeal}`)
            .then(res => res.json())
            .then(datos => {
                const receta = datos.meals[0];
                mostrarRecetaEnModal(receta);
            });
    }

    function mostrarRecetaEnModal(receta) {
        const { idMeal, strMeal, strInstructions, strMealThumb } = receta;

        modalTitle.textContent = strMeal;
        modalBody.innerHTML = `
            <img src="${strMealThumb}" alt="Imagen de ${strMeal}" class="img-fluid mb-3">
            <h3 class="my-3">Instrucciones</h3>
            <p>${strInstructions}</p>
            <h3 class="my-3">Ingredientes y Cantidades</h3>
        `;

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

        modalFooter.innerHTML = '';

        // Botones modal
        const btnFavorito = document.createElement('button');
        btnFavorito.classList.add('btn', 'btn-danger', 'col');
        btnFavorito.textContent = esFavorito(idMeal)
            ? 'Eliminar de Favoritos'
            : 'Agregar a Favoritos';

        const btnCerrar = document.createElement('button');
        btnCerrar.classList.add('btn', 'btn-secondary', 'col');
        btnCerrar.textContent = 'Cerrar';
        btnCerrar.setAttribute('data-bs-dismiss', 'modal');

        // Acción botón favorito
        btnFavorito.addEventListener('click', () => {
            if (esFavorito(idMeal)) {
                eliminarFavorito(idMeal);
                btnFavorito.textContent = 'Agregar a Favoritos';
            } else {
                agregarFavorito({ idMeal, strMeal, strMealThumb });
                btnFavorito.textContent = 'Eliminar de Favoritos';
            }

            // Actualizar lista
            if (document.querySelector('main h2')?.textContent.includes('Favoritos')) {
                mostrarFavoritos();
            }
        });

        modalFooter.appendChild(btnFavorito);
        modalFooter.appendChild(btnCerrar);

        modal.show();
    }

    function obtenerFavoritos() {
        return JSON.parse(localStorage.getItem('favoritos')) || [];
    }

    function esFavorito(id) {
        return obtenerFavoritos().some(fav => fav.idMeal === id);
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

//quiero que solo aparezca el boton de eliminar de favoritos en el model y aparezcan los resultados de las recetas que hay en favoritos.
