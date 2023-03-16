window.addEventListener('DOMContentLoaded', async () => {

    const adminUsers = document.querySelector('.adminUsers');

    let reponse = await fetch('./../../app/controller/adminUser.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: adminUsers
    });
    
    let data = await reponse.json();


    let html = `

        <table>
        <thead>
            <th>Username</th>
            <th>Register date</th>
            <th>Role actuel</th>
            <th>Role</th>
            <th>Delete</th>

        </thead>
        <tbody>
        
        `;

    data.forEach(item => {
        
        html += `
        
        <tr>
        <td>${item.username}</td>
        <td>${item.register_date}</td>
        <td>${item.role}</td>
        <td class="users">

            <select name="role" id="role">
                <option value="">--Changer le Role--</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="moderateur">Moderateur</option>
            </select>
            <button type="button" data-username="${item.username}">Changer</button>

        </td>
        <td>

        <a href="admin.php?username=${item.username}">Delete</a>

        </td>
    </tr>

        
        `
    });

    html += `
    
            </tr>
        </tbody>
    </table>

    `;
    
    adminUsers.insertAdjacentHTML('beforeend', html);




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

             if(response.status === 203){
                alert(`Le role de ${username} maintenat est : ${role}`);
            }
        });

    });



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
        
            let html = `
                <table>

                <thead>

                    <th>Title</th>
                    <th>Date</th>
                    <th>autheur</th>
                    <th>Delete</th>

                </thead>
                <tbody>
                
                `;

            data.forEach(item => {
                
                html += `
                    <tr>
                        <td>${item.title}</td>
                        <td>${item.creation_date}</td>
                        <td>${item.username}</td>
                        <td>
                            <a href="admin.php?idArticle=${item.id}">Delete</a>
                        </td>
                            
                    </tr>

                `
            })

                html += `
                    </tbody>
                </table>
                `

                adminArticles.insertAdjacentHTML('beforeend', html);
        
        })



        const adminCategory = document.querySelector('#adminCategory');

        adminCategory.addEventListener('click', function (e) {
            
            e.preventDefault();

            fetch('./../../app/controller/admincategory.php', {

                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                  },
                  body: adminCategory
                  })
                  .then(response => response.json())
                  .then((data) => {
                    console.log(data);
                  })
          

        })
    





})