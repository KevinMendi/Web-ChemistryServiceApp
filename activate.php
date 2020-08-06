<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<title>:: Account Activation :: Chemistry Service Portal</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Light Gallery Plugin Css -->
<link rel="stylesheet" href="assets/plugins/light-gallery/css/lightgallery.css">
<link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-dark">

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
                    <h2>Account Activation</h2>
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
                            
                            <?php
                            
                            include 'classes/db_mail.php';

                            $query = "SELECT user_id FROM tb_users WHERE verification_code ='". $_GET['code']."' AND verified = '0'";
                            $stmt = $con->prepare( $query );
                            $stmt->bindParam(1, $_GET['code']);
                            $stmt->execute();
                            $num = $stmt->rowCount();

                            if($num>0){

                                //echo $num;

                                $query = "UPDATE tb_users SET verified = '1' WHERE verification_code='".$_GET['code']."'";

                                $stmt = $con->prepare($query);
                                //$stmt->bindParam(':verification_code', $_GET['code']);

                                if($stmt->execute()){
                                    // tell the user
                                    echo "<h6 class='m-t-10'>Your email is valid, thanks!<br/> You may now login.</h6>";
                                    
                                    
                                }else{
                                    echo "<h6 class='m-t-10'>Unable to activate your verification code.</h6>";
                                    print_r($stmt->errorInfo());
                                }

                            }
                            else{
                                // tell the user he should not be in this page
                               echo "<h4 class='m-t-10'>We can't find your verification code.</h4>";
                            }
                            
                            echo "
                            <br>
                            
                                <strong>You will be redirected to log-in page in 3 seconds</strong>
                            ";
                            header( "refresh:3;url=https://chemistryservice.rimpido.com/sign-in.php" );
                            
                            
                            ?>
                            <!--<a href=""><img src="assets/images/emprof/SirKevin.jpg" class="rounded-circle shadow " alt="profile-image" height="150" width="150" style=""></a>-->
                                                 
                         
                        </div>
                        </div>             
                    
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