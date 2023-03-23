
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
    console.log(data);

    let date1 = new Date(data[0].creation_date);
    let date2 = new Date(data[1].creation_date);
    let date3 = new Date(data[2].creation_date);


    html = `
        <div class="cardLeft">

            <img src="../uploads/article_thumbnail/${data[0].image}" alt="${data[0].title}">
            <h3>${data[0].title}</h3>
            <div class="author">
            <div>Publier le : ${date1.toLocaleString()}</div>
            <div><span>${data[0].username}</span></div>

        </div>
        <div class="cardRight">
            <div class="card">
                <img src="../uploads/article_thumbnail/${data[1].image}" alt="${data[0].title}">
                <h3>${data[1].title}</h3>
                <div class="author">
                <div>Publier le : ${date2.toLocaleString()}</div>
                <div><span>${data[1].username}</span></div>
            </div>
            <div class="card">
                <img src="../uploads/article_thumbnail/${data[2].image}" alt="${data[0].title}">
                <h3>${data[2].title}</h3>
                <div class="author">
                <div>Publier le : ${date3.toLocaleString()}</div>
                <div><span>${data[2].username}</span></div>
            </div>
        </div>


    `;

    articlHome.insertAdjacentHTML('beforeend', html);

})
