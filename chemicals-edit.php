

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

if (isset($_POST['editChemical'])) {
    $pt = new Chempo();
    $uid  = $_POST['editChemical'];
   
    $result = $pt->readChemicalInfo($uid);

  
       
}



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if(isset($_POST['update-gen-info']) && $_SERVER["REQUEST_METHOD"] == "POST")
{



  $internalNo = test_input($_POST["internalNo"]);
  $casNumber = test_input($_POST["casNumber"]);
  $unNumber = test_input($_POST["unNumber"]);
  $ecNumber = test_input($_POST['ecNumber']);
  $reachNumber = test_input($_POST['reachNumber']);
  $chemicalName = test_input($_POST["chemicalName"]);
  $iupacName = test_input($_POST["iupacName"]);
  $commercialName = test_input($_POST["commercialName"]);

  $header_fields = [   
            'cas_no'=>$casNumber,
            'un_no'=>$unNumber,
            'ec_number'=>$ecNumber,
            'reach_number'=>$reachNumber,
            'begin_of_pname'=>$chemicalName,
            'iupac_name'=>$iupacName,
            'commercial_name'=>$commercialName

        ];
$headerTablename = "tb_chemical_header";
$whereClause = "chemical_header_id";
   $ch = new Chempo();
   $success = $ch->update($header_fields,$internalNo,$headerTablename,$whereClause); 
   if($success == '0')
   {
    echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem in updating this chemical.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   } 
   else{

      header("Location: chemicals-list.php");
      echo '<div class="alert alert-success" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>Well done!</strong> Succesfully Updated.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   }   
}



else if(isset($_POST['update-other-info']) && $_SERVER["REQUEST_METHOD"] == "POST")
{
  

  $internalNo = test_input($_POST["internalNo"]);
  $otherInfos = test_input($_POST["otherInfos"]);

  $header_fields = [   
          
            'other_infos'=>$otherInfos

        ];
  $headerTablename = "tb_chemical_header";
  $whereClause = "chemical_header_id";

   $ch = new Chempo();
   $success = $ch->update($header_fields,$internalNo,$headerTablename,$whereClause); 
   if($success == '0')
   {
    echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem in updating this chemical.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   } 
   else{

      header("Location:chemicals-list.php");
      echo '<div class="alert alert-success" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>Well done!</strong> Succesfully Updated.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   } 


}
else if(isset($_POST['update-chemical-properties']) && $_SERVER["REQUEST_METHOD"] == "POST")
{
  

  $internalNo = test_input($_POST["internalNo"]);
  $stateOfMatter = test_input($_POST["stateOfMatter"]);
  $density = test_input($_POST["density"]);
  $phValue = test_input($_POST["phValue"]);
  $boilingPoint = test_input($_POST["boilingPoint"]);
  $meltingPoint = test_input($_POST["meltingPoint"]);
  $flashPoint = test_input($_POST["flashPoint"]);
  $refractiveIndex = test_input($_POST["refractiveIndex"]);
  $molecularWeight = test_input($_POST["molecularWeight"]);
  $chemicalType = test_input($_POST["chemicalType"]);

  if($stateOfMatter == '0')
{
    $stateOfMatter = "";
}
else
{
    $stateOfMatter = $stateOfMatter;
}

if($chemicalType == '0')
{
    $chemicalType = "";
}
else
{
    $chemicalType = $chemicalType;
}
$propertiesTableName = "tb_chemical_properties";
  $whereClause = "chemical_header_id";

  $properties_fields = [   
            'state_of_matter'=>$stateOfMatter,
            'density'=>$density,
            'ph_value'=>$phValue,
            'boiling_point'=>$boilingPoint,
            'melting_point'=>$meltingPoint,
            'flash_point'=>$flashPoint,
            'refractive_index'=>$refractiveIndex,
            'molecular_weight'=>$molecularWeight,
            'chemical_type'=>$chemicalType
        ];


$ch = new Chempo();
$success = $ch->update($properties_fields,$internalNo,$propertiesTableName,$whereClause);
   if($success == '0')
   {
    echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem in updating this chemical.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   } 
   else{

      header("Location:chemicals-list.php");
      echo '<div class="alert alert-success" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>Well done!</strong> Succesfully Updated.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   } 

}
else if(isset($_POST['update-other-properties']) && $_SERVER["REQUEST_METHOD"] == "POST")
{

$propertiesTableName = "tb_chemical_properties";
$whereClause = "chemical_header_id";

$internalNo = test_input($_POST["internalNo"]);
$otherProperties = test_input($_POST["otherProperties"]);

  $properties_fields = [   
          
            'other_properties'=>$otherProperties
            
        ];

$ch = new Chempo();
$success = $ch->update($properties_fields,$internalNo,$propertiesTableName,$whereClause);
if($success == '0')
   {
    echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem in updating this chemical.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   } 
   else{
    header("Location:chemicals-list.php");
      echo '<div class="alert alert-success" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>Well done!</strong> Succesfully Updated.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   }



}
//hPhrases = good, General = good, prevention = good
else if(isset($_POST['update-hp-phrases']) && $_SERVER["REQUEST_METHOD"] == "POST")
{

  ///////////////////////////////////////////////
$hPhrases;

if(isset($_POST['hPhrases']))
{
$hPhrases = $_POST['hPhrases'];
}
else
{
  $hPhrases = NULL;
}


$pPhrases;
if(isset($_POST['pPhrases']))
{
$pPhrases = $_POST['pPhrases'];
}
else
{
  $pPhrases = NULL;
}


$pPhrases_prev;
if(isset($_POST['pPhrases_prev']))
{
$pPhrases_prev = $_POST['pPhrases_prev'];
}
else
{
  $pPhrases_prev = NULL;
}


$pPhrases_resp;
if(isset($_POST['pPhrases_resp']))
{
$pPhrases_resp = $_POST['pPhrases_resp'];
}
else
{
  $pPhrases_resp = NULL;
}


$pPhrases_storage;
if(isset($_POST['pPhrases_storage']))
{
$pPhrases_storage = $_POST['pPhrases_storage'];
}
else
{
  $pPhrases_storage = NULL;
}


$pPhrases_disp;
if(isset($_POST['pPhrases_disp']))
{
$pPhrases_disp = $_POST['pPhrases_disp'];
}
else
{
  $pPhrases_disp = NULL;
}
///////////////////////////////////////////////////

////////////////////////////////////////////////
$hPhrases1;
if(isset($_POST['hPhrases1']))
{
$hPhrases1 = $_POST['hPhrases1'];
}
else
{
  $hPhrases1 = NULL;
}


$pPhrases1;
if(isset($_POST['pPhrases1']))
{
$pPhrases1 = $_POST['pPhrases1'];
}
else
{
  $pPhrases1 = NULL;
}

$pPhrases_prev1;
if(isset($_POST['pPhrases_prev1']))
{
$pPhrases_prev1 = $_POST['pPhrases_prev1'];
}
else
{
  $pPhrases_prev1 = NULL;
}


$pPhrases_resp1;
if(isset($_POST['pPhrases_resp1']))
{
$pPhrases_resp1 = $_POST['pPhrases_resp1'];
}
else
{
  $pPhrases_resp1 = NULL;
}


$pPhrases_storage1;
if(isset($_POST['pPhrases_storage1']))
{
$pPhrases_storage1 = $_POST['pPhrases_storage1'];
}
else
{
  $pPhrases_storage1 = NULL;
}

$pPhrases_disp1;
if(isset($_POST['pPhrases_disp1']))
{
$pPhrases_disp1 = $_POST['pPhrases_disp1'];
}
else
{
  $pPhrases_disp1 = NULL;
}


///////////////////////////////////////////

$phrasesTableName = "tb_phrases";
$whereClause = "chemical_header_id";

$internalNo = test_input($_POST["internalNo"]);



////////////////////////////////////////////////////
$hphrasesMerge = array();

if((empty($hPhrases1)) && (!empty($hPhrases)))
{
  $hphrasesMerge = $hPhrases;
}
else if((empty($hPhrases)) && (!empty($hPhrases1)))
{
  $hphrasesMerge = $hPhrases1;
}
else if((!empty($hPhrases)) && (!empty($hPhrases1)))
{
  $hphrasesMerge = array_merge($hPhrases,$hPhrases1);
}
else
{
  $hphrasesMerge = NULL;
}


$pphrasesMerge = array();

if((empty($pPhrases1)) && (!empty($pPhrases)))
{
  $pphrasesMerge = $pPhrases;
}
else if((empty($pPhrases)) && (!empty($pPhrases1)))
{
  $pphrasesMerge = $pPhrases1;
}
else if((!empty($pPhrases)) && (!empty($pPhrases1)))
{
  $pphrasesMerge = array_merge($pPhrases,$pPhrases1);
}
else
{
  $pphrasesMerge = NULL;
}


$pphrases_prevMerge = array();

if((empty($pPhrases_prev1)) && (!empty($pPhrases_prev)))
{
  $pphrases_prevMerge = $pPhrases_prev;
}
else if((empty($pPhrases_prev)) && (!empty($pPhrases_prev1)))
{
  $pphrases_prevMerge = $pPhrases_prev1;
}
else if((!empty($pPhrases_prev)) && (!empty($pPhrases_prev1)))
{
  $pphrases_prevMerge = array_merge($pPhrases_prev,$pPhrases_prev1);
}
else
{
  $pphrases_prevMerge = NULL;
}


$pPhrases_respMerge = array();

if((empty($pPhrases_resp1)) && (!empty($pPhrases_resp)))
{
  $pPhrases_respMerge = $pPhrases_resp;
}
else if((empty($pPhrases_resp)) && (!empty($pPhrases_resp1)))
{
  $pPhrases_respMerge = $pPhrases_resp1;
}
else if((!empty($pPhrases_resp)) && (!empty($pPhrases_resp1)))
{
  $pPhrases_respMerge = array_merge($pPhrases_resp,$pPhrases_resp1);
}
else
{
  $pPhrases_respMerge = NULL;
}


$pPhrases_storageMerge = array();

if((empty($pPhrases_storage1)) && (!empty($pPhrases_storage)))
{
  $pPhrases_storageMerge = $pPhrases_storage;
}
else if((empty($pPhrases_storage)) && (!empty($pPhrases_storage1)))
{
  $pPhrases_storageMerge = $pPhrases_storage1;
}
else if((!empty($pPhrases_storage)) && (!empty($pPhrases_storage1)))
{
  $pPhrases_storageMerge = array_merge($pPhrases_storage,$pPhrases_storage1);
}
else
{
  $pPhrases_storageMerge = NULL;
}



$pPhrases_dispMerge = array();

if((empty($pPhrases_disp1)) && (!empty($pPhrases_disp)))
{
  $pPhrases_dispMerge = $pPhrases_disp;
}
else if((empty($pPhrases_disp)) && (!empty($pPhrases_disp1)))
{
  $pPhrases_dispMerge = $pPhrases_disp1;
}
else if((!empty($pPhrases_disp)) && (!empty($pPhrases_disp1)))
{
  $pPhrases_dispMerge = array_merge($pPhrases_disp,$pPhrases_disp1);
}
else
{
  $pPhrases_dispMerge = NULL;
}
////////////////////////////////////////////////////////////////
  //$hphrasesMerge = array_merge($hPhrases,$hPhrases1);
  //print_r($hphrases);
  //print_r($hPhrases);
  //print_r($hPhrases1);
  //print_r($hphrasesMerge);
 //////////////////////////////////////////////////////////// 
  if(empty($hphrasesMerge))
  {
    $hPhrasesMax = 0;
  }
  else
  {
    $hPhrasesMax = (int)max(array_keys($hphrasesMerge));
  }


  if(empty($pphrasesMerge))
  {
    $pPhrasesMax = 0;
  }
  else
  {
    $pPhrasesMax = (int)max(array_keys($pphrasesMerge));
  }


  if(empty($pphrases_prevMerge))
  {
    $pPhrases_prevMax = 0;
  }
  else
  {
    $pPhrases_prevMax = (int)max(array_keys($pphrases_prevMerge));
  }


  if(empty($pPhrases_respMerge))
  {
    $pPhrases_respMax = 0;
  }
  else
  {
    $pPhrases_respMax = (int)max(array_keys($pPhrases_respMerge));
  }


  if(empty($pPhrases_storageMerge))
  {
    $pPhrases_storageMax = 0;
  }
  else
  {
    $pPhrases_storageMax = (int)max(array_keys($pPhrases_storageMerge));
  }


  if(empty($pPhrases_dispMerge))
  {
    $pPhrases_dispMax = 0;
  }
  else
  {
    $pPhrases_dispMax = (int)max(array_keys($pPhrases_dispMerge));
  }
////////////////////////////////////////////////////////////////////  
  //echo $indexTemp2;

///////////////////////////

$hprases_fields = [];
  if($hPhrasesMax == 5)
  {
    
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>$hphrasesMerge[1],
            'hphrase3'=>$hphrasesMerge[2],
            'hphrase4'=>$hphrasesMerge[3],
            'hphrase5'=>$hphrasesMerge[4],
            'hphrase6'=>$hphrasesMerge[5]

        ];
  }
  else if ($hPhrasesMax == 4)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>$hphrasesMerge[1],
            'hphrase3'=>$hphrasesMerge[2],
            'hphrase4'=>$hphrasesMerge[3],
            'hphrase5'=>$hphrasesMerge[4],
            'hphrase6'=>NULL

        ];
  }
  else if ($hPhrasesMax == 3)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>$hphrasesMerge[1],
            'hphrase3'=>$hphrasesMerge[2],
            'hphrase4'=>$hphrasesMerge[3],
            'hphrase5'=>NULL,
            'hphrase6'=>NULL

        ];
  }
  else if ($hPhrasesMax == 2)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>$hphrasesMerge[1],
            'hphrase3'=>$hphrasesMerge[2],
            'hphrase4'=>NULL,
            'hphrase5'=>NULL,
            'hphrase6'=>NULL

        ];
  }
  else if ($hPhrasesMax == 1)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>$hphrasesMerge[1],
            'hphrase3'=>NULL,
            'hphrase4'=>NULL,
            'hphrase5'=>NULL,
            'hphrase6'=>NULL

        ];
  }
  else if ($hPhrasesMax == 0)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>NULL,
            'hphrase3'=>NULL,
            'hphrase4'=>NULL,
            'hphrase5'=>NULL,
            'hphrase6'=>NULL

        ];
  }
  else
  {

      $hphrases_fields = [ 
            'hphrase1'=>NULL,
            'hphrase2'=>NULL,
            'hphrase3'=>NULL,
            'hphrase4'=>NULL,
            'hphrase5'=>NULL,
            'hphrase6'=>NULL
            ];
  }
