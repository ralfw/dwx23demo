<div class="row page-titles">
<?php
//pr($subcategory); 

//exit;
$lat = $shops['Shop']['lat'];
$lng = $shops['Shop']['lng'];
?>
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
                 

                   <div class="card-body">
                        
                        <center class="m-t-30">
                        <?php
                        $m = FULL_BASE_URL . $this->webroot . $shops['Shop']['image'];
                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';

                        if(!empty($shops['Shop']['image'])){ ?>
                         <img src="<?php echo $m ?>" class="img-circle img_display" width="100" height="100"/>
                        <?php } else  { ?>
                        <img src="<?php echo $default ?>" class="img-circle img_display" width="100" height="100"/>
                        <?php } ?>
                        <h3 class="card-title m-t-10"><?php if(!empty($shops['Shop']['name_en'])){ ?>
                        <h6><?= strtoupper($shops['Shop']['name_en']); ?></h6>
                        <?php } else {echo '<h6>No record found</h6>';} ?></h3>
                        </center>
                        </div>
                        <div>
                        <hr> 
                        </div>
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
                    <?php if (strpos($shops['Shop']['facebook'], 'http://') === false) { ?>
                    <a href="<?= 'https://'.$shops['Shop']['facebook']; ?>" target="_blank" class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></a>

                    <?php } else{ ?>
                    <a href="<?= $shops['Shop']['facebook']; ?>" target="_blank" class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></a>

                     <?php } ?>
                  <?php if (strpos($shops['Shop']['twitter'], 'http://') === false) { ?>
                   <a href="<?= 'https://'.$shops['Shop']['twitter']; ?>" target="_blank"><button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button></a>

                    <?php } else { ?>
                    <a href="<?= $shops['Shop']['twitter']; ?>" target="_blank" class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></a>

                    <?php } ?>

                    <?php if (strpos($shops['Shop']['snapchat'], 'http://') === false) { ?>
                    <a href="<?= 'https://'.$shops['Shop']['snapchat']; ?>" target="_blank"><button class="btn btn-circle btn-secondary"><i class="fa fa-snapchat"></i></button></a>

                    <?php } else { ?>
                    <a href="<?= $shops['Shop']['snapchat']; ?>" target="_blank" class="btn btn-circle btn-secondary"><i class="fa fa-snapchat"></i></a>

                     <?php } ?>

                       <?php if (strpos($shops['Shop']['instagram'], 'http://') === false) { ?>
                    <a href="<?= 'https://'.$shops['Shop']['instagram']; ?>" target="_blank"><button class="btn btn-circle btn-secondary"><i class="fa fa-instagram"></i></button></a>
                    <?php } else { ?>
                    <a href="<?= $shops['Shop']['instagram']; ?>" target="_blank"><button class="btn btn-circle btn-secondary"><i class="fa fa-instagram"></i></button></a>
                     <?php } ?>


                       <?php if (strpos($shops['Shop']['youtube'], 'http://') === false) { ?>
                    <a href="<?= 'https://'.$shops['Shop']['youtube']; ?>" target="_blank"><button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button></a>
                    <?php } else { ?>
                    <a href="<?= $shops['Shop']['youtube']; ?>" target="_blank"><button class="btn btn-circle btn-secondary"><i class="fa fa-v"></i></button></a>
                     <?php } ?>
                    


                   
                  
                   
                    </div>
                    <span style="float: right; margin-top: -20px;">  <?php echo
                          $this->Html->link("<button type='button' class='btn waves-effect waves-light btn-info'>Edit</button>" , array(
                          'controller' => 'shops',
                          'action' => 'editShop',
                          'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                          $shops['Shop']['id'], 'listShop',
                          ), array('escape' => false)
                          ); ?>
                        </span>
                  </div>

                  </div>
                </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                            <li class="nav-item"> 
                            <a class="nav-link active" data-toggle="tab" href="#shop_info" role ="tab">Shop Info</a> 
                            </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">Contact Info</a> </li>
                              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile" role="tab">Address</a> </li>
                             <!--  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings" role="tab">Social Media</a> </li> -->
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane active" id="shop_info" role="tabpanel">
                              <div class="card-body">
                               
                               <?php if(!empty($subcategory['Category']['name_en'])){ ?>
                                <div class="names"><p class="stitle">Category (English)</p>
                                 <h6><?= $subcategory['Category']['name_en']; ?></h6>
                                </div>
                                <div class="names"><p class="stitle">Category (Arabic)</p>
                                 <h6><?= $subcategory['Category']['name_ar']; ?></h6>
                                </div>
                                <div class="names"><p class="stitle">Category (Kurdish)</p>
                                 <h6><?= $subcategory['Category']['name_ku']; ?></h6>
                                 </div>
                                 <?php } else {echo '<h6>No record found</h6>';} ?>


                               <?php if(!empty($subcategory['Subcategory']['name_en'])){ ?>
                                <div class="names"><p class="stitle">subcategory (English)</p>
                                 <h6><?= $subcategory['Subcategory']['name_en']; ?></h6>
                                </div>

                                <div class="names"><p class="stitle">subcategory (Arabic)</p>
                                 <h6><?= $subcategory['Subcategory']['name_ar']; ?></h6>
                                </div>
                                <div class="names"><p class="stitle">subcategory (Kurdish)</p>
                                 <h6><?= $subcategory['Subcategory']['name_ku']; ?></h6>
                                 </div>
                                 <?php } else {echo '<h6>No record found</h6>';} ?>
                                 
                             <div class="names"><p class="stitle">Provider</p>
                                <?php if(!empty($provider['User']['name'])){ ?>
                                <h6><?= $provider['User']['name']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                                </div>

                              </div>
                              </div>

                                <div class="tab-pane" id="home" role="tabpanel">
                                    <div class="card-body">
                                    
                                     <h3 class="ptitle">Shop Details:</h3>
                                     <div class="names"><p class="stitle">Phone 1</p>
                                      <?php if(!empty($shops['Shop']['phone1'])){ ?>
                                     <h6><?= $shops['Shop']['phone1']; ?></h6>
                                     <?php } else {echo '<h6>No record found</h6>';} ?>
                                     </div>

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
                                    <?php
                                      if(!empty($shops['Shop']['lng']) && !empty($shops['Shop']['lat'])){ ?>

                                      <input type="hidden" name="lat" id="lat" value="<?= $shops['Shop']['lat']; ?>">
                                      <input type="hidden" name="lng" id="lng" value="<?= $shops['Shop']['lng']; ?>">


                                      <?php } ?>
                                      <div class="names">
                                        
                                         <div id="map" style="width: 100%; height: 300px;"></div> 
                                      </div>
                                  
                                                    
                                 </div>

                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
               
              
            </div>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyB6y9gHV5gMmUW28iFyAdaybxkTru3Z5cE"></script>

<script type="text/javascript">
function initialize(){
  var lat = document.getElementById('lat').value;
  var lng = document.getElementById('lng').value;
  var latlng = new google.maps.LatLng(lat,lng);
 console.log(lat);
  var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: false,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var infowindow = new google.maps.InfoWindow();   
    google.maps.event.addListener(marker, 'click', function() {
      var iwContent = '<div id="iw_container">' +
      '<div class="iw_title"><b>Location</b></div></div>';
      // including content to the infowindow
      infowindow.setContent(iwContent);
      // opening the infowindow in the current map and at the current marker location
      infowindow.open(map, marker);
    });
}
 //e.preventDefault();
google.maps.event.addDomListener(window, 'load', initialize);
</script>
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


           
