/******************************************************************
**************************PROPAGACIÓN DE EVENTOS****************
*******************************************************************/
const cardDiv = document.querySelector('.card');
const infoDiv = document.querySelector('.info');
const titulo = document.querySelector('.titulo'); 

cardDiv.addEventListener('click', (e) => {
    e.stopPropagation();
    console.log("estás en card: abuelo");
});
infoDiv.addEventListener('click', (e) =>{
    e.stopPropagation();
    console.log("estás en info: papá");
});

titulo.addEventListener('click', (e) =>{
    e.stopPropagation();
    console.log("estás en titulo: hijo");
}); 


