<?php
$shop_id = $this->request->data['Shop']['id'];
$provider_id = $this->request->data['Shop']['user_id'];
$start = '00:00';
$end = '23:30';
$interval = '30 mins';
$format = '24';
$startTime = strtotime($start);
$endTime   = strtotime($end);
$returnTimeFormat = ($format == '12')?'g:i A':'G:i';

$current   = time();
$addTime   = strtotime('+'.$interval, $current);
$diff      = $addTime - $current;

$time = array();
while ($startTime < $endTime) {
    $time[date($returnTimeFormat, $startTime)] = date($returnTimeFormat, $startTime);
    $startTime += $diff;
}

$time[date($returnTimeFormat, $startTime)] = date($returnTimeFormat, $startTime);
?>
<div class="row page-titles">
<div class="col-md-5 align-self-center">
<h3 class="text-themecolor">Edit Shop</h3>
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
                <div class="row">
                 <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <!-- Nav tabs -->
                          <ul class="nav nav-tabs profile-tab" role="tablist">
                           <li class="nav-item"> 
                           <a class="nav-link active" data-toggle="tab" href="#shop_info" role ="tab">Shop Info</a> 
                          </li>
                          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#gallery" role="tab">Add Gallery</a> </li>
                          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#working_hours" role="tab">Add Working Hours</a> 
                          </li>
                          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#vedio" role="tab">Add Video</a> </li>
                          </ul>
                          
                            <div class="tab-content">
                              <div class="tab-pane active" id="shop_info" role="tabpanel">
                              <div class="card-body">
                              <?php
                              echo $this->Form->create('Shop', array('class' => 'horizontal-form form-validation','enctype' => 'multipart/form-data', 'novalidate'));
                              ?>
                                    <div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											<label>Select category</label>
											<?php
											echo $this->form->input('cat_id',array('label'=>false,'type'=>'select',
											'options'=>$category,'empty'=>'Select category','multiple' => 'multiple', 'class'=>'select2 form-control','required' => true));
											?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											<label>Select subcategory</label>
											<?php
											echo $this->form->input('Shop.sub_cat',array('label'=>false,'type'=>'select',
											'options'=>$subcategory,'value'=>$subcategory_id,'empty'=>'Select subcategory','multiple' => 'multiple', 'class'=>'select2 form-control','required' => true));
											?>
											</div>
										</div>

									</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Select shop provider</label>
<?php
echo $this->form->input('Shop.user_id',array('label'=>false,'type'=>'select','options'=>$provider,'empty'=>'Select provider','class'=>'form-control','required' => true));
?>
</div>
</div>  

<div class="col-md-6">
<div class="form-group">
<label>Select services</label>
<label for="exampleInputEmail1">Select Services</label>
                        <?php 
                        echo $this->Form->input('Shop.service_id', 
                        array('label' => false, 
                        'multiple' => 'multiple', 
                        'class' => 'ingre form-control',
                        'empty'=>'select services',
                        'options' => $service, 
                        'value'=> $service_id,
                        )); ?>
</div>
</div>                                     

</div>

