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

if (isset($_POST['submitdata']) && $_SERVER["REQUEST_METHOD"] == "POST") {

  $internalNo = test_input($_POST["internalNo"]);
  $casNumber = test_input($_POST["casNumber"]);
  $unNumber = test_input($_POST["unNumber"]);
  $chemicalName = test_input($_POST["chemicalName"]);
  $iupacName = test_input($_POST["iupacName"]);


  
  $stateOfMatter = test_input($_POST["stateOfMatter"]);
  
if(isset($_POST["density"])) {
  $densityValue = test_input($_POST["density"]);
  $densityUnit = test_input($_POST["densityUnit"]);
  $density = $densityValue." ".$densityUnit;
} else {
  $density = null;
}

    
 if (isset($_POST['phValueSingle'])) {
     $phValue = test_input($_POST["phValueMin"]); 
 } else {
     $phValueMin = test_input($_POST['phValueMin']);
     $phValueMax = test_input($_POST['phValueMax']);
     $phValue = $phValueMin."-".$phValueMax;
 }
    
if(isset($_POST["phValueMin"]) || isset($_POST['phValueMax'])){
    
}else{
    $phValue = null;
}
    
  
if (isset($_POST['boilingPointSingle'])) {
    $boilingPointValue = test_input($_POST["boilingPointMin"]);
    $boilingPointUnit = test_input($_POST["boilingPointUnit"]);
    $boilingPoint = $boilingPointValue." ".$boilingPointUnit;
} else {
    $boilingPointMin = test_input($_POST["boilingPointMin"]);
    $boilingPointMax = test_input($_POST["boilingPointMax"]);
    $boilingPointUnit = test_input($_POST["boilingPointUnit"]);
    $boilingPoint = $boilingPointMin."-".$boilingPointMax." ".$boilingPointUnit;
}

if(isset($_POST["boilingPointMin"]) || isset($_POST["boilingPointMax"])){
    
}else{
    $boilingPoint = null;
}
    
if (isset($_POST['meltingPointSingle'])) {
    $meltingPointValue = test_input($_POST["meltingPointMin"]);
    $meltingPointUnit = test_input($_POST["meltingPointUnit"]);
    $meltingPoint = $meltingPointValue." ".$meltingPointUnit;
} else {
    $meltingPointMin = test_input($_POST["meltingPointMin"]);
    $meltingPointMax = test_input($_POST["meltingPointMax"]);
    $meltingPointUnit = test_input($_POST["meltingPointUnit"]);
    $meltingPoint = $meltingPointMin."-".$meltingPointMax." ".$meltingPointUnit;
}

if(isset($_POST["meltingPointMin"]) || isset($_POST["meltingPointMax"])){
    
}else{
    $meltingPoint = null;
}
    

  if(isset($_POST["flashPoint"])) {
    $flashPointValue = test_input($_POST["flashPoint"]);
    $flashPointUnit = test_input($_POST["flashPointUnit"]);
    $flashPoint = $flashPointValue." ".$flashPointUnit;  
  } else {
    $flashPoint = null;
  }
  
  if(isset($_POST["refractiveIndex"])) {
      $refractiveIndex = test_input($_POST["refractiveIndex"]);
  } else {
      $refractiveIndex = null;
  }
  
  if(isset($_POST["molecularWeight"])) {
      $molecularWeightValue = test_input($_POST["molecularWeight"]);
      $molecularWeightUnit = test_input($_POST["molecularWeightUnit"]);
      $molecularWeight = $molecularWeightValue." ".$molecularWeightUnit;
  }else {
      $molecularWeight = null;
  }
  
    
  $chemicalType = test_input($_POST["chemicalType"]);

  $signalWord = test_input($_POST["signalWord"]);

 $ecNumber = test_input($_POST['ecNumber']);
 $reachNumber = test_input($_POST['reachNumber']);
 $ufi = test_input($_POST['ufi']);

  $propertiesTableName = "tb_chemical_properties";
  $phrasesTableName = "tb_phrases";
  $ghsTableName = "tb_ghs_label_temp";
    
  $headerTablename = "tb_chemical_header";
  $whereClause = "chemical_header_id";


  $user_id_session = $_SESSION['user_id'];
   $header_fields = [   
            'cas_no'=>$casNumber,
            'un_no'=>$unNumber,
            'ec_number'=>$ecNumber,
            'reach_number'=>$reachNumber,
            'begin_of_pname'=>$chemicalName,
            'iupac_name'=>$iupacName,
            'ufi'=>$ufi,
            'user_id'=>$user_id_session

        ];
        
       $ch = new Chempo();
    
    $successHeader = $ch->update($header_fields,$internalNo, $headerTablename, $whereClause);
       
    if($successHeader == '0')
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
       
       $successProperties = $ch->update($properties_fields,$internalNo,$propertiesTableName,$whereClause);
       if ($successProperties == '0') {
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
       } else {
           $ghsTableName = "tb_ghs_label_temp";
            $whereClause = "chemical_header_id";

            $internalNo = test_input($_POST["internalNo"]);
            $signalWord = test_input($_POST["signalWord"]);
              if(isset($_POST["ghs1"])) {
                  $ghs1 = (int)test_input($_POST["ghs1"]);
              } else {
                  $ghs1 = 0;
              }
              if(isset($_POST["ghs2"])) {
                  $ghs2 = (int)test_input($_POST["ghs2"]);
              } else {
                  $ghs2 = 0;
              }
              if(isset($_POST["ghs3"])) {
                  $ghs3 = (int)test_input($_POST["ghs3"]);
              } else {
                  $ghs3 = 0;
              }
              if(isset($_POST["ghs4"])) {
                  $ghs4 = (int)test_input($_POST["ghs4"]);
              } else {
                  $ghs4 = 0;
              }
              if(isset($_POST["ghs5"])) {
                  $ghs5 = (int)test_input($_POST["ghs5"]);
              } else {
                  $ghs5 = 0;
              }
              if(isset($_POST["ghs6"])) {
                  $ghs6 = (int)test_input($_POST["ghs6"]);
              } else {
                  $ghs6 = 0;
              }
              if(isset($_POST["ghs7"])) {
                  $ghs7 = (int)test_input($_POST["ghs7"]);
              } else {
                  $ghs7 = 0;
              }
              if(isset($_POST["ghs8"])) {
                  $ghs8 = (int)test_input($_POST["ghs8"]);
              } else {
                  $ghs8 = 0;
              }
              if(isset($_POST["ghs9"])) {
                  $ghs9 = (int)test_input($_POST["ghs9"]);
              } else {
                  $ghs9 = 0;
              }

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
            $successGHS = $ch->update($ghs_fields,$internalNo,$ghsTableName,$whereClause);
           if($successGHS == '0') {
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
           } else {
               
                $phrasesTableName = "tb_phrases";
                $whereClause = "chemical_header_id";


                
                if(isset($_POST['hPhrases']))
                {
                $hPhrases = $_POST['hPhrases'];
                }
                else
                {
                  $hPhrases = NULL;
                }


                $pPhrases = array();
                if(isset($_POST['pPhrases']))
                {
                $pPhrases = $_POST['pPhrases'];
                }
                else
                {
                  $pPhrases = NULL;
                }


                $pPhrases_prev = array();
                if(isset($_POST['pPhrases_prev']))
                {
                $pPhrases_prev = $_POST['pPhrases_prev'];
                }
                else
                {
                  $pPhrases_prev = NULL;
                }


                $pPhrases_resp = array();
                if(isset($_POST['pPhrases_resp']))
                {
                $pPhrases_resp = $_POST['pPhrases_resp'];
                }
                else
                {
                  $pPhrases_resp = NULL;
                }


                $pPhrases_storage = array();
                if(isset($_POST['pPhrases_storage']))
                {
                $pPhrases_storage = $_POST['pPhrases_storage'];
                }
                else
                {
                  $pPhrases_storage = NULL;
                }


                $pPhrases_disp = array();
                if(isset($_POST['pPhrases_disp']))
                {
                $pPhrases_disp = $_POST['pPhrases_disp'];
                }
                else
                {
                  $pPhrases_disp = NULL;
                }
                
                if(empty($hPhrases))
                  {
                    $hPhrasesMax = 0;
                  }
                  else
                  {
                    $hPhrasesMax = (int)max(array_keys($hPhrases));
                  }

                  if(empty($pPhrases))
                  {
                    $pPhrasesMax = 0;
                  }
                  else
                  {
                    $pPhrasesMax = (int)max(array_keys($pPhrases));
                  }


                  if(empty($pPhrases_prev))
                  {
                    $pPhrases_prevMax = 0;
                  }
                  else
                  {
                    $pPhrases_prevMax = (int)max(array_keys($pPhrases_prev));
                  }


                  if(empty($pPhrases_resp))
                  {
                    $pPhrases_respMax = 0;
                  }
                  else
                  {
                    $pPhrases_respMax = (int)max(array_keys($pPhrases_resp));
                  }


                  if(empty($pPhrases_storage))
                  {
                    $pPhrases_storageMax = 0;
                  }
                  else
                  {
                    $pPhrases_storageMax = (int)max(array_keys($pPhrases_storage));
                  }


                  if(empty($pPhrases_disp))
                  {
                    $pPhrases_dispMax = 0;
                  }
                  else
                  {
                    $pPhrases_dispMax = (int)max(array_keys($pPhrases_disp));
                  }
                
               
                $hphrasesMerge = array();

                $hprases_fields = [];
                  if($hPhrasesMax == 5)
                  {

                    $hphrases_fields = [        
                            'hphrase1'=>$hPhrases[0],
                            'hphrase2'=>$hPhrases[1],
                            'hphrase3'=>$hPhrases[2],
                            'hphrase4'=>$hPhrases[3],
                            'hphrase5'=>$hPhrases[4],
                            'hphrase6'=>$hPhrases[5]

                        ];
                  }
                  else if ($hPhrasesMax == 4)
                  {
                    $hphrases_fields = [        
                            'hphrase1'=>$hPhrases[0],
                            'hphrase2'=>$hPhrases[1],
                            'hphrase3'=>$hPhrases[2],
                            'hphrase4'=>$hPhrases[3],
                            'hphrase5'=>$hPhrases[4]

                        ];
                  }
                  else if ($hPhrasesMax == 3)
                  {
                    $hphrases_fields = [        
                            'hphrase1'=>$hPhrases[0],
                            'hphrase2'=>$hPhrases[1],
                            'hphrase3'=>$hPhrases[2],
                            'hphrase4'=>$hPhrases[3]

                        ];
                  }
                  else if ($hPhrasesMax == 2)
                  {
                    $hphrases_fields = [        
                            'hphrase1'=>$hPhrases[0],
                            'hphrase2'=>$hPhrases[1],
                            'hphrase3'=>$hPhrases[2]

                        ];
                  }
                  else if ($hPhrasesMax == 1)
                  {
                    $hphrases_fields = [        
                            'hphrase1'=>$hPhrases[0],
                            'hphrase2'=>$hPhrases[1]

                        ];
                  }
                  else if ($hPhrasesMax == 0)
                  {
                    $hphrases_fields = [        
                            'hphrase1'=>$hPhrases[0]

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
                            'pphrase1'=>$pPhrases[0],
                            'pphrase2'=>$pPhrases[1],
                            'pphrase3'=>$pPhrases[2],
                            'pphrase4'=>$pPhrases[3],
                            'pphrase5'=>$pPhrases[4],
                            'pphrase6'=>$pPhrases[5]

                        ];
                  }
                  else if ($pPhrasesMax == 4)
                  {
                    $pphrases_fields = [        
                            'pphrase1'=>$pPhrases[0],
                            'pphrase2'=>$pPhrases[1],
                            'pphrase3'=>$pPhrases[2],
                            'pphrase4'=>$pPhrases[3],
                            'pphrase5'=>$pPhrases[4]

                        ];
                  }
                  else if ($pPhrasesMax == 3)
                  {
                    $pphrases_fields = [        
                            'pphrase1'=>$pPhrases[0],
                            'pphrase2'=>$pPhrases[1],
                            'pphrase3'=>$pPhrases[2],
                            'pphrase4'=>$pPhrases[3]

                        ];
                  }
                  else if ($pPhrasesMax == 2)
                  {
                    $pphrases_fields = [        
                            'pphrase1'=>$pPhrases[0],
                            'pphrase2'=>$pPhrases[1],
                            'pphrase3'=>$pPhrases[2]

                        ];
                  }
                  else if ($pPhrasesMax == 1)
                  {
                    $pphrases_fields = [        
                            'pphrase1'=>$pPhrases[0],
                            'pphrase2'=>$pPhrases[1]

                        ];
                  }
                  else if ($pPhrasesMax == 0)
                  {
                    $pphrases_fields = [        
                            'pphrase1'=>$pPhrases[0]

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
                            'pphrase_prev1'=>$pPhrases_prev[0],
                            'pphrase_prev2'=>$pPhrases_prev[1],
                            'pphrase_prev3'=>$pPhrases_prev[2],
                            'pphrase_prev4'=>$pPhrases_prev[3],
                            'pphrase_prev5'=>$pPhrases_prev[4],
                            'pphrase_prev6'=>$pPhrases_prev[5]

                        ];
                  }
                  else if ($pPhrases_prevMax == 4)
                  {
                    $pprases_prev_fields = [        
                            'pphrase_preve1'=>$pPhrases_prev[0],
                            'pphrase_prev2'=>$pPhrases_prev[1],
                            'pphrase_prev3'=>$pPhrases_prev[2],
                            'pphrase_prev4'=>$pPhrases_prev[3],
                            'pphrase_prev5'=>$pPhrases_prev[4]

                        ];
                  }
                  else if ($pPhrases_prevMax == 3)
                  {
                    $pprases_prev_fields = [        
                            'pphrase_prev1'=>$pPhrases_prev[0],
                            'pphrase_prev2'=>$pPhrases_prev[1],
                            'pphrase_prev3'=>$pPhrases_prev[2],
                            'pphrase_prev4'=>$pPhrases_prev[3]

                        ];
                  }
                  else if ($pPhrases_prevMax == 2)
                  {
                    $pprases_prev_fields = [        
                            'pphrase_prev1'=>$pPhrases_prev[0],
                            'pphrase_prev2'=>$pPhrases_prev[1],
                            'pphrase_prev3'=>$pPhrases_prev[2]

                        ];
                  }
                  else if ($pPhrases_prevMax == 1)
                  {
                    $pprases_prev_fields = [        
                            'pphrase_prev1'=>$pPhrases_prev[0],
                            'pphrase_prev2'=>$pPhrases_prev[1]

                        ];
                  }
                  else if ($pPhrases_prevMax == 0)
                  {
                    $pprases_prev_fields = [        
                            'pphrase_prev1'=>$pPhrases_prev[0]

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
                            'pphrase_res1'=>$pPhrases_resp[0],
                            'pphrase_res2'=>$pPhrases_resp[1],
                            'pphrase_res3'=>$pPhrases_resp[2],
                            'pphrase_res4'=>$pPhrases_resp[3],
                            'pphrase_res5'=>$pPhrases_resp[4],
                            'pphrase_res6'=>$pPhrases_resp[5]

                        ];
                  }
                  else if ($pPhrases_respMax == 4)
                  {
                    $pprases_resp_fields = [        
                            'pphrase_res1'=>$pPhrases_resp[0],
                            'pphrase_res2'=>$pPhrases_resp[1],
                            'pphrase_res3'=>$pPhrases_resp[2],
                            'pphrase_res4'=>$pPhrases_resp[3],
                            'pphrase_res5'=>$pPhrases_resp[4]

                        ];
                  }
                  else if ($pPhrases_respMax == 3)
                  {
                    $pprases_resp_fields = [        
                            'pphrase_res1'=>$pPhrases_resp[0],
                            'pphrase_res2'=>$pPhrases_resp[1],
                            'pphrase_res3'=>$pPhrases_resp[2],
                            'pphrase_res4'=>$pPhrases_resp[3]

                        ];
                  }
                  else if ($pPhrases_respMax == 2)
                  {
                    $pprases_resp_fields = [        
                            'pphrase_res1'=>$pPhrases_resp[0],
                            'pphrase_res2'=>$pPhrases_resp[1],
                            'pphrase_res3'=>$pPhrases_resp[2]

                        ];
                  }
                  else if ($pPhrases_respMax == 1)
                  {
                    $pprases_resp_fields = [        
                            'pphrase_res1'=>$pPhrases_resp[0],
                            'pphrase_res2'=>$pPhrases_resp[1]

                        ];
                  }
                  else if ($pPhrases_respMax == 0)
                  {
                    $pprases_resp_fields = [        
                            'pphrase_res1'=>$pPhrases_resp[0]

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
                            'pphrase_storage1'=>$pPhrases_storage[0],
                            'pphrase_storage2'=>$pPhrases_storage[1],
                            'pphrase_storage3'=>$pPhrases_storage[2],
                            'pphrase_storage4'=>$pPhrases_storage[3],
                            'pphrase_storage5'=>$pPhrases_storage[4],
                            'pphrase_storage6'=>$pPhrases_storage[5]

                        ];
                  }
                  else if ($pPhrases_storageMax == 4)
                  {
                    $pprases_storage_fields = [        
                            'pphrase_storage1'=>$pPhrases_storage[0],
                            'pphrase_storage2'=>$pPhrases_storage[1],
                            'pphrase_storage3'=>$pPhrases_storage[2],
                            'pphrase_storage4'=>$pPhrases_storage[3],
                            'pphrase_storage5'=>$pPhrases_storage[4]

                        ];
                  }
                  else if ($pPhrases_storageMax == 3)
                  {
                    $pprases_storage_fields = [        
                            'pphrase_storage1'=>$pPhrases_storage[0],
                            'pphrase_storage2'=>$pPhrases_storage[1],
                            'pphrase_storage3'=>$pPhrases_storage[2],
                            'pphrase_storage4'=>$pPhrases_storage[3]

                        ];
                  }
                  else if ($pPhrases_storageMax == 2)
                  {
                    $pprases_storage_fields = [        
                            'pphrase_storage1'=>$pPhrases_storage[0],
                            'pphrase_storage2'=>$pPhrases_storage[1],
                            'pphrase_storage3'=>$pPhrases_storage[2]

                        ];
                  }
                  else if ($pPhrases_storageMax == 1)
                  {
                    $pprases_storage_fields = [        
                            'pphrase_storage1'=>$pPhrases_storage[0],
                            'pphrase_storage2'=>$pPhrases_storage[1]

                        ];
                  }
                  else if ($pPhrases_storageMax == 0)
                  {
                    $pprases_storage_fields = [        
                            'pphrase_storage1'=>$pPhrases_storage[0]

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
                            'pphrase_disp1'=>$pPhrases_disp[0],
                            'pphrase_disp2'=>$pPhrases_disp[1],
                            'pphrase_disp3'=>$pPhrases_disp[2],
                            'pphrase_disp4'=>$pPhrases_disp[3],
                            'pphrase_disp5'=>$pPhrases_disp[4],
                            'pphrase_disp6'=>$pPhrases_disp[5]

                        ];
                  }
                  else if ($pPhrases_dispMax == 4)
                  {
                    $pprases_disp_fields = [        
                            'pphrase_disp1'=>$pPhrases_disp[0],
                            'pphrase_disp2'=>$pPhrases_disp[1],
                            'pphrase_disp3'=>$pPhrases_disp[2],
                            'pphrase_disp4'=>$pPhrases_disp[3],
                            'pphrase_disp5'=>$pPhrases_disp[4]

                        ];
                  }
                  else if ($pPhrases_dispMax == 3)
                  {
                    $pprases_disp_fields = [        
                            'pphrase_disp1'=>$pPhrases_disp[0],
                            'pphrase_disp2'=>$pPhrases_disp[1],
                            'pphrase_disp3'=>$pPhrases_disp[2],
                            'pphrase_disp4'=>$pPhrases_disp[3]

                        ];
                  }
                  else if ($pPhrases_dispMax == 2)
                  {
                    $pprases_disp_fields = [        
                            'pphrase_disp1'=>$pPhrases_disp[0],
                            'pphrase_disp2'=>$pPhrases_disp[1],
                            'pphrase_disp3'=>$pPhrases_storage[2]

                        ];
                  }
                  else if ($pPhrases_dispMax == 1)
                  {
                    $pprases_disp_fields = [        
                            'pphrase_disp1'=>$pPhrases_storage[0],
                            'pphrase_disp2'=>$pPhrases_storage[1]

                        ];
                  }
                  else if ($pPhrases_dispMax == 0)
                  {
                    $pprases_disp_fields = [        
                            'pphrase_disp1'=>$pPhrases_storage[0]

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

                 $fk_field = [        
                     'chemical_header_id'=>$internalNo

                 ];

                //set fields first to null
                $hphrases_fieldsIni = [ 
                                    'hphrase1'=>NULL,
                                    'hphrase2'=>NULL,
                                    'hphrase3'=>NULL,
                                    'hphrase4'=>NULL,
                                    'hphrase5'=>NULL,
                                    'hphrase6'=>NULL
                                    ];
                $pphrases_fieldsIni = [ 
                                    'pphrase1'=>NULL,
                                    'pphrase2'=>NULL,
                                    'pphrase3'=>NULL,
                                    'pphrase4'=>NULL,
                                    'pphrase5'=>NULL,
                                    'pphrase6'=>NULL
                                      ];
               $pprases_prev_fieldsIni = [ 
                                    'pphrase_prev1'=>NULL,
                                    'pphrase_prev2'=>NULL,
                                    'pphrase_prev3'=>NULL,
                                    'pphrase_prev4'=>NULL,
                                    'pphrase_prev5'=>NULL,
                                    'pphrase_prev6'=>NULL
                                    ];
               $pprases_resp_fieldsIni = [ 
                                    'pphrase_res1'=>NULL,
                                    'pphrase_res2'=>NULL,
                                    'pphrase_res3'=>NULL,
                                    'pphrase_res4'=>NULL,
                                    'pphrase_res5'=>NULL,
                                    'pphrase_res6'=>NULL
                                    ];
               $pprases_storage_fieldsIni = [ 
                                    'pphrase_storage1'=>NULL,
                                    'pphrase_storage2'=>NULL,
                                    'pphrase_storage3'=>NULL,
                                    'pphrase_storage4'=>NULL,
                                    'pphrase_storage5'=>NULL,
                                    'pphrase_storage6'=>NULL
                                     ];
               $pprases_disp_fieldsIni = [ 
                                    'pphrase_disp1'=>NULL,
                                    'pphrase_disp2'=>NULL,
                                    'pphrase_disp3'=>NULL,
                                    'pphrase_disp4'=>NULL,
                                    'pphrase_disp5'=>NULL,
                                    'pphrase_disp6'=>NULL
                                       ];
        
                $fk_field = [        
                     'chemical_header_id'=>$internalNo
                    ];
               
               
               // array for initialization
                $phrases_fieldsInitialized = array_merge($hphrases_fieldsIni,$pphrases_fieldsIni,$pprases_prev_fieldsIni,$pprases_resp_fieldsIni,$pprases_storage_fieldsIni,$pprases_disp_fieldsIni,$fk_field);
               //array for edit
                $phrases_fields = array_merge($hphrases_fields,$pphrases_fields,$pprases_prev_fields,$pprases_resp_fields,$pprases_storage_fields,$pprases_disp_fields,$fk_field);

                $ch = new Chempo();
               
                //initialize fields
                $initialized = $ch->update($phrases_fieldsInitialized,$internalNo,$phrasesTableName,$whereClause);
                //insert values
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
                    header("Location:chemicals-list.php");
                    
                   }
           }
       } 

   }

}



