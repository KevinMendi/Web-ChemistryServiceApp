<div class="card">
                        <div class="header">
                            <h2><strong>GHS Label</strong></h2>
                        </div>
                        <div class="body">
                            <center>
                            <div class="row">
                                <?php
                            
                            foreach ($ghsLabel as $img) {
                                
                                if($img == "")
                                {

                                }
                                else
                                {
                                    

                                    $name = str_replace("img/ghs/","",$img);
                                    $name = str_replace(".jpg","",$name);
                                    echo '<div class="col-md-2">';
                                    echo'<img src="'.$img.'">';
                                    echo "&nbsp;&nbsp;";
                                    echo '<b>'.$name.'</b>';
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                    echo '</div>';

                                    


                                    
                                    
                                }
                                
                            }


                                ?>
                            </div>
                            </center>
                        </div>
</div>