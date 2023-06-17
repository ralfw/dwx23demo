  <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                    <li class="nav-devider"></li>
                    <li class="dash"> <a class="waves-effect" href="<?= FULL_BASE_URL . $this->webroot ?>admin/Users/dashboard" aria-expanded="false"><i class="mdi mdi-gauge text-primary"></i><span class="hide-menu">Dashboard</span></a>
                    </li>
                    <li <?=
                    ($this->request->params['action'] == 'admin_listUser')  ? "class='active'" : ''
                    ?>> 
                         <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-users text-primary"></i><span class="hide-menu">Users</span>
                         </a>
                          <ul aria-expanded="false" class="collapse">
                            <li <?= ($this->request->params['action'] == 'admin_listUser') ? "class = 'active'" : '' ?>>
                              <?= $this->Html->link('' . __('List App User') . '', array('controller' => 'users', 'action' => 'listUser', 'admin' => true), array('escape' => false));
                              ?> 
                            </li>
                          </ul>
                    </li> 

                    <li <?=
                    ($this->request->params['action'] == 'admin_addUser') || ($this->request->params['action'] == 'admin_editProvider') || ($this->request->params['action'] == 'admin_listProvider') ? "class='active'" : ''
                    ?>> 
                         <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-user text-primary"></i><span class="hide-menu">Provider</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li <?= ($this->request->params['action'] == 'admin_addUser') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('Add Provider') . '', array('controller' => 'users', 'action' => 'addUser', 'admin' => true), array('escape' => false));
                                ?> 
                                </li>
                                
                                <li <?= ($this->request->params['action'] == 'admin_listProvider') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('List Provider') . '', array('controller' => 'users', 'action' => 'listProvider', 'admin' => true), array('escape' => false));
                                ?> </li>
                            </ul>
                    </li> 
                         <li <?=
                    ($this->request->params['action'] == 'admin_addKeyword') || ($this->request->params['action'] == 'admin_editKeyword') || ($this->request->params['action'] == 'admin_listKeyword') ? "class='active'" : ''
                    ?>> 
                         <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-key text-primary"></i><span class="hide-menu">Keywords</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li <?= ($this->request->params['action'] == 'admin_addKeyword') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('Add Keyword') . '', array('controller' => 'keywords', 'action' => 'addKeyword', 'admin' => true), array('escape' => false));
                                ?> </li>
                                
                                <li <?= ($this->request->params['action'] == 'admin_listKeyword') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('List Keyword') . '', array('controller' => 'keywords', 'action' => 'listKeyword', 'admin' => true), array('escape' => false));
                                ?> </li>
                            </ul>
                        </li>

                    <li <?=
                    ($this->request->params['action'] == 'admin_addCategory') || ($this->request->params['action'] == 'admin_editCategory') || ($this->request->params['action'] == 'admin_listCategory') || ($this->request->params['action'] == 'admin_listSubcategory') || ($this->request->params['action'] == 'admin_addSubcategory') || ($this->request->params['action'] == 'admin_editSubcategory')|| ($this->request->params['action'] == 'admin_viewSubcategory')|| ($this->request->params['action'] == 'admin_viewCategory')  ? "class='active'" : ''
                    ?>> 
                         <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye text-info"></i><span class="hide-menu">Category </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li <?= ($this->request->params['action'] == 'admin_addCategory') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('Add Category') . '', array('controller' => 'categories', 'action' => 'addCategory', 'admin' => true), array('escape' => false));
                                ?>
                                </li>
                                <li <?= ($this->request->params['action'] == 'admin_addSubcategory') ? "class = 'active'" : '' ?>> <?= $this->Html->link('' . __('Add Subcategory') . '', array('controller' => 'subcategories', 'action' => 'addSubcategory', 'admin' => true), array('escape' => false));
                                ?>
                                </li>
                                <li <?= ($this->request->params['action'] == 'admin_listCategory') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('List Category') . '', array('controller' => 'categories', 'action' => 'listCategory', 'admin' => true), array('escape' => false));
                                ?>

                                </li>
                               
                            </ul>
                      </li>
                  
                       <li <?=
                    ($this->request->params['action'] == 'admin_addService') || ($this->request->params['action'] == 'admin_editService') || ($this->request->params['action'] == 'admin_listService') ? "class='active'" : ''
                    ?>> 
                         <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-arrange-send-backward text-primary"></i><span class="hide-menu">Services</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li <?= ($this->request->params['action'] == 'admin_addService') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('Add Service') . '', array('controller' => 'services', 'action' => 'addService', 'admin' => true), array('escape' => false));
                                ?> </li>
                                
                                <li <?= ($this->request->params['action'] == 'admin_listService') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('List Service') . '', array('controller' => 'services', 'action' => 'listService', 'admin' => true), array('escape' => false));
                                ?> </li>
                            </ul>
                        </li>
                          <li <?=
                    ($this->request->params['action'] == 'admin_addOffice') || ($this->request->params['action'] == 'admin_editOffice') || ($this->request->params['action'] == 'admin_listOffice') ? "class='active'" : ''
                    ?>> 
                         <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-building text-primary"></i><span class="hide-menu">Office</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li <?= ($this->request->params['action'] == 'admin_addOffice') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('Add Office') . '', array('controller' => 'offices', 'action' => 'addOffice', 'admin' => true), array('escape' => false));
                                ?> </li>
                                
                                <li <?= ($this->request->params['action'] == 'admin_listOffice') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('List Office') . '', array('controller' => 'offices', 'action' => 'listOffice', 'admin' => true), array('escape' => false));
                                ?> </li>
                            </ul>
                        </li>
                        <li <?=
                    ($this->request->params['action'] == 'admin_addShop') || ($this->request->params['action'] == 'admin_editShop') || ($this->request->params['action'] == 'admin_listShop') ? "class='active'" : ''
                    ?>> 
                         <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-bank text-primary"></i><span class="hide-menu">Shop</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li <?= ($this->request->params['action'] == 'admin_addShop') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('Add Shop') . '', array('controller' => 'shops', 'action' => 'addShop', 'admin' => true), array('escape' => false));
                                ?> </li>
                                
                                <li <?= ($this->request->params['action'] == 'admin_listShop') ? "class = 'active'" : '' ?>>
                                <?= $this->Html->link('' . __('List Shop') . '', array('controller' => 'shops', 'action' => 'listShop', 'admin' => true), array('escape' => false));
                                ?> </li>
                            </ul>
                        </li>
                       
                    </ul>
                </nav>
               
            </div>
            
<style>
.sidebar-nav > ul > li.dash > a.active{
background:transparent;
}
</style>