////////////////////////////////////////////////////////////////////END HS

////////////////////////////////////////////////////////////////////PS GENERAL
  $pprases_fields = [];
  if($pPhrasesMax == 5)
  {
    
    $pphrases_fields = [        
            'pphrase1'=>$pphrasesMerge[0],
            'pphrase2'=>$pphrasesMerge[1],
            'pphrase3'=>$pphrasesMerge[2],
            'pphrase4'=>$pphrasesMerge[3],
            'pphrase5'=>$pphrasesMerge[4],
            'pphrase6'=>$pphrasesMerge[5]

        ];
  }
  else if ($pPhrasesMax == 4)
  {
    $pphrases_fields = [        
            'pphrase1'=>$pphrasesMerge[0],
            'pphrase2'=>$pphrasesMerge[1],
            'pphrase3'=>$pphrasesMerge[2],
            'pphrase4'=>$pphrasesMerge[3],
            'pphrase5'=>$pphrasesMerge[4],
            'pphrase6'=>NULL

        ];
  }
  else if ($pPhrasesMax == 3)
  {
    $pphrases_fields = [        
            'pphrase1'=>$pphrasesMerge[0],
            'pphrase2'=>$pphrasesMerge[1],
            'pphrase3'=>$pphrasesMerge[2],
            'pphrase4'=>$pphrasesMerge[3],
            'pphrase5'=>NULL,
            'pphrase6'=>NULL

        ];
  }
  else if ($pPhrasesMax == 2)
  {
    $pphrases_fields = [        
            'pphrase1'=>$pphrasesMerge[0],
            'pphrase2'=>$pphrasesMerge[1],
            'pphrase3'=>$pphrasesMerge[2],
            'pphrase4'=>NULL,
            'pphrase5'=>NULL,
            'pphrase6'=>NULL

        ];
  }
  else if ($pPhrasesMax == 1)
  {
    $pphrases_fields = [        
            'pphrase1'=>$pphrasesMerge[0],
            'pphrase2'=>$pphrasesMerge[1],
            'pphrase3'=>NULL,
            'pphrase4'=>NULL,
            'pphrase5'=>NULL,
            'pphrase6'=>NULL

        ];
  }
  else if ($pPhrasesMax == 0)
  {
    $pphrases_fields = [        
            'pphrase1'=>$pphrasesMerge[0],
            'pphrase2'=>NULL,
            'pphrase3'=>NULL,
            'pphrase4'=>NULL,
            'pphrase5'=>NULL,
            'pphrase6'=>NULL

        ];
  }
  else
  {
    $pphrases_fields = [ 
            'pphrase1'=>NULL,
            'pphrase2'=>NULL,
            'pphrase3'=>NULL,
            'pphrase4'=>NULL,
            'pphrase5'=>NULL,
            'pphrase6'=>NULL
              ];

  }

