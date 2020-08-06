<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if(!isset($_SESSION)) 
    { 
        session_start(); 
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
$company = test_input($_POST["company"]);

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
    
$verified = "0";
$verificationCode = md5(uniqid("rim-", true));


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
$tableName = "tb_users";

if($company == 'option2')
{
  $companyName = '0'; // No company
}
else
{
  $companyName = $companyName;
}
//////////////////////////////////////////////////////////


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
            'company_id'=>$companyName,
            'role_id'=>$defaultRole,
            'usergroup_id'=>$defaultGroup,
            'verified'=>$verified,
            'verification_code'=>$verificationCode,
            'salutation'=>$salutation

        ];
    
    
$ch = new Chempo();
///////////////////Verify email and username (start-7-29-19)





//////////////////end


        
       
       $success = $ch->insert($user_fields,$tableName);
        if($success == '0')
       {
        echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem occured in registering your account. Please try again.
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
/*        echo '<div class="alert alert-success" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>Well done!</strong> You are now registered.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';*/
           
        //REDIRECT USER'S PROFILE (DIRECT LOG-IN)
           
        //$loginUser = $ch->credentialCheck($userName, $password);
        
        /*if($loginUser === 0)
        {
            
        } else {
            
            if ($_SESSION['company_id'] == '0')
            {
               header('Location: user-view.php?read='.$_SESSION['user_id']); 
            }else
            {
               header('Location: index.php');
            } 
        }*/
            
            //send the email verification
       /*     $verificationLink = "http://localhost/chempo-stable/activate.php?code=". $verificationCode;*/
           
           $verificationLink = "https://chemistryservice.rimpido.com/activate.php?code=". $verificationCode;
           
            /* Namespace alias. */

           
           /* Include the Composer generated autoload.php file. */
            require 'phpmailer/vendor/autoload.php';
           
           $mail = new PHPMailer(TRUE);
           
           /* Open the try/catch block. */
            try {
                $mail->isHTML(TRUE);
                
               /* Set the mail sender. */
               $mail->setFrom('noreply_chempo@rimpido.com', 'Dr. Jan Schuur');

               /* Add a recipient. */
               $mail->addAddress($eMail);

               /* Set the subject. */
               $mail->Subject = 'Verification Code | Chemistry Service Portal';
                
               $mail->Body = '<html>
               
                    <h3>
                        Welcome to Chemistry Service Portal by rimpido! Please click the button below to verify your email address. <br/><br/><br/>
                    </h3>
                    
                    <a href='.$verificationLink.' target="_blank" style="padding:1em; font-weight:bold; background-color:orange;color:#fff">VERIFY EMAIL</a><br/><br/><br/>
                    
                    <strong>If the link is not working, please copy and paste the url below: </strong><br/><br/>
                    
                    <b style="color:red">'.$verificationLink.'</b><br><br><br>
                    
                    
                    <i>Kind Regards,</i><br/>
                    Jan Schuur<br/>
                    CEO of rimpido GmbH and Rimpido Pacific Inc.
                    
               </html>';

               /* Set the mail message body. */
               //$mail->Body = 'Halellouuu.';
                
                /* SMTP parameters. */

               /* Tells PHPMailer to use SMTP. */
               $mail->isSMTP();

               /* SMTP server address. */
               $mail->Host = 'smtp.ionos.de';

               /* Use SMTP authentication. */
               $mail->SMTPAuth = TRUE;

               /* Set the encryption system. */
               $mail->SMTPSecure = 'tls';

               /* SMTP authentication username. */
               $mail->Username = 'noreply_chempo@rimpido.com';

               /* SMTP authentication password. */
               $mail->Password = 'M73YDxzQfp4NVeOnGHBK';

               /* Set the SMTP port. */
               $mail->Port = 587;

               /* Finally send the mail. */
               $mail->send();
                
                /*display success message */
                ?>
                    <div class="alert alert-success" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>A Verification code was sent to your email</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                    </div>
                <?php
                
            }
            catch (Exception $e)
            {
               /* PHPMailer exception. */
               echo $e->errorMessage();
            }
            catch (\Exception $e)
            {
               /* PHP exception (note the backslash to select the global namespace Exception class). */
               echo $e->getMessage();
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
<html lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: User Sign Up</title>
<!-- Favicon-->
<link rel="icon" href="assets/images/rimpido-header.png" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" href="assets/plugins/dropify/css/dropify.min.css">
<link rel="stylesheet" href="assets/plugins/sweetalert/sweetalert.css"/>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
 <style type="text/css">
   #frmCheckUsername {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
.demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;}
.status-available{color:#2FC332;}
.status-not-available{color:#D60202;}
 </style>
</head>

<body class="theme-blush " >
  
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

<div class="authentication " style="margin-top: 200px !important;">    
    <div class="container">
        <div class="row js-sweetalert">
            <div class="col-lg-5 col-sm-12">
                <form class="card auth_form" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="header">
                        <img class="logo" src="assets/images/rimpido-header.png" alt="">
                        <h5>Sign Up</h5>
                        <span>Register a new User</span>
                    </div>

                    <div class="body">
                        
                       <label for="remember_me">Are you working in a certain company ? *</label>
                        <div class="form-group">
                                    <div class=" inlineblock m-r-20">
                                        <input type="radio" name="company" id="yes" class="with-gap companyID"  value="option1" onclick='yes_company();' checked="">
                                        <label for="Yes">Yes</label>
                                    </div>                                
                                    <div class=" inlineblock">
                                        <input type="radio" name="company" id="no" class="with-gap companyID"  value="option2" onclick='no_company();'>
                                        <label for="No" >No</label>
                                    </div>
                         </div>
                         <div class="comp" id="comp">
                         <small>Company *</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="companyName">
                                      <option  value="0">Please Select</option>
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
                        <div class="input-group mb-3">
                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="salutation" >
                                        <option value="0">Mr.</option>
                                        <option value="1">Ms.</option>
                                        <option value="2">Mrs.</option>
                                    </select>
                        </div>
                         <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="First Name " name="firstName">
                           
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Middle Name " name="middleName">
                            
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Last Name " name="lastName">
                           
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Enter Email *" name="eMail" id="email" onBlur="checkEmailAvailability()" required="" onchange='check_email();' >
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                            </div>
                        </div>
                        <p id="email-availability-status" ></p>                       
                        
                        <div class="birthdate" id="birthdate">
                            
                        <label for="birthdate"><small>Birthdate *</small></label>
                        <div class="row">
                            
                          <div class="col-lg-4 col-sm-12">
                         <div class="btn-group">
                            
                                <select  id="select" class="form-control" name="birthdateYear">
                                    <?php

                                    for ($x = 1899; $x < 2040; $x++){
                                        echo "<option value=". $x .">". $x ."</option>";
                                     }
                                     ?>
                                </select>
                          </div>
                          </div> 
                          <div class="col-lg-4 col-sm-12">     
                           <div class="btn-group">
                                <select id="select" class="form-control" name="birthdateMonth">
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
                                </select>
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                           <div class="btn-group">
                                
                                    <select name="birthdateDay" id="select" class="form-control  btn-block">
                                        
                                        <?php

                                        for ($x = 1; $x < 32; $x++){
                                            echo "<option value=". $x .">". $x ."</option>";
                                        }
                                        ?>
                                    </select>
                                
                         </div>
                         </div>
                         </div>
                            </div><br>

                         
                            <div class="input-group mb-3">
                            <input name="userName" type="text" id="username" class="form-control" onBlur="checkAvailability()"  placeholder="Username *"required="">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>   
                            </div>
                            <p id="user-availability-status"></p> 
                        
                        <!--       
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Username *" name="userName" required="">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                      -->

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
                        
                        

                        <div class="checkbox">
                            <input id="remember_me" type="checkbox">
                            <!--<label for="remember_me">I read and agree to the <a href="javascript:void(0);">terms of usage</a></label>-->
                        </div>
                        <div style="font-style:italic; font-size:12px;text-align:center;">
                            <small>You may edit more information after logging in*</small>
                        </div>
                       <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" id="submit" name="submit">SUBMIT</button>
                        <div class="signin_with mt-3">
                            <a class="link" href="sign-in.php">You already have a membership?</a>
                        </div>
                    </div>
                </form>
                <div class="copyright text-center">
                    &copy;
                    <span><a href="#"></a>ChemPO</span>
                    <script>document.write(new Date().getFullYear())</script>
                    
                </div>
            </div>
            <div class="col-lg-7 col-sm-12">
              <img src="assets/images/signup_2.svg" alt="Sign Up" />
            </div>
            <!--
            <div class="col-lg-7 col-sm-12">
                <div class="card">
                    <img src="assets/images/signup.svg" alt="Sign Up" />
                </div>
            </div>
        -->
        </div>
    </div>
</div>
    
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
        document.getElementById('password').value = "";
        document.getElementById('confirmPassword').value = "";
        document.getElementById('password').focus();
    }


}

function no_company() {
    document.getElementById('comp').style.display='none';
    document.getElementById('birthdate').style.display='none';
}
    
function yes_company() {
    document.getElementById('comp').style.display='block';
    document.getElementById('birthdate').style.display='block'
}

</script>


<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 


<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="assets/js/pages/forms/advanced-form-elements.js"></script> 


<script src="assets/plugins/dropify/js/dropify.min.js"></script>
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/js/pages/forms/dropify.js"></script>


<script src="assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 
<script src="assets/js/pages/ui/sweetalert.js"></script>
</body>


</html>