            <!-- Basic Validation -->
                <div class="">
                    <div class="">
                        <div class="header">
                            <h6 style="float:left; color:orange;"><strong>Chemical</strong> Properties</h6><br>
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
                                    
                                    <small>State of Matter</small>

                                    
                                    <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="stateOfMatter" 
                                    value="<?php 
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

                                    ?>" readonly>
                                    </div>
                                   
                                </div>
                                <small>Density</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="density" value="<?php echo $result['density']; ?>" readonly>
                                </div>
                                <small>PH Value</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="phValue" value="<?php echo $result['ph_value']; ?>" readonly>
                                </div>
                                <small>Boiling Point</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="boilingPoint" value="<?php echo $result['boiling_point']; ?>" readonly>
                                </div>
                                <small>Melting Point</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="meltingPoint" value="<?php echo $result['melting_point']; ?>" readonly>
                                </div>
                                <small>Flash Point</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="flashPoint" value="<?php echo $result['flash_point']; ?>" readonly>
                                </div>
                                <small>Refractive Index</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="refractiveIndex" value="<?php echo $result['refractive_index']; ?>" readonly>
                                </div>
                                <small>Molecular Weight</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="molecularWeight" value="<?php echo $result['molecular_weight']; ?>" readonly>
                                </div>
                                <small>Chemical Type</small>
                                <div class=" form-group form-float">
                                    
                                    
                                    <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="chemicalType" 
                                    value="<?php 
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

                                    ?>" readonly>
                                    </div>
                                    
                                </div>
                                
                                <!--<button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            
                        </div>
                    </div>
                </div>