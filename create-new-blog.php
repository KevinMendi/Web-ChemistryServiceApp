<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

function __autoload($class)
{
    require_once "classes/$class.php";
}

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in_time'])){
    header('Location:https://chemistryservice.rimpido.com');
    exit;
}

$success = "";
$target = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $postContent = test_input($_POST["postContent"]);
    $postTitle = test_input($_POST["postTitle"]);
    $postName = test_input($_POST["postTitle"]);
    $postLead = test_input($_POST["postLead"]);
    $postCategory = test_input($_POST["postCategory"]);
    $postStatus = test_input($_POST["status"]);
    $user_ID = $_SESSION['user_id'];
    $date_posted = date("Y/m/d");
    
    $target = "img/blog-headers/";
    $target = $target . basename( $_FILES['blogImage']['name']);
    $pic=($_FILES['blogImage']['name']);
    
    $tableName = "chempo_posts";
    
    $blog_fields = [
        'user_ID'=>$user_ID,
        'date_posted'=>$date_posted,
        'post_content'=>$postContent,
        'post_title'=>$postTitle,
        'post_name'=>$postName,
        'post_lead'=>$postLead,
        'post_status'=>$postStatus,
        'post_category'=>$postCategory,
        'blog_img'=>$pic
    ];
    
    
    
    $ch = new Chempo();
    $success = $ch->insertBlog($blog_fields, $tableName);
    
    //echo html_entity_decode($postContent);
    
}


?>
<!doctype html>
<html class="no-js " lang="en">
<head>
    
        <style type="text/css">
            div:empty:before {
              content:attr(data-placeholder);
              color:gray
            }
        </style>
    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<title>:: Create New Blog Post :: Chemistry Service Portal by Rimpido</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/summernote/dist/summernote.css"/>
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
    <link rel="stylesheet" href="assets/plugins/dropify/css/dropify.min.css">
<!--HINT CSS-->
<link rel="stylesheet" href="assets/css/hint/dist/simple-hint.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
</head>
<body class="theme-blush ls-toggle-menu">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/logo.png" width="48" height="48" alt="Aero"></div>
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

<!-- Right Icon menu Sidebar -->
<div class="navbar-right">
    <ul class="navbar-nav">
        <li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        <li><a href="sign-in.html" class="mega-menu" title="Sign Out"><i class="zmdi zmdi-power"></i></a></li>
    </ul>
</div>

<!-- Left Sidebar -->
<!--<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="index.html"><img src="assets/images/logo.png" width="25" alt="Aero"><span class="m-l-10"></span></a>
    </div>
</aside>-->

<!-- Right Sidebar -->
<!--
<aside id="rightsidebar" class="right-sidebar">
    <div class="tab-content">
        <div class="tab-pane active" id="setting">
            <div class="slim_scroll">
                <div class="card">
                    <h6>Theme Option</h6>
                    <div class="light_dark">
                        <div class="radio">
                            <input type="radio" name="radio1" id="lighttheme" value="light" checked="">
                            <label for="lighttheme">Light Mode</label>
                        </div>
                        <div class="radio mb-0">
                            <input type="radio" name="radio1" id="darktheme" value="dark">
                            <label for="darktheme">Dark Mode</label>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h6>Color Skins</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple"><div class="purple"></div></li>                   
                        <li data-theme="blue"><div class="blue"></div></li>
                        <li data-theme="cyan"><div class="cyan"></div></li>
                        <li data-theme="green"><div class="green"></div></li>
                        <li data-theme="orange"><div class="orange"></div></li>
                        <li data-theme="blush" class="active"><div class="blush"></div></li>
                    </ul>                    
                </div>               
            </div>                
        </div>       

    </div>
</aside>
-->

<?php include_once('navbar.php') ?>

    
    
<section class="content blog-page">
    <?php 
        if($success=='1')
        {
            if(move_uploaded_file($_FILES['blogImage']['tmp_name'],$target))
            {
             echo '<div class="alert alert-success" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>Well done!</strong> You have successfully added a new blog content!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
            }else
            {
                echo '<div class="alert alert-danger" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>Error uploading image!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
            }
        }else if ($success=='0')
        {
           echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> A problem has occured when uploading your blog content. Please try again later.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>'; 
        }
    
    ?>
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>New Blog Post</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item"><a href="blog-dashboard.html">Blogs</a></li>
                        <li class="breadcrumb-item active">New Blog Post</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Blog</strong> Details</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <textarea name="postTitle" class="form-control" placeholder="Enter Blog title"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea name="postLead" class="form-control hint-right-middle" placeholder="Enter Blog LEAD (Usually the first 3-5 Sentences of the blog)" ></textarea>
                            </div>
                            <select class="form-control show-tick" name="postCategory">
                                <option value="0">Select Category --</option>
                                <option value="1">ChemPO Development News</option>
                                <option value="2">Regulatory News Regarding Chemicals</option>
                                <option value="3">News From Chemical Industry</option>
                            </select><br><br>
                            Post as: <div class="radio" name="post_Status">
                                <input type="radio" name="status" id="radio1" value="0">
                                <label for="radio1">Posted</label>
                                <input type="radio" name="status" id="radio2" value="1">
                                <label for="radio2">Draft</label>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Blog</strong> BANNER</h2>
                        </div>
                        <div class="body">
                            <p style="color:red;">*Upload size should be less than 200KB</p>
                            <input type="file" name="blogImage" class="dropify" data-max-file-size="200K">
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Blog</strong> Content</h2>
                        </div>
                        <div class="body">
                            <textarea class="summernote" name="postContent"></textarea>
                            <button type="submit" id="submit" class="btn btn-warning waves-effect m-t-20">POST</button>
                        </div>
                    </div>
                </div>            
            </div>
            </form>
        </div>
    </div>
    
    
    
  
</section>
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/dropzone/dropzone.js"></script> <!-- Dropzone Plugin Js -->
    
<script src="assets/plugins/dropify/js/dropify.min.js"></script>
<script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!--notification-->
    
<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="assets/plugins/summernote/dist/summernote.js"></script>
    
<script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
    <script src="assets/js/pages/forms/dropify.js"></script>

</body>


</html>