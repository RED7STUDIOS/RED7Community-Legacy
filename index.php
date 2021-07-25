<?php
/*
  File Name: index.php
  Original Location: /index.php
  Description: The main index file.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

if(!isset($_SESSION)){
    // Initialize the session
    session_start();
}

// Check if the user is logged in, if not then redirect him to login page
if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
header("location: home.php");
exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - <?php echo $site_name; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css?h=b282e93a33259032b42c30f5d28ab4f0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top"><?php echo $site_name; ?></a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-align-justify"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/register.php"><strong>REGISTER</strong><br></a></li>
                    <li class="nav-item"><a class="nav-link" href="/login.php">LOGIN</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="text-center text-white d-flex masthead" style="background-image:url('assets/images/header.jpg?h=1e0a2a51dfb134a58fe757975cbbf111');">
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h1 class="text-uppercase"><strong>Find new friends and play games</strong></h1>
                    <hr>
                </div>
            </div>
            <div class="col-lg-8 mx-auto">
                <p class="text-faded mb-5">Welcome to <?php echo $site_name; ?>, your number one place to find new friends and play games.</p><a class="btn btn-primary btn-xl" role="button" href="/register.php">Find Out More</a>
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/script.min.js?h=f2f8e425d817e3c0644764c37ec35af0"></script>
</body>

</html>