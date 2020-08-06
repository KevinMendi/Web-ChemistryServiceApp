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


if (isset($_POST['delete-chemical']) && $_SERVER["REQUEST_METHOD"] == "POST") {


$chemicalID = test_input($_POST["chemicalID"]);
$tableName = "chempo_posts";
$whereClause = "post_ID";
$ch = new Chempo();

$fields = [ 
         
            'post_status'=>'0'
           
        ];

$check = $ch->deleteBlog($fields,$chemicalID,$tableName,$whereClause);

if($check == 1)
{
    header("Location: blog-list-table.php");
}
else
{
    echo "Error Updating!";
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

<title>:: ChemPO :: List of Blogs</title>
<link rel="icon" href="assets/images/logo.png" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/sweetalert/sweetalert.css"/>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Custom Css -->
<link  rel="stylesheet" href="assets/css/style.min.css">
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
                    <h2>List of Draft Blogs</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item">Blogs</li>
                        <li class="breadcrumb-item active">Draft Blog List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <!--<h2><strong>Basic</strong> Examples </h2>-->
                            <!--
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right slideUp">
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
                        <div class="body">
                            
                            <div class="table-responsive">
                                <form action="edit-Blog.php" method="post">  
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>

                                        <tr>
                                            <th>Blog Title</th>
                                            <th>Blog Summary</th>
                                            <th>Actions</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    
                                    <tfoot>
                                        <tr>
                                            
                                            <th>Blog Title</th>
                                            <th>Blog Summary</th>
                                            <th>Actions</th>
                                            
                                           
                                        </tr>
                                    </tfoot>
                                    
                                    <tbody>
                                        <?php
                                        $ch = new Chempo();
                                        $rows = $ch->searchDrafts();
                                        
                                        foreach ($rows as $row)
                                        {
                                            ?>
                                                <tr>
                                                <th scope="row"><?php echo $row['post_title'] ?></th>
                                                <th scope="row"><?php echo $row['post_lead'] ?></th>
                                                <th>
                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editBlog" value="<?php echo $row['post_ID']; ?>" onclick='gotoAction("edit");'><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button> &nbsp;
                                                <a href="blog-details.php?content=<?php echo $row["post_ID"]; ?>" class="btn btn-sm btn-outline-info waves-effect" name="viewBlog"><i class="zmdi zmdi-edit" ></i>&nbsp;View</a> &nbsp;
                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row["post_ID"]; ?>"><i class="zmdi zmdi-edit" ></i>&nbsp;Undo Delete/ Post</button> &nbsp;
                                                </th>
                                                </tr>
                                            <?php
                                        }
                                        
                                        ?>
                                    </tbody>
                                
                                </table>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exportable Table -->
            
        </div>

<script type="text/javascript">
    $(".passingID").click(function () {
    var ids = $(this).attr('data-id');
    $("#chemicalID").val( ids );
   
    $("#delete-chemical").val( ids );
    $('#myModal').modal('show');
});
</script>
        
<script>
function gotoAction(action_name){
    document.getElementById('userAction').action;
    if(action_name == "edit"){
        document.getElementById('userAction').action = "company-edit.php";
        document.getElementById('userAction').submit();
    }
}        
</script>

<!--///////////////////////////////////////////////Delete Modal//////////////// -->
<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title" id="exampleModalLongTitle"><i class="zmdi zmdi-alert-triangle"></i></i>&nbsp;Confirm</h5><br>
        </div>
        <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal-body">
          Are you sure you want to Repost this Blog ?<br>
            <br>
            <input type="text" class="form-control" name="chemicalID" id="chemicalID" value="" hidden="">
         
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn btn-outline-danger waves-effect" name="delete-chemical" value="">&nbsp;Yes</button>
            
          

        </div>
        </form>
      </div>
      
    </div>
  </div>





</section>


<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<!-- Jquery DataTable Plugin Js --> 
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/tables/jquery-datatable.js"></script>


</body>


</html>