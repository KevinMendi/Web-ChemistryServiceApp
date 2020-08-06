<a href="https://chemistryservice.rimpido.com/"><button type="button" class="button button-default">Back to Home</button></a>
<br><br>
                        <div class="body">
                            <h4>TOP MATCHES FOR KEYWORD: <i style="color:orange;"><?php echo $_POST['search']; ?></i></h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                            <th>UN No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                            <th>UN No</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            if (isset($_POST['submit-search'])) 
						{

                            $search_text = $_POST['search'];
							$chemicals = new Chempo();
							$rows = $chemicals->search($search_text);
							//$chemicals->destroy_properties($id);
							if($rows == 0)
							{
							 ?>
                                        
                                <script>
                                    
                                   /* window.onload=function(){
                                      document.getElementById("noResult").click();
                                    };

                                    
                                    function doSomething(){
                                          prompt("No Results. Try refining your search keywords.")
                                        }*/
                                </script>
                                        
                                        <a id="noResult" href="#" onclick="doSomething()" style="display:none;">Click</a>
                                        
<!--                                <div id="noResults" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">$times;</button>
                                            <h4 class="modal-title">NO RESULTS.</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Try refining your search keywords or scan thru the list of Chemicals Chemistry Service Portal has!</p>
                                        </div>
                                    </div>        
                                </div> 
                                -->
                                
                                        <h4>No results found with this search parameter.</h4>
                                        
                                <?php
                                
                                $search_text2 = "*";
                                $rows2 = $chemicals->search($search_text2);
                                
                                foreach($rows2 as $row)
                                {
                                    ?>
                                        
                                <tr>
				      			<td><?php echo $row['begin_of_pname']; ?></td>
				      			<td><?php echo $row['cas_no']; ?></td>
				      			<td><?php echo $row['un_no']; ?></td>
				      			<td>
				      				<!--
				      				<a class="btn btn-sm btn-outline-primary" href="editChemicals.php?id=<?php //echo $row['internal_no']; ?>"><i class="fa fa-pencil-square-o" aria-hidden	="true"></i>&nbsp;Edit</a>&nbsp;
				      				<a class="btn btn-sm btn-outline-danger" href="searchChemicals.php?del=<?php //echo $row['internal_no']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete</a>&nbsp;
				      			-->
				      				<a  class="btn btn-sm" href="chemicalInfo.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;View</a>
                                    <a  class="btn btn-sm" href="print-label-guest.php?read=<?php echo $row['chemical_header_id']; ?>&size=<?php echo urldecode('A4'); ?>"><i class="fas fa-print" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;A4</a>
                                    <button class="btn btn-sm" data-toggle="modal" data-target="#goPremium"><i class="fas fa-print" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;A5</button>
				      			</td>
				    			</tr>   
                                        
                                    <?php
                                }
                                
                                ?>
                             <?php
							}
							else
							{
                                ?>
                                <!--<tr>
                                    <td colspan="4">TOP MATCHES</td>        
                                </tr>     -->   
                                <?php
								foreach ($rows as $row) 
				  				{
				  				?>
				  		
				  				<tr>
				      			<td><?php echo $row['begin_of_pname']; ?></td>
				      			<td><?php echo $row['cas_no']; ?></td>
				      			<td><?php echo $row['un_no']; ?></td>
				      			<td>
				      				<!--
				      				<a class="btn btn-sm btn-outline-primary" href="editChemicals.php?id=<?php //echo $row['internal_no']; ?>"><i class="fa fa-pencil-square-o" aria-hidden	="true"></i>&nbsp;Edit</a>&nbsp;
				      				<a class="btn btn-sm btn-outline-danger" href="searchChemicals.php?del=<?php //echo $row['internal_no']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete</a>&nbsp;
				      			-->
				      				<a  class="btn btn-sm" href="chemicalInfo.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;View</a>
                                    <a  class="btn btn-sm" href="print-label-guest.php?read=<?php echo $row['chemical_header_id']; ?>&size=<?php echo urldecode('A4'); ?>"><i class="fas fa-print" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;A4</a>
                                    <button class="btn btn-sm" data-toggle="modal" data-target="#goPremium"><i class="fas fa-print" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;A5</button>
				      			</td>
				    			</tr>                                    
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <h4>OTHER CHEMICALS</h4>
                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                            <th>UN No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                            <th>UN No</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                     <tbody>
                                     
                                <?php
                                }
                                $search_text2 = "*";
                                $rows2 = $chemicals->search($search_text2);
                                
                                foreach($rows2 as $row)
                                {
                                    ?>
                                        
                                <tr>
				      			<td><?php echo $row['begin_of_pname']; ?></td>
				      			<td><?php echo $row['cas_no']; ?></td>
				      			<td><?php echo $row['un_no']; ?></td>
				      			<td>
				      				<!--
				      				<a class="btn btn-sm btn-outline-primary" href="editChemicals.php?id=<?php //echo $row['internal_no']; ?>"><i class="fa fa-pencil-square-o" aria-hidden	="true"></i>&nbsp;Edit</a>&nbsp;
				      				<a class="btn btn-sm btn-outline-danger" href="searchChemicals.php?del=<?php //echo $row['internal_no']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete</a>&nbsp;
				      			-->
				      				<a  class="btn btn-sm" href="chemicalInfo.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;View</a>
                                    <a  class="btn btn-sm" href="print-label-guest.php?read=<?php echo $row['chemical_header_id']; ?>&size=<?php echo urldecode('A4'); ?>"><i class="fas fa-print" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;A4</a>
                                    <button class="btn btn-sm" data-toggle="modal" data-target="#goPremium"><i class="fas fa-print" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;A5</button>
				      			</td>
				    			</tr>   
                                        
                                    <?php
                                }
                                
                                ?>
                                         
                            <?php
				  				
				  			}
				}

                                        ?>
       
                                     </tbody>
                                </table>
                                
                                 <div class="modal fade" id="goPremium" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                                     <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                           <div class="modal-header">
                                                 <h6 class="modal-title" id="smallmodalLabel">Want to print in A5, A6, and more?</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                           </div>
                                <div class="modal-body">
                                    <p>
                                        Register to the site and be part of Chemistry Portal!
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-secondary"><a href="user-register.php">Register!</a></button>
                                </div>
                                        </div>
                                    </div>
                                </div>
                                
                               
                                
                                
                            </div>
                        </div>