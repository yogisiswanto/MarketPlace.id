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
    <body  onload="timer()">

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
                                        Aktivasi Akun MarketPlace
                                    </small>
                        
                                </h2>

                                <table border="0" align="center">
                                
                                    <?php

                                         echo validation_errors('<div id="notification" class="alert alert-danger alert-dismissible fade show" role="alert">', 
                                                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>');

                                        // getting value of notification login and activation fail
                                        $notification =  $this->session->flashdata('notification');

                                        if (isset($notification)) {
                                            
                                            $alertType = '';
                                            $message = '';

                                            // if data was inserted
                                            if($notification == 'login-success'){

                                                $alertType = 'alert-success';
                                                $message = 'Anda berhasil masuk. Silahkan Masukan kode otentikasi yang sudah dikirimkan melalui layanan SMS';

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
                                     
                                        echo form_open(site_url().'/User/User_Activation', array('onsubmit' => 'return activation_form_validation(this)'));
                                            echo "<tr>";                
                                                echo "<td>"; 
                                                    echo form_input(array('id'=>'activation_code','name'=>'activation_code', 'placeholder' => 'Kode Aktivasi', 'onchange' => 'user_name_checking', 'class' => 'form-control', 'size' => '30'));
                                                    echo "<span id='activation_code_checking_respon'></span>";
                                                    echo br(1);
                                                echo "</td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                                echo "<td>"; echo form_submit(array('id'=>'submit', 'value'=>'Aktivasi', 'class'=>'btn  btn-primary btn-lg btn-block')); echo "</td>";
                                            echo "</tr>";
                                        echo form_close();
                                    ?>

                                            <tr>
                                                <td>
                                                    <br>
                                                    <p id="timer" class="text-danger">
                                                    <div id="resend">
                                                        <a href="<?php echo base_url();?>index.php/User/User_Activation_Form">Kirim ulang kode otentikasi</a>
                                                    </div>
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
        
        <script src="<?php echo base_url();?>/assets/javascript/activation_form_validation.js"></script>
        <script src="<?php echo base_url();?>/assets/javascript/notification.js"></script>
        <script src="<?php echo base_url();?>/assets/javascript/timer.js"></script>


    </body>
</html>