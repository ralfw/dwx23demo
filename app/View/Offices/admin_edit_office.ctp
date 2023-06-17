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
                    echo $this->Form->create('Office', 
                            array('class' => 'horizontal-form form-validation',
                                'enctype' => 'multipart/form-data', 'novalidate'));
                    ?>
                    <div class="form-body">
                      
                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Location (English)</label>
                        <?php
                        echo $this->form->input('Office.location_en',
                        array('label'=>false,
                        'class'=>'form-control'))
                        ?>
                        </div>
                        </div>
                         </div>

                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Location (Arabic)</label>
                       <?php
                        echo $this->form->input('Office.location_ar',
                        array('label'=>false,
                        'class'=>'form-control'))
                        ?>
                        </div>
                        </div>
                        </div>

                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Location (Kurdish)</label>
                        <?php
                        echo $this->form->input('Office.location_ku',
                        array('label'=>false,
                        'class'=>'form-control'))
                        ?>
                        </div>
                        </div>
                        </div>

                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Address (English)</label>
                       <?php
                        echo $this->form->input('Office.address_en',
                        array('label'=>false,
                        'class'=>'form-control'))
                        ?>
                        </div>
                        </div>
                        </div>

                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Address (Arabic)</label>
                       <?php
                        echo $this->form->input('Office.address_ar',
                        array('label'=>false,
                        'class'=>'form-control'))
                        ?>
                        </div>
                        </div>
                        </div>

                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Address (Kurdish)</label>
                       <?php
                        echo $this->form->input('Office.address_ku',
                        array('label'=>false,
                        'class'=>'form-control'))
                        ?>
                        </div>
                        </div>
                        </div>

                        <div class="row p-t-20">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Phone Number</label>
                       <?php
                        echo $this->form->input('Office.phone_no',
                        array('label'=>false,'type' => 'number',
                        'class'=>'form-control'))
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

