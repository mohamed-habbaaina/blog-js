
window.addEventListener("DOMContentLoaded", () => {

let bolg = document.querySelector('.blog');

fetch("./../../app/controller/blog.php",{
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: bolg
    })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      
      // console.log(data.length);

      // If data is not empty displayed the items.
      if(data.length > 0){
      // console.log(data);
      data.forEach(item => {
        
        let html = `
          <div class="card">
              <img src="${item.image}" alt="${item.title}">
              <h3>${item.title}</h3>
              <div>
                  <p>${item.content}<a href="article.php?id=${item.id}">...plus</a></p>
                  
              </div>
          </div>
        `;

        bolg.insertAdjacentHTML('beforeend', html);
      });
    }    // else: displayed error message.
    else{
      alert('Revenir à la page précédente !');

      let html = `
      <div class="card" style="margin-top: 200px">
          <h3>Désolé, il n'y a plus d'articles à afficher !</h3>
          <div>
              <p>N'hésitez pas à revenir prochainement pour découvrir du nouveau contenu !</a></p>
              <p>Revenir à la page précédente !</p>
              
          </div>
      </div>
    `;

    bolg.insertAdjacentHTML('beforeend', html);
    }
    })
  })