////////////////////////////////////////////////////////////////END PS GENERAL

///////////////////////////////////////////////////////////////PS PREVENTION
 $pprases_prev_fields = [];
  if($pPhrases_prevMax == 5)
  {
    
    $pprases_prev_fields = [        
            'pphrase_prev1'=>$pphrases_prevMerge[0],
            'pphrase_prev2'=>$pphrases_prevMerge[1],
            'pphrase_prev3'=>$pphrases_prevMerge[2],
            'pphrase_prev4'=>$pphrases_prevMerge[3],
            'pphrase_prev5'=>$pphrases_prevMerge[4],
            'pphrase_prev6'=>$pphrases_prevMerge[5]

        ];
  }
  else if ($pPhrases_prevMax == 4)
  {
    $pprases_prev_fields = [        
            'pphrase_preve1'=>$pphrases_prevMerge[0],
            'pphrase_prev2'=>$pphrases_prevMerge[1],
            'pphrase_prev3'=>$pphrases_prevMerge[2],
            'pphrase_prev4'=>$pphrases_prevMerge[3],
            'pphrase_prev5'=>$pphrases_prevMerge[4],
            'pphrase_prev6'=>NULL

        ];
  }
  else if ($pPhrases_prevMax == 3)
  {
    $pprases_prev_fields = [        
            'pphrase_prev1'=>$pphrases_prevMerge[0],
            'pphrase_prev2'=>$pphrases_prevMerge[1],
            'pphrase_prev3'=>$pphrases_prevMerge[2],
            'pphrase_prev4'=>$pphrases_prevMerge[3],
            'pphrase_prev5'=>NULL,
            'pphrase_prev6'=>NULL

        ];
  }
  else if ($pPhrases_prevMax == 2)
  {
    $pprases_prev_fields = [        
            'pphrase_prev1'=>$pphrases_prevMerge[0],
            'pphrase_prev2'=>$pphrases_prevMerge[1],
            'pphrase_prev3'=>$pphrases_prevMerge[2],
            'pphrase_prev4'=>NULL,
            'pphrase_prev5'=>NULL,
            'pphrase_prev6'=>NULL

        ];
  }
  else if ($pPhrases_prevMax == 1)
  {
    $pprases_prev_fields = [        
            'pphrase_prev1'=>$pphrases_prevMerge[0],
            'pphrase_prev2'=>$pphrases_prevMerge[1],
            'pphrase_prev3'=>NULL,
            'pphrase_prev4'=>NULL,
            'pphrase_prev5'=>NULL,
            'pphrase_prev6'=>NULL

        ];
  }
  else if ($pPhrases_prevMax == 0)
  {
    $pprases_prev_fields = [        
            'pphrase_prev1'=>$pphrases_prevMerge[0],
            'pphrase_prev2'=>NULL,
            'pphrase_prev3'=>NULL,
            'pphrase_prev4'=>NULL,
            'pphrase_prev5'=>NULL,
            'pphrase_prev6'=>NULL

        ];
  } 
  else
  {
    $pprases_prev_fields = [ 
            'pphrase_prev1'=>NULL,
            'pphrase_prev2'=>NULL,
            'pphrase_prev3'=>NULL,
            'pphrase_prev4'=>NULL,
            'pphrase_prev5'=>NULL,
            'pphrase_prev6'=>NULL
            ];
  }

