// funtion for checking password for user_passsword
function user_password_checking(){

    // getting element from form input
    var user_password = document.getElementById('user_password'); //getting element from input text user_password
    var user_retype_password = document.getElementById('user_retype_password'); //getting element from input text user_retype_password
    var user_password_checking_respon = document.getElementById('user_password_checking_respon'); //getting element from user_password_checking_respon span
    var user_retype_password_checking_respon = document.getElementById('user_retype_password_checking_respon'); //getting element from user_retype_password_checking_respon span


    // condition when user_password is empty
    if(user_password.value.localeCompare('') == 0){
        
        user_password_checking_respon.innerHTML = "Password belum diisi"; //adding text for user_password_checking_respon span
        user_password_checking_respon.style.fontSize = '12px'; //styling user_password_checking_respon span with text size is 12px
        user_password_checking_respon.style.color = 'red'; //styling user_password_checking_respon span with text color is red
        user_password.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_password

    // condition when user_password is not empty and user_retype_password is empty
    }else if(user_password.value.localeCompare('') != 0 && user_retype_password.value.localeCompare('') == 0){

        user_password.classList.remove('is-invalid'); //removing class bootsrapt invalid for input text user_password
        user_password_checking_respon.innerHTML = ''; //removing text from user_password_checking_respon span

    //condition when user_password is equal with user_retype_password
    }else if(user_password.value.localeCompare(user_retype_password.value) == 0){

        user_password.classList.remove('is-invalid'); //removing class bootsrapt invalid for input text user_password
        user_password_checking_respon.innerHTML = ''; //removing text from user_password_checking_respon span

    //condition when user_password is not equal with user_retype_password
    }else{
        
        user_retype_password.classList.remove('is-invalid'); //removing class bootsrapt invalid for input text user_retype_password
        user_retype_password_checking_respon.innerHTML = ''; //removing text from user_retype_password_checking_respon span

        
        user_password_checking_respon.innerHTML = "Password tidak sama"; //adding text for user_password_checking_respon span
        user_password_checking_respon.style.fontSize = '12px'; //styling user_password_checking_respon span with text size is 12px
        user_password_checking_respon.style.color = 'red'; //styling user_password_checking_respon span with text color is red
        user_password.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_password
                
    }
}

//adding event listener to input text user_password when user click that
document.getElementById('user_password').addEventListener("click", user_password_checking, true);

//adding event listener to input text user_password when user change the value that
document.getElementById('user_password').addEventListener("change", user_password_checking, true);

//adding event listener to input text user_password when user change the value that
document.getElementById('user_password').addEventListener("keyup", user_password_checking, true);