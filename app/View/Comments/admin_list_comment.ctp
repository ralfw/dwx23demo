
<?php
//echo "<pre>";print_r($comments);die;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-10">
                    <h1>
                        <?= $layoutTitle ?>
                        <small></small>
                    </h1>
                </div>
                <!--                <div class="col-sm-2">
                                    <a href="<?= $this->webroot . 'admin/comments/addComment'; ?>" class="btn btn-primary">Add Comment</a>
                                </div>-->
            </div>
        </div>


    </section>

    <section>
        <!-- search box -->
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                    <?php
                    echo $this->Form->create('Comment', array('url' => array('controller' => 'Comments',
                            'action' => 'listComment', 'admin' => true),
                        'class' => 'horizontal-form form-validation',
                        'enctype' => 'multipart/form-data'));
                    ?>
                    <div class="input-group">
                        <?php
                        echo $this->Form->input('q', array('label' => false, 'type' => 'text',
                            'class' => 'form-control keyword',
                            'placeholder' => 'e.g. user name,title',
                            'value' => @$this->request->query["q"]));
                        ?>
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="submit">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                <span style="margin-left:10px;">Search</span></button>
                        </span>
                        </span>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </section>


    <!-- Main content -->
    <section class="content">
        <?php echo $this->Session->flash(); ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo $this->Paginator->sort('Comment.user_id', 'user <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                                    <th><?php echo $this->Paginator->sort('Comment.feed_id', 'feed title<i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                                    <th><?php echo $this->Paginator->sort('Comment.image', 'image <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                                    <th><?php echo $this->Paginator->sort('Comment.comment', 'comment <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>

                                </tr>
                                <?php
                                $inc = 1;
                                if ($comments):
                                    foreach ($comments as $comment):

                                        //pr($comment);                                
                                        //die; 
                                        ?>
                                        <tr>
                                            <td><?php echo $inc++; ?></td>
                                            <td><?= $comment['User']['name'] ?></td>
                                            <td><?= $comment['Feed']['title'] ?></td>
                                            <td>
                                                <?php
                                                $images = $this->webroot . 'img/feeds/default.jpg';
                                                $other = 0;
                                                if (strlen(trim($comment['Feed']['image']))) {
                                                    $images = explode(',', trim($comment['Feed']['image']));
                                                    $count = 0;
                                                    $image_name = '';
                                                    $one = true;
//                                                    //pr($images);
                                                    foreach ($images as $value) {
                                                        $_path = APP . 'webroot' . DS . 'img' . DS . 'feeds' . DS . $value;
                                                        if (strlen(trim($value))) {
                                                            if (file_exists($_path)) {
                                                                $image_name = $value;
                                                                $images = $this->webroot . 'img/feeds/' . $value;
                                                                break;
                                                            }
//                                                            if (isset($image_name) && !empty($image_name) && trim($value) != $image_name) {
//                                                                if (file_exists($_path)) {
//                                                                    $other++;
//                                                                }
//                                                            }
                                                        }
                                                    }
                                                }
                                                // echo $image;
                                                ?>
                                                <img src="<?= $images; ?>" alt="<?= __('Feed Image') ?>" style="width: 90px;">

                                            </td>
                                            <td><?= $comment['Comment']['comment'] ?></td>


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
