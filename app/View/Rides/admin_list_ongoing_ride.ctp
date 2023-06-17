<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
	    <?= $layoutTitle ?>
	</h1>
        <ol class="breadcrumb">
	    <li><i class="fa fa-home"></i> <?php
		echo $this->Html->getCrumbs(' > ', array(
		    'text' => 'Home',
		   'url' => array('controller' => 'users', 'action' => 'dashboard', 'admin' => true),
		    'escape' => false
		));
		?>  
	    </li>
	    <li class="active"><?= "Ongoing Ride List" ?></li>
        </ol>
    </section>

    <section>
        <!-- search box -->
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
		    <div class="input-append span12">
			<input type="text" name="data[q]" class="search-query myInput form-control" placeholder="Type to search">
		    </div> 
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
		<div class="box" id="allDataUpdate">
<?= $this->element('list_ongoing_rides'); ?>
                </div>
                <!-- /.box -->
            </div> 
        </div>
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    $(function () {
	//setup before functions
	var typingTimer;                //timer identifier
	var doneTypingInterval = 1000;  //time in ms, 5 second for example
	var $input = $('.myInput');

	//on keyup, start the countdown
	$input.on('keyup', function () {
	    clearTimeout(typingTimer);
	    typingTimer = setTimeout(doneTyping, doneTypingInterval);
	});

	//on keydown, clear the countdown
	$input.on('keydown', function () {
	    clearTimeout(typingTimer);
	});


	function doneTyping() {
	    var text = $('.myInput').val();
	    $("#loading").fadeIn("slow");
	    $.ajax({
		type: "GET",
		url: root + 'admin/rides/listOngoingRide/text:' + text,
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
	;
    });





</script>
<style>
    i.edit.fa.fa-pencil-square-o {
	color: #fff;
    }
    i.edit.fa.fa-eye {
	color: #fff; 
    }
</style>