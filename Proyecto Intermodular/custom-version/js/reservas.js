const sampleData = [ {id:1, name:'Parking Centro A', address:'Calle Mayor 1', price:1.5, distance:'200m'}, {id:2, name:'Parking Centro B', address:'Plaza Falsa 2', price:2.0, distance:'350m'}, {id:3, name:'Parking Subterraneo', address:'Av. Libertad 10', price:1.0, distance:'500m'} ];
function renderResults(){
  const container = document.getElementById('results');
  if(!container) return;
  container.innerHTML='';
  sampleData.forEach(p=>{
    const div = document.createElement('div');
    div.className='parking-card card';
    div.innerHTML = `<div><strong>${p.name}</strong><div style="font-size:13px;color:var(--muted)">${p.address} • ${p.distance}</div></div>
    <div style="text-align:right"><div style="font-weight:700">${p.price} €/h</div><button class="btn" data-id="${p.id}">Reservar</button></div>`;
    container.appendChild(div);
  });
  container.querySelectorAll('.btn').forEach(b=> b.addEventListener('click', e=>{
    const id = e.target.getAttribute('data-id');
    const park = sampleData.find(x=> x.id==id);
    if(confirm('Confirmar reserva en: '+park.name+' (simulada)')){
      alert('Reserva simulada creada para '+park.name);
    }
  }));
}
document.addEventListener('DOMContentLoaded', function(){
  const searchBtn = document.getElementById('search-btn');
  if(searchBtn) searchBtn.addEventListener('click', function(){ renderResults(); });
  renderResults();
});