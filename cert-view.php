

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


function __autoload($class)
{
  require_once "classes/$class.php";
}

if (!isset($_SESSION['cert-uid']))
{
    $_SESSION['cert-uid'] = $_POST['viewCert'];
}

if(isset($_SESSION['cert-uid']))
{

    $ch = new Chempo();

    if($_SESSION['company_id'] == '0')
    {
        $result = $ch->readCertInfoNoCompany($_SESSION['cert-uid']);
    }
    else
    {
       $result = $ch->readCertInfo($_SESSION['cert-uid']); 
    }

    


}



?>


<!DOCTYPE html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: View Certification</title>
<link rel="icon" href="assets/images/logo.png" type="image/x-icon">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">

</head>

<body class="theme-blush">
    

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/logo.png" width="48" height="48" alt="ChemPO"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <!--
    <form>
        <input type="search" value="" placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

-->
</div>

<!-- Navbar -->
<?php include_once('navbar.php') ?>

<section class="content">
    <div class="body_scroll">
        <form id="form_validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <!-- <form  action="" method="post"> -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>38.3 Certificate Information</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item active">38.3 Certificate</li>
                        <li class="breadcrumb-item active">View 38.3 Certificate</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>


        <!---Chemical Info -->
        <div class="container-fluid">
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Certificate</strong> Information</h2>
                            <!--
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        -->
                        </div>
                        <div class="body">
                                <div class="header">
                                
                                </div>
                                <small>Product Name</small>
                                <div class="form-group form-float">
                                    
                                    <input type="text" class="form-control"  name="casNumber" value="<?php echo $result['prod_name']; ?>" readonly>
                                </div>
                                <small>Battery Name</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="unNumber" value="<?php echo $result['batt_name']; ?>" readonly>
                                </div>
                                <small>Battery Category</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="chemicalName" value="<?php echo $result['batt_category']; ?>" readonly>
                                </div>
                                <small>Battery Type</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="iupacName" value="<?php echo $result['batt_type']; ?>" readonly>
                                </div>
                                <small>Battery Lithium Content</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="commercialName" value="<?php echo $result['batt_lithium_content']; ?>" readonly>
                                </div>
                                <small>Battery Watthour Rating</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="commercialName" value="<?php echo $result['batt_watthour_rating']; ?>" readonly>
                                </div>
                                <small>Battery Weight</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="commercialName" value="<?php echo $result['batt_weight']; ?>" readonly>
                                </div>
                                <small>Cells per Battery</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="commercialName" value="<?php echo $result['batt_cellsPerBatt']; ?>" readonly>
                                </div>
                                <small>Cells/Battery per device</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="commercialName" value="<?php echo $result['cells_batt_per_device']; ?>" readonly>
                                </div>
                                <small>Supplier Name</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="commercialName" value="<?php echo $result['batt_supplier']; ?>" readonly>
                                </div>
                                <small>Uploaded by this User</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="commercialName" value="<?php echo $result['name']; ?>" readonly>
                                </div>
                                <small>User Company</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="commercialName" value="<?php 
                                    
                                    if($_SESSION['company_id'] == '0')
                                    {
                                         echo "No Company"; 
                                    }
                                    else
                                    {
                                        
                                        echo $result['company_name'];
                                    }

                                    ?>" readonly>
                                </div><br>
                                <small>38.3 Certificate</small><hr>





                                <div class="form-group form-float">
                                    
                                    <?php echo $result['batt_cert']; ?>&nbsp;&nbsp;

                                    <?php
                                        if($_SESSION['user_role_id'] == '1' && $_SESSION['company_id'] != '0')
                                        {
                                            if(($_SESSION['user_group_id'] == '1' || $_SESSION['user_group_id'] == '2' || $_SESSION['user_group_id'] == '3' || $_SESSION['user_group_id'] == '4') && ($_SESSION['company_id'] == $result['company_id']))
                                            {
                                    ?>
                                                <a  class="btn btn-md btn-outline-success" href="certification/certs/<?php echo $result['batt_cert']; ?>"><i class="zmdi zmdi-download"></i> &nbsp; Download</a>
                                            <?php
                                            }
                                            
                                            ?>



                                    <?php
                                        }
                                        elseif($_SESSION['user_role_id'] == '2')
                                        {
                                            if($_SESSION['company_id'] == $result['company_id'])
                                            {
                                    ?>
                                            <a  class="btn btn-md btn-outline-success" href="certification/certs/<?php echo $result['batt_cert']; ?>"><i class="zmdi zmdi-download"></i> &nbsp; Download</a>          
                                            <?php
                                            }
                                            else
                                            {
                                            ?>

                                            <?php
                                            }
                                            ?>


                                    <?php
                                        }
                                        elseif($_SESSION['user_role_id'] == '3')
                                        {
                                    ?>
                                            <a  class="btn btn-md btn-outline-success" href="certification/certs/<?php echo $result['batt_cert']; ?>"><i class="zmdi zmdi-download"></i> &nbsp; Download</a>  

                                    <?php
                                        }
                                        elseif($_SESSION['user_role_id'] == '4')
                                        {
                                    ?>
                                            <a  class="btn btn-md btn-outline-success" href="certification/certs/<?php echo $result['batt_cert']; ?>"><i class="zmdi zmdi-download"></i> &nbsp; Download</a>  

                                    <?php
                                        }
                                        elseif($_SESSION['company_id'] == '0')
                                          {  
                                    ?>
                                        <a  class="btn btn-md btn-outline-success" href="certification/certs/<?php echo $result['batt_cert']; ?>"><i class="zmdi zmdi-download"></i> &nbsp; Download</a>
                                    <?php
                                     }
                                     ?>

                                    

                                   
                                </div>
                                
                                
                                <!--
                                <button class="btn btn-raised btn-primary waves-effect" name="submit-header" type="submit">SUBMIT</button>-->
                               
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


 
                
     </form>   
    </div>
</section>

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Jquery Validation Plugin Css --> 
<script src="assets/plugins/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/forms/form-validation.js"></script> 
</body>


</html>