 <div class="table-responsive jumbotron-custom wow fadeInLeft">
                                <form action="chemicals-edit.php" method="post">  
                                <table class="table table-hover js-basic-example dataTable" style=" background-color: rgba(0,0,0,0.4); border-radius:20px;">
                                    <thead style="color:white;">
                                        <tr>
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                            <th>Un No</th>
                                           
                                        </tr>
                                    </thead>
                                    
                                    <tbody style="color:white;">
                                        
                                        <?php
                                                $ch = new Chempo();
                                                $rows = $ch->chemicalsListIndex();
                                                foreach ($rows as $row) 
                                                {
                                            ?>
                        
                                                    <tr>
                                                    
                                                        <td><a class="text-white" href="chemicalInfo.php?read=<?php echo $row['chemical_header_id']; ?>"><?php echo $row['begin_of_pname']; ?></a></td>
                                                    <td><?php echo $row['cas_no']; ?></td>
                                                    <td><?php echo $row['un_no']; ?></td>


                                                    </tr>
                                            <?php
                                                }

                                            ?>
                                      
                                        
                                    </tbody>
                                </table>
                            </form>

                            </div>