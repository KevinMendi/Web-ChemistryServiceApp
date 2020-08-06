<?php
function __autoload($class)
{
    require_once "classes/$class.php";
}

include 'includes/chem-info/chem-info-php.php';
?>
<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Chemical Information :: Chemistry Portal by rimpido</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Light Gallery Plugin Css -->
<link rel="stylesheet" href="assets/plugins/light-gallery/css/lightgallery.css">
<link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-blush">

<!-- Page Loader -->
<!--<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/loader.svg" width="48" height="48" alt="Aero"></div>
        <p>Please wait...</p>
    </div>
</div>-->

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<section class="content" style="margin-left: auto; margin-right: auto;">
    <div class="body_scroll" style="padding-right: 20%; padding-left: 20%">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>Chemical Information</h2>
                  <!--  <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item active">Pages</li>
                        <li class="breadcrumb-item active">Stater Page</li>
                    </ul>-->
                  
                </div>

            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    
                    
                        <div class="card mcard_3">
                        <div class="body">
                            <div class="row">
                                <div class="col-md-6">
                                <h4 class="m-t-10">
                                <?php echo $result['begin_of_pname']; 
                                ?>
                                </h4>
                                </div>
                                <div class="col-md-6">
                                <h4 class="m-t-10">
                               <a  class="btn btn-sm" target="_blank" href="print-label-guest.php?read=<?php echo $result['chemical_header_id']; ?>&size=<?php echo urldecode('A4'); ?>">Print in A4</a>
                                <a  class="btn btn-sm" href="https://chemistryservice.rimpido.com">Go back to Homepage</a>
                                </h4>
                                </div>
                            </div>
                            
                        </div>
                        
                        </div>
                    
                    <div class="card">
                        <div class="header">
                            <h2><strong>Chemical Information</strong></h2>
                        </div>
                        <div class="body">
                            <center>
                            <!--<p>Job Position: Software Programmer</p>
                            <p>Date Employed: April 4, 2019</p>
                            <p>ID Valid Until: April 30, 2020</p>-->
                            <div class="row">
                                
                            <div class="col-md-2">Cas Number</div>
                                <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
                                
                                    <?php echo $result['cas_no']; ?>
                                
                                </div>
                            <div class="col-md-2">UN Number</div>
                                <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
                                <?php echo $result['un_no']; ?>
                                </div>
                            <div class="col-md-2">IUPAC Name</div>
                                <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
                                            <?php 
                                            if (is_null($result['iupac_name']) || $result['iupac_name'] == "")
                                            {
                                                echo "No Data";
                                            }else
                                            {    
                                            echo $result['iupac_name'];
                                            }

                                            ?>
                                </div>
                            
                            </div>
                            </center>
                        </div>
                    </div>
                    
                    <?php 
                        include 'includes/chem-info/chemical-properties.php';
                        include 'includes/chem-info/h&p-phrases.php';
                        include 'includes/chem-info/ghs-label.php';
                    ?>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>
    
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/light-gallery/js/lightgallery-all.min.js"></script> <!-- Light Gallery Plugin Js --> 
<script src="assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="assets/js/pages/medias/image-gallery.js"></script>
<script src="assets/js/pages/calendar/calendar.js"></script>
</body>

</html>