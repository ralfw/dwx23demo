<div class="row page-titles">
<?php
$lat = $shops['Shop']['lat'];
$lng = $shops['Shop']['lng'];
?>
<input type="hidden" value="<?php echo $lat?>" id="lat">
<input type="hidden" value="<?php echo $lng ?>" id="lng">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Shop detail</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">

                    <li class="breadcrumb-item">
                    <i class="fa fa-home"></i> 
                    <?php
                    echo $this->Html->getCrumbs(' > ', array(
                    'text' => 'Home',
                    'url' => array('controller' => 'users', 'action' => 'dashboard', 'admin' => true),
                    'escape' => false
                    ));
                    ?>  
                    </li>

                    <li class="breadcrumb-item">
                     <?php
                    echo $this->Html->getCrumbs(' > ', array(
                    'text' => 'View shop',
                    'url' => array('controller' => 'shops', 'action' => 'viewShop', 'admin' => true),
                    'escape' => false
                    ));
                    ?>  
                    </li>


                    </ol>
                </div>
            </div>
   <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                          
                          <div class="card-body">
                            <h3 class="ptitle">Shop Details:</h3>
                             <div class="names"><p class="stitle">Name (English)</p>
                              <?php if(!empty($shops['Shop']['name_en'])){ ?>
                                <h6><?= $shops['Shop']['name_en']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?></div>

                             <div class="names"><p class="stitle">Name (Arabic)</p>
                              <?php if(!empty($shops['Shop']['name_ar'])){ ?>
                                <h6><?= $shops['Shop']['name_ar']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?></div>
                              <div class="names"><p class="stitle">Name (Kurdish)</p>
                            <?php if(!empty($shops['Shop']['name_ku'])){ ?>
                                <h6><?= $shops['Shop']['name_ku']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?></div>
                             
                                <div class="names">
                                 <p class="stitle">Social Profile</p>
                                <br/>
                                <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fa fa-snapchat"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fa fa-instagram"></i></button>
                                </div>
                          </div>

                        </div>
                        </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Contact Info</a> </li>
                              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile" role="tab">Address</a> </li>
                             <!--  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings" role="tab">Social Media</a> </li> -->
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                     <div class="names"><p class="stitle">Phone 1</p>
                                      <?php if(!empty($shops['Shop']['phone1'])){ ?>
                                     <h6><?= $shops['Shop']['phone1']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?></div>
                                     <div class="names"><p class="stitle">Phone 2</p>
                                      <?php if(!empty($shops['Shop']['phone2'])){ ?>
                                     <h6><?= $shops['Shop']['phone2']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?></div>
                                     <div class="names"><p class="stitle">Phone 3</p>
                                      <?php if(!empty($shops['Shop']['phone3'])){ ?>
                                     <h6><?= $shops['Shop']['phone3']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?></div>
                                      <div class="names"><p class="stitle">Email</p>
                                      <?php if(!empty($shops['Shop']['email'])){ ?>
                                     <h6><?= $shops['Shop']['email']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?></div>
                                     <div class="names"><p class="stitle">Description (Engliah)</p>
                                      <?php if(!empty($shops['Shop']['desc_en'])){ ?>
                                     <h6><?= $shops['Shop']['desc_en']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?>
                                     </div>
                                     <div class="names"><p class="stitle">Description (Arabic)</p>
                                      <?php if(!empty($shops['Shop']['desc_ar'])){ ?>
                                     <h6><?= $shops['Shop']['desc_ar']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?>
                                     </div>
                                     <div class="names"><p class="stitle">Description (Kurdish)</p>
                                      <?php if(!empty($shops['Shop']['desc_ku'])){ ?>
                                     <h6><?= $shops['Shop']['desc_ku']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?>
                                     </div>
                                      
                                  </div> 

                                  </div>
                                            
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                <div class="card-body">
                                <div class="names"><p class="stitle">Address (English)</p>
                                      <?php if(!empty($shops['Shop']['address_en'])){ ?>
                                     <h6><?= $shops['Shop']['address_en']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?></div>
                                     <div class="names"><p class="stitle">Address (Arabic)</p>
                                      <?php if(!empty($shops['Shop']['address_ar'])){ ?>
                                     <h6><?= $shops['Shop']['address_ar']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?></div>
                                     <div class="names"><p class="stitle">Address (Kurdish)</p>
                                      <?php if(!empty($shops['Shop']['address_en'])){ ?>
                                     <h6><?= $shops['Shop']['address_en']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?></div>
                                      <div class="names"><p class="stitle">Latitude</p>
                                      <?php if(!empty($shops['Shop']['lat'])){ ?>
                                     <h6><?= $shops['Shop']['lat']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?></div>
                                     <div class="names"><p class="stitle">Longitude</p>
                                      <?php if(!empty($shops['Shop']['lng'])){ ?>
                                     <h6><?= $shops['Shop']['lng']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?>
                                     </div>
                                        <div class="names">
                             
                                <?php if(!empty($shops['Shop']['address_en'])){ ?>
                                <div class="map-box">
                                <?php $address = $shops['Shop']['address_en'] ;

echo '<iframe width="100%" height="150" frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $address)) . '&z=14&output=embed"></iframe>';
                            ?>
                                   <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe> -->
                                </div>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                                </div>
                                     
                                     
                                        
                                                    
                                 </div>

                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
               
              
            </div>
<style>
h3.ptitle {
font-size: 16px !important;
font-weight: 600;
text-decoration: underline;
}
p.stitle {
    margin-bottom: 0px;
    font-weight: bold;
}
.names {
    margin-bottom: 30px;
}
</style>


           
