// getting element from form input
var user_password = document.getElementById('user_password'); //getting element from input text user_password
var user_retype_password = document.getElementById('user_retype_password'); //getting element from input text user_retype_password
    
// when mouse event is over from the image, the user_password type change into text type
function user_password_visible(){
    user_password.type = 'text';
}

// when mouse event is out from the image, the user_password type change into password type
function user_password_invisible(){
    user_password.type = 'password';
}

// when mouse event is over from the image, the user_retype_password type change into text type
function user_retype_password_visible(){
    user_retype_password.type = 'text';
}

// when mouse event is out from the image, the user_retype_password type change into password type
function user_retype_password_invisible(){
    user_retype_password.type = 'password';
}