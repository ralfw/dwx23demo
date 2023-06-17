<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $layoutTitle ?>
            <small></small>
        </h1>

    </section>
    <section>
        <!-- search box -->
       <?php  echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'search','admin'=>true),
           'class'=>'horizontal-form form-validation',
           'enctype'=>'multipart/form-data')); 
       ?>
        <div class=" col-sm-offset-7 col-sm-3">
            <?php   
            echo $this->Form->input('q', array('label' => false, 'type' => 'text',
                'class' => 'form-control keyword',
                'placeholder' => 'e.g. user email',
                'value' => @$this->request->query["q"]));
            ?>
        </div><div class="col-sm-2">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
<?php echo $this->Form->end(); ?>
    </section>
    <!-- Main content -->
    <section class="content">
<?php echo $this->Session->flash(); ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="my_datatable footable table table-stripped toggle-arrow-tiny default breakpoint footable-loaded">
                            <thead>
                                <tr>
                                    <th><?php echo $this->Paginator->sort('User.name', 'Name <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>

                                    <th><?php echo $this->Paginator->sort('User.email', 'Email <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                                    <th><?php echo $this->Paginator->sort('User.phone', 'Phone <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                                    <th><?php echo $this->Paginator->sort('User.status', 'Status <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                                    <th>No of likes</th>
                                    <th>No of comments</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>	
                                <?php
                                if ($users):
                                    foreach ($users as $user):
                                        ?>
                                        <tr>

                                            <td><?= $user['User']['name'] ?></td>
                                            <td><?= $user['User']['email'] ?></td>
                                            <td><?= $user['User']['phone'] ?></td>
                                            <td>
                                                <a href="<?= FULL_BASE_URL . Router::url('/') ?>admin/users/changeStatus/<?= $user['User']['id'] ?>/<?= ($user['User']['status'] == 0) ? '1' : '0' ?>" onclick="if (confirm( & quot; Do you want to change the status? & quot; )) { return true; } return false;"><span class="label label-<?= ($user['User']['status'] == 1) ? 'success' : 'danger' ?>">
        <?= ($user['User']['status'] == 1) ? 'Approved' : 'Not approved' ?>
                                                    </span></a>
                                            </td>
                                            <td><?= count($user['Comment']) ?></td>
                                            <td><?= count($user['Comment']) ?></td>

                                            <td>

                                                <?=
                                                $this->Html->link('Delete', array('controller' => 'users', 'action' => 'deleteUser', $user['User']['id']), array('confirm' => 'Are you sure you wish to delete this user?'));
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                else :
                                    echo "<tr><td colspan='5' style='text-align: center;'>No data founds.</td></tr>";
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
<?php if ($this->Paginator->numbers()): ?>
                        <p id="dynamic_pager_content2" class="well" style="text-align: right;">
                            Showing   <?php echo $this->Paginator->counter(); ?>
                        </p>
                                <?php ?>
                        <div class="pagination pagination-large" style="width: 100%;  text-align: center;">
                            <ul class="pagination">
                                <?php
                                echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
                                echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
                                echo $this->Paginator->next(__('next'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
                                ?>
                            </ul>
                        </div>
<?php endif; ?>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
//$(document).ready(function(){
    // $('.my_datatable').DataTable();
    })</script>