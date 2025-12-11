// ============================
// Funciones de Copos de Nieve
// ============================
function crearNieve() {
    const snowflakesContainer = document.getElementById('snowflakes');
    if (!snowflakesContainer) return;

    const numberOfFlakes = 50;
    for (let i = 0; i < numberOfFlakes; i++) {
        const snowflake = document.createElement('div');
        snowflake.className = 'snowflake';
        snowflake.innerHTML = '❄';
        snowflake.style.left = Math.random() * 100 + '%';
        snowflake.style.animationDuration = (Math.random() * 3 + 2) + 's';
        snowflake.style.animationDelay = Math.random() * 5 + 's';
        snowflake.style.fontSize = (Math.random() * 0.5 + 0.5) + 'em';
        snowflakesContainer.appendChild(snowflake);
    }
}
crearNieve();

// ============================================
// Funciones de Alerta Personalizada (Bloque 2)
// ============================================
let proximaPreguntaId = "";
let entranteId = "";

/**
 * Muestra el modal de alerta personalizada.
 * @param {string} titulo - Título de la alerta.
 * @param {string} mensaje - Mensaje principal.
 * @param {boolean} esCorrecta - Si la respuesta fue correcta (true) o no (false).
 * @param {string} proximaPregunta - ID del div a mostrar si es correcta.
 * @param {string} entrante - ID del entrante a 'desdifuminar' si es correcta.
 */
function mostrarAlerta(titulo, mensaje, esCorrecta, proximaPregunta, entrante) {
    document.getElementById('alertaTitulo').textContent = titulo;
    document.getElementById('alertaMensaje').textContent = mensaje;
    
    // Configura el botón para volver a intentar o continuar
    if (!esCorrecta) {
        document.querySelector('#alertaModal button').textContent = "Volver a intentar";
        proximaPreguntaId = ""; // No avanzamos de pregunta
        entranteId = "";
    } else {
        document.querySelector('#alertaModal button').textContent = "Continuar";
        proximaPreguntaId = proximaPregunta;
        entranteId = entrante;
    }

    document.getElementById('alertaModal').style.display = "flex";
}

