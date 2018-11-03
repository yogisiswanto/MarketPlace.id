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
                    echo br(9);
                ?>
            </p>
        </nav>

        <div class='container'>

            <div class='row'>
                    
                    <div class='col-1'></div>
                    <div class='col'>
                        
                        <center>
                            <h1 class='text-primary'>Anda telah meminta kode otentikasi sebanyak 3 kali.</h1>
                            
                            <?php
                                echo br(5);
                            ?>
                            
                            <a href="<?php echo base_url();?>index.php/User/logout">
                                <button type="button" class="btn btn-secondary btn-lg">Keluar</button>
                            </a>
                        </center>
                        
                    <!-- column -->
                    </div>
                <!-- row -->
                </div>
            <!-- container -->
            </div>
        

        <script src="<?php echo base_url();?>/core/javascript/jquery-3.3.1.js"></script>
        <script src="<?php echo base_url();?>/core/js/bootstrap.min.js"></script>


    </body>
</html>