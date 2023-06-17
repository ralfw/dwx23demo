 <?php
//pr($settingdata); exit;
 ?>
  <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Account Setting</h3>
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
                    'text' => 'Account setting',
                    'url' => array('controller' => 'users', 'action' => 'setting', 'admin' => true),
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
                             <h3 class="card-title">Notifications</h3>
                              <hr>
                                       
                             <?php
                              echo $this->Form->create('Setting', array('url'=> array('controller' => 'users', 'action' => 'setting'),'class' => 'm-t-40 error','enctype'=>'multipart/form-data')); ?>
                      <div class="row">
                        <div class="col-lg-12">
                         <div class="card card-outline-info">
                           
                            <div class="card-body">
                                <form action="#" class="form-horizontal">
                                    <div class="form-body">
                                       
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group row">
                                                  <label class="control-label text-left col-md-2">Enable</label>
                                                  <div class="col-md-10">
                                                  <div class="checkbox checkbox-success">
                                                <?php if($settingdata['Setting']['enable'] == 1){
                                                  $chk = 'checked';
                                                 } ?>
                                            <input id="checkbox33" type="checkbox" name="data[Setting][enable]" <?php echo $chk; ?> >
                                                   

                                                    <label for="checkbox33"></label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!--/row-->
                                     <h3 class="box-title">For Iphone</h3>
                                      <hr>
                                      <?php if($settingdata['Setting']['mode'] == 'sandbox'){ 
                                        $sand = 'checked';
                                        $live = '';
                                        } elseif ($settingdata['Setting']['mode'] == 'live') {
                                          $sand = '';
                                        $live = 'checked';
                                        }
                                        else{
                                          $sand = '';
                                          $live = '';

                                        }

                                        ?>
                                      <div class="row">
                                        <div class="col-md-9">
                                          <div class="form-group row">
                                              <label class="control-label text-left col-md-2">Mode</label>
                                              <div class="col-md-3">
                                                <label class="custom-control custom-radio">
                                                 <input id="radio3" name="data[Setting][mode]" type="radio" value="sandbox"
                                                  <?php echo $sand ?> class="custom-control-input sandbox" >
                                                <span class="custom-control-label">Sandbox</span>
                                                </label>

                                              </div>
                                              <div class="col-md-3">
                                                <label class="custom-control custom-radio">
                                                <input id="radio4" name="data[Setting][mode]" type="radio" value="live"  <?php echo $live ?>  class="custom-control-input live">
                                                <span class="custom-control-label">Live</span>
                                                </label>
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                      

                                        <div class="row">
                                        <div class="col-md-9">
                                          <div class="form-group row">
                                             
                                              <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-left col-md-3">Sandbox pem file</label>
                                                    <div class="col-md-9">
                                            <div class="controls">
                                              <?php echo $this->Form->input('sandbox_pem_file',
                                              array('type'=>'file',
                                             'label'=>false,
                                             'class'=>'form-control'
                                             )); ?>

                                             <?php if(!empty($settingdata['Setting']['sandbox_pem_file'])){ ?>
                                <input type="hidden" value="<?php echo $settingdata['Setting']['sandbox_pem_file'] ?>" name ="data[Setting][oldsandbox]">
                                          <?php
                                          $m = FULL_BASE_URL . $this->webroot . $settingdata['Setting']['sandbox_pem_file'];  ?>
                                           <a href="<?php echo $m; ?>">Sandbox Pem file</a> 
                      
                                       <?php } ?>



                                            <div class="help-block">
                                            </div>
                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                          </div>
                                        </div>
                                      </div>


                                    


                                      <div class="row">
                                        <div class="col-md-9">
                                          <div class="form-group row">
                                             
                                              <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-left col-md-3">Live pem file</label>
                                                    <div class="col-md-9">
                                            <div class="controls">
                                                    <?php echo $this->Form->input('live_pem_file',
                                   array('type'=>'file',
                                       'label'=>false,
                                       'class'=>'form-control'
                                       )); ?>


                                             <?php if(!empty($settingdata['Setting']['live_pem_file'])){ ?>
                                <input type="hidden" value="<?php echo $settingdata['Setting']['live_pem_file'] ?>" name ="data[Setting][oldlive]">
                                          <?php
                                          $m = FULL_BASE_URL . $this->webroot . $settingdata['Setting']['live_pem_file'];  ?>
                                           <a href="<?php echo $m; ?>">live Pem file</a> 
                      
                                       <?php } ?>
                                            <div class="help-block">
                                            </div>
                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                          </div>
                                        </div>
                                      </div>


                                   
                                       <h3 class="box-title">Android</h3> 
                                        <hr>
                                         <div class="row">
                                        <div class="col-md-9">
                                          <div class="form-group row">
                                             
                                              <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-left col-md-3">Android key</label>
                                                    <div class="col-md-9">
                                            <div class="controls">
                                  <?php if(!empty($settingdata['Setting']['android_key'])){ 
                                    echo $this->Form->input('android_key',array( 'label'=>false, 'class'=>'form-control','value'=>$settingdata['Setting']['android_key'])); 
                                         } else{
                                          echo $this->Form->input('android_key',array( 'label'=>false, 'class'=>'form-control' )); 
                                         }



                                           ?>
                                            <div class="help-block">
                                            </div>
                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                          </div>
                                        </div>
                                      </div>

                                        <!--/row-->
                                    </div>
                                    <hr>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
