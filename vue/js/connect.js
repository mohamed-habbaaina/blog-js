//******************* validation  ****************** */
//****************************************************/ 

const formConnect = document.forms['formConnect'];
const unsername = document.forms['formConnect']['username'];
const password = document.forms['formConnect']['password'];

// ****************  Fetch and Create User ****************/
//*********************************************************/
formConnect.addEventListener('submit', async function(e)
{
    e.preventDefault();
    const payload = new FormData(this); // creation object Form.
    await fetch('./../../app/controller/connect.php', 
    {
        method: 'post',
        body: payload
    })
    .then((response) => {
        
        // 
        if(response.statusText === 'connected !')
        {
            alert(response.statusText);
            window.location = "./blog.php";
        }
        else
        {
            alert('Username ou Password Incorrecte !')
        }

    })
});
