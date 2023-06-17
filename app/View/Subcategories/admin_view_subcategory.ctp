  <?php
//pr($keys);
// exit;
  $flag = 0;
  ?>
  <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Subcategory detail</h3>
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
                                <center class="m-t-30">
                                <?php
                                $m = FULL_BASE_URL . $this->webroot . $subcategories['Subcategory']['image'];
                                $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';

                                if(!empty($subcategories['Subcategory']['image'])){ ?>
                                 <img src="<?php echo $m ?>" class="img-circle img_display" width="100" height="100"/>
                                <?php } else  { ?>
                                <img src="<?php echo $default ?>" class="img-circle img_display" width="100" height="100"/>
                                <?php } ?>
                                    <h3 class="card-title m-t-10"><?php if(!empty($subcategories['Category']['name_en'])){ ?>
                                <h6><?= strtoupper($subcategories['Category']['name_en']); ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?></h3>
                                </center>
                            </div>
                            <div>
                            <hr> 
                          </div>
                          <div class="card-body">
                            <h3 class="ptitle">Subcategory Details:</h3>
                             <div class="names"><p class="stitle">Name (English)</p>
                              <?php if(!empty($subcategories['Subcategory']['name_en'])){ ?>
                                <h6><?= $subcategories['Subcategory']['name_en']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?></div>

                             <div class="names"><p class="stitle">Name (Arabic)</p>
                              <?php if(!empty($subcategories['Subcategory']['name_ar'])){ ?>
                                <h6><?= $subcategories['Subcategory']['name_ar']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?></div>
                              <div class="names"><p class="stitle">Name (Kurdish)</p>
                            <?php if(!empty($subcategories['Subcategory']['name_ku'])){ ?>
                                <h6><?= $subcategories['Subcategory']['name_ku']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?></div>
                                  <span style="float: right; margin-top: -20px;">
                                <?=
                                $this->Html->link("<button type='button' class='btn waves-effect waves-light btn-info'>Edit</button>", array(
                                'controller' => 'subcategories',
                                'action' => 'editSubcategory',
                                'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                                $subcategories['Subcategory']['id'], 'listSubcategory',
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
                              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Keyword (English)</a> </li>
                              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile" role="tab">Keyword (Arabic)</a> </li>
                              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings" role="tab">Keyword (Kurdish)</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                  <div class="tab-pane active" id="home" role="tabpanel">
                                  <div class="card-body">
                                  <div class="profiletimeline">
                                    <?php foreach ($keys as $value) { ?>
                                  <p class="m-t-10"> 
                                      <?php if(!empty($value)) { ?>
                                      <?= $value['name_en']; 
                                       $flag = 1;
                                        ?>
                                      <?php } ?>
                                  </p>
                                  <?php  } ?>
                                  <?php if($flag != 1){ echo 'No record found';} ?>
                                  </div>
                                  </div>
                                  </div>
                                            
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                  <div class="card-body">
                                    <div class="profiletimeline">
                                      <?php foreach ($keys as $value) { 
                                        
                                        ?>
                                      <p class="m-t-10"> 
                                      <?php if(!empty($value)) { ?>
                                      <?= $value['name_ar']; 
                                      $flag = 2;
                                      ?>
                                      <?php } ?>
                                      </p>
                                      <?php  } ?>
                                      <?php if($flag != 2){ echo 'No record found';} ?>

                                    </div>
                                    
                                  </div>


                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                <div class="card-body">
                                        <div class="profiletimeline">
                                           <?php foreach ($keys as $value) { ?>
                                  <p class="m-t-10"> 
                                      <?php if(!empty($value)) { ?>
                                      <?= $value['name_ku'];
                                       $flag = 3;
                                       ?>
                                      <?php } ?>
                                  </p>
                                  <?php  } ?>
                                  <?php if($flag != 3){ echo 'No record found';} ?>
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


           
