<?php
//pr($keyword_en);
//pr($keyword);
?>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">

                <div class="card-body">
                   <?php  echo $this->Form->create('Subcategory', array('class'=>'horizontal-form form-validation','enctype'=>'multipart/form-data','novalidate')); ?>
                    <div class="form-body">
                      
                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Category</label>
                        <?php echo $this->form->input('Subcategory.category_id',array('label'=>false,'type'=>'select','options'=>$categories,'empty'=>'select category','class'=>'form-control','required' => true));?>
                        </div>
                        </div>
                        </div>

                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Name (English)</label>
                          <?php echo $this->form->input('Subcategory.name_en',
                                        array('label'=>false,'type'=>'text','class'=>'form-control','maxlength'=>'100','required' => true))?>
                        </div>
                        </div>
                        </div>

                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Name (Arabic)</label>
                        <?php echo $this->form->input('Subcategory.name_ar',
                                        array('label'=>false,'type'=>'text','class'=>'form-control','maxlength'=>'100','required' => true))?>
                        </div>
                        </div>
                        <!--/span-->


                        </div>
                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Name (Kurdish)</label>
                          <?php echo $this->form->input('Subcategory.name_ku',
                                        array('label'=>false,'type'=>'text','class'=>'form-control','maxlength'=>'100','required' => true))?>
                        </div>
                        </div>
                         </div>

                         <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Keyword</label>
                          <?php
                        echo $this->form->input('Subcategory.keyword',array('label'=>false,'type'=>'select','value'=>$keyword,'options'=>$keyword_en,'empty'=>'Select subcategory','multiple' => 'multiple', 'class'=>'select2 form-control'));
                        ?>
                        </div>
                        </div>
                         </div>
                         
                         <div class="row p-t-20">
                        <div class="col-md-6 ">

                        <div class="form-group">
                        <label for="exampleInputEmail1">Image
                        </label>
                        <div id="filediv">
                        <?php echo $this->Form->input('image', array('type' => 'file', 
                        'label' => false, 'class' => 'form-control file', 
                        'accept' => "image/x-png,image/gif,image/jpeg", 'required' => false)); ?>
                        <?php if (!empty($this->request->data['Subcategory']['image'])) {
                                ?>
                                <input type="hidden" value="<?php echo $this->request->data['Subcategory']['image'] ?>" name = "data[Subcategory][old_image]">
                                 <?php
                                        $m = FULL_BASE_URL . $this->webroot . $this->request->data['Subcategory']['image'];
                                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';
                                        //prx( $default);
                                        if (!empty($this->request->data['Subcategory']['image'])) {
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
                        <br/>
                        </div>

                        </div>

                        </div>

                        
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Save</button>
                        
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div></div>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Select Keyword'}
        );
        $('.ingre').select2({
            placeholder: 'Select Services'}
        );
     
    }
    );
</script>