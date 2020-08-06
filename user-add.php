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
$company = test_input($_POST["firstName"]);

$firstName = test_input($_POST["firstName"]);
$middleName = test_input($_POST["middleName"]);
$lastName = test_input($_POST["lastName"]);
$companyName = test_input($_POST["companyName"]);
$userName = test_input($_POST["userName"]);
$eMail = test_input($_POST["eMail"]);
$salutation = test_input($_POST["salutation"]);
if(intval($salutation) == 1 || intval($salutation) == 2)
{
    $sex = 0;
} else {
    $sex = 1;
}


$birthdateYear = test_input($_POST["birthdateYear"]);
$birthdateMonth = test_input($_POST["birthdateMonth"]);
$birthdateDay = test_input($_POST["birthdateDay"]);


$birthdateMonthLength = strlen($birthdateMonth);
$birthdateDayLength = strlen($birthdateDay);
$temp = "";
if($birthdateMonthLength == 1 || $birthdateDayLength == 1)
{
  $temp = "0";
}
else
{
  $temp="";
}
$birthdateMonth = $temp.$birthdateMonth;
$birthdateDay = $temp.$birthdateDay;


$birthdate = $birthdateYear."-".$birthdateMonth."-".$birthdateDay;

$password = test_input($_POST["password"]);
$passwordHash =  password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

$confirmPassword = test_input($_POST["confirmPassword"]);

$defaultRole = '1';
$defaultGroup = '1';


$target = "img/users-pic/";
$target = $target . basename( $_FILES['profilePic']['name']);
$pic=($_FILES['profilePic']['name']);

$tableName = "tb_users";





