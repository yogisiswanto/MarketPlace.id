/** Section for getting element from input text */
var activation_code = document.getElementById('activation_code'); //getting element from input text activation_code
var activation_code_checking_respon = document.getElementById('activation_code_checking_respon'); //getting element from input text activation_code_checking_respon


/** function for checking user_name */
function activation_code_checking(){

    //condition when activation_code is empty
    if(activation_code.value.localeCompare('') == 0){

        activation_code_checking_respon.innerHTML = 'Kode Aktivasi belum diisi'; //adding text for activation_code_checking_respon span
        activation_code_checking_respon.style.fontSize = '12px'; //styling activation_code_checking_respon span with text size is 12px
        activation_code_checking_respon.style.color = 'red'; //styling activation_code_checking_respon span with text color is red
        activation_code.classList.add('is-invalid'); //adding class bootsrapt invalid for input text activation_code
        
    //condition when user_name is not empty
    }else{

        activation_code.classList.remove('is-invalid'); //removing class bootsrapt invalid for input text activation_code
        activation_code_checking_respon.innerHTML = ''; //removing text from activation_code_checking_respon span

    }
}

/**function for checking activation_code after clicking masuk button */
function activation_form_validation(){

    
    if(activation_code.value.localeCompare('') == 0) {
        
        activation_code_checking();
        return false;
        
    }else{

        return true;
    }
}

/**Event Listener for checking user_name */

//adding event listener to input text user_name when user click the value that
document.getElementById('activation_code').addEventListener("click", activation_code_checking, true);

//adding event listener to input text user_name when user change value that
document.getElementById('activation_code').addEventListener("change", activation_code_checking, true);
