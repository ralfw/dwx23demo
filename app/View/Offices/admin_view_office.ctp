  <?php
  $flag = 0;
  //pr($offices); exit;
  ?>
  <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Office detail</h3>
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

                      <?php echo "&nbsp > &nbsp" ?>
        <li class="active">Subcategory detail</li>


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
                            <h3 class="ptitle">basic Info:</h3>
                             <div class="names"><p class="stitle">Phone Number</p>
                              <?php if(!empty($offices['Office']['phone_no'])){ ?>
                                <h6><?= $offices['Office']['phone_no']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                                </div>
 <span style="float: right; margin-top: -20px;">
                                <?=
                                $this->Html->link("<button type='button' class='btn waves-effect waves-light btn-info'>Edit</button>", array(
                                'controller' => 'offices',
                                'action' => 'editOffice',
                                  'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1', $offices['Office']['id'], 'listOffice',
                                ), array('escape' => false)
                                );
                                ?>    
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
                             
                              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#location" role="tab">Location</a> </li>
                              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#address" role="tab">Address</a> </li>
                             
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                  
                                <div class="tab-pane active" id="location" role="tabpanel">
                                   <div class="card-body">
                            <h3 class="ptitle">Office Location:</h3>
                             <div class="names"><p class="stitle">Location (English)</p>
                              <?php if(!empty($offices['Office']['location_en'])){ ?>
                                <h6><?= $offices['Office']['location_en']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                                </div>

                              <div class="names"><p class="stitle">Location (Arabic)</p>
                              <?php if(!empty($offices['Office']['location_ar'])){ ?>
                                <h6><?= $offices['Office']['location_ar']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                                </div>


                              <div class="names"><p class="stitle">Location (Kurdish)</p>
                              <?php if(!empty($offices['Office']['location_ku'])){ ?>
                                <h6><?= $offices['Office']['location_ku']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                                </div>

                          </div>



                                </div>
                              <div class="tab-pane" id="address" role="tabpanel">
                                <div class="card-body">
                                   <h3 class="ptitle">Office Address:</h3>
                                <div class="names"><p class="stitle">Address (English)</p>
                                <?php if(!empty($offices['Office']['address_en'])){ ?>
                                <h6><?= $offices['Office']['address_en']; ?></h6>
                                <?php } else { echo '<h6>No record found</h6>'; } ?>
                                </div>

                                <div class="names"><p class="stitle">Address (Arabic)</p>
                                <?php if(!empty($offices['Office']['address_ar'])){ ?>
                                <h6><?= $offices['Office']['address_ar']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                                </div>


                                <div class="names"><p class="stitle">Address (Kurdish)</p>
                                <?php if(!empty($offices['Office']['address_ku'])){ ?>
                                <h6><?= $offices['Office']['address_ku']; ?></h6>
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


           
