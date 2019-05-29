<?php session_start(); ?>

<?php 
    if (!isset($_SESSION['admin'])) {
       header("location: ./");
    }
    else{
        include 'connect.inc.php';
        @$client_id = $_SESSION['admin'];
    }
?>
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Mplify Bootstrap 4.1.1 Admin Template">
<meta name="author" content="ThemeMakker, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="vendor/animate-css/animate.min.css">
<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css">
<link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
<link rel="stylesheet" href="vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
<style type="text/css">
    .btn,.page-link,.nav-pills .nav-link.active{
                background-color: #28a745 !important;
                color: white !important;
            }
            .centerbutton{
                margin:0 auto !important;
                text-align: center;
            }
</style>
</head>
<body class="theme-blue">

<!-- Page Loader -->
<div class="page-loader-wrapper" style="background-color: #28a745">
    <div class="loader">
        <div class="m-t-30"><img src="images/thumbnail.png" width="48" height="48" alt="Mplify"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay" style="display: none;"></div>

<div id="wrapper">

    <nav class="navbar navbar-fixed-top text-white" style="background-color:  #28a745;color: white">
        <div class="container-fluid">

            <div class="navbar-brand" style="background-color: #28a745;color: white">
                <a href="index.html" style="color: white">
                    <!-- <img src="images/logo-icon.svg" alt="Mplify Logo" class="img-responsive logo">
                    <span class="name">mplify</span> -->
                    Registration System
                </a>
            </div>
            
            <div class="navbar-right">
                <ul class="list-unstyled clearfix mb-0">
                    <li>
                        <div class="navbar-btn btn-toggle-show">
                            <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars text-white"></i></button>
                        </div>                        
                        <!-- <a href="javascript:void(0);" class="btn-toggle-fullwidth btn-toggle-hide"><i class="fa fa-bars"></i></a> -->
                    </li>
                   
                    <li>
                        <div id="navbar-menu">
                            <ul class="nav navbar-nav">
                                <li>
                                   Welcome <?php 
                                   $fullname = $_SESSION['fullname']; 
                                   echo $fullname;?>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="leftsidebar" class="sidebar" style="background-color:  #28a745;color: white">
        <div class="sidebar-scroll">
            <nav id="leftsidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li class="active"><a href="dashboard"><i class="icon-home"></i><span>Dashboard</span></a></li>                  
                    <li><a href="users"><i class="fa fa-eye"></i>View Registered Users</a></li>
                    <li><a href="view-dealers"><i class="fa fa-eye"></i> View Registered Dealers</a></li>
                    <li><a href="branches"><i class="fa fa-eye"></i> View Branch Performance</a></li>
                    <li><a href="new-user"><i class="fa fa-plus"></i> Add New Branch Or User</a></li>
                    <li><a href="new-dealer"><i class="fa fa-plus"></i> Add New Dealer</a></li>
                    <li><a href="logout"><i class="fa fa-power-off"></i><span>Logout</span></a></li>
                </ul>
            </nav>
        </div>
    </div>

