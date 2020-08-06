<?php

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in_time'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: sign-in.php');
    exit;
}

unset($_SESSION['user-uid']);
unset($_SESSION['cert-uid']);

function __autoload($class)
{
  require_once "classes/$class.php";
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (!isset($_SESSION['company-uid']))
{
    $_SESSION['company-uid'] = $_POST['viewCompany'];
}

if(isset($_SESSION['company-uid']))
{

    $ch = new Chempo();

    $result = $ch->readCompanyInfo($_SESSION['company-uid']);

}

/////////////////////////////////////////delete user
if (isset($_POST['delete-user']) && $_SERVER["REQUEST_METHOD"] == "POST") {

$userID = test_input($_POST["userID"]);
$tableName = "tb_users";
$whereClause = "user_id";
$ch = new Chempo();

$fields = [ 
         
            'del_status'=>'X'
           
        ];

$check = $ch->delete($fields,$userID,$tableName,$whereClause);

if($check == 1)
{
    header("Location: companies-list.php");
}
else
{
    echo "Error Deleting !";
}


}

/////////////////////////////////////////delete certificate
if (isset($_POST['delete-cert']) && $_SERVER["REQUEST_METHOD"] == "POST") {

$certID = test_input($_POST["certID"]);
$tableName = "tb_battery_cert";
$whereClause = "battery_cert_id";
$ch = new Chempo();

$fields = [ 
         
            'del_status'=>'X'
           
        ];

$check = $ch->delete($fields,$certID,$tableName,$whereClause);

if($check == 1)
{
    header("Location: companies-list.php");
}
else
{
    echo "Error Deleting !";
}


}

/////////////////////////////////////////delete chemical
if (isset($_POST['delete-chemical']) && $_SERVER["REQUEST_METHOD"] == "POST") {


$chemicalID = test_input($_POST["chemicalID"]);
$tableName = "tb_chemical_header";
$whereClause = "chemical_header_id";
$ch = new Chempo();

$fields = [ 
         
            'del_status'=>'X'
           
        ];

$check = $ch->delete($fields,$chemicalID,$tableName,$whereClause);

if($check == 1)
{
    header("Location: companies-list.php");
}
else
{
    echo "Error Deleting !";
}



}

if (isset($_POST['viewUser']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['user-uid'] = $_POST['viewUser'];
    echo 'here';
    header("Location: user-view.php");
}

if (isset($_POST['editUser']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['user-uid'] = $_POST['editUser'];
    header("Location: user-edit.php");
}

if (isset($_POST['viewCert']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['cert-uid'] = $_POST['viewCert'];
    header("Location: cert-view.php");
}

if (isset($_POST['editCert']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['cert-uid'] = $_POST['editCert'];
    header("Location: cert-edit.php");
}
?>



<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: Company Profile</title>
<link rel="icon" href="assets/images/rimpido-header.png" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Light Gallery Plugin Css -->
<link rel="stylesheet" href="assets/plugins/light-gallery/css/lightgallery.css">
<link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">

<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/sweetalert/sweetalert.css"/>
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/rimpido-header.png" width="48" height="48" alt="ChemPO"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
        <input type="search" value="" placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<!-- Navbar -->
<?php include_once('navbar.php') ?>

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <form action="company-edit.php" method="post"> 
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Company Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item">Company</li>
                        <li class="breadcrumb-item active">Company Profile</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>

                    

                    <?php
                        if($_SESSION['user_role_id'] == '2' && ($_SESSION['company_id'] == $result['company_id']))
                        {
                        ?>
                            <button type="submit" class="btn btn-info btn-icon float-right" name="editCompany" value="<?php echo $result['company_id']; ?>"><i class="zmdi zmdi-edit" ></i></button>
                        <?php
                        }
                        elseif($_SESSION['user_role_id'] == '3' || $_SESSION['user_role_id'] == '4')
                        {
                        ?>
                        <button type="submit" class="btn btn-info btn-icon float-right" name="editCompany" value="<?php echo $result['company_id']; ?>"><i class="zmdi zmdi-edit" ></i></button>
                        <?php
                        }
                        ?>
                </div>
            </div>
        </form>
        </div> 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-4">
                    <div class="card widget_2 big_icon ">
                        <div class="body">
                            <h6>Company Users</h6>
                            <h2><?php
                            $companyid = $result['company_id'];
                            $compUser = $ch->countNumOfUserAddedCompany($companyid);

                            echo $compUser['compUser'];

                             ?> <small class="info">Registered Users</small></h2>
                           
                            <div class="progress">
                                <div class="progress-bar l-amber" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card widget_2 big_icon ">
                        <div class="body">
                            <h6>Company Chemicals</h6>
                            <h2><?php 
                            $companyid = $result['company_id'];
                            $compChem = $ch->countNumOfChemAddedCompany($companyid);
                            echo $compChem['compChem'];
                            ?> <small class="info">Added chemicals</small></h2>
                           
                            <div class="progress">
                                <div class="progress-bar l-amber" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card widget_2 big_icon ">
                        <div class="body">
                            <h6>Company Certificates</h6>
                            <h2><?php 
                            $companyid = $result['company_id'];
                            $compCert = $ch->countNumOfCertAddedCompany($companyid);
                            echo $compCert['compCert'];
                            ?> <small class="info">Added certificates</small></h2>
                           
                            <div class="progress">
                                <div class="progress-bar l-amber" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if($_SESSION['company_id'] != $result['company_id'] &&  $_SESSION['user_role_id'] != '4' )
                {
                ?>
                
                <div class="col-lg-12 col-md-12">
                    <div class="card mcard_3">
                        <div class="body">
                            <?php
                            $picture = $result['company_logo'];
                            echo '<img src="img/companies-logo/'.$picture.'" class="rounded-circle shadow " height="200"; width="200"; alt="company-profile-image">';
                            ?>
                            <h4 class="m-t-10"><?php echo $result['company_name']; ?></h4>                            
                            <div class="row">
                                <div class="col-12">
                                    <ul class="social-links list-unstyled">
                                        <li><a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a></li>
                                        <li><a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a></li>
                                        <li><a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a></li>
                                    </ul>
                                    <p class="text-muted mt-3 mb-3"><?php echo $result['company_address1']; ?></p>
                                </div>
                                <div class="col-4 ">                                    
                                    <small>Chemicals</small>
                                    <h5><?php 
                            $companyid = $result['company_id'];
                            $compChem = $ch->countNumOfChemAddedCompany($companyid);
                            echo $compChem['compChem'];
                            ?></h5>
                                </div>
                                <div class="col-4">                                    
                                    <small>Certificates</small>
                                    <h5><?php 
                            $companyid = $result['company_id'];
                            $compCert = $ch->countNumOfCertAddedCompany($companyid);
                            echo $compCert['compCert'];
                            ?></h5>
                                </div>
                                <div class="col-4">                                    
                                    <small>Users</small>
                                    <h5><?php
                            $companyid = $result['company_id'];
                            $compUser = $ch->countNumOfUserAddedCompany($companyid);

                            echo $compUser['compUser'];

                             ?></h5>
                                </div>                            
                            </div><br><br>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-6">
                                <small>Homepage Link</small>
                                </div>
                                 <div class="col-3"></div> 
                                 <div class="col-12"><a href="<?php echo $result['homepage_link']; ?>"><p><?php echo $result['homepage_link']; ?></p> </a></div>                             
                            </div>
                        </div>
                    </div>
                                       
                </div>

                <?php
                }
                else
                {
                ?>
                <div class="col-lg-4 col-md-12">
                    <div class="card mcard_3">
                        <div class="body">
                            <?php
                            $picture = $result['company_logo'];
                            echo '<img src="img/companies-logo/'.$picture.'" class="rounded-circle shadow " alt="company-profile-image">';
                            ?>
                            <h4 class="m-t-10"><?php echo $result['company_name']; ?></h4>                            
                            <div class="row">
                                <div class="col-12">
                                    <ul class="social-links list-unstyled">
                                        <li><a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a></li>
                                        <li><a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a></li>
                                        <li><a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a></li>
                                    </ul>
                                    <p class="text-muted mt-3 mb-3"><?php echo $result['company_address1']; ?></p>
                                </div>
                                <div class="col-4 ">                                    
                                    <small>Chemicals</small>
                                    <h5><?php 
                            $companyid = $result['company_id'];
                            $compChem = $ch->countNumOfChemAddedCompany($companyid);
                            echo $compChem['compChem'];
                            ?></h5>
                                </div>
                                <div class="col-4">                                    
                                    <small>Certificates</small>
                                    <h5><?php 
                            $companyid = $result['company_id'];
                            $compCert = $ch->countNumOfCertAddedCompany($companyid);
                            echo $compCert['compCert'];
                            ?></h5>
                                </div>
                                <div class="col-4">                                    
                                    <small>Users</small>
                                    <h5><?php
                            $companyid = $result['company_id'];
                            $compUser = $ch->countNumOfUserAddedCompany($companyid);

                            echo $compUser['compUser'];

                             ?></h5>
                                </div>                            
                            </div><br><br>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-6">
                                <small>Homepage Link</small>
                                </div>
                                 <div class="col-3"></div> 
                                 <div class="col-12"><a href="<?php echo $result['homepage_link']; ?>"><p><?php echo $result['homepage_link']; ?></p> </a></div>                             
                            </div>
                        </div>
                    </div>
                                       
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="body">
                           
                       
                        <small>Zip or Postal Code</small>
                        <div class="form-group form-float">
                                    
                            <input type="text" class="form-control"  name="casNumber" value="<?php echo $result['company_zip_postal']; ?>" readonly>
                        </div>
                        <small>Telephone Number</small>
                        <div class="form-group form-float">
                                    
                            <input type="text" class="form-control"  name="casNumber" value="<?php echo $result['company_tel_no']; ?>" readonly>
                        </div>
                        <small>Fax Number</small>
                        <div class="form-group form-float">
                                    
                            <input type="text" class="form-control"  name="casNumber" value="<?php echo $result['company_fax']; ?>" readonly>
                        </div>
                        <small>Company eMail</small>
                        <div class="form-group form-float">
                                    
                            <input type="text" class="form-control"  name="casNumber" value="<?php echo $result['company_email']; ?>" readonly>
                        </div>
                        <small>Homepage Link</small>
                        
                        <small>Date Registered</small>
                        <div class="form-group form-float">
                                    
                            <input type="text" class="form-control"  name="casNumber" value="<?php echo $result['date_created']; ?>" readonly>
                        </div>
                        </div>
                    </div>




                   
                </div>

                <?php
                }
                ?>

                
            </div>
        </div>
<?php
        
        include 'user-view-include.php';
        include 'chemical-view-include.php';
        include 'cert-view-include.php';

        
?>

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


<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>


<script src="assets/js/pages/tables/jquery-datatable.js"></script>
</body>

</html>