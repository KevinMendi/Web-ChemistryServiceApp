<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

/*
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in_time'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: sign-in.php');
    exit;
}

*/

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


$companyName = test_input($_POST["companyName"]);
$companyAddress = test_input($_POST["companyAddress"]);
$zipOrPostal = test_input($_POST["zipOrPostal"]);
$telephoneNumber = test_input($_POST["telephoneNumber"]);
$faxNumber = test_input($_POST["faxNumber"]);
$emailAddress = test_input($_POST["emailAddress"]);
$homepageLink = test_input($_POST["homepageLink"]);
$subscription = test_input($_POST["subscribe"]);

$target = "img/companies-logo/";
$target = $target . basename( $_FILES['companyLogo']['name']);
$pic=($_FILES['companyLogo']['name']);
$tableName = "tb_companies";


$company_fields = [   
            'company_name'=>$companyName,
            'company_address1'=>$companyAddress,
            'company_zip_postal'=>$zipOrPostal,
            'company_tel_no'=>$telephoneNumber,
            'company_fax'=>$faxNumber,
            'company_email'=>$emailAddress,
            'homepage_link'=>$homepageLink,
            'company_logo'=>$pic,
            'comp_priority'=>$subscription
        ];


        
       $ch = new Chempo();
       $success = $ch->insert($company_fields,$tableName);
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
        
        if ($subscription == '0')
        {
        if(move_uploaded_file($_FILES['companyLogo']['tmp_name'],$target))
            { 
                
               
                header('Location: user-register.php');
               
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
        }else if ($subscription == '1')
        {
             if(move_uploaded_file($_FILES['companyLogo']['tmp_name'],$target))
            { 
                
               
                header('Location: thankyou.php');
               
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











}





?>
<!doctype html>
<html lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: Company Sign Up</title>
<!-- Favicon-->
<link rel="icon" href="assets/images/rimpido-header.png" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" href="assets/plugins/dropify/css/dropify.min.css">
<link rel="stylesheet" href="assets/plugins/sweetalert/sweetalert.css"/>
    
<style type="text/css">
.pricingdiv{
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  font-family: 'Source Sans Pro', Arial, sans-serif;
}

.pricingdiv ul.theplan{
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  border-top-left-radius: 50px;
  border-bottom-right-radius: 50px;
  color: white;
  background: #7c3ac9;
  position: relative;
  width: 250px; /* width of each table */
  margin-right: 150px; /* spacing between tables */
  margin-bottom: 1em;
  transition: all .5s;
}

.pricingdiv ul.theplan:hover{ /* when mouse hover over pricing table */
  transform: scale(1.02);
  transition: all .5s;
  z-index: 100;
  box-shadow: 0 0 10px gray;
}

.pricingdiv ul.theplan li{
  margin: 10px 20px;
  position: relative;
}

.pricingdiv ul.theplan li.title{
  font-size: 150%;
  font-weight: bold;
  text-align: center;
  margin-top: 20px;
  text-transform: uppercase;
  border-bottom: 5px solid white;
}

.pricingdiv ul.theplan:nth-of-type(2){
  background: #e53499;
}
    
.pricingdiv ul.theplan:nth-of-type(3){
  background: #2a2cc8;
}

.pricingdiv ul.theplan:last-of-type{ /* remove right margin in very last table */
  margin-right: 0;
}

/*very last LI within each pricing UL */
.pricingdiv ul.theplan li:last-of-type{
  text-align: center;
  margin-top: auto; /*align last LI (price botton li) to the very bottom of UL */
}  

.pricingdiv a.pricebutton{
  background: white;
  text-decoration: none;
  padding: 10px;
  display: inline-block;
  margin: 10px auto;
  border-radius: 5px;
  color: navy;
  text-transform: uppercase;
}

@media only screen and (max-width: 500px) {
  .pricingdiv ul.theplan{
    border-radius: 0;
    width: 100%;
    margin-right: 10px;
  }
  
  .pricingdiv ul.theplan:hover{
    transform: none;
    box-shadow: none;
  }
  
  .pricingdiv a.pricebutton{
    display: block;
  }
}       
</style>
    
</head>

<body class="theme-blush " >

<div class="authentication " style="margin-top: 30% !important;">    
    <div class="container">
        <div class="row js-sweetalert">
            <div class="col-lg-12 col-sm-12">
                <form class="card auth_form" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="header">
                        <img class="logo" src="assets/images/rimpido-header.png" alt="">
                        <h5>Sign Up</h5>
                        <span>Register a new Company</span>
                    </div>

                    <div class="body">
                        
                       <div class="form-group form-float">
                           <input type="text" class="form-control" placeholder="Company Name *" name="companyName" required="">
                        </div>
                        <div class="form-group form-float">
                           <input type="text" class="form-control" placeholder="Company Complete Address *" name="companyAddress" required="">
                        </div>
                        <div class="form-group form-float">
                           <input type="text" class="form-control" placeholder="Zip or Postal *" name="zipOrPostal" required>
                        </div>
                        <div class="input-group masked-input mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="zmdi zmdi-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control mobile-phone-number" placeholder="Telephone Number *" name="telephoneNumber" required>
                        </div>
                        <div class="input-group masked-input mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="zmdi zmdi-account-box-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control mobile-phone-number" placeholder="Fax Number *" name="faxNumber" required>
                        </div>
                         <div class="input-group masked-input mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                        </div>
                                        <input type="text" class="form-control email" placeholder="eMail address *" name="emailAddress" id="email" onchange='check_email();' required>
                          </div>
                          <div class="form-group form-float">
                           <input type="url" class="form-control" placeholder="Homepage Link *" name="homepageLink" required>
                        </div>
                        <div class="card">
                        
                        
                            <label>Upload Your Company logo *</label>
                            <input type="file" class="dropify" data-max-file-size="100K" name="companyLogo" required>
                            <small>Please upload file not larger than 100 KB</small>
                        
                        </div>
                        <center>
                            
                            
                            
<!--                        <div class="row">
                            <div class="col-md-4">lkjlkjlkjasdf</div>
                            <div class="col-md-4">asdfasdfasdfa</div>
                            <div class="col-md-4">qwerqwerqwers</div>
                        </div>-->
                            
                        </center>
                        
                <div class="row">
                <div class="col-lg-6">
                    <div class="card pricing pricing-item">
                        <div class="pricing-deco l-slategray">
                            <svg class="pricing-deco-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" y="0px">
                                <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729&#x000A;	c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                                <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729&#x000A;	c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                                <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716&#x000A;	H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                                <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428&#x000A;	c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                            </svg>
                            <div class="pricing-price"><span class="pricing-currency">$</span>0.00 <span class="pricing-period">/ mo</span>
                            </div>
                            <h3 class="pricing-title">BASIC/FREE</h3>
                        </div>
                        <div class="body">
                            <ul class="feature-list list-unstyled">
                                <li>Free Tool Use: <strong>Yes</strong></li>
                                <li>Access to all label sizes: <strong style="color:red">Limited</strong></li>
                                <li>Possibility to save a backlink for each product: <strong style="color:red">No</strong></li>
                                <li>Use of your own logos on labels: <strong style="color:red">No</strong></li>                
                                <li>Presentation of your products online: <strong style="color:red">No</strong></li>
                                <br><br><br>
                                <li><div class="radio">
                                <input type="radio" name="subscribe" id="radio2" value="0">
                                <label for="radio2">Select Plan</label>
                                </div></li>
                            </ul>
                        </div>
                    </div>
                </div>
                        
                        
                <div class="col-lg-6">
                    <div class="card pricing pricing-item">
                        <div class="pricing-deco l-blue">
                            <svg class="pricing-deco-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" y="0px">
                                <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729&#x000A;	c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                                <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729&#x000A;	c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                                <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716&#x000A;	H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                                <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428&#x000A;	c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                            </svg>
                            <div class="pricing-price"><span class="pricing-currency"><h3>Available upon quotation</h3></span>   
                            </div>
                            <h3 class="pricing-title">PAID</h3>
                        </div>
                        <div class="body">
                            <ul class="feature-list list-unstyled">
                               <li>Free Tool Use: <strong>Yes</strong></li>
                                <li>Access to all label sizes: <strong>Unlimited</strong></li>
                                <li>Possibility to save a backlink for each product: <strong>Yes</strong></li>
                                <li>Use of your own logos on labels: <strong>Yes</strong></li>    
                                <li>Presentation of your products online: <strong>Yes</strong></li>
                                <li style="color:red;">More Features Available upon Quotation: <strong>Yes</strong></li>
                                <li><div class="radio">
                                <input type="radio" name="subscribe" id="radio1" value="1">
                                <label for="radio1">Select Plan</label>
                                </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>   
                        
                        
                        <!--
                        <div class="checkbox">
                            <input id="remember_me" type="checkbox">
                            <label for="remember_me">I read and agree to the <a href="javascript:void(0);">terms of usage</a></label>
                        </div>
                    -->

                        

                        <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" id="submit">SUBMIT</button>
                        <div class="signin_with mt-3">
                            <a class="link" href="sign-in.html">You already have a membership?</a>
                        </div>
                    </div>
                </form>
                <div class="copyright text-center">
                    &copy;
                    <span><a href="#"></a>ChemPO</span>
                    <script>document.write(new Date().getFullYear())</script>
                    
                </div>
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
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    
    if(document.getElementById('email').value.match(mailformat)) {
         
    }
    else {
          alert("You have entered an invalid email address.");
          document.getElementById('email').value="";
    }
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