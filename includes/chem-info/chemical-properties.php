<div class="card">
                        <div class="header">
                            <h2><strong>Chemical Properties</strong></h2>
                        </div>
                        <div class="body">
                            <center>
                                <div class="row">
                                    <div class="col-md-2">
                                        State of Matter
                                    </div>
                                    <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
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
                                    </div>
                                    <div class="col-md-2">
                                        Density
                                    </div>
                                    <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
                                        <?php echo $result['density']; ?>
                                    </div>
                                    <div class="col-md-2">
                                        PH Value
                                    </div>
                                    <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
                                        <?php echo $result['ph_value']; ?>
                                    </div>
                                    <div class="col-md-12"><hr></div>
                                    <div class="col-md-2">Boiling Point</div>
                                    <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
                                        <?php echo $result['boiling_point']; ?>
                                    </div>
                                    <div class="col-md-2">Melting Point</div>
                                    <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
                                        <?php echo $result['melting_point']; ?>
                                    </div>
                                    <div class="col-md-2">Flash Point</div>
                                    <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
                                        <?php echo $result['flash_point']; ?>
                                    </div>
                                    <div class="col-md-12"><hr></div>
                                    <div class="col-md-2">Refractive Index</div>
                                    <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
                                        <?php echo $result['refractive_index']; ?>
                                    </div>
                                    <div class="col-md-2">Molecular Weight</div>
                                    <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;"><?php echo $result['molecular_weight']; ?></div>
                                    <div class="col-md-2">Chemical Type</div>
                                    <div class="col-md-2" style="color:orange; font-weight:bold; font-style:italic;">
                                        <?php
                                        $type = $result['chemical_type']; 
                                        if($type == '0')
                                        {
                                            $typeVal = "";
                                        }
                                        elseif ($type == '1') 
                                        {
                                             $typeVal = "No Data Available";
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
                                        ?>
                                    </div>
                                </div>
                            </center>
                        </div>
</div>