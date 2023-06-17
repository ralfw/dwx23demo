<div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
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

</ol>
</div>
</div>
<div class="container-fluid"><div class="card-group">
                    <div class="card">
                         <a href="<?= FULL_BASE_URL . $this->webroot ?>admin/categories/listCategory"><div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-bullseye text-info"></i></h2>
                                    <h3 class=""><?php echo $category ?></h3>
                                    <h6 class="card-subtitle" style="color: #333;font-weight: bold;">Category</h6></div>
                                
                            </div>
                        </div>
                    </div></a>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-alert-circle text-success"></i></h2>
                                    <h3 class=""><?php echo $subcategory ?></h3>
                                    <a href="#"><h6 class="card-subtitle" style="color: #333;font-weight: bold;">Subcategory</h6></a></div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                         <a href="<?= FULL_BASE_URL . $this->webroot ?>admin/shops/listShop"><div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="fa fa-bank text-purple"></i></h2>
                                    <h3 class=""><?php echo $shop ?></h3>
                                   <h6 class="card-subtitle" style="color: #333;font-weight: bold;">Shop</h6></a></div>
                                
                            </div>
                        </div></a>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                     <div class="card">
                        <a href="<?= FULL_BASE_URL . $this->webroot ?>admin/users/listUser"><div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="fa fa-users text-warning"></i></h2>
                                    <h3 class=""><?= $users ?></h3>
                                     <h6 class="card-subtitle" style="color: #333;font-weight: bold;">Total User</h6></div>
                              
                            </div>
                        </div></a>
                    </div> 
                </div></div>
<style>
.card:hover {
    background: transparent;
    }

</style>