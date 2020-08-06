      <header class="section page-header">
        <!-- chemPO Navbar-->
        <div class="noHash" id="homePage">
          <nav class="rd-navbar rd-navbar-wide" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <!-- chemPO Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- ChemPO Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                </div>
                <div class="rd-navbar-nav-wrap">
                  <!-- chemPO Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item rd-nav-link noHash" data-block="homePage">Home
                    </li>
                    <li class="rd-nav-item rd-nav-link noHash" data-block="searchChemicals">About chemPO
                    </li>
                   <li class="rd-nav-item"><a class="rd-nav-link" href="data-privacy.php" rel="noopener noreferrer" target="_blank">Data Privacy</a></li>
                     <li class="rd-nav-item rd-nav-link noHash" data-block="densityCalc">Density Calculator
                    </li> 
                    
                      <li class="rd-nav-item rd-nav-link noHash" data-block="blog">Blog
                    </li>
                      
                      <?php
                      if (isset($_SESSION['user_id'])) {
                          echo "<li class='rd-nav-item'><a class='rd-nav-link' href='index.php'>Dashboard</a></li>";
                      }else{
                          echo "<li class='rd-nav-item'><a class='rd-nav-link' href='sign-in.php'>Log In</a></li>";
                      }
                      ?>
                      
                    
                      <li class="rd-nav-item" style="background-color:rgba(255,140,0.6);"><a class="rd-nav-link" href="user-register.php" class="registerColor">Register</a>
                        </li>
                  </ul>
                    
                </div>
              </div>
            </div>
          </nav>
        </div>
          
      </header>

