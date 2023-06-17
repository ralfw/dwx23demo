<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
             <?=$layoutTitle?>
            <small></small>
        </h1>
		
    </section>
    <!-- Main content -->
    <section class="content">
	
        <div class="row">
		<?php echo $this->Session->flash(); ?>
		 <div class="col-xs-3"></div>
            <div class="col-xs-6" style="margin-top: 75px;">
                
                      <div class="login-box-body">
       
        <?php echo $this->Form->create('User',array('class'=>'login-form')); 
		echo $this->Form->hidden('ID',array('class'=>'horizontal-form form-validation'));
		?>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Enter new pasword" name="data[User][password]">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Confirm password" name="data[User][conf_password]">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-sm-3">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary uppercase">change password</button>
                    </div>
                </div>
                <!-- /.col -->
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