<h3 class="box-title m-t-40">Shop Info</h3>
                                        <hr>
                                     <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Shopname (English)</label>
                                                    <?php
                                                    echo $this->form->input('Shop.name_en',
                                                    array('label'=>false,
                                                    'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Shopname (Arabic)</label>
                                                    <?php
                                                    echo $this->form->input('Shop.name_ar',
                                                    array('label'=>false,
                                                    'class'=>'form-control', 'required'))
                                                    ?>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Shopname (Kurdish)</label>
                                                    <?php
                                                    echo $this->form->input('Shop.name_ku',
                                                    array('label'=>false,
                                                    'class'=>'form-control'))
                                                    ?>
                                                </div> </div>
                                                 <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Website url</label>
                                                    <?php
                                                    echo $this->form->input('Shop.website',
                                                    array('label'=>false,
                                                    'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                           
                                            
                                        </div>
                                        <div class="row">
                                         <div class="col-md-6">
                                                <div class="form-group">
                        <label for="exampleInputEmail1">Shop image
                        </label>
                       
                        <?php   echo $this->Form->input('image', array('type' => 'file', 
                        'label' => false, 'class' => 'form-control', 
                        'accept' => "image/x-png,image/gif,image/jpeg", 'required' => false)); ?>
                        <?php if (!empty($this->request->data['Shop']['image'])) {
                                ?>
                                <input type="hidden" value="<?php echo $this->request->data['Shop']['image'] ?>" name = "data[Shop][old_image]">
                                 <?php
                                        $m = FULL_BASE_URL . $this->webroot . $this->request->data['Shop']['image'];
                                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';
                                        //prx( $default);
                                        if (!empty($this->request->data['Shop']['image'])) {
                                            $img = $this->Html->image($m, array('alt' => 'Video Thumbnail', 'border' => '1',
                                                'height' => '120', 'width' => '120', 'class'=>'abc', 'data-src' => 'holder.js/100%x100'));
                                            echo $img;
                                        } else {
                                            $img = $this->Html->image($default, array('alt' => 'default', 'border' => '1',
                                                'height' => '60', 'width' => '60', 'class'=>'abc', 'data-src' => 'holder.js/100%x100'));
                                            echo $img;
                                        }
                                    ?>
                                <!-- <a href= "<?php// echo FULL_BASE_URL . $this->webroot . $this->request->data['User']['video_thumbnail'] ?>">Thumbnail</a> --> 

                            <?php } ?>

                          


                        </div>
                                            </div>
                                            <div class="col-md-2">
                                               <div class="form-group">
                                                  <label>Recommend</label>
                                                  <div class="checkbox">
                                                  <label class="switch">
                                                   <?php $val = $this->request->data['Shop']['recommend'];?>
                                                  <input type="checkbox" name="data[Shop][recommend]" id="gender" <?= $val == 1 ? 'checked' : '' ?> />
                                                  <span class="slider round1"></span>
                                                  </label>
                                                  </div>
                                                  <?php
                                                  echo $this->Form->hidden('recommend', array(
                                                  'label' => false,
                                                  'placeholder' => 'Enter Title',
                                                  'id' => 'hidden_gender',
                                                  'value' => $val));
                                                  ?>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-2">
                                               <div class="form-group">
                                                  <label>Chat</label>
                                                  <div class="checkbox">
                                                  <label class="switch">
                                                   <?php $val = $this->request->data['Shop']['chat'];
                                ?>
                                                  <input type="checkbox" name="data[Shop][chat]" id="chat" <?= $val == 1 ? 'checked' : '' ?> />
                                                  <span class="slider round1"></span>
                                                  </label>
                                                  </div>
                                                  <?php
                                                  echo $this->Form->hidden('chat', array(
                                                  'label' => false,
                                                  'placeholder' => 'Enter Title',
                                                  'id' => 'hidden_chat',
                                                  'value' => $val
                                                  ));
                                                  ?>
                                                </div>
                                            </div>
                                             <div class="col-md-2">
                                               <div class="form-group">
                                                  <label>Online</label>
                                                  <div class="checkbox">
                                                  <label class="switch">
                                                   <?php $val = $this->request->data['Shop']['online'];
                                ?>
                                                  <input type="checkbox" name="data[Shop][online]" id="online" <?= $val == 1 ? 'checked' : '' ?> />
                                                  <span class="slider round1"></span>
                                                  </label>
                                                  </div>
                                                  <?php
                                                  echo $this->Form->hidden('online', array(
                                                  'label' => false,
                                                  'placeholder' => 'Enter Title',
                                                  'id' => 'hidden_online',
                                                  'value' => $val,
                                                  
                                                  ));
                                                  ?>
                                                </div>
                                            </div>
                                           
                                        </div>
                                        
                                        </div>
                                        <!--/row-->

                                        <h3 class="box-title m-t-40">Description</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Description (English)</label>
                                                    <?= $this->Form->input('Shop.desc_en', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label>Description (Arabic)</label>
                                                      <?= $this->Form->input('Shop.desc_ar', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label>Description (Kurdish)</label>
                                                     <?= $this->Form->input('Shop.desc_ku', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                              
                                            </div>
                                            <!--/span-->
                                        </div>

                                        <!--Contact info start-->
                                        <h3 class="box-title m-t-40">Contact Info</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone 1</label>
                                                    <?php echo $this->form->input('Shop.phone1', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone 2</label>
                                                     <?php echo $this->form->input('Shop.phone2', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone 3</label>
                                                    <?php echo $this->form->input('Shop.phone3', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                              <div class="form-group">
                                              <label>Email</label>
                                              <?php echo $this->form->input('Shop.email', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        
                                       

                                         <h3 class="box-title m-t-40">Social media</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Facebook</label>
                                                    <?php echo $this->form->input('Shop.facebook', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Twitter</label>
                                                     <?php echo $this->form->input('Shop.twitter', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Snapchat</label>
                                                    <?php echo $this->form->input('Shop.snapchat', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                              <div class="form-group">
                                              <label>Instagram</label>
                                              <?php echo $this->form->input('Shop.instagram', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>You tube</label>
                                                    <?php echo $this->form->input('Shop.youtube', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                        
                                        </div>

                                          <!--/address here-->

                                          <h3 class="box-title m-t-40">Address</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <label>Formal Address (English)</label>
                                                     <?= $this->Form->input('address_en', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Formal Address (Arabic)</label>
                                                     <?= $this->Form->input('address_ar', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Formal Address (Kurdish)</label>
                                                     <?= $this->Form->input('address_ku', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                        </div>

                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Latitude</label>
                                                    <?php
                                                    echo $this->form->input('Shop.lat',
                                                    array('label'=>false,
                                                      'id'=>'lat',
                                                    'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                              <div class="form-group">
                                              <label>Longitude</label>
                                              <?php echo $this->form->input('Shop.lng', array('label'=>false,'id'=>'lng','class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                 
                                       <div id="map" style="width: 100%; height: 300px;"></div> <br/>
                                      
                                      
                                       

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                       
                                    </div>
                               

                              </div>
                              <?php echo $this->Form->end(); ?>
                              </div>
                              <div class="tab-pane" id="gallery" role="tabpanel">
                              <div class="card-body">
                              



                              <?php
                              echo $this->Form->create('Shop', array('url'=>'addGallery','class' => 'horizontal-form form-validation','enctype' => 'multipart/form-data', 'novalidate'));
                              ?>
                             <!--<input type="hidden" name="shop_id" value="<?php //echo $shop_id?>">
                             <input type="hidden" name="user_id" value="<?php //echo $provider_id?>"> -->
                             <?php
                              echo $this->form->input('Gallery.shop_id',
                              array('type'=>'hidden','label'=>false,
                              'class'=>'form-control','value'=>$shop_id))
                              ?>
                              <?php
                              echo $this->form->input('Gallery.user_id',
                              array('type'=>'hidden','label'=>false,
                              'class'=>'form-control','value'=>$provider_id))
                              ?>
                              <div class="form-body">
                              <div class="row">
                                 <div class="col-md-12 ">
                                 <label><b>Add Gallery images</b></label>

                                  <div class="form-group">

                                    <div id="filediv">
                                     <?php echo $this->form->input('Gallery.currency',array('label'=>false,'type'=>'select','options'=>$currency,'name'=>'data[Gallery][currency][]','empty'=>'Select currency','placeholder'=>'Select your currency','class'=>'form-control','required' => true)); ?>
                                    <?php
                                    echo $this->form->input('Gallery.price',
                                    array('type'=>'text', 'name'=>'data[Gallery][price][]','label'=>false,
                                    'class'=>'form-control','placeholder'=>'Enter your price',))
                                    ?>
                                    <?php echo $this->Form->input('Gallery.image', 
                                    array('type' => 'file',
                                    'name'=>'data[Gallery][image][]' ,
                                    'label' => false, 
                                    'class' => 'form-control file', 
                                    'accept' => 'image/*',
                                    'placeholder'=>'Add image',
                                    'required'=>true
                                    )); 
                                    ?>
                                   </div>

                                  </div>
                                    <input type="button" id="add_more" class="upload custom_add_more" value="Add More Files"/>
                                    </div>
                                    </div>
                                     <div class="form-actions">
                                      <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>

                                    </div>

                                   </div>
                                   <?php echo $this->Form->end(); ?>
                                </div>
                                <div class="table-responsive" id="allDataUpdate">
                              <?= $this->element('list_gallery'); ?>
                              </div>
                              </div>

                                <div class="tab-pane" id="working_hours" role="tabpanel">

                                <div class="card-body">
                                <?php
                                 echo $this->Form->create('WorkingHour', array('url'=>'addHours','class' => 'horizontal-form form-validation','enctype' => 'multipart/form-data', 'novalidate'));
                                 ?>
                                    <div class="row">
                                        <?php
                                        echo $this->form->input('WorkingHour.shop_id',
                                        array('type'=>'hidden','label'=>false,
                                        'class'=>'form-control','value'=>$shop_id))
                                        ?>
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="FDSFAS">Day</label></br>
                                                   <label for="FDSFAS" class='form-control'>Sunday</label></br>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">From</label>
                                              <?php
                                              echo $this->Form->input('WorkingHour.sunday_from',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['sunday_from'])?$working_hours['WorkingHour']['sunday_from']:'CLOSED')); ?>
                                               </div>
                                            </div>

                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">To</label>
                                              <?php
                                              echo $this->Form->input('WorkingHour.sunday_to',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['sunday_to'])?$working_hours['WorkingHour']['sunday_to']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                    </div>
                                     <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="FDSFAS">Day</label></br>
                                                   <label for="FDSFAS" class='form-control'>Monday</label></br>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">From</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.monday_from',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['monday_from'])?$working_hours['WorkingHour']['monday_from']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">To</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.monday_to',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['monday_to'])?$working_hours['WorkingHour']['monday_to']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="FDSFAS">Day</label></br>
                                                   <label for="FDSFAS" class='form-control'>Tuesday</label></br>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">From</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.tuesday_from',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['tuesday_from'])?$working_hours['WorkingHour']['tuesday_from']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">To</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.tuesday_to',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['tuesday_to'])?$working_hours['WorkingHour']['tuesday_to']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                    </div>
                                     <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="FDSFAS">Day</label></br>
                                                   <label for="FDSFAS" class='form-control'>Wednesday</label></br>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">From</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.wednesday_from',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['wednesday_from'])?$working_hours['WorkingHour']['wednesday_from']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">To</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.wednesday_to',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['wednesday_to'])?$working_hours['WorkingHour']['wednesday_to']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="FDSFAS">Day</label></br>
                                                   <label for="FDSFAS" class='form-control'>Thursday</label></br>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">From</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.thursday_from',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['thursday_from'])?$working_hours['WorkingHour']['thursday_from']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">To</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.thursday_to',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['thursday_to'])?$working_hours['WorkingHour']['thursday_to']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                    </div>
                                     <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="FDSFAS">Day</label></br>
                                                   <label for="FDSFAS" class='form-control'>Friday</label></br>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">From</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.friday_from',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['friday_from'])? $working_hours['WorkingHour']['friday_from']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">To</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.friday_to',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['friday_to'])?$working_hours['WorkingHour']['friday_to']:'CLOSED'));?>
                                               </div>
                                            </div>
                                    </div>

                                     <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="FDSFAS">Day</label></br>
                                                   <label for="FDSFAS" class='form-control'>Saturday</label></br>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">From</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.saturday_from',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['saturday_from'])?$working_hours['WorkingHour']['saturday_from']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="FDSFAS">To</label>
                                                <?php
                                                echo $this->Form->input('WorkingHour.saturday_to',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $time,'empty'=> 'CLOSED','value'=>!empty($working_hours['WorkingHour']['saturday_to'])?$working_hours['WorkingHour']['saturday_to']:'CLOSED')); ?>
                                               </div>
                                            </div>
                                    </div>

                                    <!--end crud$$$$$$$$$$$$$$$$$ --> 
                                      <div class="form-actions">
                                      <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>

                                    </div>
                                   </div> 
                                   <?php echo $this->Form->end(); ?>

                                  </div>
                                            
                                <!--second tab-->
                                <div class="tab-pane" id="vedio" role="tabpanel">
                                <div class="card-body">
							    <?php
								 echo $this->Form->create('Video', array('url'=>'addVideo','class' => 'horizontal-form form-validation','enctype' => 'multipart/form-data', 'novalidate'));
                                ?>
                                 <div class="row">
                                        <?php
                                        echo $this->form->input('Video.shop_id',
                                        array('type'=>'hidden','label'=>false,
                                        'class'=>'form-control','value'=>$shop_id))
                                        ?>
                                         <?php
                                        echo $this->form->input('Video.user_id',
                                        array('type'=>'hidden','label'=>false,
                                        'class'=>'form-control','value'=>$provider_id))
                                        ?>
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="FDSFAS">Add Video</label></br>
                                                  <?php
                                                  echo $this->form->input('Video.video_url',
                                                  array('type'=>'text','label'=>false,
                                                  'class'=>'form-control','value'=>!empty($video_data['Video']['video_url'])?$video_data['Video']['video_url']:''));
                                                  ?>
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
                   
                </div>
               
              
            </div>

            <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyB6y9gHV5gMmUW28iFyAdaybxkTru3Z5cE"></script>

<script type="text/javascript">
$(document).ready(function(){
 showMap();
});
$("#lng").keyup(function(){
   showMap();
});

$("#lat").keyup(function(){
   showMap();
});

function showMap(){
  var lat =  document.getElementById('lat').value;
  var lng = document.getElementById('lng').value;
  if(lat != '' && lng!=''){
     var latlng = new google.maps.LatLng(lat,lng);
  //  console.log(latlng);
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
    $('#map').css({"width": "100%", "height": "300px"});
  
  } else{
     $('#map').css({"width": "0", "height": "0"});
  }
  
}
</script>
<script>
    /*car make and model dropdown*/
   // $('#UserCarmakeId').bind('change', function () {
    $('#ShopCatId').change(function () {
        var carid = $(this).val();
        console.log(carid);
        $.ajax({
            type: 'POST',
            url: '<?= Router::url('/', true) . 'admin/shops/getsubcategory/'; ?>' + carid,
            success: function (data) {
                $("#ShopSubCatId").html('');
                $("#ShopSubCatId").html(data);
            }
        }
    );
    }
    );
</script>
<script type="text/javascript">
    $('#gender').change(function () {
        if ($(this).prop('checked'))
        {
            $('#hidden_gender').val('1');
        } else
        {
            $('#hidden_gender').val('0');
        }
    });
    $('#chat').change(function () {
        if ($(this).prop('checked'))
        {
            $('#hidden_chat').val('1');
        } else
        {
            $('#hidden_chat').val('0');
        }
    });
    $('#online').change(function () {
        if ($(this).prop('checked'))
        {
            $('#hidden_online').val('1');
        } else
        {
            $('#hidden_online').val('0');
        }
    });
</script>

<style>

.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {display:none;}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round1 {
        border-radius: 34px;
    }

    .slider.round1:before {
        border-radius: 50%;
    }
</style>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Select'}
        );
        $('.ingre').select2({
            placeholder: 'Select'}
        );
        $("#checkbox").click(function () {
           $(".ingre > option").prop("selected", "selected");
           $(".ingre").trigger("change");
         }
        );
    }
    );
</script>
<script>
    var abc = 0;
    $(document).ready(function () {
      
        $('#add_more').click(function () {
            $(this).before($("<div/>", {
                id: 'filediv'}
            ).fadeIn('slow').append(
                    $('<hr>'),
                   $('<select name="data[Gallery][currency][]" placeholder="Select your currency" class="form-control select" required="required" id="GalleryCurrency"><option value="">Select currency</option><option value="$">$</option><option value="د.ع">د.ع</option></select>'),
                    $("<input/>", {
                        name: 'data[Gallery][price][]', type: 'text', class: 'form-control text', placeholder:'Enter your price'}
                    ),
                     $("<input/>", {
                        name: 'data[Gallery][image][]', type: 'file', class: 'form-control file', 'accept':'image/*',placeholder:'Enter your price'}
                    ),
                    $("")
                    ));
        });
        //following function will executes on change event of file input to select different file
        $('body').on('change', '.file', function () {
       
            if (this.files && this.files[0]) {
                abc += 1;
                //increementing global variable by 1
                var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                $(this).hide();
                $("#abcd" + abc).append($("<img/>", {
                    id: 'img', src: "<?php echo FULL_BASE_URL . $this->webroot . 'img/x.png'; ?>", alt: 'delete'}
                ).click(function () {
                    $(this).parent().parent().remove();
                }
                ));
            }
        }
        );
        //To preview image
        function imageIsLoaded(e) {
            $('#previewimg' + abc).attr('src', e.target.result);
        }  ;
        $('#upload').click(function (e) {
            var name = $(":file").val();
            if (!name)
            {
                alert("First Image Must Be Selected");
                e.preventDefault();
            }
        }
        );
    }
    );
</script>
 <script>
  
  
         $(document).ready(function() {
           
           $('#WorkingHourSundayFrom').on('change',function(){
             var vtd = $(this).val();
             $.ajax({
               type:"POST",
               url : '<?= Router::url('/', true).'admin/shops/setEnd'?>',
               data:{
                 st_date:vtd,
              },
               success:function(msg){

                var myOptions =  $.parseJSON(msg);

              var mySelect = $('#WorkingHourSundayTo');
              mySelect.empty();
              $.each(myOptions, function(val, text) {
                  mySelect.append(
                      $('<option></option>').val(val).html(text)
                  );
              });
            
               }
             })

           })
        
       $('#WorkingHourMondayFrom').on('change',function(){
             var vtd = $(this).val();
             $.ajax({
               type:"POST",
               url : '<?= Router::url('/', true).'admin/shops/setEnd'?>',
               data:{
                 st_date:vtd,
              },
               success:function(msg){

                var myOptions =  $.parseJSON(msg);

              var mySelect = $('#WorkingHourMondayTo');
              mySelect.empty();
              $.each(myOptions, function(val, text) {
                  mySelect.append(
                      $('<option></option>').val(val).html(text)
                  );
              });
            
               }
             })

           })
       $('#WorkingHourTuesdayFrom').on('change',function(){
             var vtd = $(this).val();
             $.ajax({
               type:"POST",
               url : '<?= Router::url('/', true).'admin/shops/setEnd'?>',
               data:{
                 st_date:vtd,
              },
               success:function(msg){

                var myOptions =  $.parseJSON(msg);

              var mySelect = $('#WorkingHourTuesdayTo');
              mySelect.empty();
              $.each(myOptions, function(val, text) {
                  mySelect.append(
                      $('<option></option>').val(val).html(text)
                  );
              });
            
               }
             })

           }) 
       $('#WorkingHourWednesdayFrom').on('change',function(){
             var vtd = $(this).val();
             $.ajax({
               type:"POST",
               url : '<?= Router::url('/', true).'admin/shops/setEnd'?>',
               data:{
                 st_date:vtd,
              },
               success:function(msg){

                var myOptions =  $.parseJSON(msg);

              var mySelect = $('#WorkingHourWednesdayTo');
              mySelect.empty();
              $.each(myOptions, function(val, text) {
                  mySelect.append(
                      $('<option></option>').val(val).html(text)
                  );
              });
            
               }
             })

           })
       $('#WorkingHourThursdayFrom').on('change',function(){
             var vtd = $(this).val();
             $.ajax({
               type:"POST",
               url : '<?= Router::url('/', true).'admin/shops/setEnd'?>',
               data:{
                 st_date:vtd,
              },
               success:function(msg){

                var myOptions =  $.parseJSON(msg);

              var mySelect = $('#WorkingHourThursdayTo');
              mySelect.empty();
              $.each(myOptions, function(val, text) {
                  mySelect.append(
                      $('<option></option>').val(val).html(text)
                  );
              });
            
               }
             })

           })
       $('#WorkingHourFridayFrom').on('change',function(){
             var vtd = $(this).val();
             $.ajax({
               type:"POST",
               url : '<?= Router::url('/', true).'admin/shops/setEnd'?>',
               data:{
                 st_date:vtd,
              },
               success:function(msg){

                var myOptions =  $.parseJSON(msg);

              var mySelect = $('#WorkingHourFridayTo');
              mySelect.empty();
              $.each(myOptions, function(val, text) {
                  mySelect.append(
                      $('<option></option>').val(val).html(text)
                  );
              });
            
               }
             })

           })
       $('#WorkingHourSaturdayFrom').on('change',function(){
             var vtd = $(this).val();
             $.ajax({
               type:"POST",
               url : '<?= Router::url('/', true).'admin/shops/setEnd'?>',
               data:{
                 st_date:vtd,
              },
               success:function(msg){

                var myOptions =  $.parseJSON(msg);

              var mySelect = $('#WorkingHourSaturdayTo');
              mySelect.empty();
              $.each(myOptions, function(val, text) {
                  mySelect.append(
                      $('<option></option>').val(val).html(text)
                  );
              });
            
               }
             })

           })
      });
       
   
  </script>
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #333 !important;
        border: 1px solid #333 !important;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }
    .form-control{
      display: inline-block;
    }
#filediv .text {
    width: 48%;
    display: inline-block;
    margin: 0px 8px;
}
#filediv .select {
    width: 48%;
    display: inline-block;
    margin: 0px 8px;
}

#filediv .file {
    width: 98%;
    margin: 10px auto 15px auto !important;
    display: block;
}
/*.custom_add_more {
    margin: 0px 0px 22px 0px;
}*/
.abcd {
    width: 25% !important;
    padding: 0px 5px;
}
.abcd img {
    max-width: 100%;
}
.custom_add_more {
    margin: 0px auto 22px auto;
    width: 50%;
    display: block;
    background-color: #2e74b5;
    color: #fff;
    border-color: #2e74b5;
    padding: 10px;
}
</style>