?>


<!DOCTYPE html>
<html lang="en">


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
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<style type="text/css">
    .select2 {
        width: 100% !important;
    }
    
</style>
<!-- SET NAVIGATION BAR TO TOGGLE -->
<script type="text/javascript">
$("document").ready(function() {
    setTimeout(function(){$("body").toggleClass("ls-toggle-menu")});
    check_PHRange();
    check_BPRange();
    check_MPRange();
});


    
</script>
    
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
    <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="body_scroll">
        
   <!-- <form  action="" method="post"> -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Chemical</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item active">Chemicals</li>
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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button class="btn btn-raised btn-primary waves-effect" type="submit" style="float:right" name="submitdata" id="submitdata">SUBMIT DATA</button>
                    <div class="card">
                        <div class="header">
                        </div>
                        <div class="body">
                            
                            <input type="text"  name="internalNo" class="form-control" value="<?php echo $result['chemical_header_id']; ?>" hidden>
                            
                                <div class="row clearfix">
                                <div class="col-sm-6">
                                    
                                    <div class="form-group">  
                                    <small for="chemicalname">Chemical Name/Commercial Name:* </small>
                                    <input type="text" class="form-control" placeholder="Chemical Name" name="chemicalName" value="<?php echo $result['begin_of_pname']; ?>" required>
                                    </div>
                                    <div class="form-group">  
                                    <small>Chemical Type:*</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="chemicalType" id="chemicalType" onchange='chemicalTypeChange();' placeholder="Please Select">
                                        <?php
                                        $type = $result['chemical_type'];
                                        if ($type == '1')
                                        { ?>
                                            <option value="1" selected>Substance</option>
                                            <option value="2">Substance under REACH but Mixture</option>
                                            <option value="3">Mixture</option>
                                        <?php
                                        } elseif($type == '2') { ?>
                                            <option value="1">Substance</option>
                                            <option value="2" selected>Substance under REACH but Mixture</option>
                                            <option value="3">Mixture</option>
                                        <?php
                                        } elseif($type == "3") {?>
                                            <option value="1">Substance</option>
                                            <option value="2">Substance under REACH but Mixture</option>
                                            <option value="3" selected>Mixture</option>
                                        <?php
                                        }else {?>
                                            <option value="1">Substance</option>
                                            <option value="2">Substance under REACH but Mixture</option>
                                            <option value="3">Mixture</option>
                                        <?php
                                        }?>
                                        
                                    </select>
                                    </div>
                                    <br>
                                    <div class="col-sm-12" id="title" style="margin-left:-15px">
                                        <label for="chem-identifiers"><b>Chemical Identifiers</b></label>
                                    </div>
                                    <div class="row clearfix" id="chem-identifiers">
                                        
                                        
                                        <div class="col-sm-4">
                                        <small for="casNumber" id="casNumberLabel">CAS Number</small>
                                        <input type="text" class="form-control" placeholder="" name="casNumber" id="casNumber" onchange='check_CASNumber();' value="<?php echo $result['cas_no']; ?>">
                                        </div>
                                        
                                        <div class="col-sm-4">
                                        <small for="ecNumber" id="ecNumberLabel">EC Number</small>
                                        <input type="text" class="form-control" placeholder="" name="ecNumber" id="ecNumber" onchange='check_ECNumber();' value="<?php echo $result['ec_number']; ?>">
                                        </div>
                                        <div class="col-sm-4">
                                        <small for="iupacName" id="iupacNameLabel">IUPAC Name:</small>
                                        <input type="text" class="form-control" placeholder="" name="iupacName" id="iupacName" value="<?php echo $result['iupac_name']; ?>">
                                        </div>
                                    </div>
                                    
                                        
                                    <div class="row clearfix" id="chem-identifiers2">
                                        <div class="col-sm-4">
                                        <small for="ufi" id="ufiLabel">UFI:</small>
                                        <input type="text" class="form-control" placeholder="" name="ufi" id="ufi" onchange='check_UFI();' value="<?php echo $result['ufi']; ?>">
                                        </div>
                                        <div class="col-sm-4">
                                        <small for="unNumber" id="unNumberLabel">UN Number</small>
                                        <input type="text" class="form-control" placeholder="" name="unNumber" id="unNumber" onchange='check_UNNumber();' value="<?php echo $result['un_no']; ?>">
                                        </div>
                                        <div class="col-sm-4">
                                        <small for="reachNumber" id="reachNumberLabel">REACH Number</small>
                                        <input type="text" class="form-control" placeholder="" name="reachNumber" id="reachNumber" onchange='check_REACHNumber();' value="<?php echo $result['reach_number']; ?>">
                                        </div>
                                    </div>
                                   
                                    
                                    <br>
                                    <div class="row clearfix" id="chem-characteristics">
                                    <div class="col-sm-12">
                                        <label for="chem-identifiers"><b>Chemical Characteristics</b></label>
                                    </div>
                                    <div class="col-sm-6">
                                     <small>State of Matter</small>
                                    <select class ="form-control show-tick ms select2" data-placeholder="Select" name="stateOfMatter" style="width: 50%" placeholder="Select">
                                        <?php
                                        $state = $result['state_of_matter'];
                                        if($state == "1") { ?>
                                            <option value="1" selected>Not Applicable</option>
                                            <option value="2">Solid</option>
                                            <option value="3">Liquid</option>
                                            <option value="4">Gas</option>
                                            <option value="5">Plasma</option>
                                        <?php    
                                        } elseif ($state == "2") { ?>
                                            <option value="1">Not Applicable</option>
                                            <option value="2" selected>Solid</option>
                                            <option value="3">Liquid</option>
                                            <option value="4">Gas</option>
                                            <option value="5">Plasma</option>                            
                                        <?php
                                        } elseif ($state == "3") { ?>
                                            <option value="1">Not Applicable</option>
                                            <option value="2">Solid</option>
                                            <option value="3" selected>Liquid</option>
                                            <option value="4">Gas</option>
                                            <option value="5">Plasma</option>
                                        <?php
                                        } elseif ($state == "4") { ?> 
                                            <option value="1">Not Applicable</option>
                                            <option value="2">Solid</option>
                                            <option value="3">Liquid</option>
                                            <option value="4" selected>Gas</option>
                                            <option value="5">Plasma</option>
                                        <?php
                                        } elseif ($state == "5") { ?>
                                        
                                            <option value="1">Not Applicable</option>
                                            <option value="2">Solid</option>
                                            <option value="3">Liquid</option>
                                            <option value="4">Gas</option>
                                            <option value="5" selected>Plasma</option>
                                        
                                        <?php
                                        } else { ?>
                                            <option value="1">Not Applicable</option>
                                            <option value="2">Solid</option>
                                            <option value="3">Liquid</option>
                                            <option value="4">Gas</option>
                                            <option value="5">Plasma</option>
                                        <?php
                                        } ?>
                                        

                                    </select>
                                    
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                             <small>Density</small>
                                            <?php
                                            $density = $result['density'];
                                            $densityValue = strtok($density,'/[^gkol]/');
                                            
                                            ?>
                                            <input type="text" class="form-control" placeholder="Density" name="density" id="density"  onkeypress="return isNumber(event)" value="<?php echo preg_replace('/-[^0-9.,]/', '', $densityValue); ?>">
                                        </div>
                                        
                                        <div class="col-sm-6" id="density">
                                            <small>Unit</small>
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="densityUnit" id="densityUnit" placeholder="Please Select" STYLE="height: 500px !important" >
                                                
                                            <?php
                                                $density = $result['ph_value'];
                                                
                                                if (strpos($density,'g/cm3') !== false)
                                                { ?>
                                                    <option value="g/cm3" selected>g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php    
                                                }elseif (strpos($density,'g/m3') !== false)
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3" selected>g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php
                                                }elseif (strpos($density,'g/l') !== false)
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l" selected>g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php    
                                                }elseif (strpos($density,'kg/m3') !== false)
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3" selected>kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php
                                                }elseif (strpos($density,'kg/l') !== false) 
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l" selected>kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php
                                                }elseif (strpos($density,'kg/cm3') !== false) 
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3" selected>oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php    
                                                }elseif (strpos($density,'lbm/in3') !== false) 
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3" selected>lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php
                                                }elseif (strpos($density,'lbm/ft3') !== false) 
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3" selected>lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php
                                                }elseif (strpos($density,'lbm/yd3') !== false) 
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3" selected>lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php
                                                }elseif (strpos($density,'lbm/gal (US, liq.)') !== false) 
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)" selected>lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php    
                                                }elseif (strpos($density,'oz/in3') !== false) 
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3" selected>oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                <?php
                                                }elseif (strpos($density,'lbm/ft3') !== false) 
                                                { ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3" selected>lbm/ft3</option>
                                                <?php
                                                } else {  
                                                ?>
                                                    <option value="g/cm3">g/cm3</option>
                                                    <option value="g/m3">g/m3</option>
                                                    <option value="g/l">g/l</option>
                                                    <option value="kg/m3">kg/m3</option>
                                                    <option value="kg/l">kg/l</option>
                                                    <option value="kg/cm3">oz (av.)/ft3</option>
                                                    <option value="lbm/in3">lbm/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                    <option value="lbm/yd3">lbm/yd3</option>
                                                    <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                                    <option value="oz/in3">oz/in3</option>
                                                    <option value="lbm/ft3">lbm/ft3</option>
                                                
                                                <?php 
                                                } ?>
                                        </select>
                                        </div>
                                    </div>
                                    PH Value/Range  
                                        <br>
                                        <?php 
                                            $phValue = $result['ph_value'];
                                            if (strpos($phValue, '-')) {
                                            //checkbox unchecked    
                                        ?>
                                            <input type="checkbox" name="phValueSingle" id="phValueSingle" onchange='check_PHRange();' value="1">
                                        <?php    
                                            } else {
                                            //checkbox checked
                                        ?>
                                            <input type="checkbox" name="phValueSingle" id="phValueSingle" onchange='check_PHRange();' value="1" checked>
                                        <?php
                                            }
                                        ?>
                                        
                                        <?php 
                                            $arrPV = explode("-", preg_replace('/[^-?0-9.,]/', '',$result['ph_value']), 2);
                                            $firstPV = $arrPV[0];
                                            
                                        
                                            if (isset($arrPV[1]))
                                            {
                                                $secondPV = $arrPV[1];
                                            }else{
                                                echo "<script type='text/javascript'>
                                                check_PHRange();
                                                </script>";
                                            }
                                            
                                            
                                        ?>
                                        <small>check if PH Value is not in range</small>
                                    <div class="row clearfix">
                                        <div class="col-sm-6" id="phValueMin">
                                            <input type="number" class="form-control" placeholder="Min Value" name="phValueMin" id="phValueMinInput" min="0" max="14" value="<?php echo preg_replace('/[^\d-]+/', '',$firstPV); ?>">
                                            
                                        </div>
                                        <div class="col-sm-6" id="phValueMax">
                                            <input type="number" class="form-control" placeholder="Max Value" name="phValueMax" min="0" max="14"value="<?php echo preg_replace('/[^\d-]+/', '',$secondPV); ?>">
                                            
                                        </div>
                                    </div>
  
                                    Boiling Point/Range
                                    <br> 
                                     <?php 
                                            $boilingPoint = $result['boiling_point'];
                                            if (strpos($boilingPoint, '-')) {
                                            //checkbox unchecked    
                                        ?>
                                            <input type="checkbox" name="boilingPointSingle" id="boilingPointSingle" onchange='check_BPRange();' value="1">
                                            <small>check if Boiling Point is not in range</small>
                                        <?php    
                                            } else {
                                            //checkbox checked
                                        ?>
                                            <input type="checkbox" name="boilingPointSingle" id="boilingPointSingle" onchange='check_BPRange();' value="1" checked>
                                            <small>check if Boiling Point is not in range</small>
                                        <?php
                                            }
                                        ?>
                                        
                                        <?php
                                        
                                            $arrBP = preg_split('/(?<=\d)-/', preg_replace('/[^-?0-9.,]/', '',$result['boiling_point']));
                                            $firstBP = $arrBP[0];
                                            
                                        
                                            if (isset($arrBP[1])){
                                                $secondBP = $arrBP[1];
                                            }else {
                                                echo "<script type='text/javascript'>
                                                check_BPRange(); </script>";
                                            }
                                        ?>
                                        
                                        
                                    <div class="row clearfix">
                                        <div class="col-sm-4" id="boilingPointMin">       
                                            <input type="text" class="form-control" placeholder="Min" name="boilingPointMin" id="boilingPointMinInput" value="<?php echo preg_replace('/[^-?0-9.,]/', '',$firstBP); ?>">
                                            
                                        </div>
                                        <div class="col-sm-4" id="boilingPointMax">
                                            <input type="text" class="form-control" placeholder="Max" name="boilingPointMax" value = "<?php echo preg_replace('/[^-?0-9.,]/', '',$secondBP); ?>">
                                        </div>
                                        
                                        <div class="col-sm-4" id="density">
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="boilingPointUnit" id="boilingPointUnit" placeholder="Please Select" STYLE="height: 500px !important">
                                            <?php
                                                $bpUnit = $result['boiling_point'];
                                                if (strpos($bpUnit,'°C') !== false) { 
                                                ?>
                                                    <option value="°C" selected>°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K">K</option>
                                                <?php
                                                } elseif (strpos($bpUnit, '°F') !== false){
                                                ?>
                                                    <option value="°C">°C</option>
                                                    <option value="°F" selected>°F</option>
                                                    <option value="K">K</option>
                                                <?php
                                                }elseif (strpos($bpUnit, 'K') !== false){ 
                                                ?>
                                                    <option value="°C">°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K" selected>K</option>
                                                <?php    
                                                }else{ ?>
                                                    <option value="°C">°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K">K</option> 
                                                <?php
                                                }?>
                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    Melting Point/Range
                                    <br>
                                    <?php 
                                            $meltingPoint = $result['melting_point'];
                                            if (strpos($meltingPoint, '-')) {
                                            //checkbox unchecked    
                                        ?>
                                            <input type="checkbox" name="meltingPointSingle" id="meltingPointSingle" onclick="check_MPRange();" value="1">
                                            <small>check if Melting Point is not in range</small>
                                        <?php    
                                            } else {
                                            //checkbox checked
                                        ?>
                                            <input type="checkbox" name="meltingPointSingle" id="meltingPointSingle" onclick="check_MPRange();" value="1" checked>
                                            <small>check if Melting Point is not in range</small>
                                        <?php
                                            }
                                        ?>
                                        
                                        <?php
                                            $arrMP = preg_split('/(?<=\d)-/', preg_replace('/[^-?0-9.,]/', '',$result['melting_point']));
                                            $firstMP = $arrMP[0];
                                            
                                        
                                            if (isset($arrMP[1])){
                                                $secondMP = $arrMP[1];
                                            }else {
                                                echo "<script type='text/javascript'>
                                                check_MPRange(); </script>";
                                            }
                                        ?>
                                    <div class="row clearfix">
                                        <div class="col-sm-4" id="meltingPointMin">
                                            <input type="text" class="form-control" placeholder="Min" name="meltingPointMin" id="meltingPointMinInput" value="<?php echo preg_replace('/[^-?0-9.,]/', '',$firstMP); ?>" onkeypress="return isNumber(event)">
                                            
                                        </div>
                                        <div class="col-sm-4" id="meltingPointMax">
                                            <input type="text" class="form-control" placeholder="Max" name="meltingPointMax" id="meltingPointMax" value="<?php echo preg_replace('/[^-?0-9.,]/', '', $secondMP); ?>" onkeypress="return isNumber(event)">
                                            
                                        </div>
                                        
                                        <div class="col-sm-4" id="flashpoint">
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="meltingPointUnit" id="meltingPointUnit" placeholder="Please Select" STYLE="height: 500px !important">
                                            <?php
                                                $bpUnit = $result['melting_point'];
                                                if (strpos($bpUnit,'°C') !== false) { 
                                                ?>
                                                    <option value="°C" selected>°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K">K</option>
                                                <?php
                                                } elseif (strpos($bpUnit, '°F') !== false){
                                                ?>
                                                    <option value="°C">°C</option>
                                                    <option value="°F" selected>°F</option>
                                                    <option value="K">K</option>
                                                <?php
                                                }elseif (strpos($bpUnit, 'K') !== false){ 
                                                ?>
                                                    <option value="°C">°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K" selected>K</option>
                                                <?php    
                                                }else{ ?>
                                                    <option value="°C">°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K">K</option> 
                                                <?php
                                                }?>
                                        </select>
                                        </div>
                                    </div> 
                                    Flash Point
                                    <div class="row clearfix">
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Flash Point" name="flashPoint" value="<?php echo preg_replace('/[^-?0-9.,]/', '', $result['flash_point']); ?>" onkeypress="return isNumber(event)">
                                        </div>
                                        
                                        <div class="col-sm-4" id="flashpoint">
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="flashPointUnit" id="flashPointUnit" placeholder="Please Select" STYLE="height: 500px !important">
                                            <?php
                                                $bpUnit = $result['flash_point'];
                                                if (strpos($bpUnit,'°C') !== false) { 
                                                ?>
                                                    <option value="°C" selected>°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K">K</option>
                                                <?php
                                                } elseif (strpos($bpUnit, '°F') !== false){
                                                ?>
                                                    <option value="°C">°C</option>
                                                    <option value="°F" selected>°F</option>
                                                    <option value="K">K</option>
                                                <?php
                                                }elseif (strpos($bpUnit, 'K') !== false){ 
                                                ?>
                                                    <option value="°C">°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K" selected>K</option>
                                                <?php    
                                                }else{ ?>
                                                    <option value="°C">°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K">K</option> 
                                                <?php
                                                }?>
                                        </select>
                                        </div>
                                    </div> 
                                    Refractive Index
                                    
                                    <input type="text" class="form-control" placeholder="Refractive Index" name="refractiveIndex" value="<?php echo preg_replace('/[^-?0-9.,]/', '', $result['refractive_index']); ?>" onkeypress="return isNumber(event)">
                                    Molecular Weight
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            
                                            <input type="text" class="form-control" placeholder="Molecular Weight" name="molecularWeight" id="molecularWeight" value="<?php echo preg_replace('/[^-?0-9.,]/', '', $result['molecular_weight']); ?>" onkeypress="return isNumber(event)">
                                        </div>
                                        
                                        <div class="col-sm-6" id="density">
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="molecularWeightUnit" id="molecularWeightUnit" placeholder="Please Select" STYLE="height: 500px !important">
                                                
                                                <?php
                                                $bpUnit = $result['molecular_weight'];
                                                if (strpos($bpUnit,'kg/mol') !== false) { 
                                                ?>
                                                    <option value="g/mol">g/mol</option>
                                                    <option value="kg/mol" selected>kg/mol</option> 
                                                <?php
                                                } elseif (strpos($bpUnit, 'g/mol') !== false){
                                                ?>
                                                    <option value="g/mol" selected>g/mol</option>
                                                    <option value="kg/mol">kg/mol</option> 
                                                <?php    
                                                }else{ ?>
                                                    <option value="g/mol">g/mol</option>
                                                    <option value="kg/mol">kg/mol</option> 
                                                <?php
                                                }?>
                                                
                                            
                                        </select>
                                        </div>
                                    </div> 
                                </div>
                                </div>
                                </div>
 
                                
                                <div class="col-sm-6">
                            
        <!-- H AND P PHRASES COLLAPSED -->
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 col-sm-12 mb-1">
                            <input type ="text" name="internalNo" class="form-control" value = "<?php echo $result['chemical_header_id']; ?>" hidden>
                            
                        <div class=" form-group form-float">
                                <small><b>Signal Word</b></small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="signalWord">
                                        <?php
                                        $signal = $result['signal_word'];
                                        if($signal === "W") {
                                            echo "<option value='W' selected>Warning</option>";
                                            echo "<option value='D'>Danger</option>";
                                        } elseif ($signal === "D") {
                                            echo "<option value='D' selected>Danger</option>";
                                            echo "<option value='W'>Warning</option>";
                                        } else {
                                            echo "<option value='W'>Warning</option>";
                                            echo "<option value='D'>Danger</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                              </div>
                            <div class="panel-group full-body" id="accordion_5" role="tablist" aria-multiselectable="true">
                                <div class="panel l-coral">
                                    <div class="panel-heading" role="tab" id="headingOne_5">
                                        <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_5" href="#collapseOne_5" aria-expanded="true" aria-controls="collapseOne_5"> Hazard and Precaution Phrases <b>(Click Here)</b> </a> </h4>
                                    </div>
                                    <div id="collapseOne_5" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_5">
                                        <div class="panel-body">
                                               <div class="panel-body">
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small><b>Hazard Statements</b></small>
                                   <select style="height: 100px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select H Phrases. Click Here" name="hPhrases[]">
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
                                  $ch = new Chempo();
                                  $rows = $ch->hphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['h_phrasencode']; ?>"><?php echo $row['hphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>   
                                       
                                    </select>
                                  
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>General</b> </small>
                                   <select style="height: 100px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases[]">
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
                                  <?php
                            //      $ch = new Chempo();
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
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>Prevention</b> </small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_prev[]">
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
                                  <?php
                           //       $ch = new Chempo();
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
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                    <small>Precautionary Statements: <b>Response</b></small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_resp[]">
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
                                 <?php
                         //         $ch = new Chempo();
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
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>Storage</b> </small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_storage[]">
                                   
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
                                  <?php
                       //           $ch = new Chempo();
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
                                <div class="col-lg-12 col-sm-12">
                                  
                                  <small>Precautionary Statements: <b>Disposal</b> </small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_disp[]">
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
                                  <?php
                       //           $ch = new Chempo();
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
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        <!-- GHS LABEL -->
                                <div class="panel l-coral">
                                    <div class="panel-heading" role="tab" id="headingTwo_5">
                                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_5" href="#collapseTwo_5" aria-expanded="false"
                                                aria-controls="collapseTwo_5">GHS Label <b>(Click Here)</b></a> </h4>
                                    </div>
                                    <div id="collapseTwo_5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_5">
                                        <div class="panel-body"> 
                                            <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <img src="img/GHS01.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <div class="form-check">
                                        <?php
                                        $ghs1 = (int)$result['ghs1'];
                                        if($ghs1 == 1)
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs1" checked>
                                        <?php
                                        } else { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs1">    
                                        <?php
                                        } ?>

                                        <label for="checkbox"><b>GHS01</b></label>
                                        <h6>Exploding bomb</h6>
                                        <p>Danger Unstable<br><b>Explosive</b></p>
                                    </div>
                              
                                </div>                              
                                <div class="form-group col-md-3">
                                    <img src="img/GHS02.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    
                                    <div class="form-check">
                                        <?php
                                        $ghs2 = (int)$result['ghs2'];
                                        if($ghs2 == 1)
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs2" checked>
                                        <?php
                                        }else { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs2">
                                        <?php
                                        }?>
                                        
                                        <label for="checkbox"><b>GHS02</b></label>
                                        <h6>Flame</h6>
                                        <p>Danger or Warning<br><b>Flammable</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <img src="img/GHS03.png"  width="120px" height="120px">
                                </div>
                               
                                <div class="form-group col-md-3">
                                    
                                    <div class="form-check">
                                        <?php
                                        $ghs3 = (int)$result['ghs3'];
                                        if($ghs3 == 1) 
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs3" width="120px" height="120px" checked>
                                        <?php
                                        }else{ ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs3" width="120px" height="120px">
                                        <?php
                                        } ?>
                                        
                                        <label for="checkbox"><b>GHS03</b></label>
                                        <h6>Flame over circle</h6>
                                        <p>Danger or Warning<br><b>Oxidising</b></p>
                                    </div>
                                </div>                             
                                <div class="form-group col-md-3">
                                    <img src="img/GHS04.png" width="120px" height="120px">
                                </div>
                                
                                  <div class="form-group col-md-3"  width="120px" height="120px">
                                    
                                    <div class="form-check">
                                        <?php
                                        $ghs4=(int)$result['ghs4'];
                                        if($ghs4 == 1)
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs4" checked>
                                        <?php
                                        }else{ ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs4">
                                        <?php
                                        }
                                        ?>
                                        
                                        <label for="checkbox"><b>GHS04</b></label>
                                        <h6>Gas cylinder</h6>
                                        <p>Warning<br><b>Compressed Gas</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <img src="img/GHS05.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    
                                    <div class="form-check">
                                        <?php
                                        $ghs5 = (int)$result['ghs5'];
                                        if($ghs5 == 1) 
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs5" checked>
                                        <?php
                                        }else 
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs5">
                                        <?php
                                        }
                                        ?>
                                        <label for="checkbox"><b>GHS05</b></label>
                                        <h6>Corrosion</h6>
                                        <p>Danger or Warning<br><b>Corrosive cat.</b> 1</p>
                                    </div>
                                </div>                           
                                <div class="form-group col-md-3">
                                    <img src="img/GHS06.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3" width="120px" height="120px">
                                    <div class="form-check">
                                        <?php
                                        $ghs6 = (int)$result['ghs6'];
                                        if($ghs6 == 1) 
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs6" checked>
                                        <?php
                                        }else
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs6">
                                        <?php
                                        }
                                        ?>
                                        
                                        <label for="checkbox"><b>GHS06</b></label>
                                        <h6>Skull and crossbones</h6>
                                        <p>Danger<br><b>Toxic cat. 1 - 3</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <img src="img/GHS07.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    
                                    <div class="form-check">
                                        <?php
                                        $ghs7 = (int)$result['ghs7'];
                                        if($ghs7 == 1) 
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs7" checked>
                                        <?php
                                        } else 
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs7">
                                        <?php
                                        }
                                        ?>
                                        
                                        <label for="checkbox"><b>GHS07</b></label>
                                        <h6>Exclamation Mark</h6>
                                        <p>Warning Toxic cat. 4 Irritant cat. 2 or 3 Lower systematic health hazards</p>
                                    </div>
                                </div>                           
                                <div class="form-group col-md-3">
                                    <img src="img/GHS08.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3" width="120px" height="120px">
                                    <div class="form-check">
                                        <?php
                                        $ghs8 = (int)$result['ghs8'];
                                        if($ghs8 == 1) 
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs8" checked>
                                        <?php
                                        } else 
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs8">
                                        <?php
                                        }
                                        ?>
                                        
                                        <label for="checkbox"><b>GHS08</b></label>
                                        <h6>Health Hazard</h6>
                                        <p>Danger<br> ro Warning systematic health hazard</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <img src="img/GHS09.png" width="120px" height="120px">
                                </div>
                               
                                 <div class="form-group col-md-3">
                                    
                                    <div class="form-check">
                                        <?php
                                        $ghs9 = (int)$result['ghs9'];
                                        if($ghs9 == 1) 
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs9" checked>
                                        <?php
                                        } else 
                                        { ?>
                                            <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs9">
                                        <?php
                                        }
                                        ?>
                                        
                                        <label for="checkbox"><b>GHS09</b></label>
                                        <h6>Environment</h6>
                                     <p>Warning (for cat. 1)<br>(for cat. 2 no signal word)</p>
                                    </div>
                                </div>                           
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
        
                    </div> 
                                        </div>
                                    </div>
                                        </div>
                            </div>
                            </div>
                        

                                </div>
                            </div>
                        </div>
                        </div>
                        
                        
                    </div>
                </div>

            </div>
        </div>
