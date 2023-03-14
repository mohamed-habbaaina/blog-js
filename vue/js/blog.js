

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

      

      
    })