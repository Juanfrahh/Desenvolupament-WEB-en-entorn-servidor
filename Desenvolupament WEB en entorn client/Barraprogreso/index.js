    document.addEventListener('DOMContentLoaded', () => {
      console.log('DOM listo');
      const bar = document.getElementById('bar');
      const btn = document.getElementById('start');

      if (!bar) { console.error('ERROR: no se encontró el elemento con id="bar"'); return; }
      if (!btn) { console.error('ERROR: no se encontró el botón start'); return; }

      let p = 0;
      btn.addEventListener('click', () => {
        console.log('Botón clicado, arrancando interval');
        btn.disabled = true;
        const t = setInterval(() => {
          p++;
          bar.style.width = p + '%';
          bar.textContent = p + '%';
          if (p >= 100) {
            clearInterval(t);
            console.log('Llegó a 100%');
            btn.textContent = 'Completado ✓';
          }
        }, 40); // ajusta velocidad aquí
      });
    });