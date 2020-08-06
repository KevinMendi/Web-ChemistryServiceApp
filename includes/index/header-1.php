

<section class="section context-dark bg-image bg-mask bg-mask-2 section-fullheight section-90vh" style="background-image: url(images/header1-boat-img2.jpg)" alt="header-1"  >
        <div class="section-fullheight-inner section-md">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-lg-12 text-center text-md-left">
                  <center class="jumbotron-custom wow fadeInRight" style="color:black; margin-top: -5em;">
                      <div class="text-1" style="font-family: 'Arial Black' !important;">Chemistry Service by Rimpido GmbH</div>
                      <div class="text-2">
                       Search Chemicals
                      </div>
                      
                  </center><br>
                  
              <p>
                  <form  action="search-results.php" method="post">
                    <div class="col-md-12">
                    <div class="input-group ">
                    <input class="form-control form-control-lg" type="search" name="search" placeholder="Search Chemicals by their CAS, UN Numbers, or by their Names" style="background-color:rgba(255,255,255,0.4);" >
                        <span class="input-group-append">
                          <button class="btn btn-outline-secondary" type="submit" name="submit-search" >
                              <i class="fa fa-search"></i>
                          </button>
                        </span>
                    </div>
                    </div>
                  </form>  
              </p>
                   
                  <?php include 'includes/index/chem-List.php'; ?>
              </div>
            </div>
          </div>
        </div>
</section>
