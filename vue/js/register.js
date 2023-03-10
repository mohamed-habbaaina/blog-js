    //******************* validation inputs ************* */
    //****************************************************/ 
    const formRegister = document.forms['formRegister'];

    const email = document.forms['formRegister']['email'];
    const login = document.forms['formRegister']['username'];
    const password = document.forms['formRegister']['password'];
    const repass = document.forms['formRegister']['repass'];


    //******************* Listener ******************** */
    //****************************************************/ 

    email.addEventListener('change', validEmail);
    // login.addEventListener('change', validLogin);
    // password.addEventListener('change', validPassword);
    // repass.addEventListener('change', validRepass);


    // *********************** Email *********************/
    function validEmail(){

        // Creation of the Regexp to validate the email
        let emailRegExp = new RegExp(
          '^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,}$', 'g'
        );

       //  test the email address
        let testEmail = emailRegExp.test(email.value); // return true ou false.

        //  Get the small tag: 'nextElementSibling'
        let small = email.nextElementSibling;

        // Displaying the email validation
        if(testEmail){
            small.innerHTML = 'Adresse Email Valide';
            small.style.color = 'green';
            return true; // to use it in the form devalidation function => validForm.
        } else{
            small.innerHTML = 'Adresse Email Pas Valide (Carectère Valide: A-Z 0-9 _.-)';
            small.style.color = 'red';
            return false;
        }
}