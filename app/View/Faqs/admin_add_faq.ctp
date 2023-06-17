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
            <div class="col-xs-6">
                <?php  echo $this->Form->create('Faq', array('class'=>'horizontal-form form-validation','enctype'=>'multipart/form-data')); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Question</label>
                            <?php echo $this->Form->input('ques',array('label'=>false,'placeholder'=>'Enter ques here','class'=>'form-control')); ?>
                        </div>
                      <div class="form-group">
                            <label for="exampleInputEmail1">Answer</label>
                            <?php echo $this->Form->input('ans',array('label'=>false,'placeholder'=>'Enter your answer','class'=>'form-control')); ?>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                <?php echo $this->Form->end(); ?>
                </div>
                    <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

