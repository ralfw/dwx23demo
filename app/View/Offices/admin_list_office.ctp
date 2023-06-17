 <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?= $layoutTitle ?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                 <ol class="breadcrumb">
	    <li><i class="fa fa-home"></i> <?php
		echo $this->Html->getCrumbs(' > ', array(
		    'text' => 'Home ',
		     'url' => array('controller' => 'users', 'action' => 'dashboard', 'admin' => true),
		    'escape' => false
		));
		?> 
	    </li>
             <?php echo "&nbsp > &nbsp" ?>
	    <li class="active"><?php echo  $layoutTitle ?></li>
        </ol>
                </div>
               
            </div>
<div class="container-fluid">
 <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card" >
                         <div class="card-body">
                         <div class="input-append col-md-3" style="float: right;">
                          <input type="text" name="data[q]" class="search-query myInput form-control" id="demo-input-search2" placeholder="Type to search">
                          </div> 
                           <div class="table-responsive box" id="allDataUpdate">
                        <?= $this->element('list_offices'); ?>
                        </div></div>
                        </div>
                       
                       
                    </div>
                </div>
               
            </div>
<script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
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
    url: root + 'admin/offices/listOffice/text:' + text,
    success: function (data) {
        $("#loading").fadeOut("slow");
        $('#allDataUpdate').html(data);
    },
    complete: function (e, t, settings) {
        if (e.status === 400 || t === 'timeout') {
      //  form_result.html(alertError('Timeout, please try again after sometime.'));
        }
    }
      });
  }
  ;
    });
</script>
