<?php
//pr($gallery_image);
?>
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
            <th>Sr.No</th>
            <!-- <th>Shop Id</th> -->
            <th>Gallery Image</th>
            <th>Price</th>
           <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($gallery_image):
            $count = 1;
            foreach ($gallery_image as $category): ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <!-- <td><?php //echo $category['Gallery']['shop_id'] ?></td> -->
                    <td><?php
                        $m = FULL_BASE_URL . $this->webroot . $category['Gallery']['image'];
                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';

                        if (!empty($category['Gallery']['image'])) {
                            $img = $this->Html->image($m, array('alt' => 'User Image', 'border' => '1',
                                'height' => '40', 'width' => '40',
                                'data-src' => 'holder.js/100%x100',
                                'class' => "img_display img-circle",
                                "data-title" => "gallery"
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

                        <td><?php echo $category['Gallery']['currency'].$category['Gallery']['price'] ?></td>
                       
                    


              <td style="width:150px;">
              <button type="button" title="Delete" 
               title='Delete' 
              class=" cstm-des-rounded-sec btn btn-danger deletegallery model_img" 
              u_id ="<?= $category['Gallery']['id'] ?>" 
              name="button"> <i class="fa fa-times" aria-hidden="true">
              </i></button>
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
<script>
  $('.deletegallery').click(function () {
       
       var text = $('.myInput').val();
        //$(".showSweetAlert").find('p').text("lead text-muted");
        //var table = $(this).attr("msg");
        var id = $(this).attr('u_id');
        swal({
            title: "Are you sure?",
            text: "You want to delete this gallery image !",
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
        url: root + 'admin/shops/deleteGallery/text:' + text + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>' + '/sort:<?= !empty($this->passedArgs['sort']) ? $this->passedArgs['sort'] : 'Gallery.id'  ?>'+ '/direction:<?= !empty($this->passedArgs['direction']) ? $this->passedArgs['direction'] : 'DESC'  ?>',
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
</script>
