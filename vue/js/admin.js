window.addEventListener('DOMContentLoaded', () => {

    const adminUsers = document.querySelector('.adminUsers');

    fetch('./../../app/controller/adminUser.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: adminUsers
    })
    .then(response => response.json())
    .then((data) => {


        let html = `

        <table>
        <thead>
            <th>Username</th>
            <th>Register date</th>
            <th>Role</th>
            <th>Delete</th>

        </thead>
        <tbody>
        
        `;
        // ! onclic select role
        data.forEach(item => {
            
            html += `
            
            <tr>
            <td>${item.username}</td>
            <td>${item.register_date}</td>
            <td>

                <form action="./admin.php" method="get" data-username="${item.username}">
        
                    <select name="role" id="role">
                        <option value="">--Changer le role--</option>
                        <option value="admin">Admin</option>
                        <option value="moderateur">Moderateur</option>
                        <option value="user">User</option>
                    </select>
                        <button onclick="role(e)">Changer</button>
                </form>

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



    })


    // 
    // function role(e){
    //     e.preventDefault();

    //     console.log('ok');
    //     // this.preventDefault();
    //     console.log(this.dataset.username);

    // }



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
            // console.log(data);
        
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
    





})