///////////////////////////////////////////////////////////////END PS PREVENTION

//////////////////////////////////////////////////////////////PS RESPONSE
    $pprases_resp_fields = [];
  if($pPhrases_respMax == 5)
  {
    
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_respMerge[0],
            'pphrase_res2'=>$pPhrases_respMerge[1],
            'pphrase_res3'=>$pPhrases_respMerge[2],
            'pphrase_res4'=>$pPhrases_respMerge[3],
            'pphrase_res5'=>$pPhrases_respMerge[4],
            'pphrase_res6'=>$pPhrases_respMerge[5]

        ];
  }
  else if ($pPhrases_respMax == 4)
  {
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_respMerge[0],
            'pphrase_res2'=>$pPhrases_respMerge[1],
            'pphrase_res3'=>$pPhrases_respMerge[2],
            'pphrase_res4'=>$pPhrases_respMerge[3],
            'pphrase_res5'=>$pPhrases_respMerge[4],
            'pphrase_res6'=>NULL

        ];
  }
  else if ($pPhrases_respMax == 3)
  {
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_respMerge[0],
            'pphrase_res2'=>$pPhrases_respMerge[1],
            'pphrase_res3'=>$pPhrases_respMerge[2],
            'pphrase_res4'=>$pPhrases_respMerge[3],
            'pphrase_res5'=>NULL,
            'pphrase_res6'=>NULL

        ];
  }
  else if ($pPhrases_respMax == 2)
  {
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_respMerge[0],
            'pphrase_res2'=>$pPhrases_respMerge[1],
            'pphrase_res3'=>$pPhrases_respMerge[2],
            'pphrase_res4'=>NULL,
            'pphrase_res5'=>NULL,
            'pphrase_res6'=>NULL

        ];
  }
  else if ($pPhrases_respMax == 1)
  {
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_respMerge[0],
            'pphrase_res2'=>$pPhrases_respMerge[1],
            'pphrase_res3'=>NULL,
            'pphrase_res4'=>NULL,
            'pphrase_res5'=>NULL,
            'pphrase_res6'=>NULL

        ];
  }
  else if ($pPhrases_respMax == 0)
  {
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_respMerge[0],
            'pphrase_res2'=>NULL,
            'pphrase_res3'=>NULL,
            'pphrase_res4'=>NULL,
            'pphrase_res5'=>NULL,
            'pphrase_res6'=>NULL

        ];
  } 
  else
  {
    $pprases_resp_fields = [ 
            'pphrase_res1'=>NULL,
            'pphrase_res2'=>NULL,
            'pphrase_res3'=>NULL,
            'pphrase_res4'=>NULL,
            'pphrase_res5'=>NULL,
            'pphrase_res6'=>NULL
            ];
  }

//////////////////////////////////////////////////////////////END PS RESPONSE

//////////////////////////////////////////////////////////////PS STORAGE
    $pprases_storage_fields = [];
  if($pPhrases_storageMax == 5)
  {
    
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storageMerge[0],
            'pphrase_storage2'=>$pPhrases_storageMerge[1],
            'pphrase_storage3'=>$pPhrases_storageMerge[2],
            'pphrase_storage4'=>$pPhrases_storageMerge[3],
            'pphrase_storage5'=>$pPhrases_storageMerge[4],
            'pphrase_storage6'=>$pPhrases_storageMerge[5]

        ];
  }
  else if ($pPhrases_storageMax == 4)
  {
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storageMerge[0],
            'pphrase_storage2'=>$pPhrases_storageMerge[1],
            'pphrase_storage3'=>$pPhrases_storageMerge[2],
            'pphrase_storage4'=>$pPhrases_storageMerge[3],
            'pphrase_storage5'=>$pPhrases_storageMerge[4],
            'pphrase_storage6'=>NULL

        ];
  }
  else if ($pPhrases_storageMax == 3)
  {
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storageMerge[0],
            'pphrase_storage2'=>$pPhrases_storageMerge[1],
            'pphrase_storage3'=>$pPhrases_storageMerge[2],
            'pphrase_storage4'=>$pPhrases_storageMerge[3],
            'pphrase_storage5'=>NULL,
            'pphrase_storage6'=>NULL

        ];
  }
  else if ($pPhrases_storageMax == 2)
  {
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storageMerge[0],
            'pphrase_storage2'=>$pPhrases_storageMerge[1],
            'pphrase_storage3'=>$pPhrases_storageMerge[2],
            'pphrase_storage4'=>NULL,
            'pphrase_storage5'=>NULL,
            'pphrase_storage6'=>NULL

        ];
  }
  else if ($pPhrases_storageMax == 1)
  {
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storageMerge[0],
            'pphrase_storage2'=>$pPhrases_storageMerge[1],
            'pphrase_storage3'=>NULL,
            'pphrase_storage4'=>NULL,
            'pphrase_storage5'=>NULL,
            'pphrase_storage6'=>NULL

        ];
  }
  else if ($pPhrases_storageMax == 0)
  {
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storageMerge[0],
            'pphrase_storage2'=>NULL,
            'pphrase_storage3'=>NULL,
            'pphrase_storage4'=>NULL,
            'pphrase_storage5'=>NULL,
            'pphrase_storage6'=>NULL

        ];
  }
  else
  {
    $pprases_storage_fields = [ 
            'pphrase_storage1'=>NULL,
            'pphrase_storage2'=>NULL,
            'pphrase_storage3'=>NULL,
            'pphrase_storage4'=>NULL,
            'pphrase_storage5'=>NULL,
            'pphrase_storage6'=>NULL
             ];
  } 

