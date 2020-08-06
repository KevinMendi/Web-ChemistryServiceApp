<?php
    function __autoload($class)
    {
      require_once "classes/$class.php";
    }
?>


<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>Home :: Chemistry Portal by Rimpido</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900">
    <link rel="stylesheet" href="css/bootstrap-home.css">
    <link rel="stylesheet" href="css/fonts-home.css">
    <link rel="stylesheet" href="css/style-home.css">
    <link rel="stylesheet" href="css/slider-home.css">
     <link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
      <link  rel="stylesheet" href="assets/css/style.min.css">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;} .font-color {color: black;}</style>
    <script type="application/javascript">

    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
          <?php include 'includes/search-results/search-results-header.php'; ?>
            <center>
                <br>
            <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8"><?php include 'includes/search-results/search-results.php'; ?></div>
            <div class="col-md-2"></div>
            </div>
            </center>
            
          <!-- Page Footer-->
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
          <?php include 'includes/index/footer.php'; ?>
        </div>
      
      
    <div class="snackbars" id="form-output-global"></div>
    <script src="index/js/core.min.js"></script>
    <script src="index/js/script.js"></script>
    
      
    <!-- JQUERY DATA TABLE -->
      <!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<!-- Jquery DataTable Plugin Js --> 
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
      
  </body>
</html>