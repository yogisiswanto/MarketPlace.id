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
            <p class='text-center'>
                <?php
                    echo br(4);
                ?>
            </p>
        </nav>

        <div class='container'>

            <div class='row'>
                    
                    <div class='col-3'></div>
                    <div class='col'>

                        <div class="card" style="max-width: 30rem;">
                            
                            <div class='card-body'>
                            
                                <h2 class="h1 mb-3 font-weight-normal text-center">
                        
                                    <small class='text-muted'>
                                        Login Akun MarketPlace
                                    </small>
                        
                                </h2>

                                <table border="0" align="center">
                                
                                    <?php
                                        echo validation_errors('<div id="notification" class="alert alert-danger alert-dismissible fade show" role="alert">', 
                                                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>');
                                        
                                        // getting value of notification inserting data
                                        $notification =  $this->session->flashdata('notification');

                                        if (isset($notification)) {
                                            
                                            $alertType = '';
                                            $message = '';

                                            // if data was inserted
                                            if($notification == 'registration-success'){

                                                $alertType = 'alert-success';
                                                $message = 'Akun berhasil didaftarkan';

                                            // when data was not inserted
                                            }else if($notification == 'warning'){

                                                $alertType = 'alert-danger';
                                                $message = 'Akun gagal didaftarkan';
                                                
                                            }elseif ($notification == 'login-fail') {
                                                
                                                $alertType = 'alert-danger';
                                                $message = 'username/password salah';
                                            }

                                            echo    '<div id="notification" class="alert '.$alertType.' alert-dismissible fade show" role="alert">
                                                            <p>'.$message.'</p>', 
                                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>';

                                        }
                                        

                                    echo form_open(site_url().'/User/User_Login', array('onsubmit' => 'return login_form_validation(this)'));
                                            echo "<tr>";                
                                                echo "<td>"; 
                                                    echo form_input(array('id'=>'user_name','name'=>'user_name', 'placeholder' => 'username', 'onchange' => 'user_name_checking', 'class' => 'form-control', 'size' => '30'));
                                                    echo "<span id='user_name_checking_respon'></span>";
                                                    echo br(1);
                                                echo "</td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                                echo "<td>"; 
                                                    echo form_password(array('id'=>'user_password','name'=>'user_password', 'placeholder' => 'Password', 'onchange' => 'user_password_checking', 'class' => 'form-control', 'size' => '30'));
                                                    echo "<span id='user_password_checking_respon'></span>";
                                                    echo br(1);
                                                echo "</td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                                echo "<td>"; echo form_submit(array('id'=>'submit','value'=>'Masuk', 'class'=>'btn  btn-primary btn-lg btn-block')); echo "</td>";
                                            echo "</tr>";
                                        echo form_close();
                                        ?>

                                        <tr>
                                            <td>
                                                <br>
                                                <p>Belum punya akun? 
                                                    <a href="<?php echo base_url();?>index.php/User/User_Registration_Form">Daftar sekarang juga</a>
                                                </p>
                                            </td>
                                        </tr>

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

        <script src="<?php echo base_url();?>/assets/javascript/login_form_validation.js"></script>
        <script src="<?php echo base_url();?>/assets/javascript/notification.js"></script>

    </body>
</html>