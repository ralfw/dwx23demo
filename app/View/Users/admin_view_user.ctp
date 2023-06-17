  <?php
  //pr($listsArr); 
  //exit;
  ?>
  <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">View User</h3>
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
                    'text' => 'View app user',
                    'url' => array('controller' => 'users', 'action' => 'viewUser', 'admin' => true),
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
                            <?php if($users['User']['userType'] == '2' && $users['User']['worked_as'] == '3' ){
                              $m = FULL_BASE_URL . $this->webroot . $users['Salon']['salon_logo'];
                            }
                            else
                            {
                              $m = FULL_BASE_URL . $this->webroot . $users['User']['image']; 
                            }
                            ?>
                            <center class="m-t-30"> <img src="<?php echo $m ?>" class="img-circle" width="100" height="100"/>
                                    <h4 class="card-title m-t-10"><?= $users['User']['name']; ?></h4>
                                     
                            </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> 
                                <small class="text-muted">Email address:</small>
                                <h6><?= $users['User']['email']; ?></h6> 
                                <small class="text-muted p-t-30 db">Phone:</small>
                                <h6><?= $users['User']['phoneNumber']; ?></h6> 
                                <?php if(!empty($users['User']['location']) && ($users['User']['userType'] == '2')): ?>
                                <small class="text-muted p-t-30 db">Address</small>
                                <h6><?= $users['User']['location']; ?></h6>
                                <div class="map-box">
                                <?php 
                                   $address = $users['User']['location'];
    
                                  echo '<iframe frameborder="0" width="100%" height="150" allowfullscreen src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $address)) . '&z=14&output=embed "></iframe>';

                                    ?>
                                  
                                </div>
                               <?php endif; ?>
                               
                            </div>
                        </div> </div>
                         <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                  <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Basic Info</a> </li>
                    <?php foreach ($listsArr as $value) { ?>
                    <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="<?php echo '#'.$value['salonData']['name']; ?>" role="tab"><?= $value['salonData']['name']; ?></a> 
                    </li>
                    <?php } ?>
                             
                                
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                <div class="card-body"> 
                                <small class="text-muted">Phone Number</small>
                                <?php if(!empty($users['User']['phoneNumber'])){ ?>
                                <h6><?= $users['User']['phoneNumber']; ?></h6> 
                                 <?php } else {echo '<h6>No record found</h6>';} ?>

                                <small class="text-muted p-t-30 db">Qualification</small>
                                <?php if(!empty($users['User']['qualifictaion'])){ ?>
                                <h6><?= $users['User']['qualifictaion']; ?></h6> 
                                <?php } else {echo '<h6>No record found</h6>';} ?>

                                
                                <small class="text-muted p-t-30 db">Main Skill</small>
                                   <?php if(!empty($users['User']['skill'])){ ?>
                                <h6><?= $users['User']['skill']; ?></h6>
                                 <?php } else {echo '<h6>No record found</h6>';} ?>
                                <small class="text-muted p-t-30 db">Experience</small>
                                  <?php if(!empty($users['User']['experience'])){ ?>
                                <h6><?= $users['User']['experience']; ?></h6>
                                <?php } else {echo '<h6>No record found</h6>';} ?>
                               
                                <?php
                                $m = FULL_BASE_URL . $this->webroot . $users['User']['cover_image'];
                                if(!empty($users['User']['cover_image'])){ ?>
                                 <small class="text-muted p-t-30 db">Cover Image</small>
                                <img src="<?php echo $m ?>" class="img-circle" width="100" height="100"/>
                                <?php } ?>
                                

                                
                               
                                </div>
                                </div>
                                <!--second tab-->
                                <?php foreach ($listsArr as $value) { ?>
                                <div class="tab-pane" id="<?php echo $value['salonData']['name']?>" role="tabpanel">
                                <?php foreach ($value['imgData'] as $data) { ?>
                                  
                                 <div class="card-body"> 
                                  <div class="owl-carousel owl-theme">
                                 <?php foreach ($data['imageArr'] as $value) { ?>
                                  <?php $m = FULL_BASE_URL . $this->webroot . $value['image']; ?>
                                    <div><img src="<?php echo $m; ?>" width="150" height="150"></div>
                                 <?php } ?>
                                   </div>
                                </div>
                               
                                <?php } ?>
                              </div>
                              <?php } ?>
                               
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column -->
                    <!-- Column -->
                   
                    <!-- Column -->
                </div>

           
<style>
.col-md-4{
    float:left;
}
</style>
