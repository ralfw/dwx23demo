<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
	<section class="content-header">
        <h1>
            <?= $layoutTitle ?>
		</h1>
        <ol class="breadcrumb">
			<li><i class="fa fa-home"></i> <?php echo $this->Html->getCrumbs(' > ', array(
				'text' => 'Home',
				'url' => array('controller' => 'users', 'action' => 'term', 'admin'=>true),
				'escape' => false
                )); ?> 
	        </li>
			<li class="active"><?= $layoutTitle ?></li>
        </ol>
    </section>
	
	 <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <?php echo $this->Session->flash(); ?>

            <div class="row">
                <div class="col-xs-6">
                    <?php echo $this->Form->create('Term', array('class' => 'horizontal-form form-validation', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box-body">
                        <?php //pr($this->request->data); ?>

                        <div class="form-group">
                            <label for="exampleInputEmail1"></label>

                            <div class="box-body pad">

                                


                                <textarea class="textarea"
                                          name="data[Term][info]" placeholder="Place some text here" 
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; 
                                          border: 1px solid #dddddd; padding: 10px;">
                                              <?= isset($datas['Term']['info']) &&
                                    !empty($datas['Term']['info']) ? $datas['Term']['info'] : '';
                                    ?>
                                </textarea>



                            </div>

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

<script>
    $(function () {
        
        $(".textarea").wysihtml5();
    });
</script>
<!-- /.content-wrapper -->