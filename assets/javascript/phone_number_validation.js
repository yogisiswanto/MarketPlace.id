// funtion for validate phone number for user_phone_number
function user_phone_number_validation(){

    // getting element from form input
    var user_phone_number = document.getElementById('user_phone_number'); //getting element from input text user_phone_number
    var user_phone_number_validation_respon = document.getElementById('user_phone_number_validation_respon'); //getting element from user_user_phone_number_validation_respon span

    //regular expression for checking phone number
    var regex_phone_number = /(\+62 ((\d{3}([ -]\d{3,})([- ]\d{4,})?)|(\d+)))|(\(\d+\) \d+)|\d{3}( \d+)+|(\d+[ -]\d+)|\d+/gm;
    
    // condition when user_phone_number is empty
    if(user_phone_number.value.localeCompare('') == 0){

        user_phone_number_validation_respon.innerHTML = "Nomor Handphone belum diisi"; //adding text for user_phone_number_validation_respon span
        user_phone_number_validation_respon.style.fontSize = '12px'; //styling user_phone_number_validation_respon span with text size is 12px
        user_phone_number_validation_respon.style.color = 'red'; //styling user_phone_number_validation_respon span with text color is red
        user_phone_number.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_phone_number
    
        // condition when user_phone_number is equal with regular expression
    }else if (regex_phone_number.test(user_phone_number.value)){
        
        user_phone_number.classList.remove('is-invalid'); //removing class bootsrapt invalid for input text user_phone_number
        user_phone_number_validation_respon.innerHTML = ''; //removing text from user_phone_number_validation_respon span
        
    //condition when user_phone_number is not equal with regular expression
    }else{

        user_phone_number_validation_respon.innerHTML = "Hanya masukan angka saja"; //adding text for user_phone_number_validation_respon span
        user_phone_number_validation_respon.style.fontSize = '12px'; //styling user_phone_number_validation_respon span with text size is 12px
        user_phone_number_validation_respon.style.color = 'red'; //styling user_phone_number_validation_respon span with text color is red
        user_phone_number.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_phone_number

    }
}

//adding event listener to input text user_phone_number when user click that
document.getElementById('user_phone_number').addEventListener("click", user_phone_number_validation,true);

//adding event listener to input text user_phone_number when user change the value that
// document.getElementById('user_phone_number').addEventListener("change", user_phone_number_validation, true);