/////////////////////////////////////////////////////////////END PS STORAGE
/////////////////////////////////////////////////////////////PS DISPOSAL

  $pprases_disp_fields = [];
  if($pPhrases_dispMax == 5)
  {
    
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_dispMerge[0],
            'pphrase_disp2'=>$pPhrases_dispMerge[1],
            'pphrase_disp3'=>$pPhrases_dispMerge[2],
            'pphrase_disp4'=>$pPhrases_dispMerge[3],
            'pphrase_disp5'=>$pPhrases_dispMerge[4],
            'pphrase_disp6'=>$pPhrases_dispMerge[5]

        ];
  }
  else if ($pPhrases_dispMax == 4)
  {
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_dispMerge[0],
            'pphrase_disp2'=>$pPhrases_dispMerge[1],
            'pphrase_disp3'=>$pPhrases_dispMerge[2],
            'pphrase_disp4'=>$pPhrases_dispMerge[3],
            'pphrase_disp5'=>$pPhrases_dispMerge[4],
            'pphrase_disp6'=>NULL

        ];
  }
  else if ($pPhrases_dispMax == 3)
  {
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_dispMerge[0],
            'pphrase_disp2'=>$pPhrases_dispMerge[1],
            'pphrase_disp3'=>$pPhrases_dispMerge[2],
            'pphrase_disp4'=>$pPhrases_dispMerge[3],
            'pphrase_disp5'=>NULL,
            'pphrase_disp6'=>NULL

        ];
  }
  else if ($pPhrases_dispMax == 2)
  {
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_dispMerge[0],
            'pphrase_disp2'=>$pPhrases_dispMerge[1],
            'pphrase_disp3'=>$pPhrases_dispMerge[2],
            'pphrase_disp4'=>NULL,
            'pphrase_disp5'=>NULL,
            'pphrase_disp6'=>NULL


        ];
  }
  else if ($pPhrases_dispMax == 1)
  {
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_dispMerge[0],
            'pphrase_disp2'=>$pPhrases_dispMerge[1],
            'pphrase_disp3'=>NULL,
            'pphrase_disp4'=>NULL,
            'pphrase_disp5'=>NULL,
            'pphrase_disp6'=>NULL

        ];
  }
  else if ($pPhrases_dispMax == 0)
  {
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_dispMerge[0],
            'pphrase_disp2'=>NULL,
            'pphrase_disp3'=>NULL,
            'pphrase_disp4'=>NULL,
            'pphrase_disp5'=>NULL,
            'pphrase_disp6'=>NULL

        ];
  }
  else{
    $pprases_disp_fields = [ 
            'pphrase_disp1'=>NULL,
            'pphrase_disp2'=>NULL,
            'pphrase_disp3'=>NULL,
            'pphrase_disp4'=>NULL,
            'pphrase_disp5'=>NULL,
            'pphrase_disp6'=>NULL
               ];
  } 
/////////////////////////////////////////////////////////////END PS DISPOSAL

 $fk_field = [        
     'chemical_header_id'=>$internalNo

 ];

$phrases_fields = array_merge($hphrases_fields,$pphrases_fields,$pprases_prev_fields,$pprases_resp_fields,$pprases_storage_fields,$pprases_disp_fields,$fk_field);
print_r($phrases_fields);

 $ch = new Chempo();
$success = $ch->update($phrases_fields,$internalNo,$phrasesTableName,$whereClause);
if($success == '0')
   {
    echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem in updating this chemical.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   } 
   else{
     header("Location:chemicals-list.php");
      echo '<div class="alert alert-success" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>Well done!</strong> Succesfully Updated.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   }

}

