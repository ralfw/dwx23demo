<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= __('Admin') ?> | <?= PROJECT_NAME ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->


        <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>css/admin_theme.css">
        <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>css/googlemapstylesheet.css">
        <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/datatables/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>assets/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>assets/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?= FULL_BASE_URL . $this->webroot ?>css/jquery.growl.css">

        <style>

            .btn-primary {
                background-color: #008000 !important;
                border-color: #fff  !important;
            }
            .skin-blue .main-header .navbar {
                background-color: #008000 !important;
            }
            .skin-blue .main-header .logo {
                background-color: #008000 !important;
            }

            .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
                background-color: #008000 !important;

            }
            /*            .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
                            border-left-color: #008000 !important;
                        }*/
            .table  a {
                color: #008000 !important;
            }
            /*            .skin-blue .main-header .navbar .sidebar-toggle:hover {
                            background-color: #008000 !important;
                        }*/
            .main-header .logo {
                font-size: 15px !important;
            }
            /*            .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
                            background-color: #008000 !important;
                        }*/

        </style>


        <!-- jQuery 2.2.3 -->



        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!--        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/bootstrap/js/bootstrap.min.js"></script>-->
        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/select2/select2.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>


        <script> var root = "<?= Router::url('/', true) ?>";
            var cUser = "<?= AuthComponent::user('ID') ?>";
        </script>
    </head>

    <body class="hold-transition skin-blue sidebar-mini admin_new_theme">
        <div id="loading" style="display: none;"><?= $this->Html->image('loading.gif'); ?></div>
        <div class="wrapper admin_new_theme_first_child">
            <header class="main-header">
                <!-- Logo -->
                <div class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b><?= PROJECT_NAME ?></b></span>
                </div>

                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top admin_new_theme_second_child">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only"><?= __('Toggle navigation') ?></span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <div class="pull-right">
                            <?= $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'btn btn-primary')); ?>
                        </div>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <?= $this->element('navigation'); ?>

            <?php echo $this->fetch('content'); ?>

            <footer class="main-footer">
                <?= date('Y') ?> © <?= PROJECT_NAME . ' ' . __('All Rights Reserved') ?>
            </footer>

            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->


        <!-- Bootstrap 3.3.6 -->
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



        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
		  <script src="https://code.highcharts.com/highcharts.js"></script>
			<script src="https://code.highcharts.com/modules/exporting.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js" charset="utf-8"></script>
        <!--<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js" charset="utf-8"></script>-->


        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/dist/js/app.min.js"></script>
        <!-- Sparkline -->
        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>

        <!-- ChartJS 1.0.1 -->
        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/plugins/chartjs/Chart.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

        <!-- AdminLTE for demo purposes -->
        <script src="<?= FULL_BASE_URL . $this->webroot ?>assets/dist/js/demo.js"></script>
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
