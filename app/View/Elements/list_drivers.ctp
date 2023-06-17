<?php
$this->Paginator->options(
        array('update' => '.box',
            'evalScripts' => true,
            'before' => $this->Js->get('#loading')->effect('fadeIn', array('buffer' => false)),
            'complete' => $this->Js->get('#loading')->effect('fadeOut', array('buffer' => false)),
            'url' => array('controller' => 'users',
                'action' => 'listDriver', 'admin' => true, 'text' => (!empty($text)) ? $text : '',),
));
?> 
<div class="box-body table-responsive no-padding">
    <table class="table table-stripped toggle-arrow-tiny default breakpoint footable-loaded">
        <thead>
            <tr>
                <th>
                    <?php echo $this->Paginator->sort('User.image', 'Image <i class="fa fa-sort"></i>', array('escape' => false)); ?> 
                </th>
                <th>
                    <?php echo $this->Paginator->sort('User.name', 'Name <i class="fa fa-sort"></i>', array('escape' => false)); ?> 
                </th>
                <th>
                    <?php echo $this->Paginator->sort('User.Phone', 'Phone <i class="fa fa-sort"></i>', array('escape' => false)); ?> 
                </th>
                <th>
                    <?php echo $this->Paginator->sort('User.email', 'Email <i class="fa fa-sort"></i>', array('escape' => false)); ?> 
                </th>
                <th>
                    <?php echo $this->Paginator->sort('User.created', 'Created <i class="fa fa-sort"></i>', array('escape' => false)); ?> 
                </th>
                <th>
                    <?php echo $this->Paginator->sort('User.status', 'Approved <i class="fa fa-sort"></i>', array('escape' => false)); ?> 
                </th>
                <!--               <th><?php //echo $this->Paginator->sort('User.document_verify', 'Document verify <i class="fa fa-sort"></i>', array('escape' => false));       ?> </th>-->
                <th>Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($users):
                foreach ($users as $user):
                    ?>
                    <tr>
                        <td>
                            <?php
                            $m = FULL_BASE_URL . $this->webroot . $user['User']['image'];
                            $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';
//prx( $default);
                            if (!empty($user['User']['image'])) {
                                $img = $this->Html->image($m, array(
                                    'alt' => 'User Image', 
                                    'border' => '1',
                                    'height' => '', 
                                    'width' => '120',
                                    'class' => "img_display",
                                    "data-title" => "Driver",
                                    'data-src' => 'holder.js/100%x100'));
                                echo $img;
                            } else {
                                $img = $this->Html->image($default, array('alt' => 'default', 'border' => '1',
                                    'height' => '60', 'width' => '60', 'data-src' => 'holder.js/100%x100'));
                                echo $img;
                            }
                            ?>
                        </td>
                        <td>
                            <?= $user['User']['name'] ?>
                        </td>
                        <td>
                            <?= $user['User']['phone'] ?>
                        </td>
                        <td>
                            <?= $user['User']['email'] ?>
                        </td>
                        <td>
                            <?php
                            $timestamp = $user['User']['created'];
                        echo date("F jS, Y,g:i a", strtotime($timestamp)); //September 30th, 2013
                        ?>
                            
                        </td>
                        <td>
                            <?php if ($user['User']['document_verify'] == '1') { ?>
                                <button type="button"  data-toggle="tooltip" title="Change Status" class="cstm-des-rounded-sec btn btn-<?=
                                ($user['User']['status'] == 1) ? 'success ' : 'danger'
                                ?> 
                                        change
                                        " u_id ="<?= $user['User']['id'] ?>" 
                                        status ="<?= ($user['User']['status'] == '1') ? '0' : '1' ?>" 
                                        name="button" data-toggle="tooltip">
                                            <?= ($user['User']['status'] == 1) ? 'Y' : 'N' ?>
                                </button>
                            <?php } else {
                                ?>
                                <button type="button" class="cstm-des-rounded-sec btn btn-danger">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" 
                                          title="Please go to edit button to verify document">Document not verified
                                    </span>
                                </button>
                            <?php } ?>
                        </td>
                        <!--                        <td>
                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" 
                title="<?php
                        if ($user['User']['document_verify'] == '0') {
                            echo "Please verify document go to edit button";
                        }
                        ?>"> 
                <button type="button" class="btn btn-<?= ($user['User']['document_verify'] == 1) ? 'success ' : 'danger' ?> 
                        <?php if ($user['User']['document_verify'] == '1') { ?>
                    change2
                        <?php }
                        ?>
                "u_id ="<?= $user['User']['id'] ?>" 
                document_verify ="<?= ($user['User']['document_verify'] == 1) ? '0' : '1' ?>" 
                name="button">
                        <?= ($user['User']['document_verify'] == 1) ? 'Document verified' : 'Document not verify' ?>
                </button>
                </span>
                </td>-->
                        <td>
                            <?=
                            $this->Html->link("<button type='button' data-toggle='tooltip' title='View' class='cstm-des-rounded-sec btn btn-danger'><i class='view fa fa-eye' aria-hidden='true'></i></button>", array(
                                'controller' => 'users',
                                'action' => 'viewDetail',
                                'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                                $user['User']['id'], 'listDriver',
// !empty($this->request->params['action']) ? $this->request->params['action'] : ''
                                    )
                                    , array('escape' => false));
                            ?>
                            <?=
                            $this->Html->link("<button type='button' data-toggle='tooltip' title='Edit' class='cstm-des-rounded-sec btn btn-danger'><i class='edit fa fa-pencil-square-o' aria-hidden='true'></i></button>", array(
                                'controller' => 'users',
                                'action' => 'editDriver',
                                'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                                $user['User']['id'], 'listDriver',
// !empty($this->request->params['action']) ? $this->request->params['action'] : ''
                                    )
                                    , array('escape' => false));
                            ?>
                            <button type="button" title="Delete" data-toggle='tooltip' title='Delete' class="cstm-des-rounded-sec btn btn-danger delete_user" u_id ="<?= $user['User']['id'] ?>" name="button">
                                <i class="fa fa-times" aria-hidden="true">
                                </i>
                            </button>
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
<div id="img_display" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h4 class="modal-title" id="modal_title">
                </h4>
            </div>
            <div class="modal-body">
                <img class="modal-content" id="model_img" src="" width="100%">
            </div>
        </div>
    </div>
