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
                <?php  echo $this->Form->create('Sponsor', array('class'=>'horizontal-form form-validation','enctype'=>'multipart/form-data')); 
				 echo $this->Form->hidden('ID',array('class'=>'horizontal-form form-validation'));
				?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tracking Name</label>
                            <?php echo $this->Form->input('name',array('label'=>false,'placeholder'=>'Enter Sponsor name','class'=>'form-control')); ?>
						</div>
						 <div class="form-group">
                            <label for="exampleInputPassword1">Sponsor Logo</label>
                            <?php echo $this->Form->file('logo',array('label'=>false,'class'=>'form-control','required' => false)); ?>
							<a href="<?= $this->webroot.'img/sponsor/'.$this->request->data['Sponsor']['logo']?>"><?= $this->request->data['Sponsor']['logo']?></a>  
										<input type ="hidden" name="oldImages" value="<?=$this->request->data['Sponsor']['logo']?>">
                        </div>  
						<div class="form-group">
                            <label for="exampleInputEmail1">Background Type</label>
                            <?php 
							$status = array('1'=>'Single color','2'=>'Two color');
							echo $this->Form->input('background_type',array('label'=>false,'options'=>$status,'empty'=> '--Select--','class'=>'form-control')); ?>
						</div>
						 <div class="form-group">
                            <label for="exampleInputEmail1">Backgrond1</label>
                            <?php echo $this->Form->input('background1',array('label'=>false,'placeholder'=>'Enter Sponsor name','class'=>'form-control jscolor')); ?> 
						</div>
						 <div class="form-group">
                            <label for="exampleInputEmail1">Backgrond2</label>
                            <?php echo $this->Form->input('background2',array('label'=>false,'placeholder'=>'Enter Sponsor name','class'=>'form-control jscolor')); ?>
							<small>Backgrond2 will used when you select two color.</small>
						</div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Duration</label>
                            <?php 
							$status = array('1'=>'1 Second','2'=>'2 Seconds','3'=>'3 Seconds','4'=>'4 Seconds','5'=>'5 Seconds','6'=>'6 Seconds','7'=>'7 Seconds','8'=>'8 Seconds','9'=>'9 Seconds','10'=>'10 Seconds');
							echo $this->Form->input('duration',array('label'=>false,'options'=>$status,'empty'=> '--Select--','class'=>'form-control')); ?>
						</div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Action Text</label>
                            <?php echo $this->Form->input('action_text',array('label'=>false,'placeholder'=>'Enter Action Text','class'=>'form-control')); ?>
						</div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Action Button</label>
							<?php echo $this->Form->input('action_url',array('label'=>false,'placeholder'=>'Enter Action Button','class'=>'form-control')); ?>
						</div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Action</label>
                            <?php 
							$status = array('Off','On');
							echo $this->Form->input('action',array('label'=>false,'options'=>$status,'empty'=> '--Select--','class'=>'form-control')); ?>
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

