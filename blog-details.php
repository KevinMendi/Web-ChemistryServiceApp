<?php
    
if (!isset($_SESSION))
{
    session_start();
}

/*if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in_time'])){
    header('Location:sign-in.php');
    exit;
}*/

function __autoload($class)
{
    require_once "classes/$class.php";
}

$content_ID = "";
$success = "";

//$addedComment = "";

if(isset($_GET['content']))
    {
        $content_ID = $_GET['content'];
    
        $_SESSION["initializedGet"] = $content_ID;
    
        $blogDetails = new Chempo();
    
        $result = $blogDetails->viewBlogContent($content_ID);
    }else
    {
        if (isset($_SESSION['initializedGet']))
        {
         $blogDetails = new Chempo();
    
         $result = $blogDetails->viewBlogContent($_SESSION['initializedGet']);   
        }
        else
        {
        header('Location:404.php');
        }
    }

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
    
{
    $comment_Name = test_input($_POST["comment_Name"]);
    $comment_Address = test_input($_POST["comment_Address"]);
    $comment_Content = test_input($_POST["comment_Content"]);
    $post_ID = $_SESSION['initializedGet'];
    
    $tableName = "chempo_comments";
    
    $comment_fields = [
        'comment_Name'=>$comment_Name,
        'comment_Address'=>$comment_Address,
        'comment_Content'=>$comment_Content,
        'post_ID'=>$post_ID  
    ];
    
    $initComment = new Chempo();
    
    $_SESSION["addedComment"] = $_SESSION['initializedGet'];
    
    $success = $initComment->insertComment($comment_fields, $tableName);
    
    
    
}

$viewComments = new Chempo();

$result2 = $viewComments->countComments($_SESSION['initializedGet']);


?>

<!doctype html>
<html class="no-js " lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
<title>:: Blog Details :: Chemistry Service Portal</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
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

<!-- Right Icon menu Sidebar -->

<!-- Left Sidebar -->

<!-- Right Sidebar -->

<section class="content" style="margin-right:auto; margin-left:auto;">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Blog Details</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item"><a href="bloglist.php">Blog</a></li>
                        <li class="breadcrumb-item active">Blog Details</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="blogitem mb-5">
                            <div class="blogitem-image">
                                <?php 
                                    if (is_null($result['blog_img']))
                                    {
                                ?>
                                <img src="assets/images/blog/blog-bleed.png" alt="blog image">
                                
                             
                                <?php
                                    }else
                                    {
                                        echo '<img src="img/blog-headers/'.$result['blog_img'].'" alt="blog image2" height="288px"/>';
                                    }
                                ?>
                                <span class="blogitem-date"><strong>Date Posted:</strong>
                                    <?php
                                    $dayofWeek = date("l", strtotime($result['date_posted']));
                                    
                                    echo $dayofWeek .', '. date('M d Y',strtotime($result['date_posted']));
                                    ?>
                                   </span>
                            </div>
                            <div class="blogitem-content">
                                <div class="blogitem-header">
                                    <div class="blogitem-meta">
                                        <span><i class="zmdi zmdi-account"></i>By <a href="javascript:void(0);">
                                        
                                            <?php 
                                                $initUser = new Chempo();
                                                
                                                $getUser = $initUser->readUserInfo($result['user_ID']);
                
                                                echo $getUser['f_name']." ".$getUser['l_name'];
                                            
                                            ?>
                                            
                                        </a></span>
                                       <!-- <span><i class="zmdi zmdi-comments"></i><a href="blog-details.html"><?php //echo $result2['commentCount']. " Comments"; ?></a></span>-->
                                    </div>
                                    <div class="blogitem-share">
                                      <ul class="list-unstyled mb-0">
                                            <li><div class="fb-share-button" data-href="https://chemistryservice.rimpido.com/blog-details.html?content=<?php echo $result["post_ID"]?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fchemistryservice.rimpido.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div></li>
                                            <li><script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
                                            <script type="IN/Share" data-url="https://www.linkedin.com"></script></li>
                                            <!--<li><a href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-twitter-box"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-linkedin-box"></i></a></li>-->
                                        </ul>
                                    </div>
                                </div>
                                <h3><?php echo $result['post_title']; ?></h3>
                                <?php 
                                
                                echo html_entity_decode($result['post_content']);
                                
                                ?>
                                <hr>
                            </div>
                        </div>
                    </div>
                    

                    
                </div>
                <div class="col-lg-4 col-md-12">
<!--                    <div class="card">
                        <div class="body search">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="zmdi zmdi-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>  -->                  
                    <div class="card">
                        <div class="header">
                            <h2><strong>BLOG Categories</strong></h2>                        
                        </div>
                        <div class="body">
                            <?php
                                $blogCats = new Chempo();
                            
                                $rowCat = $blogCats->viewBlogCat();
                                
                                foreach($rowCat as $row2)
                                {
                                    
                            ?>
                            <ul class="list-unstyled mb-0 widget-categories">
                                <li><a href="blog-categories.php?cat=<?php echo $row2["category_ID"]; ?>"><?php echo $row2["category_name"]; ?></a></li>
                            </ul>
                            <?php
                            
                                }    
                            ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Recent</strong> Posts</h2>
                        </div>
                        <div class="body">
                            <ul class="list-unstyled mb-0 widget-recentpost">
                                

                                <?php 
                                     $blogList = new Chempo();
            
                                    $rows = $blogList->searchBlogs("5");

                                    foreach($rows as $row)
                                    {
                                    
                                    
                                    ?>
                                    <li>
                                    <br>
                                    <div class="recentpost-content">
                                        <a href="blog-details.php?content=<?php echo $row["post_ID"]; ?>"><?php echo $row["post_title"]; ?></a>
                                        <span class="blogitem-date">
                                        <?php
                                        $dayofWeek = date("l", strtotime($row['date_posted']));

                                        echo $dayofWeek .', '. date('M d Y',strtotime($row['date_posted']));
                                        ?>
                                       </span>
                                    </div>
                                <?php
                                }        
                                ?>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!--<div class="card">
                        <div class="header">
                            <h2><strong>Tag</strong> Clouds</h2>                        
                        </div>
                        <div class="body">
                            <ul class="list-unstyled mb-0 tag-clouds">
                                <li><a href="javascript:void(0);" class="tag badge badge-default">Design</a></li>
                                <li><a href="javascript:void(0);" class="tag badge badge-success">Project</a></li>
                                <li><a href="javascript:void(0);" class="tag badge badge-info">Creative UX</a></li>
                                <li><a href="javascript:void(0);" class="tag badge badge-success">Wordpress</a></li>
                                <li><a href="javascript:void(0);" class="tag badge badge-warning">HTML5</a></li>
                            </ul>
                        </div>
                    </div>-->
                    <div class="card">
                        <div class="header">
                            <h2><strong>Facebook</strong> Page</h2>                        
                        </div>
                        <div class="body">
                            <ul class="list-unstyled mb-0 instagram-plugin">
                                <div class="fb-page" data-href="https://www.facebook.com/RimpidoPacificInc/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/RimpidoPacificInc/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/RimpidoPacificInc/">Rimpido Pacific Inc.</a></blockquote></div>
                            </ul>
                        </div>
                    </div>
                    <!--<div class="card">
                        <div class="header">
                            <h2><strong>Email</strong> Newsletter</h2>
                        </div>
                        <div class="body newsletter">                            
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter Email">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="zmdi zmdi-mail-send"></i></span>
                                </div>
                            </div>
                            <small>Get our products/news earlier than others, let’s get in touch.</small>
                        </div>
                    </div>-->
                </div>
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