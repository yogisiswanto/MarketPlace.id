// getting element from form input
var user_gender_male = document.getElementById("user_gender_male");
var user_gender_female = document.getElementById("user_gender_female");
var user_gender_respon = document.getElementById('user_gender_respon'); //getting element from input text user_gender_respon

// function for disbaling user_gender_female when user_gender_male is clicked
function radio_gender_male_pressed() {

        user_gender_male.classList.remove('is-invalid'); //removing class bootsrapt invalid for radio button user_gender_male
        user_gender_female.classList.remove('is-invalid'); //removing class bootsrapt invalid for radio button user_gender_female
        user_gender_respon.innerHTML = ''; //removing text from user_gender_respon span
 
    document.getElementById("user_gender_female").checked = false;
}

// function for disbaling user_gender_male when user_gender_female is clicked
function radio_gender_female_pressed() {
 
    user_gender_male.classList.remove('is-invalid'); //removing class bootsrapt invalid for radio button user_gender_male
    user_gender_female.classList.remove('is-invalid'); //removing class bootsrapt invalid for radio button user_gender_female
    user_gender_respon.innerHTML = ''; //removing text from user_gender_respon span

    document.getElementById("user_gender_male").checked = false;
}