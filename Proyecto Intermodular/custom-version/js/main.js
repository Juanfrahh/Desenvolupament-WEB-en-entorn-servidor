(function(){
  const btns = document.querySelectorAll('#theme-toggle');
  function applyTheme(dark){
    if(dark) document.documentElement.classList.add('dark-mode');
    else document.documentElement.classList.remove('dark-mode');
    btns.forEach(b=>{ if(b) b.textContent = dark ? '🌙' : '🌞' });
  }
  const stored = localStorage.getItem('parkEaseDark');
  applyTheme(stored === 'true');
  document.addEventListener('click', function(e){
    if(e.target && e.target.id === 'theme-toggle'){
      const isDark = document.documentElement.classList.toggle('dark-mode');
      localStorage.setItem('parkEaseDark', isDark);
      applyTheme(isDark);
    }
  });
})();