<!DOCTYPE html>
<html lang="en">  
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>pescao</title>
	<link rel="icon" href="<?php echo base_url('assets/img/Northwestern_Mindanao_State_College_of_Science_and_Technology.png'); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- animate CSS -->
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/animate.css'); ?> ">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/owl.carousel.min.css'); ?> ">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/all.css'); ?> ">
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/nice-select.css'); ?> ">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/flaticon.css'); ?> ">
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/themify-icons.css'); ?>">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/magnific-popup.css'); ?> ">
    <!-- swiper CSS -->
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/slick.css'); ?> ">
    <!-- swiper CSS -->
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/price_rangs.css'); ?> ">
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/kronos.css'); ?> ">
    <!-- style CSS -->
    <link rel="stylesheet" href=" <?php echo base_url('assets/css/style.css'); ?> ">
	<link rel="stylesheet" href=" <?php echo base_url('assets/css/custom.css'); ?> ">
	<link rel="stylesheet" href=" <?php echo base_url('assets/css/daterangepicker.css'); ?> ">
	
	<link rel="stylesheet" href=" <?php echo base_url('assets/css/image-uploader.min.css'); ?> ">
	
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
          rel="stylesheet">

	<script src=" <?php echo base_url('assets/mdb/js/jquery.min.js'); ?> "></script>
	<script src=" <?php echo base_url('assets/mdb/js/jquery-3.4.1.min.js'); ?> "></script>
	<script src=" <?php echo base_url('assets/mdb/js/mdb.min.js'); ?> "></script>
	
</head>


<body class="bg-white">
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-11">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="<?php echo $admin_id  ?   base_url("admin/dashboard/") : base_url('/')  ; ?>"> PESCAO </a>
						 <img style=" max-width: 100%; width: auto; height: 61px;" id="image" src=" <?php echo base_url('assets/img/Northwestern_Mindanao_State_College_of_Science_and_Technology.png'); ?> " alt="logo" />
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
							<?php if( $admin_id ) : ?>
								<ul class="navbar-nav">
									<li class="nav-item">
										<!--<a class="nav-link" href="<?php  //echo ( $admin_id && $admin_id == 1 ? base_url('admin/dashboard/') : base_url('/') ) ; ?>">Home</a>-->
										<a class="nav-link" href="<?php  echo base_url("admin/dashboard/"); ?>">Home</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="<?php echo base_url("/checkout/cart")?>">Item Checkout</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="<?php echo base_url("/admin/rentors")?>">Rented Items</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="<?php echo base_url("/admin/borrowers")?>">Borrowers</a>
									</li>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3"
											role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											reports
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
											<a class="dropdown-item" href="<?php echo base_url('/admin/rentorReport'); ?>">Rentor History</a>
											<a class="dropdown-item" href="<?php echo base_url('/admin/borrowerReport'); ?>">Borrower History</a>
											<a class="dropdown-item" href="<?php echo base_url('/admin/item_lost'); ?>">Item Inventory Report</a>
										</div>
									</li>
									<li class="nav-item">
										<?php echo (  $admin_id == 1 && $admin_id ? '<a class="nav-link" href="/pescao/admin/users/">Admin Users</a>': '' ) ?>
									</li>
									<li class="nav-item">
										<?php echo (  $admin_id == 1 && $admin_id ? '<a class="nav-link" href="/pescao/admin/guest/">Users</a>': '' ) ?>
									</li>

								</ul>
							<?php endif; ?>
                        </div>
                        <div class="hearer_icon d-flex">
									<div class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3"
											role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="ti-user"></i>
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
											<?php echo(  $admin_id ? '<a class="dropdown-item" href='. base_url("admin/logout") .'>Logout</a>' : '<a class="dropdown-item" href='. base_url("admin/login") .'>Login</a>' ) ?>
											<a class="dropdown-item" href="/pescao/admin/profile/">My Profile</a>
											<!--<a class="dropdown-item" href="<?php echo base_url("/admin/rentors")?>">Rentors</a> -->
										</div>
									</div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->