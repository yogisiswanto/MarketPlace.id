// funtion for validate email for user_email
function user_email_validation(){

    // getting element from form input
    var user_email = document.getElementById('user_email'); //getting element from input text user_email
    var user_email_validation_respon = document.getElementById('user_email_validation_respon'); //getting element from user_email_validation_respon span

    //regular expression for checking email
    var regex_email = /\S+@\S+\.\S+/;

    // condition when user_email is empty
    if(user_email.value.localeCompare('') == 0){

        user_email_validation_respon.innerHTML = "Email belum diisi"; //adding text for user_email_validation_respon span
        user_email_validation_respon.style.fontSize = '12px'; //styling user_email_validation_respon span with text size is 12px
        user_email_validation_respon.style.color = 'red'; //styling user_email_validation_respon span with text color is red
        user_email.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_email

    // condition when user_email is equal with regular expression
    }else if (regex_email.test(user_email.value)){

        user_email.classList.remove('is-invalid'); //removing class bootsrapt invalid for input text user_email
        user_email_validation_respon.innerHTML = ''; //removing text from user_email_validation_respon span
        
    //condition when user_email is not equal with regular expression
    }else{

        user_email_validation_respon.innerHTML = "Format email salah"; //adding text for user_email_validation_respon span
        user_email_validation_respon.style.fontSize = '12px'; //styling user_email_validation_respon span with text size is 12px
        user_email_validation_respon.style.color = 'red'; //styling user_email_validation_respon span with text color is red
        user_email.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_email
        
    }
}

//adding event listener to input text user_email when user click that
document.getElementById('user_email').addEventListener("click", user_email_validation,true);

//adding event listener to input text user_email when user change the value that
document.getElementById('user_email').addEventListener("change", user_email_validation, true);

//adding event listener to input text user_email when user change the value that
document.getElementById('user_email').addEventListener("keyup", user_email_validation, true);