else if(isset($_POST['update-ghs-label']) && $_SERVER["REQUEST_METHOD"] == "POST")
{

$ghsTableName = "tb_ghs_label_temp";
$whereClause = "chemical_header_id";

$internalNo = test_input($_POST["internalNo"]);
$signalWord = test_input($_POST["signalWord"]); 
  $ghs1 = (int)test_input($_POST["ghs1"]);
  $ghs2 = (int)test_input($_POST["ghs2"]);
  $ghs3 = (int)test_input($_POST["ghs3"]);
  $ghs4 = (int)test_input($_POST["ghs4"]);
  $ghs5 = (int)test_input($_POST["ghs5"]);
  $ghs6 = (int)test_input($_POST["ghs6"]);
  $ghs7 = (int)test_input($_POST["ghs7"]);
  $ghs8 = (int)test_input($_POST["ghs8"]);
  $ghs9 = (int)test_input($_POST["ghs9"]);


$ghs_fields = [ 
            'signal_word'=>$signalWord,       
            'ghs1'=>$ghs1,
            'ghs2'=>$ghs2,
            'ghs3'=>$ghs3,
            'ghs4'=>$ghs4,
            'ghs5'=>$ghs5,
            'ghs6'=>$ghs6,
            'ghs7'=>$ghs7,
            'ghs8'=>$ghs8,
            'ghs9'=>$ghs9,
            'chemical_header_id'=>$internalNo

        ];
$ch = new Chempo();
$success = $ch->update($ghs_fields,$internalNo,$ghsTableName,$whereClause);
if($success == '0')
{
  echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem in updating this chemical.
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
  header("Location:chemicals-list.php");
  echo '<div class="alert alert-success" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>Well done!</strong> Succesfully Updated.
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


<!DOCTYPE html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: Edit Chemical</title>
<link rel="icon" href="assets/images/logo.png" type="image/x-icon">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">

<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css" />
<!-- Colorpicker Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
<!-- Multi Select Css -->
<link rel="stylesheet" href="assets/plugins/multi-select/css/multi-select.css">
<!-- Bootstrap Spinner Css -->
<link rel="stylesheet" href="assets/plugins/jquery-spinner/css/bootstrap-spinner.css">
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<!-- Bootstrap Select Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<!-- noUISlider Css -->
<link rel="stylesheet" href="assets/plugins/nouislider/nouislider.min.css" />
<!-- Select2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">


    
<style type="text/css">
    .select2 {
        width: 100% !important;
    }
    
</style>

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
    <!--
    <form>
        <input type="search" value="" placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

-->
</div>
<!-- Navbar -->
<?php include_once('navbar.php') ?>

<section class="content">
    <div class="body_scroll">
        
   <!-- <form  action="" method="post"> -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Chemical</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Chemicals</a></li>
                        <li class="breadcrumb-item active">Edit Chemical</li>
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
            <form id="form_validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Chemical</strong> General Information</h2>
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
                        <div class="body">
                                
                                <input type="text"  name="internalNo" class="form-control" value="<?php echo $result['chemical_header_id']; ?>" hidden>
                                
                                
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  placeholder="CAS Number" name="casNumber" value="<?php echo $result['cas_no']; ?>" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  placeholder="UN Number" name="unNumber" value="<?php echo $result['un_no']; ?>">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="EC Number" name="ecNumber" value="<?php echo $result['ec_number']; ?>">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="REACH Number" name="reachNumber" value="<?php echo $result['reach_number']; ?>">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  placeholder="Chemical Name" name="chemicalName" value="<?php echo $result['begin_of_pname']; ?>" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  placeholder="IUPAC Name" name="iupacName" value="<?php echo $result['iupac_name']; ?>" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  placeholder="Commercial Name" name="commercialName" value="<?php echo $result['commercial_name']; ?>">
                                </div>
                                
                                <!--
                                <button class="btn btn-raised btn-primary waves-effect" name="submit-header" type="submit">SUBMIT</button>-->
                               <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" name="update-gen-info">Update General Information</button>
                            
                        </div>
                    </div>
                </div>
            </div>
          </form>

        </div>
        <div class="container-fluid">
            <!-- Basic Validation -->
            <form id="form_validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Other Informations</strong></h2>
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
                        <div class="body">
                            
                                
                                <div class=" form-group form-float">
                                  <div class="form-group">
                                    <input type="text"  name="internalNo" class="form-control" value="<?php echo $result['chemical_header_id']; ?>" hidden>
                                    <label for="other-info"><b>Other Informations</b></label>
                                    <p>Example: Chemical Description, df5, Systematic Names, Formula and etc.</p>
                                    <textarea class="form-control" rows="7" id="other-info" name="otherInfos" ><?php echo $result['other_infos']; ?></textarea>
                                  </div>
                                    
                                   
                                
                                <!--<button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            
                        </div>
                        <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" name="update-other-info">Update Other Information</button>
                    </div>
                </div>
            </div>
        </div>
      </form>
      </div>
        <div class="container-fluid">
            <!-- Basic Validation -->
            <form id="form_validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Chemical</strong> Properties</h2>
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
                        <div class="body">
                            
                                
                                <div class=" form-group form-float">
                                    <input type="text"  name="internalNo" class="form-control" value="<?php echo $result['chemical_header_id']; ?>" hidden>
                                    <small>State of Matter</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="stateOfMatter">
                                        <option value="<?php echo $result['state_of_matter']; ?>" selected>
                                        <?php 
                                     $state = $result['state_of_matter']; 
                                        if($state == '0')
                                        {
                                            $stateVal = "";
                                        }
                                        elseif ($state == '1') 
                                        {
                                             $stateVal = "Not Applicable";
                                        }
                                        elseif ($state == '2') 
                                        {
                                             $stateVal = "Solid";
                                        } 
                                        elseif ($state == '3') 
                                        {
                                             $stateVal = "Liquid";
                                        }
                                        elseif ($state == '4') 
                                        {
                                             $stateVal = "Gas";
                                        }
                                        elseif ($state == '5') 
                                        {
                                             $stateVal = "Plasma";
                                        } 

                                        echo $stateVal;   

                                    ?>
                                    </option>
                                        
                                        <option value="1">Not Applicable</option>
                                        <option value="2">Solid</option>
                                        <option value="3">Liquid</option>
                                        <option value="4">Gas</option>
                                        <option value="5">Plasma</option>
                                    </select>
                                </div>
                            
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Density" name="density" value="<?php echo $result['density']; ?>">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="PH Value" name="phValue" value="<?php echo $result['ph_value']; ?>">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Boiling Point" name="boilingPoint" value="<?php echo $result['boiling_point']; ?>">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Melting Point" name="meltingPoint" value="<?php echo $result['melting_point']; ?>">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Flash Point" name="flashPoint" value="<?php echo $result['flash_point']; ?>">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Refractive Index" name="refractiveIndex" value="<?php echo $result['refractive_index']; ?>">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Molecular Weight" name="molecularWeight" value="<?php echo $result['molecular_weight']; ?>">
                                </div>
                                <div class=" form-group form-float">
                                    
                                    <small>Chemical Type</small>

                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="chemicalType">
                                        <option value="<?php echo $result['chemical_type']; ?>"><?php 
                                     $type = $result['chemical_type']; 
                                        if($type == '0')
                                        {
                                            $typeVal = "";
                                        }
                                        elseif ($type == '1') 
                                        {
                                             $typeVal = "Not Data Available";
                                        }
                                        elseif ($type == '2') 
                                        {
                                             $typeVal = "Mixture";
                                        } 
                                        elseif ($type == '3') 
                                        {
                                             $typeVal = "Pure Substance";
                                        }
                                       

                                        echo $typeVal;   

                                    ?></option>
                                        
                                        <option value="1">No Data Available</option>
                                        <option value="2">Mixture</option>
                                        <option value="3">Pure Substance</option>
                                        
                                    </select>
                                </div>
                                
                                <!--<button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" name="update-chemical-properties">Update Chemical Properties</button>
                        </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
        <div class="container-fluid">
            <!-- Basic Validation -->
            <form id="form_validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>Other  <strong>Chemical Properties</strong></h2>
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
                        <div class="body">
                            
                                
                                <div class=" form-group form-float">
                                  <div class="form-group">
                                    <input type="text"  name="internalNo" class="form-control" value="<?php echo $result['chemical_header_id']; ?>" hidden>
                                    <label for="other-properties"><b>Other Information</b></label>
                                    <p>Example: Temperature, Pressure, Concentration and etc.</p>
                                    <textarea class="form-control" rows="7" id="other-properties" name="otherProperties" ><?php echo $result['other_properties']; ?></textarea>
                                  </div>
                                    
                                   
                                
                                <!--<button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            
                        </div>
                        <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" name="update-other-properties">Update Other Properties</button>
                    </div>
                </div>
            </div>
        </div>
      </form>
      </div>

        <div class="container-fluid">
          <form id="form_validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>H & P</strong> Phrases</h2>
                           
                        </div>
                        <!--
                        <div class="body">
                           
                           
                                <div class=" form-group form-float">
                                <small>Signal Word</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="signalWord">
                                        <option value="W">Warning</option>
                                        <option value="D">Danger</option>
                                       
                                        
                                    </select>
                                </div>
                               
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="ex. H201;H332;H400" name="hPhrases" >
                                    <small>Enter up to six GHS H-Phrase codes separated by semi-colon (;). The corresponding Phrases will be detected automatically and printed in the selected language.</small>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="ex. P260;P264" name="pPhrases" >
                                    <small>Enter up to six GHS P-Phrase codes separated by  semi-colon (;). The corresponding Phrases will be detected automatically and printed in the selected language.</small>
                                </div>
                          
                            
                        </div>
                      -->
                     
                      <div class="body">
                        <div class="row clearfix">
<!--      Start of H Phrases      -->                                 
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  <input type="text"  name="internalNo" class="form-control" value="<?php echo $result['chemical_header_id']; ?>" hidden>
                                  <small><b>Hazard Statements</b></small>
                  <!------------------------------------>
                                    <select style="height: 100px !important; border-top: none !important;" class="form-control show-tick ms select2" multiple data-placeholder="Click Here ! to add H phrases" name="hPhrases1[]" data-maximum-selection-length="6">
                                          <?php
                                  
                                  for ($a=1; $a < 7; $a++) { 
                                    if($result['hphrase'.$a] != '' || $result['hphrase'.$a] != '')
                                    {

                                    ?>
                                     <option value="<?php echo $result['hphrase'.$a]; ?>" selected=""><?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['hphrase'.$a]);
                                    echo $result['hphrase'.$a].' - '. $phrasetext['phrasentext']; 
                                    ?></option>
                                <?php

                                    }
                                  }

                                  ?>
                                    
                                    
                                <?php
                                  
                                  $rows = $ch->hphrasesList();
                                   foreach ($rows as $row) 
                                    {
                                       $count = 0;
                                       if ($count < 7) {
                                           $count++;
                                       }
                                       if($result['hphrase'.$a] === $row['hphrase'])
                                       {
                                           
                                       }else {

                                  ?>
                                   <option value="<?php echo $row['h_phrasencode']; ?>"><?php echo $row['hphrase']; ?></option>

                                   <?php 
                                           }
                                    }
                                   ?>
                                    </select>
                                    

                                </div>
<!--      End of H Phrases      -->
<!--      Start of P Phrases      -->                                  
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>General</b> </small>
                                   <select style="height: 100px !important ;" class="form-control show-tick ms select2" multiple  name="pPhrases[]">
                                     <?php

                                  for ($b=1; $b < 7; $b++) { 
                                    if($result['pphrase'.$b] != '' || $result['pphrase'.$b] != '')
                                    {

                                    ?>
                                     <option value="<?php echo $result['pphrase'.$b]; ?>" selected=""><?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['pphrase'.$b]);
                                    echo $result['pphrase'.$b].' - '. $phrasetext['phrasentext']; 
                                    ?></option>
                                <?php

                                    }
                                  }

                                  ?>
                                    </select>
                  <!------------------------------------>
                                    <select style="height: 100px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Click Here ! to add P phrases" name="pPhrases1[]">
                                          <?php
                                  
                                  $rows = $ch->pphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['p_phrasencode']; ?>"><?php echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
