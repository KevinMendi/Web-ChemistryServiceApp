<br>       
<a href="https://chemistryservice.rimpido.com/"><button type="button" class="button button-default">Back to Home</button></a>
        <br><br>
        <table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col" class="table-primary">Chemical Name</th>
				      <th scope="col" class="table-primary">CAS No</th>
				      <th scope="col" class="table-primary">UN No</th>
				      <th scope="col" class="table-primary" width="25%">Action</th>
				    </tr>
				  </thead>
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
                                <td colspan="4"><center><strong>NO RESULTS. TRY REFINING YOUR SEARCH KEYWORDS.</strong></center></td>
                             <?php
							}
							else
							{
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
                                    <button class="btn btn-sm btn-outline-success" style="background-color:rgba(0,0,0,0); color:orange;" data-toggle="modal" data-target="#goPremium"><i class="fas fa-print" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;A5</button>
				      			</td>
				    			</tr>
				  				<?php
				  				}
				  			}
				  			}

				  			?>
							
				  	
				  

				 

				    
				    
				  </tbody>
				</table>


                                <!-- MODAL -->

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
                                    <button type="button" class="btn btn-primary"><a href="user-register.php">Register!</a></button>
                                </div>
                                        </div>
                                    </div>
                                </div>