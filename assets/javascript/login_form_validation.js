/** Section for getting element from input text */
var user_name = document.getElementById('user_name'); //getting element from input text user_name
var user_password = document.getElementById('user_password'); //getting element from input text user_password
var user_name_checking_respon = document.getElementById('user_name_checking_respon'); //getting element from input text user_name_checking_respon
var user_password_checking_respon = document.getElementById('user_password_checking_respon'); //getting element from input text user_password_checking_respon


/** function for checking user_name */
function user_name_checking(){

    //condition when user_name is empty
    if(user_name.value.localeCompare('') == 0){

        user_name_checking_respon.innerHTML = 'Username belum diisi'; //adding text for user_name_checking_respon span
        user_name_checking_respon.style.fontSize = '12px'; //styling user_name_checking_respon span with text size is 12px
        user_name_checking_respon.style.color = 'red'; //styling user_name_checking_respon span with text color is red
        user_name.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_name
        
    //condition when user_name is not empty
    }else{

        user_name.classList.remove('is-invalid'); //removing class bootsrapt invalid for input text user_name
        user_name_checking_respon.innerHTML = ''; //removing text from user_name_checking_respon span

    }
}

/** function for checking user_password */
function user_password_checking(){

    //condition when user_password is empty
    if(user_password.value.localeCompare('') == 0){

        user_password_checking_respon.innerHTML = 'Password belum diisi'; //adding text for user_password_checking_respon span
        user_password_checking_respon.style.fontSize = '12px'; //styling user_password_checking_respon span with text size is 12px
        user_password_checking_respon.style.color = 'red'; //styling user_password_checking_respon span with text color is red
        user_password.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_password
        
    //condition when user_password is not empty
    }else{

        user_password.classList.remove('is-invalid'); //removing class bootsrapt invalid for input text user_password
        user_password_checking_respon.innerHTML = ''; //removing text from user_name_checking_respon span

    }
}

/**function for checking user_name and user_password after clicking masuk button */
function login_form_validation(){

    
    if((user_name.value.localeCompare('') == 0) || (user_password.value.localeCompare('') == 0)){
        
        user_name_checking();
        user_password_checking();
        
        return false;
        
    }else{

        return true;
    }
}

/**Event Listener for checking user_name */

//adding event listener to input text user_name when user click the value that
document.getElementById('user_name').addEventListener("click", user_name_checking, true);

//adding event listener to input text user_name when user change value that
document.getElementById('user_name').addEventListener("change", user_name_checking, true);

//adding event listener to input text user_name when user change value that
document.getElementById('user_name').addEventListener("keyup", user_name_checking, true);


/**Event Listener for checking user_password */

//adding event listener to input text user_password when user click the value that
document.getElementById('user_password').addEventListener("click", user_password_checking, true);

//adding event listener to input text user_password when user change value that
document.getElementById('user_password').addEventListener("change", user_password_checking, true);

//adding event listener to input text user_password when user change value that
document.getElementById('user_password').addEventListener("keyup", user_password_checking, true);