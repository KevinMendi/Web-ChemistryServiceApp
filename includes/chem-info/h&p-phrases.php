<div class="card" style="text-align:left !important;">
                        <div class="header">
                            <h2><strong>H&P Phrases</strong></h2>
                        </div>
                        <div class="body">
                            <center>
                                <div class="row">
                                <div class="col-md-6">Signal Word</div>
                                <div class="col-md-6" style="color:orange; font-weight:bold; font-style:italic;">
                                    <?php 
                                $signal = $result['signal_word']; 
                                        if($signal == 'W')
                                        {
                                            $signalVal = "Warning";
                                        }
                                        elseif ($signal == 'D') 
                                        {
                                             $signalVal = "Danger";
                                        }
                                        echo $signalVal;   
                                    ?>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"><hr></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">Hazard Phrases</div>
                                            <div class="col-md-6" style="text-align:left;">
                                            <?php 
                                    $temp = (string)($result['hphrase1']);
                                     $temp2 = (string)($result['hphrase2']);
                                     $temp3 = (string)($result['hphrase3']);
                                     $temp4 = (string)($result['hphrase4']);
                                     $temp5 = (string)($result['hphrase5']);
                                     $temp6 = (string)($result['hphrase6']);

                                     if($temp == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp);
                                        echo $result['hphrase1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($temp2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp2);
                                     echo $result['hphrase2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp3);
                                     echo $result['hphrase3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp4);
                                     echo $result['hphrase4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp5);
                                     echo $result['hphrase5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($temp6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp6);
                                     echo $result['hphrase6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }
                                                
                                            ?>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">Precautionary Statements: General</div>
                                            <div class="col-md-6">
                                            <?php 
                                            $tempp = (string)($result['pphrase1']);
                                     $tempp2 = (string)($result['pphrase2']);
                                     $tempp3 = (string)($result['pphrase3']);
                                     $tempp4 = (string)($result['pphrase4']);
                                     $tempp5 = (string)($result['pphrase5']);
                                     $tempp6 = (string)($result['pphrase6']);

                                     if($tempp == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp);
                                        echo $result['pphrase1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($tempp2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp2);
                                     echo $result['pphrase2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($tempp3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp3);
                                     echo $result['pphrase3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($tempp4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp4);
                                     echo $result['pphrase4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($tempp5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp5);
                                     echo $result['pphrase5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($tempp6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp6);
                                     echo $result['pphrase6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }    
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">Precautionary Statements: Prevention</div>
                                            <div class="col-md-6" style="text-align:left;">
                                              <?php 
                                    
                                     $temp_prev = (string)($result['pphrase_prev1']);
                                     $temp_prev2 = (string)($result['pphrase_prev2']);
                                     $temp_prev3 = (string)($result['pphrase_prev3']);
                                     $temp_prev4 = (string)($result['pphrase_prev4']);
                                     $temp_prev5 = (string)($result['pphrase_prev5']);
                                     $temp_prev6 = (string)($result['pphrase_prev6']);

                                     if($temp_prev == "" )
                                     {
                                        echo "No data Available";
                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev);
                                        echo $result['pphrase_prev1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($temp_prev2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev2);
                                     echo $result['pphrase_prev2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_prev3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev3);
                                     echo $result['pphrase_prev3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_prev4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev4);
                                     echo $result['pphrase_prev4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_prev5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev5);
                                     echo $result['pphrase_prev5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($temp_prev6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev6);
                                     echo $result['pphrase_prev6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     ?>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">Precautionary Statements: Response</div>
                                            <div class="col-md-6">
                                            <?php 
                                    
                                     $temp_res = (string)($result['pphrase_res1']);
                                     $temp_res2 = (string)($result['pphrase_res2']);
                                     $temp_res3 = (string)($result['pphrase_res3']);
                                     $temp_res4 = (string)($result['pphrase_res4']);
                                     $temp_res5 = (string)($result['pphrase_res5']);
                                     $temp_res6 = (string)($result['pphrase_res6']);

                                     if($temp_res == "" )
                                     {
                                        echo "No data Available";
                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res);
                                        echo $result['pphrase_res1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($temp_res2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res2);
                                     echo $result['pphrase_res2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_res3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res3);
                                     echo $result['pphrase_res3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_res4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res4);
                                     echo $result['pphrase_res4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_res5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res5);
                                     echo $result['pphrase_res5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($temp_res6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res6);
                                     echo $result['pphrase_res6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">Precautionary Statements: Storage</div>
                                            <div class="col-md-6" style="text-align:left;"> 
                                                 <?php 
                                    
                                     $temp_storage = (string)($result['pphrase_storage1']);
                                     $temp_storage2 = (string)($result['pphrase_storage2']);
                                     $temp_storage3 = (string)($result['pphrase_storage3']);
                                     $temp_storage4 = (string)($result['pphrase_storage4']);
                                     $temp_storage5 = (string)($result['pphrase_storage5']);
                                     $temp_storage6 = (string)($result['pphrase_storage6']);

                                     if($temp_storage == "" )
                                     {
                                        echo "No data Available";
                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage);
                                        echo $result['pphrase_storage1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($temp_storage2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage2);
                                     echo $result['pphrase_storage2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_storage3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage3);
                                     echo $result['pphrase_storage3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_storage4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage4);
                                     echo $result['pphrase_storage4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_storage5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage5);
                                     echo $result['pphrase_storage5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($temp_storage6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage6);
                                     echo $result['pphrase_storage6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">Precautionary Statements: Disposal</div>
                                            <div class="col-md-6">
                                            <?php 
                                    
                                     $temp_disp = (string)($result['pphrase_disp1']);
                                     $temp_disp2 = (string)($result['pphrase_disp2']);
                                     $temp_disp3 = (string)($result['pphrase_disp3']);
                                     $temp_disp4 = (string)($result['pphrase_disp4']);
                                     $temp_disp5 = (string)($result['pphrase_disp5']);
                                     $temp_disp6 = (string)($result['pphrase_disp6']);

                                     if($temp_disp == "" )
                                     {
                                        echo "No data Available";
                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp);
                                        echo $result['pphrase_disp1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($temp_disp2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp2);
                                     echo $result['pphrase_disp2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_disp3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp3);
                                     echo $result['pphrase_disp3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_disp4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp4);
                                     echo $result['pphrase_disp4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_disp5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp5);
                                     echo $result['pphrase_disp5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($temp_disp6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp6);
                                     echo $result['pphrase_disp6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <hr>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>