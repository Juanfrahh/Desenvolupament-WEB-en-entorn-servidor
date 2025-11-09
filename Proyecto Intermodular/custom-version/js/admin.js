document.addEventListener('DOMContentLoaded', function(){
  const total = document.getElementById('total-parking');
  const reservasHoy = document.getElementById('reservas-hoy');
  if(total) total.textContent = '120';
  if(reservasHoy) reservasHoy.textContent = '34';
  const canvas = document.getElementById('chart');
  if(canvas && canvas.getContext){
    const ctx = canvas.getContext('2d');
    const data = [20,40,60,55,70,50,30,20];
    const max = Math.max(...data);
    const w = canvas.width; const h = canvas.height;
    ctx.clearRect(0,0,w,h);
    ctx.fillStyle = getComputedStyle(document.documentElement).getPropertyValue('--accent') || '#0b5ed7';
    const barWidth = w / data.length;
    data.forEach((v,i)=>{
      const barH = (v / max) * (h - 20);
      ctx.fillRect(i*barWidth + 10, h - barH - 10, barWidth - 20, barH);
    });
  }
});