<!--      End of P Phrases      -->  
<!--      Start of Prevention      --> 
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>Prevention</b> </small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple  name="pPhrases_prev[]">
                                    <?php

                                  for ($c=1; $c < 7; $c++) { 
                                    if($result['pphrase_prev'.$c] != '' || $result['pphrase_prev'.$c] != '')
                                    {

                                    ?>
                                     <option value="<?php echo $result['pphrase_prev'.$c]; ?>" selected=""><?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['pphrase_prev'.$c]);
                                    echo $result['pphrase_prev'.$c].' - '. $phrasetext['phrasentext']; 
                                    ?></option>
                                <?php

                                    }
                                  }

                                  ?>
                                  
                                    </select>
                  <!------------------------------------>
                                    <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Click Here ! to add P phrases" name="pPhrases_prev1[]">
                                       <?php
                                 
                                  $rows = $ch->pphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['p_phrasencode']; ?>"><?php echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
<!--      End of Prevention      --> 
<!--      Start of Response      --> 
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                    <small>Precautionary Statements: <b>Response</b></small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple  name="pPhrases_resp[]">
                                    <?php

                                  for ($d=1; $d < 7; $d++) { 
                                    if($result['pphrase_res'.$d] != '' || $result['pphrase_res'.$d] != '')
                                    {

                                    ?>
                                     <option value="<?php echo $result['pphrase_res'.$d]; ?>" selected=""><?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['pphrase_res'.$d]);
                                    echo $result['pphrase_res'.$d].' - '. $phrasetext['phrasentext']; 
                                    ?></option>
                                <?php

                                    }
                                  }

                                  ?>

                                    </select>
                  <!------------------------------------>
                                    <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Click Here ! to add P phrases" name="pPhrases_resp1[]">
                                       <?php
                                  
                                  $rows = $ch->pphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['p_phrasencode']; ?>"><?php echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
<!--      End of Response      -->
<!--      Start of Storage      -->
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>Storage</b> </small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple  name="pPhrases_storage[]">

                                    <?php

                                  for ($e=1; $e < 7; $e++) { 
                                    if($result['pphrase_storage'.$e] != '' || $result['pphrase_storage'.$e] != '')
                                    {

                                    ?>
                                     <option value="<?php echo $result['pphrase_storage'.$e]; ?>" selected=""><?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['pphrase_storage'.$e]);
                                    echo $result['pphrase_storage'.$e].' - '. $phrasetext['phrasentext']; 
                                    ?></option>
                                <?php

                                    }
                                  }

                                  ?>
                                         
                                    </select>
                  <!------------------------------------>
                                    <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Click Here ! to add P phrases" name="pPhrases_storage1[]">
                                      <?php
                                  
                                  $rows = $ch->pphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['p_phrasencode']; ?>"><?php echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
