<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: Add Chemical</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">

</head>

<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/loader.svg" width="48" height="48" alt="ChemPO"></div>
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
                    <h2>Add Chemical</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Chemicals</a></li>
                        <li class="breadcrumb-item active">Add Chemical</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>

        <!---Chemical Info -->
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Chemical</strong> General Information</h2>
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
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="CAS Number" name="casNumber" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="UN Number" name="unNumber" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Chemical Name" name="chemicalName" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="IUPAC Name" name="iupacName" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Commercial Name" name="commercialName" required>
                                </div>
                                
                                
                                <!--<button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Chemical</strong> Properties</h2>
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
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                                
                                <div class=" form-group form-float">
                                    
                                    <small>State of Matter</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="stateOfMatter">
                                        <option selected="">Please Select</option>
                                        <option>Not Applicable</option>
                                        <option>Solid</option>
                                        <option>Liquid</option>
                                        <option>Gas</option>
                                        <option>Plasma</option>
                                    </select>
                                </div>
                            
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Density" name="density" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="PH Value" name="phValue" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Boiling Point" name="boilingPoint" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Melting Point" name="meltingPoint" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Flash Point" name="flashPoint" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Refractive Index" name="refractiveIndex" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Molecular Weight" name="molecularWeight" required>
                                </div>
                                <div class=" form-group form-float">
                                    
                                    <small>Chemical Type</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="chemicalType">
                                        <option selected="">Please Select</option>
                                        <option>Mixture</option>
                                        <option>Pure Substance</option>
                                        
                                    </select>
                                </div>
                                
                                <!--<button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>GHS</strong> Label</h2>
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
                        </div>
                        <div class="body">
                            
                                <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS01.jpg">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <div class="checkbox">
                                        <input id="checkbox" type="checkbox" value="GHS01" name="ghs[]">
                                        <label for="checkbox"><b>GHS01</b></label>
                                        <h5>Exploding bomb</h5>
                                     <p>Danger Unstable<br>Explosive</p>
                                    </div>
                                </div>
                                <div class="body">
                           
                            <div class="checkbox">
                                <input id="checkbox10" type="checkbox">
                                <label for="checkbox10">
                                    Unchecked
                                </label>
                            </div>

                        </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS02.jpg">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <div class="checkbox">
                                        <input id="checkbox" type="checkbox" value="GHS02" name="ghs[]">
                                        <label for="checkbox"><b>GHS02</b></label>
                                        <h5>Flame</h5>
                                     <p>Danger or Warning<br>Flammable</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS03.jpg">
                                </div>
                               
                                <div class="form-group col-md-6">
                                    <div class="checkbox">
                                        <input id="checkbox" type="checkbox" value="GHS03" name="ghs[]">
                                        <label for="checkbox"><b>GHS03</b></label>
                                        <h5>Flame over circle</h5>
                                     <p>Danger or Warning<br>Oxidising</p>
                                    </div>
                                </div>
                
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS04.jpg">
                                </div>
                                
                                  <div class="form-group col-md-6">
                                    <div class="checkbox">
                                        <input id="checkbox" type="checkbox" value="GHS04" name="ghs[]">
                                        <label for="checkbox"><b>GHS04</b></label>
                                        <h5>Gas cylinder</h5>
                                     <p>Warning<br>Compressed Gas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS05.jpg">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <div class="checkbox">
                                        <input id="checkbox" type="checkbox" value="GHS05" name="ghs[]">
                                        <label for="checkbox"><b>GHS05</b></label>
                                        <h5>Corrosion</h5>
                                     <p>Danger or Warning<br>Corrosive cat. 1</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS06.jpg">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <div class="checkbox">
                                        <input id="checkbox" type="checkbox" value="GHS06" name="ghs[]">
                                        <label for="checkbox"><b>GHS06</b></label>
                                        <h5>Skull and crossbones</h5>
                                     <p>Danger<br>Toxic cat. 1 - 3</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS07.jpg">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <div class="checkbox">
                                        <input id="checkbox" type="checkbox" value="GHS07" name="ghs[]">
                                        <label for="checkbox"><b>GHS07</b></label>
                                        <h5>Exclamation Mark</h5>
                                     <p>Warning<br>Toxic cat. 4<br>Irritant cat. 2 or 3<br>Lower systematic health hazzards</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS08.jpg">
                                </div>
                                

                                <div class="form-group col-md-6">
                                    <div class="checkbox">
                                        <input id="checkbox" type="checkbox" value="GHS08" name="ghs[]">
                                        <label for="checkbox"><b>GHS08</b></label>
                                        <h5>Health hazard</h5>
                                     <p>Danger or Warning<br>Systematic health hazard</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS09.jpg">
                                </div>
                               
                                 <div class="form-group col-md-6">
                                    <div class="checkbox">
                                        <input id="checkbox" type="checkbox" value="GHS09" name="ghs[]">
                                        <label for="checkbox"><b>GHS09</b></label>
                                        <h5>Environment</h5>
                                     <p>Warning (for cat. 1)<br>(for cat. 2 no signal word)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    </div>  
                                
                                
                                <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>
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

<script src="assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Jquery Validation Plugin Css --> 
<script src="assets/plugins/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/forms/form-validation.js"></script> 
</body>


</html>