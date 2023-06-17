<?php
$this->Paginator->options(
        array('update' => '.box',
            'evalScripts' => true,
            'before' => $this->Js->get('#loading')->effect('fadeIn', array('buffer' => false)),
            'complete' => $this->Js->get('#loading')->effect('fadeOut', array('buffer' => false)),
            'url' => array('controller' => 'categories',
                'action' => 'listCategory', 'admin' => true, 'text' => (!empty($text)) ? $text : '',),
));
?> 



<table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list footable-loaded footable" data-page-size="10">
    <thead>
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Name (English)</th>
            <th>Name (Arabic)</th>
            <th>Name (Kurdish)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($categories):
             $page = $this->request->params['paging']['Category']['page'];/*page number exe. page no.2 */
        $record_limit = $this->request->params['paging']['Category']['limit'];/* limit 10*/
            $count = (($page-1)*$record_limit)+1;
            foreach ($categories as $category):
                
                ?>
                <tr>
                <td><?php echo $category['Category']['id'] ?></td>
                    
                    <td>

                        <?php
                        $m = FULL_BASE_URL . $this->webroot . $category['Category']['image'];
                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';

                        if (!empty($category['Category']['image'])) {
                            $img = $this->Html->image($m, array('alt' => 'User Image', 'border' => '1',
                                'height' => '40', 'width' => '40',
                                'data-src' => 'holder.js/100%x100',
                                'class' => "img_display img-circle",
                                "data-title" => "Category"
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
<td> <?=
                    $this->Html->link('' . __($category['Category']['name_en']) . '', array(
                    'controller' => 'subcategories',
                    'action' => 'listSubcategory',  
                    $category['Category']['id'],
                   ), array('escape' => false));
                    ?></td>
<td> <?=
                    $this->Html->link('' . __($category['Category']['name_ar']) . '', array(
                    'controller' => 'subcategories',
                    'action' => 'listSubcategory',  
                    $category['Category']['id'],
                   ), array('escape' => false));
                    ?></td>
<td> <?=
                    $this->Html->link('' . __($category['Category']['name_ku']) . '', array(
                    'controller' => 'subcategories',
                    'action' => 'listSubcategory',  
                    $category['Category']['id'],
                   ), array('escape' => false));
                    ?></td>

                    <td style="width:150px;">
                    <?php
                   // echo $this->Html->link('' . __($category['Category']['name_en']) . '', array(
                   //  'controller' => 'subcategories',
                   //  'action' => 'listSubcategory',  
                   //  $category['Category']['id'],
                   // ), array('escape' => false));
                    ?>





            
 <button type="button" title="Delete" data-toggle='tooltip' title='Delete'  alt='alert' class=" cstm-des-rounded-sec btn btn-danger  delete_cat model_img" u_id ="<?= $category['Category']['id'] ?>" name="button"> <i class="fa fa-times" aria-hidden="true"> </i> </button>

 </td>
                </tr>
        <?php
        $count++;
    endforeach;
else :
    echo "<tr><td colspan='5' style='text-align: center;'>No data found.</td></tr>";
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
                    <h4 class="modal-title" id="modal_title"></h4>
                </div>
                <div class="modal-body">
                    <img class="modal-content" id="model_img" src="" width="100%">
                </div>
            </div>
        </div>
    </div> 
    
    <tfoot>
        <tr>

            <td colspan="6">
                <div class="text-right">
<?php if ($this->Paginator->numbers()): ?>
                        <ul class="pagination pag" style="float: right">
    <?php
    echo $this->Paginator->prev(__('<<'), array('tag' => 'li', 'class' => 'footable-page-arrow'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
    echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
    echo $this->Paginator->next(__('>>'), array('tag' => 'li', 'currentClass' => 'disabled', 'class' => 'footable-page-arrow'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
    ?>

                        </ul>
                        <?php endif; ?>


                </div>
            </td>
        </tr>
    </tfoot>
    
</table>


<?php // if ($this->Paginator->numbers()):  ?>
<!-- <p id="dynamic_pager_content2" class="well" style="text-align: right;">
Showing   <?php  echo $this->Paginator->counter();  ?>
</p>-->
<?php ?>
<!--<div class="pagination pagination-large" style="width: 100%;  text-align: center;">
<ul class="pagination">-->
<?php
// echo $this->Paginator->prev(__('<<'), array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
// echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
// echo $this->Paginator->next(__('>>'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
?>
<!--</ul>
</div> -->
<?php //endif; ?>

<?php echo $this->Js->writeBuffer(); ?>

<script>
    $('.delete_cat').click(function () {
       
       var text = $('.myInput').val();
        //$(".showSweetAlert").find('p').text("lead text-muted");
        //var table = $(this).attr("msg");
        var id = $(this).attr('u_id');
        swal({
            title: "Are you sure?",
            text: "You want to delete this category !",
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
                    url: root + 'admin/categories/deleteCategory/text:'+ text 
                        + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>' 
                        + '/category:<?= !empty($this->passedArgs['sort']) ? $this->passedArgs['sort'] : 'Category.id' ?>' 
                        + '/direction:<?= !empty($this->passedArgs['direction']) ? $this->passedArgs['direction'] : 'DESC' ?>',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $("#loading").fadeOut("slow");
                        $('#allDataUpdate').html(data);
                      
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Please try again", "error");
                    }
//                complete: function (e, t, settings) {
//                    if (e.status === 400 || t === 'timeout') {
//                        //	form_result.html(alertError('Timeout, please try again after sometime.'));
//                    }
//                }
                });
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
