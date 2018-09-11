function User_Registration_Form_Validation(){

    // getting element from form input
    var user_full_name = document.getElementById('user_full_name'); //getting element from input text user_full_name
    var user_name = document.getElementById('user_name'); //getting element from input text user_name
    var user_gender_male = document.getElementById("user_gender_male");
    var user_gender_female = document.getElementById("user_gender_female");
    var user_password = document.getElementById('user_password'); //getting element from input text user_password
    var user_retype_password = document.getElementById('user_retype_password'); //getting element from input text user_retype_password
    var user_email = document.getElementById('user_email'); //getting element from input text user_email
    var user_phone_number = document.getElementById('user_phone_number'); //getting element from input text user_phone_number
    
    var user_full_name_respon = document.getElementById('user_full_name_respon'); //getting element from input text user_full_name_respon
    var user_name_respon = document.getElementById('user_name_respon'); //getting element from input text user_name_respon
    var user_gender_respon = document.getElementById('user_gender_respon'); //getting element from input text user_gender_respon
    var user_password_checking_respon = document.getElementById('user_password_checking_respon'); //getting element from user_password_checking_respon span
    var user_retype_password_checking_respon = document.getElementById('user_retype_password_checking_respon'); //getting element from user_retype_password_checking_respon span
    var user_email_validation_respon = document.getElementById('user_email_validation_respon'); //getting element from user_email_validation_respon span
    var user_phone_number_validation_respon = document.getElementById('user_phone_number_validation_respon'); //getting element from user_user_phone_number_validation_respon span

    var wrongCount = 0;

    //condition when user_full_name is empty
    if(user_full_name.value.localeCompare('') == 0){

        user_full_name_respon.innerHTML = 'Nama Lengkap belum diisi'; //adding text for user_full_name_respon span
        user_full_name_respon.style.fontSize = '12px'; //styling user_full_name_respon span with text size is 12px
        user_full_name_respon.style.color = 'red'; //styling user_full_name_respon span with text color is red
        user_full_name.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_full_name

        wrongCount++;

    }

    //condition when user_name is empty
    if(user_name.value.localeCompare('') == 0){
        
        user_name_respon.innerHTML = 'Username belum diisi'; //adding text for user_name_respon span
        user_name_respon.style.fontSize = '12px'; //styling user_name_respon span with text size is 12px
        user_name_respon.style.color = 'red'; //styling user_name_respon span with text color is red
        user_name.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_name

        wrongCount++;
    }

    //condition when user_gender_male and user_gender_female is not checked
    if((user_gender_male.checked == false) && (user_gender_female.checked == false)){

        user_gender_respon.innerHTML = 'Jenis Kelamin belum diisi'; //adding text for user_gender_respon span
        user_gender_respon.style.fontSize = '12px'; //styling user_gender_respon span with text size is 12px
        user_gender_respon.style.color = 'red'; //styling user_gender_respon span with text color is red
        user_gender_male.classList.add('is-invalid'); //adding class bootsrapt invalid for radio button user_gender_male
        user_gender_female.classList.add('is-invalid'); //adding class bootsrapt invalid for radio button user_gender_female

        wrongCount++;
    
    }

    // condition when user_password is empty
    if(user_password.value.localeCompare('') == 0){
        
        user_password_checking_respon.innerHTML = "Password belum diisi"; //adding text for user_password_checking_respon span
        user_password_checking_respon.style.fontSize = '12px'; //styling user_password_checking_respon span with text size is 12px
        user_password_checking_respon.style.color = 'red'; //styling user_password_checking_respon span with text color is red
        user_password.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_password

        wrongCount++;
    }

    // condition when user_retype_password is empty
    if(user_retype_password.value.localeCompare('') == 0){
        
        user_retype_password_checking_respon.innerHTML = "Password belum diisi"; //adding text for user_retype_password_checking_respon span
        user_retype_password_checking_respon.style.fontSize = '12px'; //styling user_retype_password_checking_respon span with text size is 12px
        user_retype_password_checking_respon.style.color = 'red'; //styling user_retype_password_checking_respon span with text color is red
        user_retype_password.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_retype_password

        wrongCount++;
    }

    // condition when user_email is empty
    if(user_email.value.localeCompare('') == 0){

        user_email_validation_respon.innerHTML = "Email belum diisi"; //adding text for user_email_validation_respon span
        user_email_validation_respon.style.fontSize = '12px'; //styling user_email_validation_respon span with text size is 12px
        user_email_validation_respon.style.color = 'red'; //styling user_email_validation_respon span with text color is red
        user_email.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_email

        wrongCount++;
    }

    // condition when user_phone_number is empty
    if(user_phone_number.value.localeCompare('') == 0){

        user_phone_number_validation_respon.innerHTML = "Nomor Handphone belum diisi"; //adding text for user_phone_number_validation_respon span
        user_phone_number_validation_respon.style.fontSize = '12px'; //styling user_phone_number_validation_respon span with text size is 12px
        user_phone_number_validation_respon.style.color = 'red'; //styling user_phone_number_validation_respon span with text color is red
        user_phone_number.classList.add('is-invalid'); //adding class bootsrapt invalid for input text user_phone_number
    
        wrongCount++;
    }

    if(wrongCount > 0){

        return false;
    
    }else{

        return true;

    }

    
    
    


}