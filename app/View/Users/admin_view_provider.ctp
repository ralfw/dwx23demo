  <?php
 // pr($subcategories); 
  //exit;
  ?>
  <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?php echo $layoutTitle;?></h3>
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
        <li class="active"><?php echo $layoutTitle;?></li>


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
                                $m = FULL_BASE_URL . $this->webroot . $users['User']['image'];
                                $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';

                                if(!empty($users['User']['image'])){ ?>
                                 <img src="<?php echo $m ?>" class="img-circle img_display" width="100" height="100"/>
                                <?php } else  { ?>
                                <img src="<?php echo $default ?>" class="img-circle img_display" width="100" height="100"/>
                                <?php } ?>
                               </center>
                            </div>
                            <div>
                            <hr> 
                            </div>
                          <div class="card-body">
                            <h3 class="ptitle">Provider Details:</h3>
                             <div class="names"><p class="stitle">Name</p>
                              <?php if(!empty($users['User']['name'])){ ?>
                                <h6><?= $users['User']['name']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                            </div>
                            <div class="names"><p class="stitle">Phone</p>
                              <?php if(!empty($users['User']['phone'])){ ?>
                                <h6><?= $users['User']['phone']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                            </div>
                            <div class="names"><p class="stitle">Email</p>
                              <?php if(!empty($users['User']['email'])){ ?>
                                <h6><?= $users['User']['email']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                            </div>
                            <span style="float: right; margin-top: -20px;">
                            <?=
                            $this->Html->link("<button type='button' class='btn waves-effect waves-light btn-info'>Edit</button>", array(
                            'controller' => 'users',
                            'action' => 'editProvider',
                            'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                            $users['User']['id'], 'listProvider',
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
                                  
                                                       <p class="m-t-10"> 
                                             <?php if(!empty($subcategories['Subcategory']['keyboard_en'])){ ?>
                               <?= $subcategories['Subcategory']['keyboard_en']; ?>
                                <?php } else {echo 'No record found';} ?>
                                            </p>
                                                    </div>
                                                    
                                                </div>
                                  </div>
                                            
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                <div class="card-body">
                                        <div class="profiletimeline">
                                           <p class="m-t-10"> 
                                             <?php if(!empty($subcategories['Subcategory']['keyboard_ar'])){ ?>
                               <?= $subcategories['Subcategory']['keyboard_ar']; ?>
                                <?php } else {echo 'No record found';} ?>
                                            </p>
                                                    </div>
                                                    
                                                </div>

                                   
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                <div class="card-body">
                                  <div class="profiletimeline">
                                  
                                                      <p class="m-t-10"> 
                                             <?php if(!empty($subcategories['Subcategory']['keyboard_ku'])){ ?>
                               <?= $subcategories['Subcategory']['keyboard_ku']; ?>
                                <?php } else {echo 'No record found';} ?>
                                            </p>
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



           
