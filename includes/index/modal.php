<!-- FIRST NEWS -->    
<div class="modal fade" id="chemBlogs" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true" style="margin-top:5em;">
                                     <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                           <div class="modal-header">
                                               <h6 class="modal-title" id="smallmodalLabel"><h5 style="color:black !important;">
                                                   <?php
                                                    $ch = new Chempo();

                                                    $output = $ch->viewBlogOfTheDay("1");

                                                    echo $output['post_name'];
                                                    ?>
                                                   </h5></h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                           </div>
                                <div class="modal-body">
                                    <p>
                                        <center>
                                        <?php
                                        echo html_entity_decode($output['post_content']);
                                        ?>
                                        </center>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                        </div>
                                    </div>
</div>

<!-- SECOND NEWS -->

<div class="modal fade" id="chemBlogs2" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true" style="margin-top:5em;">
                                     <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                           <div class="modal-header">
                                               <h6 class="modal-title" id="smallmodalLabel"><h5 style="color:black !important;">
                                                 <?php
                                                    $ch2 = new Chempo();

                                                    $output2 = $ch->viewBlogOfTheDay("2");

                                                    echo $output2['post_name'];
                                                 ?>   
                                                </h5></h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                           </div>
                                <div class="modal-body">
                                    <p style="text-align:justify;">
                                        <?php
                                        echo html_entity_decode($output2['post_content']);
                                        ?>
                                        
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                        </div>
                                    </div>
</div>

<!-- THIRD NEWS -->

<div class="modal fade" id="chemBlogs3" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true" style="margin-top:5em;">
                                     <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                           <div class="modal-header">
                                               <h6 class="modal-title" id="smallmodalLabel"><h5 style="color:black !important;">
                                               <?php
                                                    $ch3 = new Chempo();

                                                    $output3 = $ch3->viewBlogOfTheDay("3");

                                                    echo $output3['post_name'];
                                                 ?>       
                                               </h5></h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                           </div>
                                <div class="modal-body">
                                    <p>
                                         <?php
                                        echo html_entity_decode($output3['post_content']);
                                        ?>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                        </div>
                                    </div>
</div>

<!-- 4TH BLOG -->
<div class="modal fade" id="chemBlogs4" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true" style="margin-top:5em;">
                                     <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                           <div class="modal-header">
                                               <h6 class="modal-title" id="smallmodalLabel"><h5 style="color:black !important;">Building Next Gen Smart Materials with the Power of Sound</h5></h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                           </div>
                                <div class="modal-body">
                                    <p>
                                        <center>
                                        <img src="images/blog/head-4-mini.png" width="350"/></center><br>
                                        Researchers have used sound waves to precisely manipulate atoms and molecules, accelerating the sustainable production of breakthrough smart materials.<br>

Metal-organic frameworks, or MOFs, are incredibly versatile and super porous nanomaterials that can be used to store, separate, release or protect almost anything.<br>

Predicted to be the defining material of the 21st century, MOFs are ideal for sensing and trapping substances at minute concentrations, to purify water or air, and can also hold large amounts of energy, for making better batteries and energy storage devices.<br>

Scientists have designed more than 88,000 precisely-customised MOFs—with applications ranging from agriculture to pharmaceuticals—but the traditional process for creating them is environmentally unsustainable and can take several hours or even days.<br>

Now researchers from RMIT University in Melbourne, Australia, have demonstrated a clean, green technique that can produce a customised MOF in minutes.<br>

Dr. Heba Ahmed, lead author of the study published in Nature Communications, said the efficient and scaleable method harnessed the precision power of high-frequency sound waves.
<br>
"MOFs have boundless potential, but we need cleaner and faster synthesis techniques to take full advantage of all their possible benefits," Ahmed, a postdoctoral researcher in RMIT's Micro/Nanophysics Research Laboratory, said.
<br>
"Our acoustically-driven approach avoids the environmental harms of traditional methods and produces ready-to-use MOFs quickly and sustainably.
<br>
"The technique not only eliminates one of the most time-consuming steps in making MOFs, it leaves no trace and can be easily scaled up for efficient mass production."
<br>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                        </div>
                                    </div>
</div>