// Esta función es llamada por el botón del modal.
function cerrarAlerta() {
    document.getElementById('alertaModal').style.display = "none";
    
    if (proximaPreguntaId) {
        // Lógica para avanzar la pregunta y 'desdifuminar' el entrante
        
        let preguntaAnterior = "";
        
        // Determinar la pregunta a ocultar (basado en el ID de la siguiente)
        if (proximaPreguntaId === "div_p2") {
            // Esto solo funciona si se está en un flujo de div_p1 a div_p2
            const preguntaActualDiv = document.querySelector('[style*="display: block"]:not(#alertaModal):not(#div_continuar)');
            if (preguntaActualDiv) {
                preguntaAnterior = preguntaActualDiv.id;
            } else {
                 // Manejo para el caso donde 'div_p1' está visible
                 preguntaAnterior = "div_p1";
            }
        } else if (proximaPreguntaId === "div_p3") {
            preguntaAnterior = "div_p2";
        } else if (proximaPreguntaId === "div_p4") {
            preguntaAnterior = "div_p3";
        } else if (proximaPreguntaId === "div_continuar") {
            // El caso 'div_continuar' es especial, necesitamos saber desde qué div venimos.
            const preguntaActualDiv = document.querySelector('[style*="display: block"]:not(#alertaModal)');
             if (preguntaActualDiv) {
                preguntaAnterior = preguntaActualDiv.id;
            }
        }

        if (preguntaAnterior && document.getElementById(preguntaAnterior)) {
            document.getElementById(preguntaAnterior).style.display = "none";
        }

        // Mostrar la siguiente pregunta/div
        if (document.getElementById(proximaPreguntaId)) {
            setTimeout(() => {
                document.getElementById(proximaPreguntaId).style.display = "block";
                document.getElementById(proximaPreguntaId).scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }

        // Quitar el blur del entrante
        if (entranteId && document.getElementById(entranteId)) {
            setTimeout(() => {
                document.getElementById(entranteId).style.filter = "blur(0px)";
            }, 500); 
        }
    }
}

// ===============================================
// Función Principal Unificada (Lógica del Bloque 1 y 2)
// ===============================================

/**
 * Verifica la respuesta para la pregunta dada y gestiona el avance.
 * @param {string} pregunta - El ID de la pregunta (ej: "pregunta1", "pregunta4").
 */
function verificarRespuesta(pregunta) {
    const numeroPregunta = pregunta.replace('pregunta', '');
    const formId = `form_entrantes${numeroPregunta}`; // Asume que tus formularios siguen esta convención
    
    let opciones, nombreGrupoRadio;
    
    // Intentamos obtener el grupo de radio de la estructura más nueva (Bloque 2)
    const form = document.getElementById(formId);
    if (form) {
         nombreGrupoRadio = `entrante${numeroPregunta}`;
         opciones = form.querySelectorAll(`input[name="${nombreGrupoRadio}"]`);
    } else {
        // Fallback a la estructura más antigua si no se encuentra el formulario con el ID específico
        nombreGrupoRadio = 'entrante';
        opciones = document.getElementsByName(nombreGrupoRadio);
    }

    let seleccionada = null;
    
    for (let i = 0; i < opciones.length; i++) {
        if (opciones[i].checked) {
            seleccionada = opciones[i].value;
            break;
        }
    }

    if (seleccionada === null) {
        mostrarAlerta("Atención", "Por favor, selecciona una opción antes de enviar.", false, "", "");
        return;
    }

    let respuestaCorrecta = null;
    let div_aparece = null;
    let entrante_id = null; // ID del div del plato a 'desdifuminar' (ej: 'entrante1', 'entrante2', etc.)

    // --- Lógica de Respuestas Unificada (Preguntas 1 a 12) ---
    switch (pregunta) {
        // --- Entrantes ---
        case "pregunta1":
            respuestaCorrecta = "respuesta2"; // Ensalada de Protocolo
            div_aparece = "div_p2";
            entrante_id = "entrante1";
            break;
        case "pregunta2":
            respuestaCorrecta = "respuesta8"; // Pincho de Eventos
            div_aparece = "div_p3";
            entrante_id = "entrante2";
            break;
        case "pregunta3":
            respuestaCorrecta = "respuesta11"; // Pincho de Contabilidad
            div_aparece = "div_continuar"; // Asume que este es el final de la sección Entrantes
            entrante_id = "entrante3";
            break;
            
        // --- Principales ---
        case "pregunta4":
            respuestaCorrecta = "resp_prin2";
            div_aparece = "div_p5"; // Asume que los platos principales comienzan en div_p4 y avanzan
            entrante_id = "principal1"; // ID que deberías asignar al plato 1
            break;

        case "pregunta5":
            respuestaCorrecta = "resp_prin5";
            div_aparece = "div_p6";
            entrante_id = "principal2";
            break;

        case "pregunta6":
            respuestaCorrecta = "resp_prin11";
            div_aparece = "div_continuar_principales"; // Cambia a un ID de div de continuación específico
            entrante_id = "principal3";
            break;
        
        // --- Postres ---
        case "pregunta7":
            respuestaCorrecta = "resp_postre3";
            div_aparece = "div_p8";
            entrante_id = "postre1";
            break;

        case "pregunta8":
            respuestaCorrecta = "resp_postre8";
            div_aparece = "div_continuar_postres";
            entrante_id = "postre2";
            break;

        // --- Bebidas ---
        case "pregunta9":
            respuestaCorrecta = "resp_bebida4";
            div_aparece = "div_p10";
            entrante_id = "bebida1";
            break;

        case "pregunta10":
            respuestaCorrecta = "resp_bebida7";
            div_aparece = "div_p11";
            entrante_id = "bebida2";
            break;

        case "pregunta11":
            respuestaCorrecta = "resp_bebida10";
            div_aparece = "div_p12";
            entrante_id = "bebida3";
            break;

        case "pregunta12":
            respuestaCorrecta = "resp_bebida9";
            div_aparece = "div_continuar_final";
            entrante_id = "bebida4";
            break;

        default:
            respuestaCorrecta = null;
    }

    // --- Gestión de la Alerta y el Avance ---
    if (seleccionada === respuestaCorrecta) {
        // La función mostrarAlerta ahora maneja el avance de la pregunta después de cerrar el modal.
        mostrarAlerta(
            "🎄 ¡Respuesta Correcta! 🎄", 
            "Felicidades, has desbloqueado este plato.", 
            true, // esCorrecta
            div_aparece, 
            entrante_id
        );
        
    } else {
        // Si es incorrecta, solo muestra la alerta y el usuario debe volver a intentar.
        mostrarAlerta(
            "❌ ¡Respuesta Incorrecta! ❌", 
            "Sigue intentándolo, el menú está delicioso.", 
            false, // esCorrecta
            "", 
            ""
        );
    }
}