<?php
$this->Paginator->options(
        array('update' => '.box',
            'evalScripts' => true,
            'before' => $this->Js->get('#loading')->effect('fadeIn', array('buffer' => false)),
            'complete' => $this->Js->get('#loading')->effect('fadeOut', array('buffer' => false)),
            'url' => array('controller' => 'users',
                'action' => 'listUser', 'admin' => true, 'text' => (!empty($text)) ? $text : '',),
));
?> 

                               
                               
                                    <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list footable-loaded footable" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>image</th>
                                                <th><?php echo $this->Paginator->sort('User.name', 'Name <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                                                <th>Phone</th>
                                                <th class="footable-sortable footable-sorted-desc">Email<span class="footable-sort-indicator"></span></th>
                                                <!-- <th>wallet</th> -->
                                                <!-- <th>created</th> -->
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if ($users):
                                            $count = 1;
                                        foreach ($users as $user):
                                            if($count % 2 == 0){
                                                $mine = 'even';
                                            }else{
                                                 $mine = 'odd';
                                            }

                                        ?>
                                        <tr class="footable-<?php echo $mine; ?>">
                                                <td><?php echo $count; ?></td>
                                                <td>
                                                <?php
                                                    $m = FULL_BASE_URL . $this->webroot . $user['User']['image'];
                                                    $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';
                                                    //prx( $default);
                                                    if (!empty($user['User']['image'])) {
                                                    $img = $this->Html->image($m, array('alt' => 'User Image', 'border' => '1',
                                                    'height' => '40', 'width' => '40',
                                                    'data-src' => 'holder.js/100%x100',
                                                    'class' => "img_display img-circle",
                                                    "data-title" => "User"
                                                    ));
                                                    echo $img;
                                                    } else {
                                                    $img = $this->Html->image($default, array('alt' => 'default', 'border' => '1',
                                                    'height' => '40', 'width' => '40',
                                                    'data-src' => 'holder.js/100%x100',
                                                    'class' => "img_display img-circle",
                                                    "data-title" => ""
                                                    ));
                                                    echo $img;
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <?= ucfirst($user['User']['name']) ?>
                                                </td>
                                                <td>
                                                 <?= $user['User']['phone'] ?>
                                                </td>
                                                <td>
                                                    <?= $user['User']['email'] ?>
                                                </td>
                                        
                                        <td>
                                        <button type="button" title="Change Status" class=" cstm-des-rounded-sec
                                            btn btn-<?= ($user['User']['status'] == 1) ?
                                            'success ' : 'danger'
                                            ?> change" 
                                            u_id ="<?= $user['User']['id'] ?>" 
                                            status ="<?= ($user['User']['status'] == 1) ? '0' : '1' ?>" name="button">
                                             <?= ($user['User']['status'] == 1) ? 'Y' : 'N' ?>
                                            </button>
                                        </td>
                                        <td>
                                            <?php 
                                            // echo $this->Html->link("<button type='button' data-toggle='tooltip' class='cstm-des-rounded-sec btn btn-info'><i class='view fa fa-eye' aria-hidden='true'></i></button>", array(
                                            // 'controller' => 'users',
                                            // 'action' => 'viewUser',
                                            // ($user['User']['id'])),array('escape' => false));
                                            ?>
                                            <button type="button" title='Delete' class="cstm-des-rounded-sec btn btn-danger delete_user model_img" u_id ="<?= $user['User']['id'] ?>" name="button" >
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        </tr>
                                            <?php
                                            $count++;
                                            endforeach;
                                            else :
                                                echo "<tr><td colspan='7' style='text-align: center;'>No data found.</td></tr>";
                                            endif;
                                            ?>
                                            
                                        </tbody>
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
                                        <tfoot>
                                        <tr>
                                        <td colspan="6">
                                        <div class="text-right">
                                            <?php if ($this->Paginator->numbers()): ?>
                                                <ul class="pagination">
                                                <?php
                                                echo $this->Paginator->prev(__('<<'), array('tag' => 'li','class' => 'footable-page-arrow'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
                                                echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
                                                echo $this->Paginator->next(__('>>'), array('tag' => 'li', 'currentClass' => 'disabled','class' => 'footable-page-arrow'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
                                                ?>
                
                                                </ul>
                                            <?php endif; ?>


                                        </div>
                                        </td>
                                        </tr>
                                        </tfoot>
                                        </table>
                                        
                                         
   <?php //if ($this->Paginator->numbers()): ?>
    <!-- <p id="dynamic_pager_content2" class="well" style="text-align: right;">
        Showing   <?php// echo $this->Paginator->counter(); ?>
    </p>
    <?php ?>
    <div class="pagination pagination-large" style="width: 100%;  text-align: center;">
        <ul class="pagination">
            <?php
           // echo $this->Paginator->prev(__('<<'), array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
           // echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
           // echo $this->Paginator->next(__('>>'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
            ?>
        </ul>
    </div> -->
<?php //endif; ?>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js">
</script>

<script>
$('.delete_user').click(function () {
       
       var text = $('.myInput').val();
        //$(".showSweetAlert").find('p').text("lead text-muted");
        //var table = $(this).attr("msg");
        var id = $(this).attr('u_id');
        swal({
            title: "Are you sure?",
            text: "You want to delete this user !",
            type: "warning",
            timer: 3000,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel !",

            closeOnConfirm: true,
            closeOnCancel: true,
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
        }, function (isConfirm) {
            if (isConfirm) {
                $("#loading").fadeIn("slow");
                $.ajax({
                    type: "POST",
                    url: root + 'admin/users/deleteUser/text:'+ text 
                        + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>' 
                        + '/sort:<?= !empty($this->passedArgs['sort']) ? $this->passedArgs['sort'] : 'User.id' ?>' 
                        + '/direction:<?= !empty($this->passedArgs['direction']) ? $this->passedArgs['direction'] : 'DESC' ?>',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $("#loading").fadeOut("slow");
                        $('#allDataUpdate').html(data);
                       // swal("Done!", "It was succesfully deleted!", "success");
                      // location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Please try again", "error");
                    }
//                complete: function (e, t, settings) {
//                    if (e.status === 400 || t === 'timeout') {
//                        //    form_result.html(alertError('Timeout, please try again after sometime.'));
//                    }
//                }
                });
            } else
            {
            
                swal();
            }
        });
    });
 
  $('.change').click(function () {
       
       var text = $('.myInput').val();
        //$(".showSweetAlert").find('p').text("lead text-muted");
        //var table = $(this).attr("msg");
        var id = $(this).attr('u_id');
        
        var sts= $(this).attr('status');
        swal({
            title: "Are you sure?",
            text: "You want to deactivate the user",
            type: "warning",
            timer: 3000,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Change it!",
            cancelButtonText: "No, cancel !",

            closeOnConfirm: true,
            closeOnCancel: true,
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
        }, function (isConfirm) {
            if (isConfirm) {
                $("#loading").fadeIn("slow");
                $.ajax({
                type: "POST",
                url: root + 'admin/users/changeUserstatus/text:' + text
                        + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>'
                        + '/sort:<?= !empty($this->passedArgs['sort']) ? $this->passedArgs['sort'] : 'User.id' ?>'
                        + '/direction:<?= !empty($this->passedArgs['direction']) ? $this->passedArgs['direction'] : 'DESC' ?>',
                data: {
                    id: id,
                    sts: sts,
                }
                , success: function (data) {
                    $("#loading").fadeOut("slow");
                    $('#allDataUpdate').html(data);
                }
                ,
                 error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Please try again", "error");
                    }
            }
            );
            } else
            {
            
                swal();
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        $(".img_display").click(function () {

            var img_display = $(this).attr("src");
            var title = $(this).attr("data-title");
            $("#model_img").attr("src", img_display);
            //$("#modal_title").html("image");
            $("#img_display").modal("show");
        }
        );
    }
    );



</script>
