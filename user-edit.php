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

if (!isset($_SESSION['user-uid']))
{
    $_SESSION['user-uid'] = $_POST['editUser'];
}

if (isset($_SESSION['user-uid'])) {
    $pt = new Chempo();
   
    $result = $pt->readUserInfo($_SESSION['user-uid']);

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if (isset($_POST['update-profile-user']) && $_SERVER["REQUEST_METHOD"] == "POST") {
$userId = test_input($_POST["userId"]);
//$profilePic = test_input($_POST["profilePic"]);



        $target = "img/users-pic/";
        $target = $target . basename( $_FILES['profilePic']['name']);
        $pic=($_FILES['profilePic']['name']);
        $tableName = "tb_users";
        $whereClause = "user_id";

             $user_fields = [   
                'profile_pic'=>$pic
            ];
            $ch = new Chempo();
        $success = $ch->update($user_fields,$userId,$tableName,$whereClause);
         if($success == 0)
       {
        echo '<div class="alert alert-danger" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-block"></i>
                                    </div>
                                    <strong>Sorry ! </strong> There was a problem occured in updating this account. Please try again. 
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
                
               
                header('Location: users-list.php');
               
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



///////////////////////////////////////////////////////////////////////////////////////


if (isset($_POST['update-credent-user']) && $_SERVER["REQUEST_METHOD"] == "POST") {

$userId = test_input($_POST["userId"]);
$userName = test_input($_POST["userName"]);
$password = test_input($_POST["password"]);
$passwordHash =  password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
$confirmPassword = test_input($_POST["confirmPassword"]);
$userRole = test_input($_POST["userRole"]);
$userGroup = test_input($_POST["userGroup"]);
$passwordlength = strlen($password);
$userGroupInt = 0;

$tableName = "tb_users";
$whereClause = "user_id";
if($userRole == '3' || $userRole == '4')
{
    $userGroupInt = 5;
}
else
{
    $userGroupInt = (int)$userGroup;
}





if(($password == $confirmPassword) && $passwordlength > 0)
{

             $user_fields = [   
                'username'=>$userName,
                'password'=>$passwordHash,
                'role_id'=>$userRole,
                'usergroup_id'=>$userGroupInt

            ];

            $ch = new Chempo();
            $success = $ch->update($user_fields,$userId,$tableName,$whereClause);

            if($success === 0)
            {
                echo '<div class="alert alert-danger" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-block"></i>
                                    </div>
                                    <strong>Sorry ! </strong> There was a problem occured in updating this account. Please try again. 
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
                header('Location: users-list.php');
            }
}

else if(($password == $confirmPassword) && $passwordlength < 1)
{
        $user_fields = [   
                'username'=>$userName,
                'role_id'=>$userRole,
                'usergroup_id'=>$userGroupInt

            ];

            $ch = new Chempo();
            
            $success = $ch->update($user_fields,$userId,$tableName,$whereClause);
            if($success === 0)
            {
                echo '<div class="alert alert-danger" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-block"></i>
                                    </div>
                                    <strong>Sorry ! </strong> There was a problem occured in updating this account. Please try again. 
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
                header('Location: users-list.php');
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

//////////////////////////////////////////////////////////////////////////////////////////






if (isset($_POST['update-info-user']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    
$userId = test_input($_POST["userId"]);
$firstName = test_input($_POST["firstName"]);
$middleName = test_input($_POST["middleName"]);
$lastName = test_input($_POST["lastName"]);
$eMail = test_input($_POST["eMail"]);
$gender = test_input($_POST["gender"]);
$birthDate = test_input($_POST["birthDate"]);
$address1 = test_input($_POST["address1"]);
$address2 = test_input($_POST["address2"]);
$address3 = test_input($_POST["address3"]);
$phoneNumber = test_input($_POST["phoneNumber"]);
//$userName = test_input($_POST["userName"]);
//$password = test_input($_POST["password"]);
//$passwordHash =  password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

//$confirmPassword = test_input($_POST["confirmPassword"]);
//$profilePic = test_input($_POST["profilePic"]);
//$userRole = test_input($_POST["userRole"]);
//$userGroup = test_input($_POST["userGroup"]);
$tableName = "tb_users";
$whereClause = "user_id";
 $user_fields = [   
                'f_name'=>$firstName,
                'm_name'=>$middleName,
                'l_name'=>$lastName,
                'birthdate'=>$birthDate,
                'address1'=>$address1,
                'address2'=>$address2,
                'address3'=>$address3,
                'sex'=>$gender,
                'phone_no'=>$phoneNumber,
                'email'=>$eMail

            ];
            $ch = new Chempo();
            
            $success = $ch->update($user_fields,$userId,$tableName,$whereClause);

            if($success === 0)
            {
                echo "Error !";
            }
            else
            {
                header('Location: users-list.php');
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

<title>:: ChemPO :: User Profile</title>
<link rel="icon" href="assets/images/rimpido-header.png" type="image/x-icon">
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
                    <h2>User Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item">User</li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card mcard_3">
                         <form class="card auth_form" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                        <div class="body">
                            <div class="form-group form-float">
                           <input type="text" class="form-control" placeholder="" name="userId" value="<?php echo $result['user_id']; ?>"  hidden>
                        </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <span class="btn btn-primary btn-file"><i class="zmdi zmdi-edit" ></i>
                            <input style="position: relative;overflow: hidden;position: absolute;top: 0;right: 0;min-width: 100%;min-height: 100%;font-size: 100px;text-align: right;filter: alpha(opacity=0);opacity: 0;outline: none;   cursor: inherit;display: block;" type="file" name="profilePic" onchange="readURL(this);">
                            </span>

                            </div>
                            

                            <?php
                            $picture = $result['profile_pic'];
                            if($picture == "")
                            {
                                echo '<img id="profile" src="img/users-pic/default.jpg" class="rounded-circle shadow " alt="user-profile-image">';
                            }
                            else
                            {
                               echo '<img id="profile" src="img/users-pic/'.$picture.'" class="rounded-circle shadow " alt="user-profile-image">'; 
                            }
                            //FOR SALUTATION
                            // 0 - MR.
                            // 1 - MS.
                            // 2 - MRS.
                            
                            if (((int)$result['salutation']) === 0) {
                                $salutation = 'Mr.';
                            } elseif (((int)$result['salutation']) === 1) {
                                $salutation = 'Ms.';
                            } elseif (((int)$result['salutation']) === 2) {
                                $salutation = 'Mrs.';
                            } else {
                                $salutation = '';
                            }
                            ?>
                            <h4 class="m-t-10"><?php echo ($salutation.' '.$result['f_name'].' '. $result['m_name'].' '.$result['l_name']); ?></h4>

                                                         
                            <div class="row">
                                <div class="col-12">
                                    <ul class="social-links list-unstyled">
                                        <li><a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a></li>
                                        <li><a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a></li>
                                        <li><a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a></li>
                                    </ul>
                                    <p class="text-muted mt-3 mb-3"></p>
                                </div>
                                <div class="col-5 ">                                    
                                    <small>Chemicals</small>
                                    <h5><?php 
                                        $ch = new Chempo();
                                        $userid = $result['user_id'];
                                        $chemRes = $ch->countNumOfChemAdded($userid);
                                        echo $chemRes['chemAdded'];
                                     ?></h5>
                                </div>
                                 <div class="col-2">                                    
                                   
                                </div>  
                                <div class="col-5">                                    
                                    <small>Certificates</small>
                                    <h5><?php
                                    $userid = $result['user_id'];
                                    $certRes = $ch->countNumOfCertAdded($userid);
                                    echo $certRes['certAdded'];
                                    ?></h5>
                                </div> 
                                                         
                            </div><br><br>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-6">
                              <!--  <small>Credentials</small>-->
                                </div>
                                 <div class="col-3"></div> 
                                 <div class="col-12">
                                    <!--<p>
                                        Not yet Implemented<br><br>
                                        Not yet Implemented<br><br>
                                        Not yet Implemented
                                    </p>-->
                                </div>                             
                            </div><br><br><br>
                            
                            
                        </div>
                         <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" name="update-profile-user">Update Profile Picture</button>
                    </form>

                    </div>
                                       
                </div>
                <div class="col-lg-8 col-md-12">
                     <div class="card">
                        <div class="body">
                            <div class="container-fluid">
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>User</strong> General Information</h2>
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
                         <form class="card auth_form" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                        <div class="body">
                            <div class="form-group form-float">
                           <input type="text" class="form-control" placeholder="" name="userId" value="<?php echo $result['user_id']; ?>"  hidden>
                        </div>
                                
                                <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="First Name *" name="firstName" value="<?php echo $result['f_name']; ?>" required="">
                            </div>
                            <hr>
                              <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Middle Name" name="middleName" value="<?php echo $result['m_name']; ?>">
                            
                        </div><hr>
                                <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Last Name *" name="lastName" value="<?php echo $result['l_name']; ?>" required="">
                           
                        </div><hr>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Enter Email *" name="eMail" required="" value="<?php echo $result['email']; ?>" onchange='check_email();' required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                            </div>
                        </div><hr>
                        <small>Sex</small>
                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="gender">
                                    <?php 
                                     $sex = $result['sex']; 
                                     $sexVal= "";
                                     if($sex == '1')
                                     {
                                        echo "<option value='1' selected>Male</option>
                                                <option value='0'>Female</option>";
                                     }
                                     else
                                     {
                                        echo "<option value='1'>Male</option>
                                                <option value='0'  selected>Female</option>";
                                     }
                                     echo $sexVal;
                                     ?>
                                   
                        </select><hr>
                         <small>Birthdate</small>
                         <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Last Name *" name="birthDate" value="<?php echo $result['birthdate']; ?>" required="">
                           
                        </div><hr>
                       
                        <small>Address 1 ( Apartment, suite , unit, building, floor, etc. )</small>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Address 1 *" name="address1" value="<?php echo $result['address1']; ?>" required="">
                           
                        </div>
                        
                        <hr>
                        <small>Address 2 ( City or Town )</small>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Address 2" name="address2" value="<?php echo $result['address2']; ?>" >
                           
                        </div><hr>
                        <small>Address 3 ( State or Province )</small>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Address 3" name="address3" value="<?php echo $result['address3']; ?>" >
                           
                        </div><hr>
                        <small>Phone Number</small>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Phone Number" name="phoneNumber" value="<?php echo $result['phone_no']; ?>" >
                           
                        </div><hr><br>
                        <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" name="update-info-user">Update User General Information</button>
                            
                            
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>

        </div>
        </div>                    



                   
     </div>
                <div class="col-lg-12 col-md-12">
                <div class="card">
                        <div class="body">
                            <div class="container-fluid">
                              <form class="card auth_form" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">   
                            <div class="body">
                        <div class="form-group form-float">
                           <input type="text" class="form-control" placeholder="" name="userId" value="<?php echo $result['user_id']; ?>"  hidden>
                        </div>
                           <small>Username</small>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Username *" name="userName" required="" value="<?php echo $result['username']; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <label>Note: Enter your new password if you wish to change it. Otherwise leave it blank. </label><br>
                        <small>Password</small>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password *" name="password"  value="">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                            </div>
                             

                        </div>
                       
                        </script>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Confirm Password *" name="confirmPassword"  value="">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                            </div>                            
                        </div>

                        <?php
                            if($_SESSION['company_id'] != '0')
                            {
                                if($_SESSION['user_role_id'] == '4')
                                {
                        ?> 
                            
                        
                        <small>User Role</small>
                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="userRole">
                                <option  value="<?php echo $result['role_id']; ?>" selected><?php echo $result['role_name']; ?> </option>

                                   <?php
                                          $pt = new Chempo();
                                           $rows = $pt->selectUserRole();
                                           foreach ($rows as $row) 
                                             {
                                             ?>
                                               <option  value="<?php echo $row['role_id']; ?>"><?php echo $row['role_name']; ?> </option>


                                            <?php
                                               }


                                                ?>
                          </select>
                            <?php 
                                } else {
                            ?>
                                   <small>User Role</small>
                                  <input type="text" class="form-control" placeholder="User Role" name="userRole" required="" value="<?php echo $result['role_id']; ?>" hidden>
                                  <input type="text" class="form-control" placeholder="User Role" name="userRoleName" required="" value="<?php echo $result['role_name']; ?>" readonly>
                            <?php
                                } //end bracket for session role id 4 for User role selection
                            ?>
                                  
                        <small>User Group</small>
                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="userGroup">
                                 

                                  <option  value="<?php echo $result['usergroup_id']; ?>" selected><?php echo $result['usergroup_name']; ?> </option>

                                   <?php
                                          $pt = new Chempo();
                                            echo $_SESSION['user_role_id'];
                                           $rows = $pt->selectUserGroup($_SESSION['user_role_id']);
                                           foreach ($rows as $row) 
                                             {
                                             ?>
                                               <option  value="<?php echo $row['usergroup_id']; ?>"><?php echo ($row['usergroup_name'].' - '.$row['usergroup_desc']); ?> </option>


                                            <?php
                                               }


                                                ?>

                          </select><br><br>

                          <?php
                          } // end bracket for SESSION company id
                          ?>


                          <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" name="update-credent-user">SUBMIT</button>


                            </div>
                            </form>
                        </div>
                    </div>
            </div>

        </div>
        </div>

    
        </div>
    
    </div>
</section>

<script type='text/javascript'>
    
function check_email() {
    var mailformat = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
        
     if(document.getElementById('email').value.match(mailformat)) {
         
    }else {
          alert("You have entered an invalid email address.");
          document.getElementById('email').value="";
          document.getElementById('email').focus();
        }
  }

function readURL(input){
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e){
            $('#profile')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
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
</body>

</html>