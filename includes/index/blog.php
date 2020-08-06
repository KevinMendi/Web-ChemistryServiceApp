 <section class="section section-lg bg-default section-lined" id="blog" style="margin-top:5px;">
        <div class="container container-custom-width">
          <h3 class="text-center">BLOGS</h3>
          <div class="row row-custom-width row-30 row-xxl-100 row-flex">
            <div class="col-sm-6 col-md-4 wow fadeInRight">
              <div class="project-grid" style="background-image: url(images/blog/head-1.png);">
                <div class="inner"><!--<img src="images/blog/head-1-mini.jpg" alt="" width="250" height="96"/>-->
                  <h5 class="title">ChemPO Development News</h5>
                  
                    <p class="exeption">
                        <?php
                        $ch = new Chempo();
                        
                        $output = $ch->viewBlogOfTheDay("1");
                        
                        echo $output['post_name'];
                        ?>
                    </p>
                    <button class="button button-light" data-toggle="modal" data-target="#chemBlogs">View</button>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 wow fadeInRight" data-wow-delay="0.2s">
              <div class="project-grid" style="background-image: url(images/blog/head-2.jpeg);">
                <div class="inner"><!--<img src="images/blog/head-2-mini-2.jpg" alt="" width="250" height="96"/>-->
                  <h5 class="title">Regulatory News Regarding Chemicals</h5>
                   <p class="exeption">
                        <?php
                        $ch2 = new Chempo();
                        
                        $output2 = $ch2->viewBlogOfTheDay("2");
                        
                        echo $output2['post_name'];
                        ?>
                    </p>
                    <button class="button button-light" data-toggle="modal" data-target="#chemBlogs2">View</button>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 wow fadeInRight" data-wow-delay="0.4s">
              <div class="project-grid" style="background-image: url(images/blog/head-3.jpg); ">
                <div class="inner"><!--<img src="images/blog/head-3-mini.jpg" alt="" width="250" height="96"/>-->
                  <h5 class="title">News from the Chemical Industry</h5>
                  <p class="exeption">
                        <?php
                        $ch3 = new Chempo();
                        
                        $output3 = $ch2->viewBlogOfTheDay("3");
                        
                        echo $output3['post_name'];
                        ?>
                 </p>
                  <button class="button button-light" data-toggle="modal" data-target="#chemBlogs3">View</button>
                </div>
              </div>
            </div>

          </div>
          <div class="button-wrap-1 text-center"><a class="button button-default" href="bloglist.php">View All Blog Posts</a></div>
        </div>
      </section>


<?php 
    
    include 'includes/index/modal.php';

?>