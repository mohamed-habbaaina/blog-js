//******************* validation inputs ************* */
//****************************************************/ 
const formProfil = document.forms['formProfil'];

const username = document.forms['formProfil']['username'];
const password = document.forms['formProfil']['password'];
const repass = document.forms['formProfil']['repass'];


//******************* Listener ***********************/
//****************************************************/ 

username.addEventListener('change', validusername);
password.addEventListener('change', validPassword);
repass.addEventListener('change', validRepass);

// *********************** username ******************/
//****************************************************/ 
function validusername()
{
    // Creation of the Regexp to validate the username.
    let usernameRegExp = new RegExp
    (
        '^[a-zA-Z0-9\-_]+$'
    )
    let testusername = usernameRegExp.test(username.value); // @return true , fals
    // Display messag
    let small = username.nextElementSibling;
    
    // username minimum 4 characters.
    if(username.value.length < 4)
    {
        small.innerHTML = 'username trop court, minimum 4 lettre !';
        small.style.color = 'red';
    }
    else
    {
        if(testusername)
        {
            small.innerHTML = 'username Valide';
            small.style.color = 'green';
            return true; // to use it in the form devalidation function => validForm.
        }
        else
        {
            small.innerHTML = 'username Invalid, [a-z] 0-9 (.-_) !';
            small.style.color = 'red';
        return false;
        }
    }
}
// *********************** Password ********************/
// *****************************************************/ 
function validPassword()
{
    let messg;
    let valide = false;
    if(password.value.length < 4){
        messg = 'Password trop court, Minimum 4 caractères !'
    }
    else if(!/[A-Z]/.test(password.value))   // Check Upper case.
    {
        messg = 'Minimum 1 Majuscule !';
    }
    else if (!/[a-z]/.test(password.value))
    {
        messg = 'Minimum 1 Minuscule !';    // Check Lower case.
    }
    else if(!/[0-9]/.test(password.value))
    {
        messg = 'Minimum 1 Chiffre !';  // Check Number.
    }
    else{
        messg = 'Le Password est Valide';
        valide = true;
    }
    const small = password.nextElementSibling;
    if(valide){
        small.innerHTML = 'Password Valide';
        small.style.color = 'green';
        return true;
    }
    else{
        small.innerHTML = messg;
        small.style.color = 'red';
        return false;
    }
}
//****************** Confermation Password ***************/
// *******************************************************/ 
function validRepass(){
    const small = repass.nextElementSibling;
    if(repass.value === password.value){
        small.innerHTML = 'Confermation Password Valide';
        small.style.color = 'green';
        return true;
    }
    else{
        small.innerHTML = 'Veuillez entrer le même Password !';
        small.style.color = 'red';
        return false;
    }
}
//******************  Validation  ********************$$**/
// *******************************************************/ 
/**
 * 
 * @returns true if inputs valide
 */
function validForm() {
    if(validusername() && validPassword() && validRepass()){
        return true;
    }
    else{
        return false;
    }
}
// ****************  Fetch and change Profil **************/
//*********************************************************/
formProfil.addEventListener('submit', function(e)
{
    e.preventDefault();
    const payload = new FormData(this); // creation object Form.
    fetch('./../../app/controller/profil.php', 
    {
        method: 'POST',
        // headers: {
        //     'Accept': 'application/json',
        //     'Content-Type': 'application/json'
        //   },
        body: payload
    })
    .then((response) => {
    
        if(validForm())
        {
            //  Displaying message if user is created.
            if(response.status === 201)
            {
                alert('Profil Modifier !');
                window.location = "./blog.php";
            }
            else
            {
                alert('Le Username n\'est pas disponible, Veillez le changé !');
            }
        }
        else
        {
            alert('Données Invalides !')
        }
    })           
})