<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
   <!--  <link rel="icon" type="image/png" sizes="16x16" href="<?=FULL_BASE_URL.$this->webroot?>assets/images/favicon.png"> -->
<link rel="icon" type="image/png" sizes="16x16" href="<?= FULL_BASE_URL . $this->webroot.$customdata['Custom']['fav_icon'] ?>">
    <title><?=__('Admin')?> | <?=PROJECT_NAME?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=FULL_BASE_URL.$this->webroot?>assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?=FULL_BASE_URL.$this->webroot?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>css/jquery.growl.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register custom-login-cont" style="background-image:url(<?=FULL_BASE_URL.$this->webroot.$customdata['Custom']['background_image']?>);">
        <div class="custom-login-logo-cont">
        <img src="<?= FULL_BASE_URL . $this->webroot.$customdata['Custom']['logo'];?>" alt="logo" />
           <!-- <img src="http://175.176.184.119/~apis~/Go_taxi//img/logo.png" /> -->
        </div>
           <?php echo $this->fetch('content'); ?>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?=FULL_BASE_URL.$this->webroot?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?=FULL_BASE_URL.$this->webroot?>assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=FULL_BASE_URL.$this->webroot?>assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=FULL_BASE_URL.$this->webroot?>assets/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script type="text/javascript">
        $("#login_form").on("click", function() {
    //alert('gu');
         $("#recoverform").slideUp();
        $("#loginform").fadeIn();
    });

    </script>
   <script src="<?= FULL_BASE_URL . $this->webroot ?>js/jquery.growl.js"></script>
    <?php
        if (!empty($_SESSION['Message']['error'])) {
            echo "<script>  $.growl.error({location: 'tr',title:'" . __('Error') . "', message: '" . $this->Session->flash('error') . "',size:'large',duration:6000});</script>";
        } else if (!empty($_SESSION['Message']['success'])) {
            echo "<script>  $.growl.notice({location: 'tr',title:'" . __('Success') . "', message: '" . $this->Session->flash('success') . "',size:'large',duration:5000});</script>";
        }
 ?>
</body>

</html>


