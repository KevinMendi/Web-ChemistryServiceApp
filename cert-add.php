

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

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $batteryName = test_input($_POST["batteryName"]);
  $productName = test_input($_POST["productName"]);
  $batterCat = test_input($_POST["batterCat"]);
  $batteryType = test_input($_POST["batteryType"]);
  $lithiumContent = test_input($_POST["lithiumContent"]);
  $watHourRating = test_input($_POST["watHourRating"]);
  $batteryWeight = test_input($_POST["batteryWeight"]);
  $cellsPerBattery = test_input($_POST["cellsPerBattery"]);
  $cellsBattPerDevice = test_input($_POST["cellsBattPerDevice"]);
  $supplierName = test_input($_POST["supplierName"]);
   

// $target = "certification/certs/";
//target = $target . basename( $_FILES['uploadCert']['name']);
//$certFilename=($_FILES['uploadCert']['name']);

 $folder_path = 'certification/certs/';
$filename = basename($_FILES['uploadCert']['name']);
$newname = $folder_path . $filename;
$FileType = pathinfo($newname,PATHINFO_EXTENSION);

$tableName = "tb_battery_cert";

if($FileType == "pdf")
    {

         $cert_fields = [   
            'prod_name'=>$productName,
            'batt_name'=>$batteryName,
            'batt_category'=>$batterCat,
            'batt_type'=>$batteryType,
            'batt_lithium_content'=>$lithiumContent,
            'batt_watthour_rating'=>$watHourRating,
            'batt_weight'=>$batteryWeight,
            'batt_cellsPerBatt'=>$cellsPerBattery,
            'cells_batt_per_device'=>$cellsBattPerDevice,
            'batt_supplier'=>$supplierName,
            'batt_cert'=>$filename,
            'user_id'=>$_SESSION['user_id']
        ];


        
       $ch = new Chempo();
       
       $success = $ch->insert($cert_fields,$tableName);

       if ($success == '0')
       {
         echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem occured. Please try again.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';

       }
        else
       {


            if (move_uploaded_file($_FILES['uploadCert']['tmp_name'], $newname))
            {
               // echo "SAVE!";

                
                if($_SESSION['company_id'] == '0')
                {
                    header('Location: 38.3-certificate.php');
                }
                else
                {
                    header('Location: cert-lists.php');
                }

            }
            else
            {
            echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry ! </strong> Sorry, there was a problem occured in uploading your Certificate.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
            }
     
    
       }




        
    }
 





}






?>


<!DOCTYPE html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: ChemPO :: Add 38.3 Certificate</title>
<link rel="icon" href="assets/images/logo.png" type="image/x-icon">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">


<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css" />
<!-- Colorpicker Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
<!-- Multi Select Css -->
<link rel="stylesheet" href="assets/plugins/multi-select/css/multi-select.css">
<!-- Bootstrap Spinner Css -->
<link rel="stylesheet" href="assets/plugins/jquery-spinner/css/bootstrap-spinner.css">
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<!-- Bootstrap Select Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<!-- noUISlider Css -->
<link rel="stylesheet" href="assets/plugins/nouislider/nouislider.min.css" />
<!-- Select2 -->
<link rel="stylesheet" href="assets/plugins/select2/select2.css" />

<link rel="stylesheet" href="assets/plugins/dropify/css/dropify.min.css">



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
        <form  method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <!-- <form  action="" method="post"> -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add 38.3 Certificate</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item active">38.3 Certificate</li>
                        <li class="breadcrumb-item active">Add 38.3 Certificate</li>
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
                            <h2><strong>38.3</strong> Certificate</h2>
                           
                        </div>
                        <div class="body">
                                
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Enter Battery Name *" name="batteryName" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Enter Product Name *" name="productName" required>
                                </div>
                                <div class=" form-group form-float">
                                    
                                    <small>Battery Category *</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="batterCat" required>
                                        <option value="0" selected>Please Select</option>
                                        <option value="1">Cell</option>
                                        <option value="2">Battery</option>
                                        
                                        
                                    </select>
                                </div>
                                <div class=" form-group form-float">
                                    
                                    <small>Battery Type *</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="batteryType" required>
                                        <option value="0" selected>Please Select</option>
                                        <option value="1">Lithium metal battery</option>
                                        <option value="2">Lithium ion battery</option>
                                        <option value="3">Lithium hybrid battery</option>
                                        
                                        
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Enter Lithium Content" name="lithiumContent" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Enter Watt hour rating" name="watHourRating" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Enter Battery weight" name="batteryWeight" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Enter Cells per battery" name="cellsPerBattery" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Enter Cells/Battery per device" name="cellsBattPerDevice" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Enter Supplier Name *" name="supplierName" required>
                                </div>

                                
                                <div class="card">
                        
                        
                            <label>Upload Your 38.3 Certificate *</label>
                            <input type="file" class="dropify" data-max-file-size="1000K" name="uploadCert" required>
                            <small>Please upload file not larger than 1 MB</small>
                        
                        </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

                   
                <!--<button type="submit" class="btn btn-info" name="submit">Save</button>-->
                <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>
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

<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 

<script src="assets/plugins/select2/select2.min.js"></script> <!-- Select2 Js -->



<script src="assets/js/pages/forms/advanced-form-elements.js"></script> 

<script src="assets/plugins/dropify/js/dropify.min.js"></script>
<script src="assets/js/pages/forms/dropify.js"></script>


</body>


</html>