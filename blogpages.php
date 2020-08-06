<?php
//session_start();
function __autoload($class)
{
  require_once "classes/$class.php";
}


include 'includes/chem-info/chem-info-php.php';
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>Blog Pages :: Chemistry Portal by Rimpido</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900">
    <link rel="stylesheet" href="css/bootstrap-home.css">
    <link rel="stylesheet" href="css/fonts-home.css">
    <link rel="stylesheet" href="css/style-home.css">
    <link rel="stylesheet" href="css/slider-home.css">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;} .font-color {color: black;}</style>
    <script type="application/javascript">

    </script>
    <style type="text/css">
    </style>
  </head>
  <body>
    <?php include 'includes/ie-checker.php'; ?>
    <?php include 'includes/preloader.php'; ?>
        <div class="page" id="homePage">
          <!-- ADVERTISEMENT PAGE -->
          <?php include 'includes/index/ad-page.php'; ?>
          <!-- NAVIGATION BAR -->
          <?php //include 'includes/navbar-main.php'; ?>
          <!-- SEARCH RESULTS -->
          <?php include 'includes/blogpages/blogpages-header.php'; ?>
            <center>
            <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8"><?php include 'includes/blogpages/blogpages.php'; ?></div>
            <div class="col-md-2"></div>
            </div>
            </center>
            
          <!-- Page Footer-->
          <?php include 'includes/index/footer.php'; ?>
        </div>
      
      
    <div class="snackbars" id="form-output-global"></div>
    <script src="index/js/core.min.js"></script>
    <script src="index/js/script.js"></script>
      
  </body>
</html>