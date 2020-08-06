<?php
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


    $username = test_input($_POST['userUsername']);
    $password = test_input($_POST['userPassword']);



    $chemicals = new Chempo();
    $check = $chemicals->credentialCheck($username, $password);
    if($check === 0)
    {
        echo '<div class="alert alert-danger" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-block"></i>
                                    </div>
                                     Your Username or Password is Incorrect !
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
        //SET COOKIES FOR REMEMBER ME CHECKBOX (REMEMBER LOGIN CREDENTIALS)
        
        if($_POST["remember_me"] == '1' || $_POST["remember_me"] == 'on')
        {
            $hour = time() + 3600 * 24 * 30;
            setcookie('username',$username, $hour);
            setcookie('password',$password, $hour);
        }
        
       if($_SESSION['company_id'] == '0')
       {
        /*if ($_GET['try'] = 'density')
        {
            header('Location: calc-density.php');
        }
        else
        {*/
        $_SESSION['user-uid'] = $_SESSION['user_id'];
        header('Location: chemicals-list.php');
        /*}*/
       }
       else
       {
           /*if ($_GET['try'] = 'density')
           {
               header('Location: calc-density.php');
           }
           else
           {*/
               header('Location: index.php');
           /*}*/
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

<title>:: ChemPO :: Sign In</title>
<!-- Favicon-->
<link rel="icon" href="assets/images/rimpido-header.png" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.min.css">    
</head>

<body class="theme-blush">

<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12 card auth_form">
                
                    <div class="header">
                        <img class="logo" src="assets/images/rimpido-header.png" alt="">
                        <h5>Log in</h5>
                    </div>
                    <div class="body">
                         <?php 
                          if (isset($_COOKIE['username']) && isset($_COOKIE['password']))
                          {
                        ?>
                        <!-- IF COOKIE IS SET (REMEMBER ME) -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Username" name="username" id="userUsername" value="<?php echo $_COOKIE['username']; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="userPassword" value="<?php echo $_COOKIE['password']; ?>">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><a href="forgot-password.html" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>                            
                        </div>
                        
                        <div class="checkbox">
                            <input type="checkbox" name="remember_me" id="remember_me" checked>
                            <label for="remember_me">Remember Me</label>
                        </div>
                        <?php
                          } else {
                        ?>
                            <!-- COOKIE IS NOT SET -->
                            <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Username" name="username" id="userUsername">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="userPassword">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><a href="forgot-password.html" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>                            
                        </div>
                        
                        <div class="checkbox">
                            <input type="checkbox" name="remember_me" id="remember_me">
                            <label for="remember_me">Remember Me</label>
                        </div>
                        <?php
                          }
                        ?>
                        
                        <button class="btn btn-raised btn-block btn-primary waves-effect" id="btnSignIn" type="button" onclick='submitSignin();'>SIGN IN</button>                      
                        <div class="signin_with mt-3">
                            <p class="mb-0">No Account Yet? <a href="user-register.php">Sign Up Here!</a></p>
                            <!--<button class="btn btn-primary btn-icon btn-icon-mini btn-round facebook"><i class="zmdi zmdi-facebook"></i></button>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round twitter"><i class="zmdi zmdi-twitter"></i></button>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round google"><i class="zmdi zmdi-google-plus"></i></button>-->
                        </div>
                    </div>
                
                <div class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                    <span><a href="https://chemistryservice.rimpido.com">ChemPO</a></span>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <img src="assets/images/signin2.svg" alt="Sign In"/>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cookieNotice" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick='cookieCancel();'>&times;</button>
                <h4 class="modal-title">Cookies</h4>
            </div>
            <div class="modal-body">
                <p>This site uses cookies to offer you a better browsing experience. Find out more on <a href='http://www.rimpido.com/en/privacy.html'>how we use cookies and how you can change your settings.</a></p>
                <input type="text" id="username" name="userUsername" value="echo" hidden/>
                <input type="text" id="password" name="userPassword" value="echo" hidden/>
                <input type="text" id="rememberme" name="remember_me" value="echo" hidden/>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" id="accept_cookie">I accept cookies</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel_cookie" onclick='cookieCancel();'>I refuse cookies</button>
            </div>
            </form> 
        </div>
    </div>
</div>
   

<script type="text/javascript">

var input = document.getElementById("userPassword");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("btnSignIn").click();
  }
});
    
function submitSignin() {
    // Get the checkbox
    var checkBox = document.getElementById("remember_me");
    if (checkBox.checked == true) {
        document.getElementById('rememberme').value = '1';
    } else {
        document.getElementById('rememberme').value = '0';
    }
    var usernamePass = document.getElementById('userUsername').value;
    var passwordPass = document.getElementById('userPassword').value;
    document.getElementById('username').value = usernamePass;
    document.getElementById('password').value = passwordPass;
    $("#cookieNotice").modal();
}
    
function cookieCancel() {
    document.getElementById('remember_me').checked = false;
}
</script>
    
<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
</body>


</html>