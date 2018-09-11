<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Market Place</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>/core/css/bootstrap.min.css">

    </head>
    <body>

        <nav class="navbar navbar-light">
            <p class='text-center'></p>
        </nav>

        <div class='container'>

            <div class='row'>
                
                <div class='col-3'></div>
                <div class='col'>

                    <div class="card" style="max-width: 30rem;">

                        <div class='card-body'>

                            <h2 class="h1 mb-3 font-weight-normal text-center">
                    
                                <small class='text-muted'>
                                    Pendaftaran Akun MarketPlace
                                </small>
                    
                            </h2>
                            
                            <table border="0" align="center">

                                <?php

                /**
                 * TODO
                 * 1. buat controller untuk user
                 * 2. bikin fungsi register
                 * 3. bikin view login
                 * 4. bikin fungsi login
                 * 5. bikin view OTP
                 * 6. bikin fungsi OTP
                 */ 
                                    echo validation_errors('<div id="notification" class="alert alert-danger alert-dismissible fade show" role="alert">', 
                                                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>');
                                                            
                                    echo form_open(site_url().'/User/User_Registration', array('onsubmit' => 'return User_Registration_Form_Validation(this)' , 'class' => 'form-signin'));
                                    echo "<tr>";
                                        echo "<td>"; 
                                            echo form_input(array('id'=>'user_full_name','name'=>'user_full_name', 'placeholder' => 'Nama Lengkap', 'onClick' => 'make_username', 'class' => 'form-control', 'size' => '30'));
                                            echo "<span id='user_full_name_respon'> </span>";                        
                                            echo br(1);
                                        echo "</td>";
                                    echo "</tr>";
                                    echo "<tr>";                
                                        echo "<td>"; 
                                            echo form_input(array('id'=>'user_name','name'=>'user_name', 'placeholder' => 'username', 'class' => 'form-control', 'size' => '30'));
                                            echo "<span id='user_name_respon'> </span>";                                                
                                            echo br(1);
                                        echo "</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>"; 
                                            echo "<div class='custom-control custom-radio custom-control-inline'>";
                                                echo form_radio(array('id'=>'user_gender_male','name'=>'user_gender', 'class' => 'custom-control-input', 'value' => 'Male', 'onClick' => 'radio_gender_male_pressed()'));
                                                echo form_label('Laki-laki','user_gender_male', array('class' => 'custom-control-label'));
                                            echo "</div>";
                                            echo "<div class='custom-control custom-radio custom-control-inline'>";
                                                echo form_radio(array('id'=>'user_gender_female','name'=>'user_gender', 'class' => 'custom-control-input', 'value' => 'Female', 'onClick' => 'radio_gender_female_pressed()'));
                                                echo form_label('Perempuan','user_gender_female', array('class' => 'custom-control-label'));
                                            echo "</div>";
                                            echo br(1);
                                            echo "<span id='user_gender_respon'> </span>";
                                            echo br(1);
                                        echo "</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>"; 
                                            echo "<div class='for-group'>";
                                                echo "<div class='input-group mb-3'>";
                                                    echo form_password(array('id'=>'user_password','name'=>'user_password', 'placeholder' => 'Password', 'onchange' => 'user_password_checking', 'class' => 'form-control', 'size' => '8'));
                                                    echo nbs(1);
                                                    echo "<div class='input-group-append'>";
                                                        echo img(base_url().'/assets/image/eye.png', False, array('onmouseover' => 'user_password_visible()', 'onmouseout' => 'user_password_invisible()', 'width' => '30px'));
                                                echo "</div>";
                                            echo "</div>";
                                            echo "<span id='user_password_checking_respon'></span>";
                                        echo "</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>"; 
                                            echo "<div class='for-group'>";
                                                echo "<div class='input-group mb-3'>";
                                                    echo form_password(array('id'=>'user_retype_password','name'=>'user_retype_password', 'placeholder' => 'Tulis Ulang Password', 'onchange' => 'user_retype_password_checking', 'class' => 'form-control', 'size' => '30')); 
                                                    echo nbs(1);
                                                    echo "<div class='input-group-append'>";
                                                        echo img(base_url().'/assets/image/eye.png', False, array('onmouseover' => 'user_retype_password_visible()', 'onmouseout' => 'user_retype_password_invisible()', 'width' => '30px'));
                                                echo "</div>";
                                            echo "</div>";
                                            echo "<span id='user_retype_password_checking_respon'> </span>";
                                        echo "</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>"; 
                                            echo form_input(array('id'=>'user_email','name'=>'user_email', 'placeholder' => 'Email', 'onchange' => 'user_email_validation()', 'class' => 'form-control', 'size' => '30'));
                                            echo "<span id='user_email_validation_respon'> </span>";
                                            echo br(1);
                                        echo "</td>";                    
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>"; 
                                            echo form_input(array('id'=>'user_phone_number','name'=>'user_phone_number', 'placeholder' => 'Nomor Handphone', 'onclick' => 'user_phone_number_validation()',  'class' => 'form-control', 'size' => '30',));
                                            echo "<span id='user_phone_number_validation_respon'> </span>";
                                            echo br(1);
                                        echo "</td>"; 
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>"; echo form_submit(array('id'=>'submit','value'=>'Daftar', 'class'=>'btn  btn-primary btn-lg btn-block')); echo "</td>";
                                    echo "</tr>";
                                    echo form_close();

                                ?>
                
                            </table>

                        <!-- card body -->
                        </div>
                    <!-- card div -->
                    </div>
                <!-- column -->
                </div>
            <!-- row -->
            </div>
        <!-- container -->
        </div>

        <script src="<?php echo base_url();?>/core/javascript/jquery-3.3.1.js"></script>
        <script src="<?php echo base_url();?>/core/js/bootstrap.min.js"></script>

        
        <script src="<?php echo base_url();?>/assets/javascript/User_Registration_Form_Validation.js"></script>
        <script src="<?php echo base_url();?>/assets/javascript/make_username.js"></script>
        <script src="<?php echo base_url();?>/assets/javascript/radio_button_gender_user_registration.js"></script>
        <script src="<?php echo base_url();?>/assets/javascript/user_password_checking.js"></script>
        <script src="<?php echo base_url();?>/assets/javascript/user_retype_password_checking.js"></script>
        <script src="<?php echo base_url();?>/assets/javascript/visibility.js"></script>
        <script src="<?php echo base_url();?>/assets/javascript/user_email_validation.js"></script>
        <!-- <script src="<?php echo base_url();?>/assets/javascript/phone_number_validation.js"></script> -->
        <script src="<?php echo base_url();?>/assets/javascript/searching_user_phone_number.js"></script>


        
    </body>
</html>
