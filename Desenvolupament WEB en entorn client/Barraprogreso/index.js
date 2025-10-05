 // Elementos
    const barra = document.getElementById('barra');
    const textoPercent = document.getElementById('textoPercent');
    const startBtn = document.getElementById('startBtn');
    const resetBtn = document.getElementById('resetBtn');

    // Estado
    let porcentaje = 0;
    let timerId = null;

    // Función que actualiza la UI según el porcentaje actual
    function actualizarUI(pct) {
      const pctClamped = Math.max(0, Math.min(100, Math.round(pct)));
      barra.style.width = pctClamped + '%';
      barra.textContent = pctClamped + '%';
      textoPercent.textContent = pctClamped + '%';
    }

    // Inicia la animación de la barra
    function iniciarCarga({interval = 60, step = 1, randomize = false} = {}) {
      // Si ya hay una carga en curso, no crear otra
      if (timerId !== null) return;

      startBtn.disabled = true;
      startBtn.textContent = 'Cargando...';

      timerId = setInterval(() => {
        // Si randomize está activo, variamos el paso ligeramente
        let actualStep = step;
        if (randomize) {
          actualStep = Math.max(0.2, step * (0.6 + Math.random() * 0.8));
        }

        porcentaje += actualStep;

        // Al llegar a 100 lo fijamos y paramos el timer
        if (porcentaje >= 100) {
          porcentaje = 100;
          actualizarUI(porcentaje);
          detenerCarga();
          // Pequeña animación final: dejar el botón como "Completado"
          startBtn.textContent = 'Completado ✓';
          startBtn.disabled = false;
          return;
        }

        actualizarUI(porcentaje);
      }, interval);
    }

    // Detiene la animación
    function detenerCarga() {
      if (timerId !== null) {
        clearInterval(timerId);
        timerId = null;
      }
    }

    // Reinicia todo a 0
    function reiniciar() {
      detenerCarga();
      porcentaje = 0;
      actualizarUI(porcentaje);
      startBtn.disabled = false;
      startBtn.textContent = 'Iniciar';
    }

    // Eventos
    startBtn.addEventListener('click', () => {
      // Ejemplo: intervalo 50ms, paso 1 (ajusta para velocidad)
      // También puedes habilitar randomize para que no vaya constante.
      iniciarCarga({ interval: 50, step: 1.2, randomize: true });
    });

    resetBtn.addEventListener('click', reiniciar);

    // Opcional: iniciar automáticamente al cargar la página
    // window.addEventListener('load', () => iniciarCarga({ interval: 40, step: 1.1 }));

    // Inicialización UI
    actualizarUI(porcentaje);