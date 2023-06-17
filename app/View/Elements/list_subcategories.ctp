<?php
// pr($subcategories); exit;
$this->Paginator->options(
        array('update' => '.box',
            'evalScripts' => true,
            'before' => $this->Js->get('#loading')->effect('fadeIn', array('buffer' => false)),
            'complete' => $this->Js->get('#loading')->effect('fadeOut', array('buffer' => false)),
            'url' => array('controller' => 'subcategories',
                'action' => 'listSubcategory','admin' => true, 'text' => (!empty($text)) ? $text : '',),
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
           <!--<th>Keyword (English)</th>
            <th>Keyword (Arabic)</th>
            <th>Keyword (Kurdish)</th> -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($subcategories):
            $count = 1;
            foreach ($subcategories as $category): ?>
                <tr>
                    <td><?php echo $category['Subcategory']['id']; ?></td>
                    
                    <td>

                        <?php
                        $m = FULL_BASE_URL . $this->webroot . $category['Subcategory']['image'];
                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';

                        if (!empty($category['Subcategory']['image'])) {
                            $img = $this->Html->image($m, array('alt' => 'User Image', 'border' => '1',
                                'height' => '40', 'width' => '40',
                                'data-src' => 'holder.js/100%x100',
                                'class' => "img_display img-circle",
                                "data-title" => "Category"
                            ));
                            echo $img;
                        } else {
                            $img = $this->Html->image($default, array('alt' => 'default', 'border' => '1',
                                'height' => '40', 
                                'width' => '40',
                                'data-src' => 'holder.js/100%x100',
                                'class' => "img_display img-circle",
                                "data-title" => ""
                            ));
                            echo $img;
                        }
                        ?> </td>

                        <td>  <?=
                $this->Html->link(''.__($category['Subcategory']['name_en']).'', array(
                    'controller' => 'subcategories',
                    'action' => 'viewSubcategory',
                    'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                    $category['Subcategory']['id'], 'listSubcategory' ), array('escape' => false));?></td>
                        <td>  <?=
                $this->Html->link(''.__($category['Subcategory']['name_ar']).'', array(
                    'controller' => 'subcategories',
                    'action' => 'viewSubcategory',
                    'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                    $category['Subcategory']['id'], 'listSubcategory' ), array('escape' => false));?></td>
                     <td>  <?=
                $this->Html->link(''.__($category['Subcategory']['name_ku']).'', array(
                    'controller' => 'subcategories',
                    'action' => 'viewSubcategory',
                    'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                    $category['Subcategory']['id'], 'listSubcategory' ), array('escape' => false));?></td>


        <td style="width:150px;"> 
             <!-- <?php // echo
                // $this->Html->link("<button type='button' data-toggle='tooltip' title='View Detail' class='btn btn-info cstm-des-rounded-sec'> <i class='view fa fa-eye' aria-hidden='true'></i></button>", array(
                //     'controller' => 'subcategories',
                //     'action' => 'viewSubcategory',
                //     'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                //     $category['Subcategory']['id'], 'listSubcategory',
                //         // !empty($this->request->params['action']) ? $this->request->params['action'] : ''
                //         ), array('escape' => false));
             ?> -->
        <?php
        // echo $this->Html->link(
        //      "<button type='button' data-toggle='tooltip' title='Edit' class='cstm-des-rounded-sec btn btn-info'><i class='edit fa fa-pencil-square-o' aria-hidden='true'></i></button>", array(
        //     'controller' => 'subcategories',
        //     'action' => 'editSubcategory',
        //     'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
        //     $category['Subcategory']['id'], 'listSubcategory',
        //         ), array('escape' => false)
        // );
        ?>             


                        <button type="button" title="Delete" 
                                data-toggle='tooltip' 
                                title='Delete' 
                                class=" cstm-des-rounded-sec btn btn-danger deletesubcategory model_img" 
                                u_id ="<?= $category['Subcategory']['id'] ?>" 
                                name="button">
                            <i class="fa fa-times" aria-hidden="true">
                                </i>
                        </button>









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
                    <h4 class="modal-title" id="modal_title">
                    </h4>
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

<?php //echo $this->Js->writeBuffer(); ?>
<!-- <script src="<?//= FULL_BASE_URL . $this->webroot ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<?php //echo $this->Js->writeBuffer(); ?> -->
<script>
  $('.deletesubcategory').click(function () {
       
       var text = $('.myInput').val();
        //$(".showSweetAlert").find('p').text("lead text-muted");
        //var table = $(this).attr("msg");
        var id = $(this).attr('u_id');
        swal({
            title: "Are you sure?",
            text: "You want to delete this Subcategory !",
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
        url: root + 'admin/subcategories/deleteSubcategory/text:' + text + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>' + '/sort:<?= !empty($this->passedArgs['sort']) ? $this->passedArgs['sort'] : 'Subcategory.id'  ?>'+ '/direction:<?= !empty($this->passedArgs['direction']) ? $this->passedArgs['direction'] : 'DESC'  ?>',
        data: {
            id: id,
        },
        success: function (data) {
            $("#loading").fadeOut("slow");
            $('#allDataUpdate').html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Please try again", "error");
         }
        });
            } else
            {
            
                swal();
            }
        });
    });

    // $('.deletesubcategory').click(function () {
    // var text = $('.myInput').val();
    // // var id =
    // if (confirm('Are you sure you want to delete this subcategory?')) {
    //     $("#loading").fadeIn("slow");
    //     $.ajax({
    //     type: "POST",
    //     url: root + 'admin/subcategories/deleteSubcategory/text:' + text + '/page:<?//= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>' + '/sort:<?//= !empty($this->passedArgs['sort']) ? $this->passedArgs['sort'] : 'Subcategory.id'  ?>'+ '/direction:<?//= !empty($this->passedArgs['direction']) ? $this->passedArgs['direction'] : 'DESC'  ?>',
    //     data: {
    //         id: $(this).attr('u_id'),
    //     }
    //     ,
    //     success: function (data) {
    //         $("#loading").fadeOut("slow");
    //         $('#allDataUpdate').html(data);
    //     },
    //     error: function (xhr, ajaxOptions, thrownError) {
    //                     swal("Error deleting!", "Please try again", "error");
    //      }
    //     });
    // }
    //  })

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
<style>
    i.edit.fa.fa-pencil-square-o {
    color: #fff;
    }
    i.edit.fa.fa-eye {
    color: #fff;
    }
</style>