<!---------------------------------------------------------->


                       <!--<button type="submit" class="btn btn-info" name="submit">Save</button>-->
                
     </form>   
    </div>
</section>

<script type="text/javascript">
    $(".js-example-theme-multiple").select2({
  theme: "classic"
});
    
    function isNumber(evt) {
        debugger;
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode == 46 && evt.srcElement.value.split('.').length>1) {
            return false;
        }
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    
    function chemicalTypeChange(){
        var chemicalType = document.getElementById('chemicalType').value;
        if (chemicalType == "3") {
            document.getElementById("chem-identifiers").style.display = 'none';
            document.getElementById("reachNumberLabel").style.display = 'none';
            document.getElementById("reachNumber").style.display = 'none';
            document.getElementById("unNumber").style.display = 'none';
            document.getElementById("unNumberLabel").style.display = 'none';
        } else {
            document.getElementById("chem-identifiers").style.display = '';
            document.getElementById("reachNumberLabel").style.display = '';
            document.getElementById("reachNumber").style.display = '';
            document.getElementById("unNumber").style.display = '';
            document.getElementById("unNumberLabel").style.display = '';
        }
    }
    

    
    function check_CASNumber() {
        var CASformat = /^[0-9]{2,6}-[0-9]{2}-[0-9]{1}$/;
        
        if(document.getElementById('casNumber').value.match(CASformat)) {
            
        } else {
            alert("Invalid CAS Number.");
            document.getElementById('casNumber').value = '';
            document.getElementById('casNumber').focus();
        }
        
    }
    
    function check_REACHNumber() {
        var reachformat = /^[0-9]{2}-[0-9]{10}-[0-9]{2}-[0-9]{4}$/;
        
        if(document.getElementById('reachNumber').value.match(reachformat)) {
            
        } else {
            alert("Invalid Reach Number.");
            document.getElementById('reachNumber').value = '';
            document.getElementById('reachNumber').focus();
        }
        
    }
    
    function check_UFI(){
        var UFIformat = /^[0-9A-Z]{4}-[0-9A-Z]{4}-[0-9A-Z]{4}-[0-9A-Z]{4}$/;
        if(document.getElementById('ufi').value.match(UFIformat)) {
            
        } else {
            alert("Invalid Unique Formula Identifier.");
            document.getElementById('ufi').value = '';
            document.getElementById('ufi').focus();
        }       
    }
    
    function check_UNNumber() {
        var UNformat = /^[0-9]{4}$/;
        if(document.getElementById('unNumber').value.match(UNformat)) {
            
        } else {
            alert("Invalid UN Number.");
            document.getElementById('unNumber').value = '';
            document.getElementById('unNumber').focus();
        }
    }
    
    function check_ECNumber() {
        var ECformat = /^[0-9]{3}-[0-9]{3}-[0-9]{1}$/;
        
        if (document.getElementById('ecNumber').value.match(ECformat)){
            
        } else {
            alert("Invalid EC Number.");
            document.getElementById('ecNumber').value = '';
            document.getElementById('ecNumber').focus();
        }
    }
    
    function check_Density() {
        var densityValue = document.getElementById('density').value;
        if (densityValue > "30") {
            alert ("Maximum density value is 30.");
            document.getElementById('density').value = '';
            document.getElementById('density').focus;
        } else if (densityValue < "0") {
            alert ("Minimum density value is 0.");
            document.getElementById('density').value = '';
            document.getElementById('density').focus;
        } else {
            
        }
    }
    
    function check_PHRange() {
        var checkbox = document.getElementById('phValueSingle');
        var placeholderModify = document.getElementById('phValueMinInput');
        
        if(checkbox.checked) {
            
            document.getElementById("phValueMin").className = "col-sm-12";
            document.getElementById("phValueMax").style.display = 'none';  
            placeholderModify.placeholder = "pH Value";
        } else {  
            document.getElementById("phValueMax").style.display = '';
            document.getElementById("phValueMin").className = "col-sm-6";
            placeholderModify.placeholder = "Min Value";
        }
        
    }
    
    function check_BPRange(){
        var checkbox = document.getElementById('boilingPointSingle');
        var placeholderModify = document.getElementById('boilingPointMinInput');
        
        if(checkbox.checked) {
            document.getElementById("boilingPointMin").className = "col-sm-8";
            document.getElementById("boilingPointMax").style.display = 'none';
            placeholderModify.placeholder = "Boiling Point";
        } else {
            document.getElementById("boilingPointMin").className = "col-sm-4";
            document.getElementById("boilingPointMax").style.display = '';
            placeholderModify.placeholder = "Min";
        }
    }
    
    function check_MPRange(){
        var checkbox = document.getElementById('meltingPointSingle');
        var placeholderModify = document.getElementById('meltingPointMinInput');
        if(checkbox.checked) {
            document.getElementById("meltingPointMin").className = "col-sm-8";
            document.getElementById("meltingPointMax").style.display = 'none';
            placeholderModify.placeholder = "Melting Point";
        } else {
            document.getElementById("meltingPointMin").className = "col-sm-4";
            document.getElementById("meltingPointMax").style.display = '';
            placeholderModify.placeholder = "Min";
        }
    }
    
</script>
        
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
    $("#hazardStatements").select2({
        maximumSelectionLength: 6
    });
});


  </script>

<script src="assets/js/pages/forms/advanced-form-elements.js"></script>  

</body>


</html>