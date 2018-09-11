// function for making automated username from user_full_name
function make_username(){

    // getting element from form input
    var user_full_name = document.getElementById('user_full_name'); //getting element from input text user_full_name
    var user_name = document.getElementById('user_name'); //getting element from input text user_name
    var user_full_name_respon = document.getElementById('user_full_name_respon'); //getting element from input text user_full_name_respon

    //condition when user_full_name is empty
    if(user_full_name.value.localeCompare('') == 0){

        user_full_name_respon.innerHTML = 'Nama Lengkap belum diisi'; //adding text for user_full_name_respon span
        user_full_name_respon.style.fontSize = '12px'; //styling user_full_name_respon span with text size is 12px
        user_full_name_respon.style.color = 'red'; //styling user_full_name_respon span with text color is red
        user_full_name.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_full_name
        user_name.value = user_full_name.value; // input value from user_full_name

    //condition when user_full_name is not empty
    }else{

        user_full_name.classList.remove('is-invalid'); //removing class bootsrapt invalid for input text user_full_name
        user_full_name_respon.innerHTML = ''; //removing text from user_full_name_respon span
        
        // input value from user_full_name with no white space and lowercase character
        user_name.value = user_full_name.value.replace(/\s/g,'').toLowerCase();

        user_name.classList.remove('is-invalid'); //removing class bootsrapt invalid for input text user_name
        user_name_respon.innerHTML = ''; //removing text from user_name_respon span
        
    }
    // console.log(user_full_name.value.replace(/\s/g,'').toLowerCase());
}

//adding event listener to input text user_full_name when user away from keyboard
document.getElementById('user_full_name').addEventListener("keyup", make_username, true);

//adding event listener to input text user_full_name when user change value that
document.getElementById('user_full_name').addEventListener("change", make_username, true);

//adding event listener to input text user_full_name when user change value that
document.getElementById('user_full_name').addEventListener("click", make_username, true);
