<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?=FULL_BASE_URL.$this->webroot?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=FULL_BASE_URL.$this->webroot?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=FULL_BASE_URL.$this->webroot?>assets/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <div class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b><?=PROJECT_NAME?></b></span>
        </div>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <div class="pull-right">
                    <?=$this->Html->link( 'Logout',array('controller' => 'users','action'=>'logout'),array('class' => 'btn btn-primary') ); ?>
                </div>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?=FULL_BASE_URL.$this->webroot?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p style="text-transform: capitalize;"><?=$this->Session->read('Auth.User.username')?></p>
					<?= $this->Html->link('<i class="fa fa-circle text-success"></i> Change password', array(
                                                    'controller' => 'users',
                                                    'action' => 'changePassword',
													'admin'=>true,
                                                     $this->Session->read('Auth.User.ID')
                                                ),array('escape'=>false));?>
												
                    
                </div>
            </div>
			<?=$this->element('navigation');?>
           
    </aside>

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
             Page not found
            <small></small>
        </h1>
		
    </section>
 <section class="content">
 </section>
 </div>
    <footer class="main-footer">
        <strong>Copyright &copy; <?=date('Y')?> <?=PROJECT_NAME?> </strong> All Rights Reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
 <script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/jscolor/jscolor.js"></script>
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 --> 
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 
<!-- AdminLTE for demo purposes -->
<script src="<?=FULL_BASE_URL.$this->webroot?>assets/dist/js/demo.js"></script>
</body>
</html>