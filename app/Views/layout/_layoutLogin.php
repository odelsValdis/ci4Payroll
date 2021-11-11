<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>EREKBOS</title>
	<link href="~/images/amano.png" rel="shortcut icon" type="image/x-icon" />


    <link rel="stylesheet" href="<?php echo base_url('public/assets/Lib/css/dx.common.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/assets/Lib/css/dx.softblue.compact.css')?>">
 
    <!-- DevExtreme library -->
    <script type="text/javascript" src="<?php echo base_url('public/assets/Lib/js/dx.all.js')?>"></script>


    <link href="<?php echo base_url('public/assets/material-icons/css/materialdesignicons.min.css')?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/assets/dist/css/bootstrap.min.css')?>" rel="stylesheet" />
	

	

	<link href="<?php echo base_url('public/assets/css/style.css')?>" rel="stylesheet">

    <script src='<?php echo base_url('public/assets/dist/js/bootstrap.bundle.min.js')?>'></script>




</head>


<style>
            .bg { 
                /* The image used */
                background-image: url("<?php echo base_url('public/assets/img/header-bg-2.jpg'); ?>");

                /* Full height */
                height: 100%; 

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            
        </style>
    <body class="bg-primary bg">
    <div id="layoutAuthentication">
    <?= $this->renderSection('content') ?>

        
    <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Odels 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    
    </body>






</html>