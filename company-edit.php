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

if (!isset($_SESSION['company-uid']))
{
    $_SESSION['company-uid'] = $_POST['editCompany'];
}

if (isset($_SESSION['company-uid'])) {
    $pt = new Chempo();
   
    $result = $pt->readCompanyInfo($_SESSION['company-uid']);

}



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['company-edit']) && $_SERVER["REQUEST_METHOD"] == "POST") {


  $companyId = test_input($_POST["companyId"]);
  $companyName = test_input($_POST["companyName"]);
  $companyAddress = test_input($_POST["companyAddress"]);
  $zipOrPostal = test_input($_POST["zipOrPostal"]);
  $telephoneNumber = test_input($_POST["telephoneNumber"]);
  $faxNumber = test_input($_POST["faxNumber"]);
  $emailAddress = test_input($_POST["emailAddress"]);
  $homepageLink = test_input($_POST["homepageLink"]);
  $updateLogo = test_input($_POST["updateLogo"]);
$tableName = "tb_companies";
$whereClause = "company_id";


$ch = new Chempo();
  if ($updateLogo == "option1") {
      # code...
        

        $logoName =  $ch->selectLogoName($companyId);
        $lname = $logoName['company_logo'];

        $file_to_delete = 'img/companies-logo/'.$lname;
        unlink($file_to_delete);

        $target = "img/companies-logo/";
        $target = $target . basename( $_FILES['companyLogo']['name']);
        $pic=($_FILES['companyLogo']['name']);

        $company_fields = [   
            'company_name'=>$companyName,
            'company_address1'=>$companyAddress,
            'company_zip_postal'=>$zipOrPostal,
            'company_tel_no'=>$telephoneNumber,
            'company_fax'=>$faxNumber,
            'company_email'=>$emailAddress,
            'homepage_link'=>$homepageLink,
            'company_logo'=>$pic

        ];
        //$success = $ch->updateCompanyInfo($company_fields,$companyId);
        $success = $ch->update($company_fields,$companyId,$tableName,$whereClause);
         if($success == 0)
       {
        echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem occured in updating this account. Please try again.
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

        if(move_uploaded_file($_FILES['companyLogo']['tmp_name'],$target))
            { 
                
               
                header('Location: companies-list.php');
               
            }
            else {

            echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry ! </strong> Sorry, there was a problem uploading your Company logo.
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
  elseif ($updateLogo == "option2")
  {
    $company_fields = [   
            'company_name'=>$companyName,
            'company_address1'=>$companyAddress,
            'company_zip_postal'=>$zipOrPostal,
            'company_tel_no'=>$telephoneNumber,
            'company_fax'=>$faxNumber,
            'company_email'=>$emailAddress,
            'homepage_link'=>$homepageLink

        ];

        $success = $ch->update($company_fields,$companyId,$tableName,$whereClause);
         if($success == 0)
       {
        echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem occured in registering this account. Please try again.
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
        header('Location: companies-list.php');
       }
  }

 


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
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" href="assets/plugins/dropify/css/dropify.min.css">
<link rel="stylesheet" href="assets/plugins/sweetalert/sweetalert.css"/>
</head>

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
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Company Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item">Company</li>
                        <li class="breadcrumb-item active">Edit Company Profile</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <!--<a href="profile-edit.html" class="btn btn-info btn-icon float-right"><i class="zmdi zmdi-edit"></i></a>-->
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">
                           
                       
                         <form class="card auth_form" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    

                    <div class="body">
                        <div class="form-group form-float">
                           <input type="text" class="form-control" placeholder="" name="companyId" value="<?php echo $result['company_id']; ?>"  hidden>
                        </div>
                        
                       <div class="form-group form-float">
                           <input type="text" class="form-control" placeholder="Company Name *" value="<?php echo $result['company_name']; ?>" name="companyName" required="">
                        </div>
                        <div class="form-group form-float">
                           <input type="text" class="form-control" placeholder="Company Complete Address *" value="<?php echo $result['company_address1']; ?>" name="companyAddress" required="">
                        </div>
                        <div class="form-group form-float">
                           <input type="text" class="form-control" placeholder="Zip or Postal *" value="<?php echo $result['company_zip_postal']; ?>" name="zipOrPostal" required>
                        </div>
                        <div class="input-group masked-input mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="zmdi zmdi-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control mobile-phone-number" placeholder="Telephone Number *" name="telephoneNumber" value="<?php echo $result['company_tel_no']; ?>" required>
                        </div>
                        <div class="input-group masked-input mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="zmdi zmdi-account-box-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control mobile-phone-number" placeholder="Fax Number *" name="faxNumber" value="<?php echo $result['company_fax']; ?>" required>
                        </div>
                         <div class="input-group masked-input mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                        </div>
                                        <input type="text" class="form-control email" placeholder="eMail address *" name="emailAddress" value="<?php echo $result['company_email']; ?>" required>
                          </div>
                          <div class="form-group form-float">
                           <input type="url" class="form-control" placeholder="Homepage Link *" name="homepageLink" value="<?php echo $result['homepage_link']; ?>"  required>
                        </div>
                        <label>Do you want to update your company logo ?</label>
                        <div class="form-group">
                                    <div class=" inlineblock m-r-20">
                                        <input type="radio" name="updateLogo" id="yes" class="with-gap" value="option1" onclick="document.getElementById('logo').style.display='block'" checked="">
                                        <label for="Yes">Yes</label>
                                    </div>                                
                                    <div class=" inlineblock">
                                        <input type="radio" name="updateLogo" id="no" class="with-gap" value="option2" onclick="document.getElementById('logo').style.display='none'" >
                                        <label for="No" >No</label>
                                    </div>
                         </div>
                        <div class="card" id="logo">
                        
                        
                            <label>Upload Your Company logo *</label>
                            <input type="file" class="dropify" data-max-file-size="100K" name="companyLogo" >
                            <small>Please upload file not larger than 100 KB</small>
                        
                        </div>
                         
                        
                        
                        <!--
                        <div class="checkbox">
                            <input id="remember_me" type="checkbox">
                            <label for="remember_me">I read and agree to the <a href="javascript:void(0);">terms of usage</a></label>
                        </div>
                    -->

                        

                        <button class="btn btn-raised btn-primary btn-block waves-effect" name="company-edit" type="submit">SUBMIT</button>
                        
                    </div>
                </form>
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

<script src="assets/plugins/dropify/js/dropify.min.js"></script>
<script src="assets/js/pages/forms/dropify.js"></script>


<script src="assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 
<script src="assets/js/pages/ui/sweetalert.js"></script>
<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="assets/js/pages/forms/advanced-form-elements.js"></script> 
</body>

</html>