</div>
<?php if ($this->Paginator->numbers()): ?>
    <p id="dynamic_pager_content2" class="well" style="text-align: right;">
        Showing   
        <?php echo $this->Paginator->counter(); ?>
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
<?php echo $this->Js->writeBuffer(); ?>
<script src="<?= FULL_BASE_URL . $this->webroot ?>assets/bootstrap/js/bootstrap.min.js">
</script>
<script>
    $('.delete_user').click(function () {
        var text = $('.myInput').val();
        // var id =
        if (confirm('Are you sure you want to delete this user?')) {
            $("#loading").fadeIn("slow");
            $.ajax({
                type: "POST",
                url: root + 'admin/users/deleteDriver/text:' + text 
                        + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>' 
                        + '/sort:<?= !empty($this->passedArgs['sort']) ? $this->passedArgs['sort'] : 'User.id' ?>' 
                        + '/direction:<?= !empty($this->passedArgs['direction']) ? $this->passedArgs['direction'] : 'DESC' ?>',
                data: {
                    id: $(this).attr('u_id'),
                }
                ,
                success: function (data) {
                    $("#loading").fadeOut("slow");
                    $('#allDataUpdate').html(data);
                }
                ,
                complete: function (e, t, settings) {
                    if (e.status === 400 || t === 'timeout') {
                        //	form_result.html(alertError('Timeout, please try again after sometime.'));
                    }
                }
            }
            );
        }
    }
    );
    $(".change").click(function () {
        var text = $('.myInput').val();
         if (confirm('Are you sure you want to change status this user?')) {
        $("#loading").fadeIn("slow");
        
        $.ajax({
            type: "POST",
            url: root + 'admin/users/changeDriverstatus/text:' + text
                    + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>'
                    + '/sort:<?= !empty($this->passedArgs['sort']) ? $this->passedArgs['sort'] : 'User.id' ?>'
                    + '/direction:<?= !empty($this->passedArgs['direction']) ? $this->passedArgs['direction'] : 'DESC' ?>',
            data: {
                id: $(this).attr('u_id'),
                sts: $(this).attr('status'),
            }
            , success: function (data) {
                $("#loading").fadeOut("slow");
                $('#allDataUpdate').html(data);
            }
            ,
            complete: function (e, t, settings) {
                if (e.status === 400 || t === 'timeout') {
                    //	form_result.html(alertError('Timeout, please try again after sometime.'));
                }
            }
        }
        );
}
    }
    );
    //    $(".change2").click(function () {
    //        var text = $('.myInput').val();
    //        $("#loading").fadeIn("slow");
    //        $.ajax({
    //            type: "POST",
    //            url: root + 'admin/users/changeDocumentStatus/text:' + text
    //                    + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>'
    //                    + '/sort:<?= !empty($this->passedArgs['sort']) ? $this->passedArgs['sort'] : 'User.id' ?>'
    //                    + '/direction:<?= !empty($this->passedArgs['direction']) ? $this->passedArgs['direction'] : 'DESC' ?>',
    //            data: {
    //                id: $(this).attr('u_id'),
    //                dvs: $(this).attr('document_verify'),
    //            }
    //            , success: function (data) {
    //                $("#loading").fadeOut("slow");
    //                $('#allDataUpdate').html(data);
    //            }
    //            ,
    //            complete: function (e, t, settings) {
    //                if (e.status === 400 || t === 'timeout') {
    //                    //	form_result.html(alertError('Timeout, please try again after sometime.'));
    //                }
    //            }
    //        }
    //        )
    //    }
    //    )
</script>
<style>
    img:hover {
        cursor: pointer;
    }
    
</style>
<script>
    $(document).ready(function () {
        $(".img_display").click(function () {
          
            var img_display = $(this).attr("src");
	    var title = $(this).attr("data-title");
            $("#model_img").attr("src", img_display);
            $("#modal_title").html(title + " image");
            $("#img_display").modal("show");
        }
        );
    }
    );
    
    

</script>
<script src="<?= FULL_BASE_URL . $this->webroot ?>assets/bootstrap/js/bootstrap.min.js">
</script>