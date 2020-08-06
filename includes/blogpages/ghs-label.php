        <div class="">
            <!-- Basic Validation -->
            <div class="">
                <div class="">
                    <div class="">
                        <div class="header">
                            <h6 style="float:left; color:orange;"><strong>GHS</strong> Label</h6>
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
                            <?php
                            
                            foreach ($ghsLabel as $img) {
                                
                                if($img == "")
                                {

                                }
                                else
                                {
                                    

                                    $name = str_replace("img/ghs/","",$img);
                                    $name = str_replace(".jpg","",$name);
                                    echo'<img src="'.$img.'">';
                                    echo "&nbsp;&nbsp;";
                                    echo '<b>'.$name.'</b>';
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

                                    


                                    
                                    
                                }
                                
                            }


                            ?>
                            
                                
                    
                     
                                
                                
                               <!-- <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>