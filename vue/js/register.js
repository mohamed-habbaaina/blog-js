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
    login.addEventListener('change', validLogin);
    password.addEventListener('change', validPassword);
    repass.addEventListener('change', validRepass);


    // *********************** Email *********************/
    //****************************************************/ 

    function validEmail()
    {

        // Creation of the Regexp to validate the email
        let emailRegExp = new RegExp
        (
          '^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,}$', 'g'
        );

       //  test the email address
        let testEmail = emailRegExp.test(email.value); // return true ou false.

        //  Get the small tag: 'nextElementSibling'
        let small = email.nextElementSibling;

        // Displaying the email validation
        if(testEmail)
        {
            small.innerHTML = 'Adresse Email Valide';
            small.style.color = 'green';
            return true; // to use it in the form devalidation function => validForm.
        } else
        {
            small.innerHTML = 'Adresse Email Pas Valide (Carectère Valide: A-Z 0-9 _.-)';
            small.style.color = 'red';
            return false;
        }
    }

    // *********************** Login *********************/
    //****************************************************/ 


    function validLogin()
    {

        // Creation of the Regexp to validate the Login.
        let loginRegExp = new RegExp
        (
            '^[a-zA-Z\-]+$'
        )

        let testLogin = loginRegExp.test(login.value); // @return true , fals

        // Display messag
        let small = login.nextElementSibling;
        
        // Login minimum 3 characters.
        if(login.value.length < 3)
        {
            small.innerHTML = 'Login trop court, minimum 3 lettre !';
            small.style.color = 'red';
        }
        else
        {
            if(testLogin)
            {
                small.innerHTML = 'Login Valide';
                small.style.color = 'green';
                return true; // to use it in the form devalidation function => validForm.
            }
            else
            {
                small.innerHTML = 'Login Invalid, [a-z] 0-9 (.-_) !';
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