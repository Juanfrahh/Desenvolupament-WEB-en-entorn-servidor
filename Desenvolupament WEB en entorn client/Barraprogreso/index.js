let p = 0, bar = document.getElementById("bar");
    let carga = setInterval(() => {
      if (p >= 100) return clearInterval(carga);
      p++;
      bar.style.width = p + "%";
      bar.textContent = p + "%";
    }, 50);
