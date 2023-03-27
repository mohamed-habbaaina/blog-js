
//************************* Table Category ******************/
// **********************************************************/
// ? display JS.
// let formCategory = `
//     <h2>Ajouter une catégorie</h2>
//     <form action="#" method="post">
//         <label for="name">Nom de la catégorie</label>
//         <input type="text" name="namecategorie">
//         <small></small>
//         <label for="description"></label>
//         <textarea name="description"></textarea>
//         <small></small>
//         <button>Valider</button>
//     </form>
// `;
// adminCategory.insertAdjacentHTML('beforeend', formCategory);

const adminCategory = document.querySelector('.adminCategory');
const formCategory = document.forms['formCategory'];
const inputName = document.forms['formCategory']['namecategorie'];
const inputDescription = document.forms['formCategory']['description'];


inputName.addEventListener('change', categorie);

// addEventListner form catégorie.
inputDescription.addEventListener('change', description);


function categorie()
{
        let name = inputName.value;

        //! Creation of the Regexp to validate the username.
        let nameCategorie = new RegExp

        (   //todo: \s ne fonction pas pour les espaces !
            '^[a-zA-Z\s\'àâäéèêëîïôöùûüçÀÂÄÉÈÊËÎÏÔÖÙÛÜÇ]+$'
        )

        let testNameCategorie = nameCategorie.test(name); // @return true , fals

        // Display messag
        let small = inputName.nextElementSibling;

        
        if(name.length >= 3){
            
            if(testNameCategorie)
            {
                small.innerHTML = 'Catégorie Valide';
                small.style.color = 'green';
                return true; // to use it in the form devalidation function => validForm.
            }
            else
            {
                small.innerHTML = 'Catégorie Invalid, (lettre alphabétique seulement) !';
                small.style.color = 'red';
                return false;
            }
        }
        else
        {
            small.innerHTML = 'Minimum 3 Caractère !';
            small.style.color = 'red';
            return false; // to use it in the form devalidation function => validForm.

        }
    }   

    function description()
    {
        let descriptionValue = inputDescription.value;

        // Display messag
        let small = inputDescription.nextElementSibling;

        if(descriptionValue.length >= 8)
        {
            small.innerHTML = 'Valide';
            small.style.color = 'green';
            return true; // to use it in the form devalidation function => validForm.
        }
        else
        {
            small.innerHTML = 'Minimum 8 Caractère !';
            small.style.color = 'red';
            return false; // to use it in the form devalidation function => validForm.

        }
    }

    function validFormCategorie()
    {
        
        if(categorie() && description()){
            return true;
        }
        return false;
    }

    formCategory.addEventListener('submit', (e) => {

        e.preventDefault();

        if(validFormCategorie()){

            if(confirm('Voullez vous rajouter la catégorie : ' + inputName.value + ' !')){

                formCategory.submit();
            }

        }

    })


window.addEventListener('DOMContentLoaded', () => {
    
//************************* Buttons ******************************/
// ***************************************************************/
const buttonDisplay = document.querySelectorAll('.btnAdmin button');
const adminUsers = document.querySelector('.adminUsers');
//************************* addEventListner **********************/
// ***************************************************************/
buttonDisplay[0].addEventListener('click', displayUsers);
buttonDisplay[1].addEventListener('click', displayArticles);

//************************* Table Users **************************/
// ***************************************************************/
async function displayUsers(e)
{
    // cleared the display
    adminUsers.innerHTML = '';
    e.preventDefault();
    
    let reponse = await fetch('./../../app/controller/admin.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: adminUsers
    });

    let data = await reponse.json();
    // Creation table
    let html = `
        <h2>Gérer les utilisateurs</h2>
        <table>
        <thead>
            <th>Nom d'utilisateur</th>
            <th>Date d'inscription</th>
            <th>Rôle actuel</th>
            <th>Modifier le rôle</th>
            <th>Supprimer</th>
        </thead>
        <tbody>

        `;
        // creation of td's with user data
    data.forEach(item => {

        html += `

        <tr>
        <td>${item.username}</td>
        <td>${item.register_date}</td>
        <td>${item.role}</td>
        <td class="users">
            <select name="role" id="role">
                <option value="">--Modifier le Role--</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="moderator">Modérateur</option>
            </select>
            <button type="button" data-username="${item.username}">Changer</button>
        </td>
        <td>
        <a href="admin.php?username=${item.username}" class="deleteUser">Supprimer</a>
        </td>
    </tr>

        `
    });
    html += `

            </tr>
        </tbody>
    </table>
    `;
    // display html.
    adminUsers.insertAdjacentHTML('beforeend', html);


    //******************** Update Role User *********************/
    // **********************************************************/
    let usersTD = document.querySelectorAll('td.users');
    usersTD.forEach((usersTD) => {
    
        let selectEl = usersTD.querySelector('select');
        let button = usersTD.querySelector('button');
        button.addEventListener('click', async ev => {

            // recuperated the username and the role.
            let username = ev.target.dataset.username;
            let role = selectEl.value;
            let object = { username: username, role: role };
            // ! The FormData did not work
            // let data = new FormData(ev.target);
            // data.append('username', username);
            // data.append('role', role);

            try{

            let res = await fetch(`./../../app/controller/adminRole.php?username=${username}&role=${role}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(object)
            });
            // ? second method to solve the undate "GET"
            //  let res = await fetch(`./../../app/controller/adminRole.php?username=${username}&role=${role}`);
            let response = await res.json();
            //  verify the repense done by the php
            if(response.status === 203){
                alert(`Le role de ${username} maintenat est : ${role}`);
            }
        }
        catch(err) {
            console.error(err);
        }
        });
    });
}
//************************* Table Articles ******************/
// **********************************************************/
async function displayArticles(){
const adminArticles = document.querySelector('.adminArticles');
fetch('./../../app/controller/adminArticle.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: adminArticles
    })
    .then(response => response.json())
    .then((data) => {
    
        // cleared the display
        adminArticles.innerHTML = '';

    // Creation table
        let html = `
            <h2>Gérer les articles</h2>
            <table>
            <thead>
                <th>Titre / Lien</th>
                <th>Date de création</th>
                <th>Auteur</th>
                <th>Supprimer</th>
            </thead>
            <tbody>
            
            `;
    // creation of td's with article data
        data.forEach(item => {
            
            html += `
                <tr>
                    <td><a href="../src/article.php?id=${item.id}" class="articleLink">${item.title}</a></td>
                    <td>${item.creation_date}</td>
                    <td>${item.username}</td>
                    <td>
                        <a href="admin.php?idArticle=${item.id}&title=${item.title}" class="deleteArticle">Supprimer</a>
                    </td>
                        
                </tr>
            `
        })
            html += `
                </tbody>
            </table>
            `
    // display html.
            adminArticles.insertAdjacentHTML('beforeend', html);

    })
}

})