<!-- 5TH BLOG -->
<div class="modal fade" id="chemBlogs5" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true" style="margin-top:5em;">
                                     <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                           <div class="modal-header">
                                               <h6 class="modal-title" id="smallmodalLabel"><h5 style="color:black !important;">Nature Inspires a Novel New Form of Computing, Using Light</h5></h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                           </div>
                                <div class="modal-body">
                                    <p>
                                        <center>
                                        <img src="images/blog/head-5-mini.jpg" width="350"/></center><br>
                                        The material in the cube reads and reacts intuitively to the light in much the same way a plant would turn to the sun, or a cuttlefish would change the color of its skin.<br>

The researchers are graduate students in chemistry supervised by Kalaichelvi Saravanamuttu, an associate professor of chemistry and chemical biology whose lab focuses on ideas inspired by natural biological systems.<br>

The researchers were able to use their new process to perform simple addition and subtraction questions.<br>

"These are autonomous materials that respond to stimuli and do intelligent operations," says Saravanamuttu. "We're very excited to be able to do addition and subtraction this way, and we are thinking of ways to do other computational functions."<br>

The researchers' work, published today in the journal Nature Communications, represents a completely new form of computing, one they say holds the promise of complex and useful functions yet to be imagined, possibly organized along the structures of neural networks.<br>

The form of computing is highly localized, needs no power source and operates completely within the visible spectrum.<br>

The technology is part of a branch of chemistry called nonlinear dynamics, and uses materials designed and manufactured to produce specific reactions to light.<br>

A researcher shines layered stripes of light through the top and sides of a tiny, glass case holding the amber-coloured polymer, itself roughly the size of a die used in a board game. The polymer starts as a liquid and transforms to a gel in reaction to the light.<br>

A neutral carrier beam passes through the cube from the back, toward a camera that reads the results, as refracted by the material in the cube, whose components form spontaneously into thousands of filaments that react to the patterns of light to produce a new three-dimensional pattern that expresses the outcome.<br>

"We don't want to compete with existing computing technologies," says co-author Fariha Mahmood, a master's student in chemistry. "We're trying to build materials with more intelligent, sophisticated responses."
<br>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                        </div>
                                    </div>
</div>


<!-- 6TH BLOG -->
<div class="modal fade" id="chemBlogs6" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true" style="margin-top:5em;">
                                     <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                           <div class="modal-header">
                                               <h6 class="modal-title" id="smallmodalLabel"><h5 style="color:black !important;">Comet inspires chemistry for making breathable oxygen on Mars</h5></h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                           </div>
                                <div class="modal-body">
                                    <p>
                                        <center>
                                        <img src="images/blog/head-6-mini.jpg" width="350"/></center><br>
                                        The material in the cube reads and reacts intuitively to the light in much the same way a plant would turn to the sun, or a cuttlefish would change the color of its skin.<br>

The researchers are graduate students in chemistry supervised by Kalaichelvi Saravanamuttu, an associate professor of chemistry and chemical biology whose lab focuses on ideas inspired by natural biological systems.<br>

The researchers were able to use their new process to perform simple addition and subtraction questions.<br>

"These are autonomous materials that respond to stimuli and do intelligent operations," says Saravanamuttu. "We're very excited to be able to do addition and subtraction this way, and we are thinking of ways to do other computational functions."<br>

The researchers' work, published today in the journal Nature Communications, represents a completely new form of computing, one they say holds the promise of complex and useful functions yet to be imagined, possibly organized along the structures of neural networks.<br>

The form of computing is highly localized, needs no power source and operates completely within the visible spectrum.<br>

The technology is part of a branch of chemistry called nonlinear dynamics, and uses materials designed and manufactured to produce specific reactions to light.<br>

A researcher shines layered stripes of light through the top and sides of a tiny, glass case holding the amber-coloured polymer, itself roughly the size of a die used in a board game. The polymer starts as a liquid and transforms to a gel in reaction to the light.<br>

A neutral carrier beam passes through the cube from the back, toward a camera that reads the results, as refracted by the material in the cube, whose components form spontaneously into thousands of filaments that react to the patterns of light to produce a new three-dimensional pattern that expresses the outcome.<br>

"We don't want to compete with existing computing technologies," says co-author Fariha Mahmood, a master's student in chemistry. "We're trying to build materials with more intelligent, sophisticated responses."
<br>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                        </div>
                                    </div>
</div>

