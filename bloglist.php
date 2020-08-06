<?php
if (!isset($_SESSION))
{
    session_start();
}

/*if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in_time'])){
    header('Location: sign-in.php');
    exit;
}*/

function __autoload($class)
{
    require_once "classes/$class.php";
}


?>

<!doctype html>
<html class="no-js " lang="en">


<head>
<style type="text/css">
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<title>:: Blog Lists || Chemistry Service Portal ::</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link  rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-blush">
    
<!--SHARE BUTTON FACEBOOK -->
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>

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


<!-- Left Sidebar -->
<!--<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="index.html"><img src="assets/images/logo.png" width="25" alt="Aero"><span class="m-l-10"></span></a>
    </div>
</aside>-->

<!-- Right Sidebar -->
<!--<aside id="rightsidebar" class="right-sidebar">
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
</aside>-->
    


<section class="content" style="margin-left:auto; margin-right:auto;">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Blog List</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item active"><a href="bloglist.php">Blog List</a></li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
               <!-- <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>-->
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <?php
            $blogList = new Chempo();
            
            $rows = $blogList->searchBlogs("10");
        
            foreach($rows as $row)
            {
        ?>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="blogitem mb-5">
                            <div class="blogitem-image">
                                <?php 
                                    if (is_null($row['blog_img']))
                                    {
                                ?>
                                <a href="blog-details.php?content=<?php echo $row["post_ID"]; ?>"><img src="assets/images/blog/blog-bleed.png" alt="blog image"></a>
                                <?php
                                    }else
                                    {
                                        echo '<a href="blog-details.html?content='. $row["post_ID"].'"><img src="img/blog-headers/'.$row['blog_img'].'" alt="blog image" height="288px"/></a>';
                                    }
                                ?>
                                <span class="blogitem-date">
                                    <?php
                                    $dayofWeek = date("l", strtotime($row['date_posted']));
                                    
                                    echo $dayofWeek .', '. date('M d Y',strtotime($row['date_posted']));
                                    ?>
                                   </span>
                            </div>
                            <div class="blogitem-content">
                                <div class="blogitem-header">
                                    <div class="blogitem-meta">
                                        <span><i class="zmdi zmdi-account"></i>By <a href="javascript:void(0);">
                                        
                                            <?php 
                                                $initUser = new Chempo();
                                                
                                                $getUser = $initUser->readUserInfo($row['user_ID']);
                
                                                echo $getUser['f_name']." ".$getUser['l_name'];
                                            
                                            ?>
                                            
                                        </a></span>
                                        <!--<span><i class="zmdi zmdi-comments"></i><a href="blog-details.html"></a></span>-->
                                    </div>
                                    <div class="blogitem-share">
                                        <ul class="list-unstyled mb-0">
                                            <li><div class="fb-share-button" data-href="https://chemistryservice.rimpido.com/blog-details.html?content=<?php echo $row["post_ID"]?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fchemistryservice.rimpido.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div></li>
                                            <!--LINKEDIN-->
                                             <li><script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
                                            <script type="IN/Share" data-url="https://www.linkedin.com"></script></li>
                                            <!--<li><a href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-twitter-box"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-linkedin-box"></i></a></li>-->
                                        </ul>
                                    </div>
                                </div>
                                <h5><a href="blog-details.php?content=<?php echo $row["post_ID"]; ?>"><?php echo $row['post_name']; ?></a></h5>
                                <?php 
                                    //echo html_entity_decode($string);
                                    /*echo substr(html_entity_decode($row['post_content']),209405, 700)."...";*/
                                    
                                    if (is_null($row['post_lead']))
                                    {
                                        echo "NO BLOG PREVIEW AVAILABLE";
                                    }else
                                    {
                                        echo $row['post_lead']."...";
                                    }
                                ?>
                                
                                <br><br>
                                <a href="blog-details.php?content=<?php echo $row["post_ID"]; ?>" class="btn btn-info">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
          }      
        ?>
            </div>
        </div>
    </div>
</section>
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
</body>


</html>