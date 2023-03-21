
window.addEventListener("DOMContentLoaded", () => {

let bolg = document.querySelector('.blog');
const btnSuivant = document.querySelector('#btnSuivant');

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
      
      // display button Page suivante return: if articles < 6 => button display: none

      btnSuivant.style.display = data.length < 6 ? 'none' : 'block';

      // If data is not empty displayed the items.
      if(data.length > 0){

        data.forEach(item => {

          // Format date.
          let date = new Date(item.creation_date);

          // Create div class card
        let html = `
          <div class="card">
              <img src="../../uploads/article_thumbnail/${item.image}" alt="${item.title}">
              <h3>${item.title}</h3>
              <div class="author">
              <div>Publier le : ${date.toLocaleString()}</div>
              <div><span>${item.username}</span></div>
          </div>
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