
<?php //pr($datas);die;?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $layoutTitle ?>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <?php
                echo $this->Html->getCrumbs(' > ', array(
                    'text' => 'Home',
                    'url' => array('controller' => 'rides', 'action' => 'profit', 'admin' => true),
                    'escape' => false
                ));
                ?>  
            <li class="active"><?= $layoutTitle ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <?php echo $this->Session->flash(); ?>
            <div class="row">
                <div class="col-xs-6">
                    <?php echo $this->Form->create('Option', array('class' => 'horizontal-form form-validation', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box-body">
<!--                        <div class="form-group">
                            <label for="exampleInputEmail1">Distance
                            </label>

                            <input type="text" class="form-control"
                                   name="data[Option][name]" placeholder="Place some text here"
                                 value="<?=
                                   isset($datas['Option']['name']) &&
                                   !empty($datas['Option']['name']) ? $datas['Option']['name'] : '';
                                   ?>"  >
                            
                        </div>-->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Profit setting
                            </label>
                               <input class="form-control"
                                   name="data[Option][value]" required placeholder="Place enter Profit percentage"
                                  value="<?=
                                   isset($datas['Option']['value']) &&
                                   !empty($datas['Option']['value']) ? $datas['Option']['value'] : '';
                                   ?>">

                        </div>
                        
                        <!--			<div class="form-group">
                                                    <label for="exampleInputEmail1">Amount
                                                    </label>
                        <?php //echo $this->Form->input('value', array('label' => false, 'placeholder' => 'Enter name','type'=>'text', 'class' => 'form-control'));  ?>
                                                </div>-->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit
                            </button>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
