<!DOCTYPE html>
<html>
     <head>
    <title>E-REKBOS</title>
    <link rel="icon" type="image/png" href="<?php echo base_url("public/assets/img/sulawesi_tengah.png"); ?>"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.10.1/polyfill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/3.8.0/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>


    <script type="text/javascript" src="<?php echo base_url('public/assets/js/jquery.min.js')?>"></script>
   
     <!-- DevExtreme themes -->
       <link rel="stylesheet" href="<?php echo base_url('public/assets/Lib/css/dx.common.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/assets/Lib/css/dx.carmine.compact.css')?>">
 
    <!-- DevExtreme library -->
    <script type="text/javascript" src="<?php echo base_url('public/assets/Lib/js/dx.all.js')?>"></script>
   
    <link href="<?php echo base_url('public/assets/css/style.css')?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/assets/material-icons/css/materialdesignicons.min.css')?>" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
 
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light shadow">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">
            <img src="<?php echo base_url('public/assets/img/logo-bos.png')?>" width="30" height="30" class="d-inline-block align-text-top">    
            E-REKBOS</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
               
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                              <li><a class="dropdown-item" href="<?php echo base_url('login/logout')?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
				<div class="sb-sidenav-menu">
					<div class="nav">

					
						<div class="sb-sidenav-menu-heading"> </div>
                        <?= $this->include('layout/_sidebar') ?>

							

					</div>

				</div>
				<div class="sb-sidenav-footer">
					<div class="small">Logged in as:</div>
					<?= session()->get('userName') ?>
				</div>
			</nav>

		</div>



		<div id="layoutSidenav_content">
			<main>
				<div class="container-fluid px-4">
					<div class="row"></div>
                    <?= $this->renderSection('content') ?>

				</div>


			</main>
			<footer class="py-4 bg-light mt-auto">

				<div class="container-fluid px-4">
					
					<div class="d-flex align-items-center justify-content-between small">
						<img src="<?php echo base_url('public/assets/img/sulawesi_tengah.png')?>" alt="Odels" height="25" />
						<div class="text-muted">Copyright &copy; <a href="#">Odels 2021</a></div>
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
    <script src='<?php echo base_url('public/assets/dist/js/bootstrap.bundle.min.js')?>'></script>
    <script src='<?php echo base_url('public/assets/js/scripts.js')?>'></script>
   
</html>