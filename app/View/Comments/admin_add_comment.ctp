
<?php
//pr($feeds);
//die();
?>

<style>
    .time_duration_boxes .input
    {
        width: 30%;
        display: inline-block;
    }
    .select2-container
    {
        width: 100% !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
<?php echo $this->Session->flash(); ?>
            <div class="row">
                <div class="col-xs-6">
                    <?php echo $this->Form->create('Comment', array('class' => 'horizontal-form form-validation', 'enctype' => 'multipart/form-data'));
                    echo $this->Form->hidden('ID', array('class' => 'horizontal-form form-validation'));
                    ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Feed</label>
<?php //print_r($feeds); ?>
<?php echo $this->form->input('feed_id', array('label' => false, 'type' => 'select', 'options' => $feeds, 'class' => 'form-control')); ?>                           
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Comment Name </label>

<?php echo $this->form->input('comment', array('label' => false, 'type' => 'text', 'placeholder' => 'Enter name', 'class' => 'form-control')); ?>
                        </div>



                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <a href="<?php echo $this->webroot . 'admin/comments/listComment'; ?>" class="btn btn-primary">Back</a>
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
<script>
//    $(document).ready(function () {
//        $('.ingre').select2({placeholder: '--Select--'});
//    });
</script>