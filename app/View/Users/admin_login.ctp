        <div class="login-box card">
                <div class="card-body">
                   <?php echo $this->Form->create(array('url'=>'login','class'=>'form-horizontal form-material','id'=>'loginform')); ?>
                   
                        <h3 class="box-title m-b-20">Sign In</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                 <input class="form-control" type="text" required="" placeholder="Email" name="data[User][email]"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                 <input class="form-control" type="password" required="" placeholder="Password" name="data[User][password]"> </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 font-14">
                                <div class="checkbox checkbox-primary pull-left p-t-0">
                                </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><!-- <i class="fa fa-lock m-r-5"></i> --> Forgot pwd?</a> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                     <?php echo $this->Form->end(); ?>

                   
                    <?php echo $this->Form->create(array('url'=>'resetPassword','class'=>'form-horizontal','id'=>'recoverform')); ?>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                              <input class="form-control" type="email" required="" placeholder="Enter Email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 font-14">
                                <div class="checkbox checkbox-primary pull-left p-t-0">
                                </div> <a href="javascript:void(0)" id="login_form" class="text-dark pull-right">Back to login</a> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                 <button class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>
                   <?php echo $this->Form->end(); ?>
                </div>
            </div>
  

