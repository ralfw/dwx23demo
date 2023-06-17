 <?php
 //pr($loginuserdata); 
 //exit;
 ?>
 <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">My Profile</h3>
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
                    'text' => 'My profile',
                    'url' => array('controller' => 'users', 'action' => 'myProfile', 'admin' => true),
                    'escape' => false
                    ));
                    ?>  
                    </li>
                    </ol>
                </div>
            </div>
 <div class="container-fluid">
 <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                           
                        <div class="card-body">
                            <?php  echo $this->Form->create('User', 
                            array('url'=>'myProfile','class'=>'horizontal-form form-validation',
                            'enctype'=>'multipart/form-data','novalidate')); ?>
                                    <div class="form-body">
                                        <h3 class="card-title">Add options</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <?php if(!empty($loginuserdata['User']['name'])){
                                                      echo $this->Form->input('name',array('label'=>false,'placeholder'=>'Enter Name','class'=>'form-control','id'=>'firstName','value'=>$loginuserdata['User']['name'] )); 
                                                       } else {
                                                       echo $this->Form->input('name',array('label'=>false,'placeholder'=>'Enter Name','class'=>'form-control','id'=>'firstName' )); 
                                                     }
                                                    ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                   <?php if(!empty($loginuserdata['User']['email'])){
                                                   echo $this->Form->input('email',array('label'=>false, 'placeholder'=>'Enter Email','class'=>'form-control', 'required'=>true, 'value'=>$loginuserdata['User']['email'] )); 
                                                 } else{
                                                   echo $this->Form->input('email',array('label'=>false, 'placeholder'=>'Enter Email','class'=>'form-control', 'required'=>true )); 
                                                 }




                                                   ?>
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                       
                                        <div class="row p-t-20">
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                <label class="control-label">My logo</label>
                                                <div class="controls">

                                                 <?php  echo $this->Form->input('image', array('type'=>'file',  'label'=>false,'class'=>'form-control','accept' => 'image/*', 'required'=>true)); 
                                                ?>

                                          <?php if(!empty($loginuserdata['User']['image'])){ ?>
                                          <input type="hidden" value="<?php echo $loginuserdata['User']['image'] ?>" name = "data[User][oldImage]">
                                          <?php
                                          $m = FULL_BASE_URL . $this->webroot . $loginuserdata['User']['image'];
                                           if (!empty($loginuserdata['User']['image'])) {
                                          $img = $this->Html->image($m, array('alt' => 'User Image', 'border' => '1',
                                          'height' => '120', 'width' => '120', 'data-src' => 'holder.js/100%x100'));
                                          echo $img;
                                          } 
                                          
                                          ?>
                      
                      
                                       <?php } ?>
                                                 
                                                  <div class="help-block"> </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                              <div class="form-group">
                                              <label class="control-label">Favicon</label>
                                              <div class="controls">
                                         <?php echo $this->Form->input('fav_icon', array('type'=>'file','label'=>false, 'class'=>'form-control','accept' => 'image/*','required'=>true )); ?>

                                          <?php if(!empty($loginuserdata['User']['fav_icon'])){ ?>
                                          <input type="hidden" value="<?php echo $loginuserdata['User']['fav_icon'] ?>" name = "data[User][oldFav]">
                                          <?php
                                          $m = FULL_BASE_URL . $this->webroot . $loginuserdata['User']['fav_icon'];
                                           if (!empty($loginuserdata['User']['fav_icon'])) {
                                          $img = $this->Html->image($m, array('alt' => 'User Image', 'border' => '1',
                                          'height' => '120', 'width' => '120', 'data-src' => 'holder.js/100%x100'));
                                          echo $img;
                                          } 
                                          
                                          ?>
                                           <?php } ?>
                                                <div class="help-block">
                                                </div>
                                              </div>
                                              </div>
                                          </div>
                                        </div>

                                         <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                <label class="control-label">Background Image</label>
                                                    <div class="controls">
                                        <?php echo $this->Form->input('background_image', array('type'=>'file','label'=>false, 'class'=>'form-control','accept' => 'image/*','required'=>true )); ?>
                                       <?php if(!empty($loginuserdata['User']['background_image'])){ ?>
                                          <input type="hidden" value="<?php echo $loginuserdata['User']['background_image'] ?>" name = "data[User][oldbackground]">
                                          <?php
                                          $m = FULL_BASE_URL . $this->webroot . $loginuserdata['User']['background_image'];
                                           if (!empty($loginuserdata['User']['background_image'])) {
                                          $img = $this->Html->image($m, array('alt' => 'User Image', 'border' => '1',
                                          'height' => '120', 'width' => '120', 'data-src' => 'holder.js/100%x100'));
                                          echo $img;
                                          } 
                                          
                                          ?>
                                           <?php } ?>

                                            <div class="help-block">
                                            </div>
                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                       
                                    </div>
                                 <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
 
                    <div class="row">
                     <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Change Password</h4>
                            </div>
                            <div class="card-body">
                                       
                             <?php
                              echo $this->Form->create('User', array('url'=> array('controller' => 'users', 'action' => 'changePassword', 1),'class' => 'form-horizontal'));
                              echo $this->Form->hidden('ID', array('class' => 'horizontal-form form-validation'));
                             ?>
                             <div class="form-body">
                                      
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Old Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" placeholder="Old Password" name="data[User][old_password]">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-9">
                                               <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">New Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" placeholder="New Password" name="data[User][password]">
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Confirm Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" placeholder="Confirm Password" name="data[User][conf_password]">
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                       
                                    </div>
                                    <hr>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Change Password</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> </div>
                                        </div>
                                    </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>

<style type="text/css">
.error-message {
color: red;
}
</style>