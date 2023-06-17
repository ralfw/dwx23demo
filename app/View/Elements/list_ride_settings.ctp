<?php
$this->Paginator->options(
        array('update' => '.box',
            'evalScripts' => true,
            'before' => $this->Js->get('#loading')->effect('fadeIn', array('buffer' => false)),
            'complete' => $this->Js->get('#loading')->effect('fadeOut', array('buffer' => false)),
            'url' => array('controller' => 'sports',
                'action' => 'listRideSettting', 'admin' => true, 'text' => (!empty($text)) ? $text : '',),
));
?>
<div class="box-body table-responsive no-padding">
    <table class="table table-stripped toggle-arrow-tiny default breakpoint footable-loaded">
        <thead>
            <tr>
                <th>
                    <?php echo $this->Paginator->sort('Option.name', 'Name <i class="fa fa-sort"></i>', array('escape' => false)); ?> 
                </th>
                <th>
                    <?php echo $this->Paginator->sort('Option.value', 'Amount <i class="fa fa-sort"></i>', array('escape' => false)); ?> 
                </th>
                <th>Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($options):
                foreach ($options as $option):
                    ?>
                    <tr>
                        <td>
                            <?= ucfirst($option['Option']['name']) ?>
                        </td>
                        <td>
                            <?= ucfirst($option['Option']['value']) ?>
                        </td>
                        <td>
                            <button type="button" title="View" data-toggle='tooltip' title='View' class="btn btn-danger" u_id ="<?= $option['Option']['id'] ?>" name="button">
                                <?=
                                $this->Html->link("<i class='edit fa fa-pencil-square-o' aria-hidden='true'></i>", array(
                                    'controller' => 'rides',
                                    'action' => 'editRideSetting',
                                    'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                                    $option['Option']['id'], !empty($this->request->params['action']) ? $this->request->params['action'] : '1'
                                        ), array('escape' => false));
                                ?>
                            </button>
        <!--			    <button type="button" title="Delete" class="btn btn-danger deletesport" u_id ="<?= $option['Option']['id'] ?>" name="button">
                                <i class="fa fa-times" aria-hidden="true">
                                </i>
                            </button>-->
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
<script>
    $('.deletesport').click(function () {
        var text = $('.myInput').val();
        // var id =
        if (confirm('Are you sure you want to delete this Option?')) {
            $("#loading").fadeIn("slow");
            $.ajax({
                type: "POST",
                url: root + 'admin/sports/deletesport/text:' + text + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>',
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
    
    
    
     /********Tool Tip*********/
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    
</script>
<style>
    i.edit.fa.fa-pencil-square-o {
        color: #fff;
    }
    i.edit.fa.fa-eye {
        color: #fff;
    }
</style>
<script src="<?= FULL_BASE_URL . $this->webroot ?>assets/bootstrap/js/bootstrap.min.js">
</script>