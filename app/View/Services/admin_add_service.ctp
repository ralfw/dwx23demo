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
                    <?php
                    echo $this->Form->create('Service', 
                            array('url' => 'addService',
                                'class' => 'horizontal-form form-validation',
                                'enctype' => 'multipart/form-data', 'novalidate'));
                    ?>
                    <div class="form-body">
                      
                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Name (English)</label>
                        <?php
                        echo $this->form->input('Service.name_en',
                        array('label'=>false,
                        'class'=>'form-control'))
                        ?>
                        </div>
                        </div>
                        <!--/span-->


                        </div>
                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Name (Arabic)</label>
                        <?php
                        echo $this->form->input('Service.name_ar',
                        array('label'=>false,
                        'class'=>'form-control'))
                        ?>
                        </div>
                        </div>
                        </div>

                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Name (Kurdish)</label>
                        <?php
                        echo $this->form->input('Service.name_ku',
                        array('label'=>false,
                        'class'=>'form-control'))
                        ?>
                        </div>
                        </div>
                        </div>

                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Image</label>
                        <?php 
                        echo $this->Form->input('image', array('type' => 'file', 
                        'label' => false, 'class' => 'form-control file', 
                        'accept' => "image/x-png,image/gif,image/jpeg", 'required' => false)); 
                        ?>
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