if($password == $confirmPassword)
{
    $user_fields = [   
            'f_name'=>$firstName,
            'm_name'=>$middleName,
            'l_name'=>$lastName,
            'birthdate'=>$birthdate,
            'sex'=>$sex,
            'email'=>$eMail,
            'username'=>$userName,
            'password'=>$passwordHash,
            'profile_pic'=>$pic,
            'company_id'=>$companyName,
            'role_id'=>$defaultRole,
            'usergroup_id'=>$defaultGroup,
            'salutation'=>$salutation


        ];


        
       $ch = new Chempo();
   
       $success = $ch->insert($user_fields,$tableName);
        if($success == '0')
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
         if(move_uploaded_file($_FILES['profilePic']['tmp_name'],$target))
            { 
                
               
                header('Location: user-add.php');
               
            }
            else {

            echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry ! </strong> Sorry, there was a problem uploading your profile picture.
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
else
{
echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                     Password does not match !
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';

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

<title>:: ChemPO :: Add User</title>
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

<script>
function checkAvailability() {
  $("#loaderIcon").show();
    
  jQuery.ajax({
  url: "check_availability.php",
  data:'username='+$("#username").val(),
  type: "POST",
  success:function(data){
    $("#user-availability-status").html(data);
    $("#loaderIcon").hide();
    if ($("span").hasClass("status-not-available") == true) {
        $("#submit").attr("disabled",true);
    } else {
        $("#submit").attr("disabled",false);
    }
  },
  error:function (){}
  });
}

function checkEmailAvailability() {
  $("#loaderIcon").show();
  jQuery.ajax({
  url: "check_email_availability.php",
  data:'email='+$("#email").val(),
  type: "POST",
  success:function(data){
    $("#email-availability-status").html(data);
    $("#loaderIcon").hide();
    if ($("span").hasClass("status-not-available") == true) {
        $("#submit").attr("disabled",true);
    } else {
        $("#submit").attr("disabled",false);
    }
  },
  error:function (){}
  });
}
</script>

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
                    <h2>Register User</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item">User</li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    
                </div>
            </div>
        </div>
        <form class="card auth_form" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="body">
                        <?php
                            if ($_SESSION['user_role_id'] == '4' || $_SESSION['user_role_id'] == '3')
                            {
                        ?>
                       <label for="remember_me">Working in a certain company ? *</label>
                        <div class="form-group">
                                    <div class=" inlineblock m-r-20">
                                        <input type="radio" name="company" id="yes" class="with-gap" value="option1" onclick='yes_company();' checked="">
                                        <label for="Yes">Yes</label>
                                    </div>                                
                                    <div class=" inlineblock">
                                        <input type="radio" name="company" id="no" class="with-gap" value="option2" onclick='no_company();'>
                                        <label for="No" >No</label>
                                    </div>
                         </div>
                         <div class="comp" id="comp">
                         <small>Company *</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="companyName">
                                        <option value="0" selected>Please Select</option>
                                          <?php
                                                             $pt = new Chempo();
                                                                $rows = $pt->selectCompany();
                                                                     foreach ($rows as $row) 
                                                                        {
                                                         ?>
                                                                     <option  value="<?php echo$row['company_id']; ?>"><?php echo $row['company_name']; ?> </option>


                                                          <?php
                                                                     }


                                                          ?>
                                    </select><br>  
                        <label for="remember_me">Is your company not in the list ?<br>To register your company.<a href="company-register.php"> Click Here </a></label>
                        </div>
                        
                        <?php
                            } else if ($_SESSION['user_role_id'] == '2') {
                                
                        ?>
                            <!-- IF ADMIN COMPANY REGISTER NEW USER COMPANY == ADMIN COMPANY'S COMPANY -->
                            <small><i><b> Note: </b> User that is be added is registered under the same company.</i></small>
                            <input type="text" class="form-control" placeholder="companyName" name="companyName" value="<?php echo $_SESSION['company_id']; ?>" hidden>
                            
                        <?php
                                } else {
                                } //end bracket for user role 4 and 3 company dropdown list
                        ?>
                        <div class="input-group mb-3">
                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="salutation" >
                                        <option value="0">Mr.</option>
                                        <option value="1">Ms.</option>
                                        <option value="2">Mrs.</option>
                                    </select>
                        </div>
                         <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="First Name *" name="firstName" required="">
                           
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Middle Name" name="middleName">
                            
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Last Name *" name="lastName" required="">
                           
                        </div>
                        
                       <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Enter Email *" name="eMail" id="email" onBlur="checkEmailAvailability()" required="" onchange='check_email();' >
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                            </div>
                        </div>
                        <p id="email-availability-status" ></p>
            
                        <div class="birthdate" id="birthdate">
                        <small>Birthdate *</small>
                        <div class="row">

                          <div class="col-lg-4 col-sm-12">
                         <div class="btn-group">
                            
                                

                                 <select class="form-control show-tick ms select2" data-placeholder="Select" name="birthdateYear" style="width:250px;">
                                        <?php

                                    for ($x = 1899; $x < 2040; $x++){
                                        echo "<option value=". $x .">". $x ."</option>";
                                     }
                                     ?>
                                </select><br> 

                          </div>
                          </div> 
                          <div class="col-lg-4 col-sm-12">     
                           <div class="btn-group">
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="birthdateMonth" style="width:250px;">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select><br> 
                          </div>
                        </div>
                            
                        <div class="col-lg-4 col-sm-12">
                           <div class="btn-group">
                                
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="birthdateDay" style="width:250px;">
                                        <?php

                                        for ($x = 1; $x < 32; $x++){
                                            echo "<option value=". $x .">". $x ."</option>";
                                        }
                                        ?>
                                </select><br> 
                                
                         </div>
                         </div>
                         </div><br>
                            </div>


                               
                        <div class="input-group mb-3">
                            <input name="userName" type="text" id="username" class="form-control" onBlur="checkAvailability()"  placeholder="Username *"required="">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>   
                            </div>
                            <p id="user-availability-status"></p> 

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password *" id= "password" name="password" onchange='check_pass();' required="">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                            </div>                            
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Confirm Password *" id="confirmPassword" name="confirmPassword" onchange='check_pass();' required=""/>
                            <div class="input-group-append">                                
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                            </div>                            
                        </div>
                        <div class="card">
                        
                        
                            <label>Upload Profile Picture </label>
                            <input type="file" class="dropify" data-max-file-size="100K" name="profilePic" required="">
                            <small>Please upload file not larger than 100 KB</small>
                        
                        </div>
                        
                        
                        
                        <div class="checkbox">
                            <input id="remember_me" type="checkbox">
                            <!--<label for="remember_me">I read and agree to the <a href="javascript:void(0);">terms of usage</a></label>-->
                        </div>
                       <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" id="submit">SUBMIT</button>
                        
                    </div>

                </form>


        
        
    
    </div>

</section>

<script>
    
function check_email() {
    var mailformat = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
        
     if(document.getElementById('email').value.match(mailformat)) {
         
    }else {
          alert("You have entered an invalid email address.");
          document.getElementById('email').value="";
          document.getElementById('email').focus();
        }
  }
    
function check_pass() {
    if (document.getElementById('password').value ==
            document.getElementById('confirmPassword').value) {
        document.getElementById('submit').disabled = false;
    } else if (document.getElementById('confirmPassword').value == "") {
        document.getElementById('submit').disabled = true;   
    } else {
        document.getElementById('submit').disabled = true;
        alert("Password incorrect!");
        document.getElementByID('password').focus();
        document.getElementById('password').value = "";
        document.getElementById('confirmPassword').value = "";
    }
}
    
function no_company() {
    document.getElementById('comp').style.display='none';
    document.getElementById('birthdate').style.display='none';
}
    
function yes_company() {
    document.getElementById('comp').style.display='block';
    document.getElementById('birthdate').style.display='block';
}
    
</script>
    
    
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/light-gallery/js/lightgallery-all.min.js"></script> <!-- Light Gallery Plugin Js --> 
<script src="assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="assets/js/pages/medias/image-gallery.js"></script>
<script src="assets/js/pages/calendar/calendar.js"></script>


<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="assets/js/pages/forms/advanced-form-elements.js"></script> 


<script src="assets/plugins/dropify/js/dropify.min.js"></script>
<script src="assets/js/pages/forms/dropify.js"></script>


<script src="assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 
<script src="assets/js/pages/ui/sweetalert.js"></script>


</body>

</html>