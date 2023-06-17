<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="1800; URL='<?= Router::url('/', true) ?>logout'"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
     <link rel="icon" type="image/png" sizes="16x16" href="<?= FULL_BASE_URL . $this->webroot.$loginuserdata['User']['fav_icon'] ?>"> 
    <title><?= __('Admin') ?> | <?= PROJECT_NAME ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

     <link href="<?= FULL_BASE_URL . $this->webroot ?>assets/css/select2.css" rel="stylesheet">
    <!--alerts CSS -->
    <link href="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- morris CSS -->
   
    <!-- Custom CSS -->
    <link href="<?= FULL_BASE_URL . $this->webroot ?>assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= FULL_BASE_URL . $this->webroot ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>css/jquery.growl.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css">
         <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
 
<!-- Default Theme -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.css">
 <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script> var root = "<?= Router::url('/', true) ?>";
            var cUser = "<?= AuthComponent::user('ID') ?>";
        </script>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <?php /* ?>
    <div id="loading" style="display: none;"><?= $this->Html->image('loading.gif'); ?></div>
    <?php */?>
    <div id="loading" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

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
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                <h1><?= PROJECT_NAME ?></h1>   
                </div>

                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                       
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                      <!--  <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= FULL_BASE_URL . $this->webroot ?><?=$loginuserdata['User']['image'];?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?= FULL_BASE_URL . $this->webroot.$loginuserdata['User']['image'] ?>" alt="user" /></div>
                                        <div class="u-text">
                                         <h4><?php echo $loginuserdata['User']['name']; ?></h4>
                                        <p class="text-muted"><?php echo $loginuserdata['User']['email']; ?></p>

                                        <!-- <a href="<?php echo FULL_BASE_URL . $this->webroot ?>/admin/users/setting" class="btn btn-rounded btn-danger btn-sm">View Profile</a> -->
                                        <?=$this->Html->link('<i class="ti-user"></i> ' . __('View Profile') . '',array('controller' => 'users','action'=>'myProfile'),array('class' => 'btn btn-rounded btn-danger btn-sm','escape'=>false) );?>
                                        </div>

                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                  <!--   <li><a href="<?php echo FULL_BASE_URL . $this->webroot ?>/admin/users/setting"><i class="ti-user"></i>My Profile</a></li> -->
                                  <li> <?=$this->Html->link('<i class="ti-user"></i> ' . __('My Profile') . '',array('controller' => 'users','action'=>'myProfile'),array('class' => '','escape'=>false) );?></li>

                                    <li role="separator" class="divider"></li>

                                    <li> <?=$this->Html->link('<i class="ti-settings"></i> ' . __('Account Setting') . '',array('controller' => 'users','action'=>'setting'),array('class' => '','escape'=>false) );?></li>

                                   <!--  <li><a href="<?php echo FULL_BASE_URL . $this->webroot ?>/admin/users/notification"><i class="ti-settings"></i>Account Setting</a></li> -->

                                    <li role="separator" class="divider"></li>
                                    <li>
                                    <?=$this->Html->link('<i class="fa fa-power-off"></i> ' . __('Logout') . '',array('controller' => 'users','action'=>'logout'),array('class' => '','escape'=>false) ); ?>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?= FULL_BASE_URL . $this->webroot.$loginuserdata['User']['image'] ?>" alt="user" />
                        <!-- this is blinking heartbit-->
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5><?=$loginuserdata['User']['name'];?></h5>
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <!-- <a href="pages-login.html" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> -->
                          <?=$this->Html->link('<i class="mdi mdi-power"></i> ' . __('') . '',array('controller' => 'users','action'=>'logout'),array('class' => '','escape'=>false) ); ?> 
                          
                        <div class="dropdown-menu animated flipInY">
                        <?=$this->Html->link('<i class="ti-user"></i> ' . __('My Profile') . '',array('controller' => 'users','action'=>'myProfile'),array('class' => 'dropdown-item','escape'=>false) );?>
                            <!-- text-->
                           <!--  <a href="<?= FULL_BASE_URL . $this->webroot ?>/admin/users/setting" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
 -->                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                             <?=$this->Html->link('<i class="ti-settings"></i> ' . __('Account Setting') . '',array('controller' => 'users','action'=>'setting'),array('class' => 'dropdown-item','escape'=>false) );?>
                            <!-- <a href="<?= FULL_BASE_URL . $this->webroot ?>/admin/users/notification" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a> -->
                           <div class="dropdown-divider"></div>
									 
                            <!-- text-->
                          
                            <?=$this->Html->link('<i class="fa fa-power-off"></i> ' . __('Logout') . '',array('controller' => 'users','action'=>'logout'),array('class' => 'dropdown-item','escape'=>false) ); ?> 
                            <!-- text-->
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <?=$this->element('navigation');?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
           
                <?php echo $this->fetch('content'); ?>
           
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © <?= date('Y') ?> <?= PROJECT_NAME . ' ' . __('All Rights Reserved') ?> </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
     <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/jquery/jquery.min.js"></script>
<!--    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>-->
    <!-- Bootstrap tether Core JavaScript -->
     <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/js/select2.js"></script>
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--morris JavaScript -->
    
    
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="<?= FULL_BASE_URL . $this->webroot ?>js/jquery.growl.js"></script> 
    <!-- Sweet-Alert  -->
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->

<!-- You can use latest version of jQuery  -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
 
<!-- Include js plugin -->
<script type="text/javascript">
 $('.treeview a').click(function(){
    $(this).parent('.treeview').toggleClass('active');
    if( $(this).parent('.treeview').hasClass('active')){
        $(this).next('ul.treeview-menu').css('display','block');
    }
    
})
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>   
<script type="text/javascript">
    $(document).ready(function() {
 
  $(".owl-carousel").owlCarousel({
    items:1,
    loop:true,
    margin:10,
    autoplay:true

  });
 
});
</script> 
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
    <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <?php
        if (!empty($_SESSION['Message']['error'])) {
            echo "<script>  $.growl.error({location: 'tr',title:'" . __('Error') . "', message: '" . $this->Session->flash('error') . "',size:'large',duration:6000});</script>";
        } else if (!empty($_SESSION['Message']['success'])) {
            echo "<script>  $.growl.notice({location: 'tr',title:'" . __('Success') . "', message: '" . $this->Session->flash('success') . "',size:'large',duration:5000});</script>";
        }
 ?>
    <style>
            #loading {
                background-color: rgba(0, 0, 0, 0.5);
                height: 100%;
                position: fixed;
                width: 100%;
                cursor: wait;
                z-index: 99;
            }
            #loading img {
                left: 50%;
                position: fixed;
                top: 50%;
                max-width: 180px;
                transform: translate(-50px,-50px);
            }
        </style>
</body>

</html>

