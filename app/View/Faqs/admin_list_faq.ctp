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
	<?php echo $this->Session->flash(); ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover center_table">
                            <tbody>
							<tr>
                              <th style="width: 350px;"><?php echo $this->Paginator->sort('Faq.ques', 'Question <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
							  <th style="width: 600px;"><?php echo $this->Paginator->sort('Faq.ans', 'Answer <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
							   <th>Action</th>
							</tr> 
						<?php if($faqs): 
						foreach ($faqs as $user):
						?>
                            <tr>
                                 <td><?=$user['Faq']['ques']?></td>
								 <td><?=$user['Faq']['ans']?></td>
								 <td>
								 <?= $this->Html->link('Edit', array(
                                                    'controller' => 'faqs',
                                                    'action' => 'editFaq',
                                                    $user['Faq']['ID']
                                                ));?> |
                                     <?= $this->Html->link('Delete',
                                                    array('controller' => 'faqs','action' => 'deleteFaq', $user['Faq']['ID']),
                                                    array('confirm' => 'Are you sure you wish to delete this Faq?'));
								 ?>
                                </td>
                            </tr>
                        <?php endforeach; else :
						echo "<tr><td colspan='5' style='text-align: center;'>No data founds.</td></tr>";
						endif;?>
                            </tbody>
						</table>
                    </div>
                    <!-- /.box-body -->
					 <?php if($this->Paginator->numbers()): ?>
                                 <p id="dynamic_pager_content2" class="well" style="text-align: right;">
                                    Showing   <?php echo $this->Paginator->counter(); ?>
                                </p>
                                <?php ?>
								<div class="pagination pagination-large" style="width: 100%;  text-align: center;">
									<ul class="pagination">
											<?php
												echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
												echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
												echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
											?>
										</ul>
                                </div>
	                 <?php endif;?>
							
                    <!-- <div class="box-tools" style="text-align: center;">
                        <ul class="pagination pagination-sm">
                            <li><a href="#">«</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div> -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