<!--      end of Storage      -->
<!--      Start of Disposal      -->
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>Disposal</b> </small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple  name="pPhrases_disp[]">
                                    <?php

                                  for ($f=1; $f < 7; $f++) { 
                                    if($result['pphrase_disp'.$f] != '' || $result['pphrase_disp'.$f] != '')
                                    {

                                    ?>
                                     <option value="<?php echo $result['pphrase_disp'.$f]; ?>" selected=""><?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['pphrase_disp'.$f]);
                                    echo $result['pphrase_disp'.$f].' - '. $phrasetext['phrasentext']; 
                                    ?></option>
                                <?php

                                    }
                                  }

                                  ?>
                                         
                                    </select>
                  <!------------------------------------>
                                    <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Click Here ! to add P phrases" name="pPhrases_disp1[]">
                                      <?php
                                  
                                  $rows = $ch->pphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['p_phrasencode']; ?>"><?php echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
<!--      end of Disposal      -->                        
                   
                        </div><br>
                          <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" name="update-hp-phrases">Update H & P Phrases</button>
                      </div>

                     



                    </div>
                </div>
            </div>
          </form>
        </div>

        <div class="container-fluid">
            <!-- Basic Validation -->
            <form id="form_validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>GHS</strong> Label</h2>
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
                         



                        <div class="body">
                            
                                <div class="form-row">
                        <div class="col-lg-12 col-sm-12 mb-1">
                                  <input type="text"  name="internalNo" class="form-control" value="<?php echo $result['chemical_header_id']; ?>" hidden>
                        <div class=" form-group form-float">
                                <small><b>Signal Word</b></small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="signalWord">
                                         <option value="<?php echo $result['signal_word']; ?>" selected>
                                            <?php
                                            $sw = $result['signal_word']; 
                                        if($sw == 'D')
                                        {
                                            $swVal = "Danger";
                                        }
                                        elseif ($sw == 'W') 
                                        {
                                             $swVal = "Warning";
                                        }
                                        
                                       

                                        echo $swVal; 

                                            ?>


                                        </option>
                                        <option value="W">Warning</option>
                                        <option value="D">Danger</option>
                                       
                                        
                                    </select>
                                </div>
                              </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS01.png">
                                </div>
                                <input type="text"  name="internalNo" class="form-control" value="<?php echo $result['chemical_header_id']; ?>" hidden>
                                <div class="form-group col-md-6">
                                    <div class="form-check">
                                        
                                        <?php
                                        $ghs1 = (int)$result['ghs1'];
                                        if($ghs1 == 1)
                                        {
                                        ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs1" checked>
                                        <?php
                                        }
                                        else
                                        {

                                        ?>
                                           <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs1">
                                        <?php
                                        }

                                        ?>


                                      
                                        <label for="checkbox"><b>GHS01</b></label>
                                        <h5>Exploding bomb</h5>
                                        <p>Danger Unstable<br>Explosive</p>
                                    </div>
                              
                                </div>
                                

                                
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS02.png">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                        <?php
                                        $ghs2 = (int)$result['ghs2'];
                                        if($ghs2 == 1)
                                        {
                                        ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs2" checked>
                                        <?php
                                        }
                                        else
                                        {

                                        ?>
                                           <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs2">
                                        <?php
                                        }

                                        ?>

                                        
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
                                    <img src="img/GHS03.png">
                                </div>
                               
                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                         <?php
                                        $ghs3 = (int)$result['ghs3'];
                                        if($ghs3 == 1)
                                        {
                                        ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs3" checked>
                                        <?php
                                        }
                                        else
                                        {

                                        ?>
                                           <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs3">
                                        <?php
                                        }

                                        ?>
                                        
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
                                    <img src="img/GHS04.png">
                                </div>
                                
                                  <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                         <?php
                                        $ghs4 = (int)$result['ghs4'];
                                        if($ghs4 == 1)
                                        {
                                        ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs4" checked>
                                        <?php
                                        }
                                        else
                                        {

                                        ?>
                                           <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs4">
                                        <?php
                                        }

                                        ?>
                                        
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
                                    <img src="img/GHS05.png">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                         <?php
                                        $ghs5 = (int)$result['ghs5'];
                                        if($ghs5 == 1)
                                        {
                                        ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs5" checked>
                                        <?php
                                        }
                                        else
                                        {

                                        ?>
                                           <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs5">
                                        <?php
                                        }

                                        ?>
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
                                    <img src="img/GHS06.png">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                         <?php
                                        $ghs6 = (int)$result['ghs6'];
                                        if($ghs6 == 1)
                                        {
                                        ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs6" checked>
                                        <?php
                                        }
                                        else
                                        {

                                        ?>
                                           <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs6">
                                        <?php
                                        }

                                        ?>
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
                                    <img src="img/GHS07.png">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                         <?php
                                        $ghs7 = (int)$result['ghs7'];
                                        if($ghs7 == 1)
                                        {
                                        ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs7" checked>
                                        <?php
                                        }
                                        else
                                        {

                                        ?>
                                           <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs7">
                                        <?php
                                        }

                                        ?>
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
                                    <img src="img/GHS08.png">
                                </div>
                                

                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                         <?php
                                        $ghs8 = (int)$result['ghs8'];
                                        if($ghs8 == 1)
                                        {
                                        ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs8" checked>
                                        <?php
                                        }
                                        else
                                        {

                                        ?>
                                           <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs8">
                                        <?php
                                        }

                                        ?>
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
                                    <img src="img/GHS09.png">
                                </div>
                               
                                 <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                         <?php
                                        $ghs9 = (int)$result['ghs9'];
                                       if($ghs9 == 1)
                                        {
                                        ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs9" checked>
                                        <?php
                                        }
                                        else
                                        {

                                        ?>
                                           <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs9">
                                        <?php
                                        }

                                        ?>
                                        <label for="checkbox"><b>GHS09</b></label>
                                        <h5>Environment</h5>
                                     <p>Warning (for cat. 1)<br>(for cat. 2 no signal word)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    </div>  
                                
                                
                               <!-- <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" name="update-ghs-label">Update GHS Label</button>
                        </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
                <!--<button type="submit" class="btn btn-info" name="submit">Save</button>-->
               <!-- <button class="btn btn-raised btn-primary waves-effect" type="submit" name="edit-chemical">SUBMIT</button> -->
    
    </div>
</section>

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Jquery Validation Plugin Css --> 
<script src="assets/plugins/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/forms/form-validation.js"></script>



<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> <!-- Select2 Js -->


  <script type="text/javascript">
      
      
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
  </script>
        
<script src="assets/js/pages/forms/advanced-form-elements.js"></script>   
</body>


</html>