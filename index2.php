<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    function __autoload($class)
    {
      require_once "classes/$class.php";
    }

    //$_GET['try'] = 'notdensity';
    unset($_GET['try']);

    include 'includes/index/density-calculator-include.php';


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
    <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
    <?php
    include 'header-map.php';
    //include 'include-head.php';
    
    ?>
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;} .font-color {color: black;}</style>
    <script type="application/javascript">

    </script>
    <style type="text/css">
        .slider-holder
        {
            width: 800px;
            height: 400px;
            background-color: yellow;
            margin-left: auto;
            margin-right: auto;
            margin-top: 0px;
            text-align: center;
            overflow: hidden;
        }
       
        .image-holder
        {
            width: 2400px;
            background-color: red;
            height: 400px;
            clear: both;
            position: relative;
           
            -webkit-transition: left 2s;
            -moz-transition: left 2s;
            -o-transition: left 2s;
            transition: left 2s;
        }
       
        .slider-image
        {
            float: left;
            margin: 0px;
            padding: 0px;
            position: relative;
        }
       
        #slider-image-1:target ~ .image-holder
        {
            left: 0px;
        }
       
        #slider-image-2:target ~ .image-holder
        {
            left: -800px;
        }
       
        #slider-image-3:target ~ .image-holder
        {
            left: -1600px;
        }
       
        .button-holder
        {
            position: relative;
            top: -20px;
        }
       
        .slider-change
        {
            display: inline-block;
            height: 10px;
            width: 10px;
            border-radius: 5px;
            background-color: brown;
        }
        .noHash{
            cursor: pointer;
        }
        .registerColor{
            color:white;
        }
        .registerColor:hover {
            color:black;
            transition: all 0.5s ease-in;
        }
        
        .textMargin {
            
        }
        
        @media screen and (max-width: 1200px){
            .textMargin{
                margin-left:-50%;
            }
        }
    </style>
  </head>
  <body>
    <?php include 'includes/ie-checker.php'; ?>
    <?php include 'includes/preloader.php'; ?>
        <div class="page">
          <!-- ADVERTISEMENT PAGE -->
          <?php //include 'includes/index/ad-page.php'; ?>
          <!-- NAVIGATION BAR -->
          <?php include 'includes/navbar-main.php'; ?>
          <!-- COMPANY DESCRIPTION-->
          <?php include 'includes/index/header-1.php'; ?>
          <!-- SEARCH CHEMICALS -->
          <?php //include 'includes/index/search-chemicals.php'; ?>
          <?php include 'includes/index/about-chempo.php'; ?>
          <!-- DENSITY CALCULATOR -->
          <?php include 'includes/index/density-calculator.php'; ?>
          <!-- BLOG PAGE -->
          <?php include 'includes/index/blog.php'; ?>
            <!-- VISITOR STATISTICS -->
                 <!-- <section class="section section-md bg-default" style="margin-top:-80px; z-index:999;">-->
        <!--<div class="container" style="z-index:999;">
          <h4 style="z-index:999;">Visitor Statistics</h4>-->

            <?php
            
            //include 'maps-include.php';
            
            ?>
            
            
       <!-- </div>
      </section>-->
          <!-- LOGIN PAGE -->
          <?php //include 'includes/index/login-page.php'; ?>
          <!-- Page Footer-->
          <?php include 'includes/index/footer.php'; ?>
        </div>
      
      
    <div class="snackbars" id="form-output-global"></div>
    <script src="index/js/core.min.js"></script>
    <script src="index/js/script.js"></script>
    <script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
    <script>
    function handleClickLink(event) {
      const block = event.target.dataset.block;
      console.log(block)
      document.getElementById(block).scrollIntoView({ behavior: 'smooth'});
    }

    document.querySelectorAll('.noHash').forEach((elem) => {
      elem.addEventListener('click', handleClickLink);
    });  
      
    </script>
    <script>
        document.getElementById("defaultOpen").click();
        
        function openCity(evt, cityName) {
          // Declare all variables
          var i, tabcontent, tablinks;

          // Get all elements with class="tabcontent" and hide them
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }

          // Get all elements with class="tablinks" and remove the class "active"
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }

          // Show the current tab, and add an "active" class to the button that opened the tab
          document.getElementById(cityName).style.display = "block";
          evt.currentTarget.className += " active";
        }
        
        function aboutChempo(){
            var jumpToAbout = document.getElementById("aboutChemPo");
            jumpToAbout.scrollIntoView;
        }
        
        
    </script>
  </body>
</html>