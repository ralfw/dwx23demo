<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?php echo $layoutTitle; ?></h3>
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
                     
                    <?php echo $layoutTitle; ?>
                    
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
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Provider Info</h4>
                            </div>
                            <div class="card-body">
                            <?php
                            echo $this->Form->create('User', array('class' => 'horizontal-form form-validation','enctype' => 'multipart/form-data', 'novalidate'));
                            ?>
                                    <div class="form-body">
                                       <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <?php
                                                    echo $this->form->input('User.name',
                                                    array('label'=>false,
                                                    'maxlength'=>'30',
                                                    'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div></div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <?php echo $this->form->input('User.email',
                                                    array('label'=>false,
                                                    'maxlength'=>'30',
                                                    'class'=>'form-control', 'required')
                                                    )
                                                    ?>
                                                </div>
                                            </div></div>
                                             <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <?php
                                                    echo $this->form->input('User.phone',
                                                    array('type' => 'number','label'=>false,
                                                    'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div></div>
                                             <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                            <label>Image</label>
                                              <?php   echo $this->Form->input('image', array('type' => 'file', 
                                              'label' => false, 'class' => 'form-control file', 
                                              'accept' => "image/x-png,image/gif,image/jpeg", 'required' => false)); ?>
                                              <?php if (!empty($this->request->data['User']['image'])) {
                                              ?>
                                              <input type="hidden" value="<?php echo $this->request->data['User']['image'] ?>" name = "data[User][old_image]">
                                              <?php
                                              $m = FULL_BASE_URL . $this->webroot . $this->request->data['User']['image'];
                                              $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';
                                              //prx( $default);
                                              if (!empty($this->request->data['User']['image'])) {
                                              $img = $this->Html->image($m, array('alt' => 'Video Thumbnail', 'border' => '1',
                                              'height' => '120', 'width' => '120', 'class'=>'abc', 'data-src' => 'holder.js/100%x100'));
                                              echo $img;
                                              } else {
                                              $img = $this->Html->image($default, array('alt' => 'default', 'border' => '1',
                                              'height' => '60', 'width' => '60', 'class'=>'abc', 'data-src' => 'holder.js/100%x100'));
                                              echo $img;
                                              }
                                              ?>
                                              <?php } ?>
                                            </div>
                                            </div></div>
                                        </div>
                                        
                                        <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                       
                                    </div>
                                    </div>
                                     </div>
                                    </div>
                                    
                               <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
