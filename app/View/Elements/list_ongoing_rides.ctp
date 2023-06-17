<?php
$this->Paginator->options(
        array('update' => '.box',
            'evalScripts' => true,
            'before' => $this->Js->get('#loading')->effect('fadeIn', array('buffer' => false)),
            'complete' => $this->Js->get('#loading')->effect('fadeOut', array('buffer' => false)),
            'url' => array('controller' => 'rides',
                'action' => 'listOngoingRide', 'admin' => true, 'text' => (!empty($text)) ? $text : '',),
));
?> 

<div class="box-body table-responsive no-padding" >
    <table class="table table-stripped toggle-arrow-tiny default breakpoint footable-loaded">
        <?php //pr($rides);  ?>

        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('User.name', 'Ride By <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                <th><?php echo $this->Paginator->sort('Driver.name', 'Driver Name <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                <th><?php echo $this->Paginator->sort('Ride.cash_amt', 'Cash Amount<i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                <th><?php echo $this->Paginator->sort('Ride.wallet_amt', 'Wallet Amount <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                <th><?php echo $this->Paginator->sort('Ride.status', 'Status <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>
                <th><?php echo $this->Paginator->sort('Ride.created', 'Date <i class="fa fa-sort"></i>', array('escape' => false)); ?> </th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($rides):
                foreach ($rides as $ride):
                    ?>
                    <tr>
                        <td><?= $ride['User']['name'] ?></td>
                        <td><?= $ride['Driver']['name'] ?></td>
                        <td><?= $ride['Ride']['cash_amt'] ?></td>
                        <td><?= $ride['Ride']['wallet_amt'] ?></td>

                        <td> <?php
                            echo $rstatus = $ride_status[$ride['Ride']['status']];
                            ?></td>








                        <td><?=
                            date("D, d M Y ,h:m A", strtotime($ride['Ride']['created']));
                            ?></td>

                        <td>
                            <button type="button" data-toggle='tooltip' title='View' class="cstm-des-rounded-sec btn btn-danger" 
                                    u_id ="<?= $ride['Ride']['id'] ?>" name="button">
                                <?=
                                $this->Html->link("<i class='edit fa fa-eye' aria-hidden='true'></i>", array(
                                    'controller' => 'Rides',
                                    'action' => 'viewCompletedRide',
                                    'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                                    $ride['Ride']['id'],
                                    !empty($this->request->params['action']) ? $this->request->params['action'] : ''
                                        ), array('escape' => false));
                                ?>
                            </button>
                            <button type="button"  data-toggle='tooltip' 
                                    title='Delete' class="cstm-des-rounded-sec btn btn-danger delete_ride" 
                                    u_id ="<?= $ride['Ride']['id'] ?>" name="button">
                                <i class="fa fa-times" aria-hidden="true"></i>
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

<?php echo $this->Js->writeBuffer(); ?>


<script>

    $('.delete_ride').click(function () {
        var text = $('.myInput').val();

        // var id =
        if (confirm('Are you sure you want to delete this Ride?')) {
            $("#loading").fadeIn("slow");
            $.ajax({
                type: "POST",
                url: root + 'admin/rides/deleteOngoingRide/text:' + text + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>',
                data: {
                    id: $(this).attr('u_id'),
                },
                success: function (data) {
                    $("#loading").fadeOut("slow");
                    $('#allDataUpdate').html(data);
                },
                complete: function (e, t, settings) {
                    if (e.status === 400 || t === 'timeout') {
                        //	form_result.html(alertError('Timeout, please try again after sometime.'));
                    }
                }
            });
        }

    });

</script>

<script>

    setTimeout(function () {
        var text = $('.myInput').val();

        $("#loading").fadeIn("slow");
        $.ajax({
            type: "POST",
            url: root + 'admin/rides/listOngoingRide/text:' + text + '/page:<?= !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1' ?>',
            data: {
                id: $(this).attr('u_id'),
            },
            success: function (data) {
                $("#loading").fadeOut("slow");
                $('#allDataUpdate').html(data);
            },
            complete: function (e, t, settings) {
                if (e.status === 400 || t === 'timeout') {
                    //	form_result.html(alertError('Timeout, please try again after sometime.'));
                }
            }
        });


    }, 20000);





</script>

<style>
    td.custome-td {
        max-width: 26px;
    }
</style>

<script src="<?= FULL_BASE_URL . $this->webroot ?>assets/bootstrap/js/bootstrap.min.js">
</script>
