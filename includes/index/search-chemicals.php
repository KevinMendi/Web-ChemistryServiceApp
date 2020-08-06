<section class="section section-xl-custom image-section section-lined" id="searchChemicals">
        <div class="container">
          <div class="row">
            <div class="col-md-4"><h3>Search Chemicals</h3></div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-7 col-lg-6">
              
              <div class="big big-custom font-color" style="margin-top:-20px;">Find Chemical Information and Explore Chemicals</div>
              <p>
                  <form  action="searchResults.php" method="post">
                    <div class="col-md-12">
                    <div class="input-group ">
                    <input class="form-control form-control-lg" type="search" name="search" placeholder="Search Chemicals by their CAS, UN Numbers, or by their Names" >
                        <span class="input-group-append">
                          <button class="btn btn-outline-secondary" type="submit" name="submit-search" >
                              <i class="fa fa-search"></i>
                          </button>
                        </span>
                    </div>
                    </div>
                  </form>  
              </p>
              
                  <?php include 'chem-List.php'; ?>
              <!--<div class="button-wrap-2"><a class="button button-default" href="about-us.html">Read more about us</a></div>-->
            </div>
          </div>
        <div class="image-container">
          <div class="mock-up-1">
            <div class="object object-1"><img class="wow fadeInRight" src="images/SEARCH_CHEMICALS_1.svg" alt="" width="395" height="243"/>
            </div>
            <div class="object object-2"><img  class="wow fadeInRight" src="images/SEARCH_CHEMICALS_4.svg" alt="" width="384" height="189" data-wow-delay="0.2s"/>
            </div>
            <div class="object object-3"><img class="wow fadeInRight" src="images/SEARCH_CHEMICALS_3.svg" alt="" width="395" height="243" data-wow-delay="0.4s"/>
            </div>
            <div class="object object-4"><img class="wow fadeInRight" src="images/image-custom-4-209x184.jpg" alt="" width="209" height="184" data-wow-delay="0.6s"/>
            </div>
            <div class="object object-5"><img class="wow fadeInRight" src="images/SEARCH_CHEMICALS_2.svg" alt="" width="395" height="243" data-wow-delay="0.2s"/>
            </div>
            <div class="object object-6"><img class="wow fadeInRight" src="images/image-custom-6-275x184.jpg" alt="" width="275" height="184" data-wow-delay="0.4s"/>
            </div>
          </div>
        </div>
          <br><br><br>
      </section>