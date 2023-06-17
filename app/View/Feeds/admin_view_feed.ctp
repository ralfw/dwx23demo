<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?=$layoutTitle?>

        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <?php echo $this->Session->flash(); ?> 

        <div class="row">
            <div class="col-xs-12">
                <?php  echo $this->Form->create('Feed', array('class'=>'horizontal-form form-validation','enctype'=>'multipart/form-data')); ?>
                     <?php  //pr($restaurants); ?> 
                    <div class="box-body"> 
                        <h4><label for="FDSFAS">Details </label>
                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></br>
                        </h4>
                        <div id="demo" class="collapse in" >
                          <div class="clearfix"></div>
                          <div class="col-md-12">
                            <div class="col-md-6">
                              <div class="form-group">
                                    <label>Title </label></br>
                                <?= $feeds['Feed']['title'];?>
                              </div>
                            </div>
									 
									  <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputPassword1">Description</label></br>
                                    <?= $feeds['Feed']['description'];?>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="col-md-12">
                           
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Video Image</label></br>
											 <?php if(!empty($feeds['Feed']['video_thumbnail'])){ ?>
                                 <img src="<?php echo FULL_BASE_URL.$this->webroot.$feeds['Feed']['video_thumbnail']; ?>"height="100" width="100"/>
											<?php } ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Video</label></br>
											 <?php if(!empty($feeds['Feed']['video'])){ ?>
                                  <a href = "<?php echo FULL_BASE_URL.$this->webroot.$feeds['Feed']['video']; ?>" target="blank"><?php echo FULL_BASE_URL.$this->webroot.$feeds['Feed']['video']; ?></a> 
											 <?php } ?>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
								  
								  <div class="col-md-12">
                           
									
                            <div class="col-md-6">
                              <div class="form-group postimage">
                                  <label for="exampleInputEmail1">Images</label></br>
                                 <?php 
											$images = explode(',',$feeds['Feed']['image']);
											//pr($images);
											
											foreach($images as $image) 
											{
											//pr($image);
											?>
											<img src="<?php echo FULL_BASE_URL.$this->webroot.$image; ?>"height="100" width="100"/>
											<?php } ?>
                              </div>
                            </div>
                          </div>
                    
                        </div>

                    </div>
						  
		


          

             
                    <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>

.form-group.postimage img {
    margin: 8px 6px 5px 8px;
}
</style>