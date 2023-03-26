//********************* Search bar **********************/
//***************************************************** */

const formSearch = document.forms['formSearch'];
let search = document.forms['formSearch']['search'];

let resultDisplay = document.querySelector('#result');

formSearch.addEventListener('input', async function(e) {

    // Remove display
    resultDisplay.innerHTML = '';


    let articleSearch = search.value;

    // if minimum 3 character
    if(articleSearch.length > 2){

        let search = await fetch('./../app/controller/homeSearch.php?search=' + articleSearch);

        let data = await search.json();
        let html = '';

        resultDisplay.innerHTML = '';

        // Display link Db
        data.forEach(item => {
            html += `
                <li class=""><a href="./../vue/src/article.php?id=${item.id}">${item.title}</a></li>
            `
        });
        
        resultDisplay.insertAdjacentHTML('beforeend', html);


    }

})


//****************** Display last 3 Aerticles ***********/
//***************************************************** */

const articlHome = document.querySelector('.articlHome');
let html;
const headeArticle = {
    method: 'post',
    header: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: articlHome
}
fetch("./../app/controller/home.php", headeArticle)
.then(response => response.json())
.then((data) => {

    // console.log(data);

    // create a date object to format it.
    let date1 = new Date(data[0].creation_date);
    let date2 = new Date(data[1].creation_date);
    let date3 = new Date(data[2].creation_date);


    html = `
        <div class="cardLeft">

            <img src="../uploads/article_thumbnail/${data[0].image}" alt="${data[0].title}">
            <h3>${data[0].title}</h3>
            <div class="author">
                <div>Publié le : ${date1.toLocaleString()}</div>
                <div><span>${data[0].username}</span></div>
            </div>
            <button><a href="../vue/src/article.php?id=${data[0].id}">Voir l'article</a></button>

        </div>
        <div class="cardRight">
            <div class="card">
                <img src="../uploads/article_thumbnail/${data[1].image}" alt="${data[0].title}">
                <h3>${data[1].title}</h3>
                <div class="author">
                    <div>Publié le : ${date2.toLocaleString()}</div>
                    <div><span>${data[1].username}</span></div>
                </div>
                <button><a href="../vue/src/article.php?id=${data[1].id}">Voir l'article</a></button>

            </div>
            <div class="card">
                <img src="../uploads/article_thumbnail/${data[2].image}" alt="${data[0].title}">
                <h3>${data[2].title}</h3>
                <div class="author">
                    <div>Publié le : ${date3.toLocaleString()}</div>
                    <div><span>${data[2].username}</span></div>
                </div>
                <button><a href="../vue/src/article.php?id=${data[2].id}">Voir l'article</a></button>

            </div>
        </div>


    `;

    articlHome.insertAdjacentHTML('beforeend', html);

})
