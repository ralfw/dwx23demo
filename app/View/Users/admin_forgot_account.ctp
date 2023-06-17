        <div class="login-box card">
                <div class="card-body">
                 <?=__($this->Session->flash()); ?>
                    <?= $this->Form->create(array('url'=> array('controller' => 'users', 'action' => 'forgotAccount',(isset($_GET['forgot'])?$_GET['forgot']:''),(isset($_GET['forgotid'])?$_GET['forgotid']:'')),'class'=>'form-horizontal')); ?>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Reset your password</h3>
                                
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                              <input class="form-control" type="text" required=""  placeholder="Enter your new password" name="data[User][password]">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Change password</button>
                            </div>
                        </div>
                   <?php echo $this->Form->end(); ?>
                </div>
            </div>

