<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('User', 'Order', 'OrderItem', 'Product', 'Category', 'Discloser', 'Term', 'Welcome', 'About', 'Privacy');
    public $layout = 'admin';
    public $components = array('Paginator');

    public function admin_login() {
        $this->layout = 'login';
        if ($this->Session->check('Auth.User')) {
            return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
             return $this->redirect($this->Auth->redirectUrl());
            } 
            else
            {
                  $this->Session->setFlash(__('Invalid username and password'), 'default', array(), 'error');
                // $this->Session->setFlash(' <a href="#" class="close" data-dismiss="alert">&times;</a><span>' . __('Invalid username or password') . '</span>', 'default', array('class' => 'alert  alert-danger'));
            }
        }
        $this->set('layoutTitle', __('Login Form'));
    }

    public function admin_logout() {
        // $this->Session->setFlash('<a href="#" class="close" data-dismiss="alert">&times;</a><span>' . __('You are now logged out') . '</span>', 'default', array('class' => 'alert  alert-danger'));
        $this->Session->setFlash(__('You are now log out'), 'default', array(), 'error');
        return $this->redirect($this->Auth->logout());
    }

    public function admin_myProfile(){

     if ($this->request->is('post')) {
        
        if (isset($this->request->data['User']['image']) && $this->request->data['User']['image']['name'] !== '' && !empty($this->request->data['User']['image']['name'])) {
                $name = $this->request->data['User']['image'];

                if ($name['size'] >= 2000000) {
                $this->Session->setFlash(__('Photo size must be less then 2MB'), 'default', array(), 'error'); 
                goto a;

                }

                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '_' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'png');

                if (in_array($ext, $arr_ext)) {

                    $path = 'img/users/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['User']['image'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } 
                else 
                {
                     $this->Session->setFlash(__('Please only upload images ( png, jpg, jpeg) for profile image'), 'default', array(), 'error');
                    goto a;
                }
            } else {
                $this->request->data['User']['image'] = $this->request->data['User']['oldImage'];
            }
            if (isset($this->request->data['User']['background_image']) && $this->request->data['User']['background_image']['name'] !== '' && !empty($this->request->data['User']['background_image']['name'])) {
                $name = $this->request->data['User']['background_image'];

                if ($name['size'] >= 2000000) {
                $this->Session->setFlash(__('Photo size must be less then 2MB'), 'default', array(), 'error'); 
                goto a;

                }

                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '_' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'png');

                if (in_array($ext, $arr_ext)) {

                    $path = 'img/users/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['User']['background_image'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } 
                else 
                {
                     $this->Session->setFlash(__('Please only upload images ( png, jpg, jpeg) for profile image'), 'default', array(), 'error');
                    goto a;
                }
            } 
            else 
            {
                $this->request->data['User']['background_image'] = $this->request->data['User']['oldbackground'];
            }

            if (isset($this->request->data['User']['fav_icon']) && $this->request->data['User']['fav_icon']['name'] !== '' && !empty($this->request->data['User']['fav_icon']['name'])) {
                $name = $this->request->data['User']['fav_icon'];

                if ($name['size'] >= 2000000) {
                $this->Session->setFlash(__('Photo size must be less then 2MB'), 'default', array(), 'error'); 
                goto a;
                }

                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '_' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('ico');

                if (in_array($ext, $arr_ext)) {

                    $path = 'img/favicon/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['User']['fav_icon'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } 
                else 
                {
                     $this->Session->setFlash(__('Please only upload images ( png, jpg, jpeg) for profile image'), 'default', array(), 'error');
                    goto a;
                }
            } else {
                $this->request->data['User']['fav_icon'] = $this->request->data['User']['oldFav'];
            }

            $this->User->id = $this->Auth->user('id');
            $this->request->data['User']['id'] = $this->Auth->user('id');
            if ($this->User->save($this->request->data)) 
            {
                $custom_setting = $this->Custom->find('first');
                $arrayName = array('fav_icon' =>$this->request->data['User']['fav_icon'] ,'background_image'=>$this->request->data['User']['background_image'],'logo'=>$this->request->data['User']['image'] );
                if(!empty($custom_setting)){
                     $this->Custom->id = $custom_setting['Custom']['id'];
                }
                else
                {
                     $this->Custom->create();

                }
             if ($this->Custom->save($arrayName)) 
            {
                $this->Session->setFlash(__('The option has been save successfully'), 'default', array(), 'success');
               $this->redirect(Router::url($this->referer(), true));

            }

         }else{

                $this->Session->setFlash(__("The User can not updated error occured."), 'default', array(), 'error');
          
            }

     
    }
    else
    {
        $errorArray = "<ul>";
            foreach ($this->User->validationErrors as $error) {
            $errorArray .= "<li>";
            $errorArray .= $error[0];
            $errorArray .= "</li>";
            }
        $errorArray .= "</ul>";
    }
    a:

    }

   public function admin_addUser(){
     if($this->request->is('post')){
    if (isset($this->request->data['User']['image']) && $this->request->data['User']['image']['name'] !== '' && !empty($this->request->data['User']['image']['name'])) {
        $name = $this->request->data['User']['image'];
        if ($name['size'] >= 2000000) {
        $this->Session->setFlash('Photo size must be less tha 2MB', 'default', array(), 'error');
        goto a;
        }

        $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
        $filename = time() . '_' . $file;
        $ext = substr(strtolower(strrchr($file, '.')), 1);
        $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
        if (in_array($ext, $arr_ext)) {
        $path = 'img/basic/';
        if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
        $this->request->data['User']['image'] = $path . $filename;
        $multi_image[] = $filename;
        }
        } else {
        $this->Session->setFlash('Please only upload images (gif, png, jpg, jpeg)', 'default', array(), 'error');
        goto a;
        }
    } 
    else 
    {
    $this->request->data['User']['image'] = '';
    }

    $this->request->data['User']['userType'] = 2;
    $this->request->data['User']['status'] = 1;
    if ($this->User->save($this->request->data)) 
        {
        $this->Session->setFlash(__('The provider has been added successfully'), 'default', array(), 'success');
        $this->redirect(array('action' => 'listProvider'));

        } 
        else 
        {
        $errorArray = "<ul>";
        foreach ($this->User->validationErrors as $error) {
        $errorArray .= "<li>";
        $errorArray .= $error[0];
        $errorArray .= "</li>";
        } $errorArray .= "</ul>";
        $this->Session->setFlash(__($error[0]), 'default', array(), 'error');
        }

    }
    a:
    $this->set('layoutTitle',__('Add Provider'));
  }

    public function admin_editProvider($id = null, $action = null){
         if (!$id || !$action) {
            $this->Session->setFlash(__('Please provide a provider id'), 'default', array(), 'error');
            $this->redirect(array("controller" => "users",
                "action" => $action,
                "page" => $this->passedArgs['page']));
        }
        $users = $this->User->findById($id);
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->User->id = $id;
            if (isset($this->request->data['User']['image']) && $this->request->data['User']['image']['name'] !== '' && !empty($this->request->data['User']['image']['name'])) {
                $name = $this->request->data['User']['image'];
                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '-' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('png', 'jpeg', 'jpg');
                if (in_array($ext, $arr_ext)) {
                    $path = 'img/basic/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['User']['image'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } else {
                    $this->Session->setFlash(__('Please only upload images (gif, png, jpg, jpeg)'), 'default', array(), 'error');
                    $this->redirect(array("controller" => "users",
                        "action" => $action,
                        "page" => $this->passedArgs['page']));

                    goto a;
                }
            } else {
                if(!empty($this->request->data['User']['old_image'])){
                     $old_img = $this->request->data['User']['old_image'];
                }else{
                     $old_img = '';
                }
               
                $this->request->data['User']['image'] = $old_img;
            }

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Provider has been updated successfully'), 'default', array(), 'success');
                $this->redirect(array("controller" => "users",
                    "action" => $action,
                    "page" => $this->passedArgs['page']));
                } 
                else
                {
                $errorArray = "<ul>";
                foreach ($this->User->validationErrors as $error) {
                    $errorArray .= "<li>";
                    $errorArray .= $error[0];
                    $errorArray .= "</li>";
                }
                $errorArray .= "</ul>";
                $this->Session->setFlash(__($error[0]), 'default', array(), 'error');
                //return $this->redirect($this->referer());
            }
        }

        if (!$this->request->data) {
            $this->request->data = $users;
        }
        a:
        $this->set(compact('users'));
        $this->set('layoutTitle', __('Edit Provider'));

    }

     public function admin_listUser(){
     $cond = array();
        $cond['User.userType'] = '1';
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(User.email) like' => '%' . $capital_search . '%',
                'LOWER(User.name) like' => '%' . $capital_search . '%',
                'User.phone like' => '%' . $this->passedArgs['text']. '%',
            );
            $text = $this->passedArgs['text'];
        }
        $users = $this->paginate = array(
            'conditions' => $cond,
            'limit' => 10,
            'order' => 'User.id DESC',
        );
 
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $users = $this->paginate('User');
            $this->set(compact('users', 'text'));
            $this->render('/Elements/list_users');
        }

        $users = $this->paginate('User');
        $this->set(compact('users', 'text'));
        $this->set('layoutTitle', __('App User list'));

    }

    public function admin_listProvider(){
     $cond = array();
        $cond['User.userType'] = '2';

        if (!empty($this->passedArgs['text'])) {
              $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(User.email) like' => '%' . $capital_search . '%',
                'LOWER(User.name) like' => '%' . $capital_search . '%',
                'User.phone like' => '%' . $this->passedArgs['text'] . '%',
            );
            $text = $this->passedArgs['text'];
        }
        $users = $this->paginate = array(
            'conditions' => $cond,
            'limit' => 10,
            'order' => 'User.id DESC',
        );
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $users = $this->paginate('User');
            $this->set(compact('users', 'text'));
            $this->render('/Elements/list_provider');
        }
        $users = $this->paginate('User');
        $this->set(compact('users', 'text'));
        $this->set('layoutTitle', __('Providers list'));

    }

       public function admin_changeproviderStatus() {
        $id = $_REQUEST['id'];
        $status = $_REQUEST['sts'];
        $this->User->id = $id;
        $data['User']['status'] = $status;
        $this->User->id = $id;
        $cond = array();
        $cond['User.userType'] = '2';
        if (!empty($this->passedArgs['text'])) {
            $cond['or'] = array(
                'User.email like' => '%' . $this->passedArgs['text'] . '%',
                'User.name like' => '%' . $this->passedArgs['text'] . '%',
                'User.phone like' => '%' . $this->passedArgs['text'] . '%',
            );
            $text = $this->passedArgs['text'];
        }
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
          
            $this->User->save($data);
            $users = $this->paginate = array(
                'conditions' => $cond,
                'limit' => 10,
                'order' => 'User.id DESC',
            );
            $users = $this->paginate('User');
            $this->set(compact('users', 'text'));
            $this->render('/Elements/list_provider');
        }
    }
     public function admin_changeUserstatus() {
        $id = $_REQUEST['id'];
        $status = $_REQUEST['sts'];
        $this->User->id = $id;
        $data['User']['status'] = $status;
        $this->User->id = $id;
        $cond = array();
        $cond['User.userType'] = '1';
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(User.email) like' => '%' . $capital_search . '%',
                'LOWER(User.name) like' => '%' . $capital_search . '%',
                'User.phone like' => '%' . $this->passedArgs['text']. '%',
            );
            $text = $this->passedArgs['text'];
        }
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
          
            $this->User->save($data);
            $users = $this->paginate = array(
                'conditions' => $cond,
                'limit' => 10,
                'order' => 'User.id DESC',
            );
            $users = $this->paginate('User');
            $this->set(compact('users', 'text'));
            $this->render('/Elements/list_users');
        }
    }

     public function admin_viewProvider($id = null,$action = null) {
        if (!$id) {
            $this->Session->setFlash('Record not found', 'default', array(), 'error');
            return $this->redirect($this->referer());
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('User does not exist', 'default', array(), 'error');
            return $this->redirect($this->referer());
        }
        $users = $this->User->find('first', array('conditions' => array('User.id' => $id)));
        $this->set(compact('users', 'text'));
        echo $this->set('layoutTitle', 'Provider detail');
    }

    public function admin_deleteProvider() {
        $cond = array();
         // $cond['User.userType'] = '2';
        if (!empty($this->passedArgs['text'])) {
            $cond['or'] = array(
                'User.email like' => '%' . $this->passedArgs['text'] . '%',
                'User.name like' => '%' . $this->passedArgs['text'] . '%',
                'User.phone like' => '%' . $this->passedArgs['text'] . '%',
            );
            $text = $this->passedArgs['text'];
        }
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $id = $_REQUEST['id'];
            $this->User->delete($id);
            $cond['User.userType '] = '2';
            $users = $this->paginate = array(
                'conditions' => $cond,
                'order' => 'User.id DESC',
                'limit' => 10,
            );
            $users = $this->paginate('User');
            $this->set(compact('users', 'text'));
            $this->render('/Elements/list_provider');
        }
    }
    public function admin_deleteUser() {
        $cond = array();
         // $cond['User.userType'] = '2';
       if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(User.email) like' => '%' . $capital_search . '%',
                'LOWER(User.name) like' => '%' . $capital_search . '%',
                'User.phone like' => '%' . $this->passedArgs['text']. '%',
            );
            $text = $this->passedArgs['text'];
        }
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $id = $_REQUEST['id'];
            $this->User->delete($id);
            $cond['User.userType '] = '1';
            $users = $this->paginate = array(
                'conditions' => $cond,
                'order' => 'User.id DESC',
                'limit' => 10,
            );
            $users = $this->paginate('User');
            $this->set(compact('users', 'text'));
            $this->render('/Elements/list_users');
        }
    }

  public function admin_setting(){  
          if ($this->request->is('post')) {
          if (isset($this->request->data['Setting']['sandbox_pem_file']) && $this->request->data['Setting']['sandbox_pem_file']['name'] !== '' && !empty($this->request->data['Setting']['sandbox_pem_file']['name'])) {
                $name = $this->request->data['Setting']['sandbox_pem_file'];


                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '_' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                
                $arr_ext = array('pem');

                if (in_array($ext, $arr_ext)) {

                    $path = 'files/sandboxpem/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['Setting']['sandbox_pem_file'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } 
                else 
                {
                     $this->Session->setFlash(__('Please only upload pem file'), 'default', array(), 'error');
                    goto a;
                }
            } else {
                if(!empty($this->request->data['Setting']['oldsandbox'])){
                    $this->request->data['Setting']['sandbox_pem_file'] = $this->request->data['Setting']['oldsandbox'];
                }
                else{
                    $this->request->data['Setting']['sandbox_pem_file'] = '';
                }
            }

             if (isset($this->request->data['Setting']['live_pem_file']) && $this->request->data['Setting']['live_pem_file']['name'] !== '' && !empty($this->request->data['Setting']['live_pem_file']['name'])) {
                $name = $this->request->data['Setting']['live_pem_file'];


                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '_' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
               
                $arr_ext = array('pem');

                if (in_array($ext, $arr_ext)) {

                    $path = 'files/livepem/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['Setting']['live_pem_file'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } 
                else 
                {
                     $this->Session->setFlash(__('Please only upload pem file'), 'default', array(), 'error');
                     goto a;
                }
            } else {
                if(!empty($this->request->data['Setting']['oldlive'])){
                     $this->request->data['Setting']['live_pem_file'] = $this->request->data['Setting']['oldlive'];
                }
                else{
                     $this->request->data['Setting']['live_pem_file'] = '';
                }
               
            }

            $this->request->data['Setting']['enable'] = (isset($this->request->data['Setting']['enable']) == 'on' ? '1' : '0');

            $this->request->data['Setting']['user_id'] = $this->Auth->user('id');

             $setRec = $this->Setting->find('first');
              if (!empty($setRec)) {
                $this->Setting->id = $setRec['Setting']['id'];
            } else{

                $this->Setting->create();
            }

   if ($this->Setting->save($this->request->data)) 
            {
                $this->Session->setFlash(__('The notification setting has been save successfully'), 'default', array(), 'success');
               $this->redirect(Router::url($this->referer(), true));
            }
            else
            {
             $this->Session->setFlash(__("The notification setting can not updated error occured."), 'default', array(), 'error');
          
            }
            
        }
        else
        {
            $errorArray = "<ul>";
            foreach ($this->Setting->validationErrors as $error) {
            $errorArray .= "<li>";
            $errorArray .= $error[0];
            $errorArray .= "</li>";
            }
            $errorArray .= "</ul>";

        }

        a:

    }
    
    public function admin_dashboard(){
        $category = $this->Category->find('count');
        $subcategory = $this->Subcategory->find('count');
        $shop = $this->Shop->find('count');
        $user_data = $this->User->find('all', array('conditions'=>array('User.userType !='=>'3')));
      $users = count($user_data);
      
        $this->set(compact('category','subcategory','shop','users'));
    }

    public function admin_changePassword($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please provide a user id'), 'default', array(), 'error');
            $this->redirect(array('action' => 'dashboard'));
        }

        //$user = $this->User->findById($id);
        $user = $this->User->find('first', array('conditions' => array('User.id'=>$id)));
        if (!$user) {
            $this->Session->setFlash(__('Invalid user id provided'), 'default', array(), 'error');
            $this->redirect(array('action' => 'dashboard'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $old_pass = $this->request->data['User']['old_password'];
            $pass=Security::hash($old_pass, 'md5', true);
            $userData = $this->User->find('first',array('conditions'=>array('User.id'=>$id,'User.password'=>$pass)));
            if(!$userData){
                 $this->Session->setFlash('Old password is not valid', 'default', array(), 'error');
                 return $this->redirect($this->referer());
            }

            //pr($userData); exit;
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                if($this->Auth->user('userType') == '1') {
                    $this->Session->setFlash(__('Your password has been changed successfully'), 'default', array(),'success');
                    return $this->redirect($this->referer());
                }
                else{
                    $this->Session->setFlash(__('Your password has been changed successfully'), 'default', array(),'success');
                    $this->redirect(array('action' => 'dashboard'));

                }
                

            } else {
                $errorArray = "<ul>";
                foreach ($this->User->validationErrors as $error) {
                    $errorArray .= "<li>";
                    $errorArray .= $error[0];
                    $errorArray .= "</li>";
                }
                $errorArray .= "</ul>";
                $this->Session->setFlash(__($error[0]), 'default', array(), 'error');
                return $this->redirect($this->referer());
   
            }
        }
        
        a:
        if (!$this->request->data) {
            $this->request->data = $user;
        }
        $this->set('layoutTitle', __('Change Password'));
    }




    public function api_changePassword() {
        //http://webmantechnologies.com/himanshu/alamal/api/users/changePassword?ID&password
        $user = $this->User->findById($_REQUEST['ID']);
        if (!empty($user)) {
            $this->User->id = $_REQUEST['ID'];
            $this->request->data['User']['password'] = $_REQUEST['password'];
            $user = $this->User->save($this->request->data);
            if ($user) {
                $results = array('mesg' => 'Password updated successfully', 'responce' => '1');
            } else {
                foreach ($this->User->validationErrors as $error) {
                    $results = array('mesg' => __($error[0]), 'responce' => '0');
                }
            }
        }
        else 
        {
            $results = array('mesg' => 'User not exsists', 'responce' => '0');
        }
        echo json_encode($results);
        exit;
    }
      public function admin_forgotAccount() {
        $this->layout = 'login';
        if (!empty($_REQUEST['forgot'])) {
            $id = base64_decode($_REQUEST['forgot']);
        } else {
            $id = '';
        }
        if (!empty($_REQUEST['forgotid'])) {
            $aId = $_REQUEST['forgotid'];
        } else {
            $aId = '';
        }
        if (!$this->request->is('post')) {
            $user = $this->User->find('all', array('conditions' => array('User.id' => $id, 'User.forgot_key' => $aId)));
            if (!$user) {
                $this->redirect(array('action' => 'redirection', 'admin' => true, '?' => array('msg' => 'Link may be expired.'
                                )));
             
            }
        }
        if ($this->request->is('post')) {
            if (empty($this->request->params['pass'][0]) || empty($this->request->params['pass'][0])) {
                $this->redirect(array('action' => 'redirection', 'admin' => true, '?' => array('msg' => 'Link may be expired.'
                                )));
                
            } else {
                $user = $this->User->find('all', array('conditions' => array('User.ID' => base64_decode($this->request->params['pass'][0]))));
                if ($user) {
                    if (count($user) > 0) {
                        $this->request->data['User']['password'] = $this->request->data['User']['password'];
                        $this->request->data['User']['forgot_key'] = '';
                        $this->User->id = $user[0]['User']['id'];

                        if ($this->User->validates()) {
                            if ($this->User->save($this->request->data)) {
                               $this->redirect(array('action' => 'redirection', 'admin' => true, '?' => array('msg' => 'Your password has been reset successfully'
                                )));
                             
                            } else {
                                $errorArray = "<ul>";
                                foreach ($this->User->validationErrors as $error) {
                                    $errorArray .= "<li>";
                                    $errorArray .= $error[0];
                                    $errorArray .= "</li>";
                                }
                                $errorArray .= "</ul>";
                                $this->Session->setFlash("<a href='#' class='close' data-dismiss='alert'>&times;</a><span>" . $error[0] . "</span>", 'default', array('class' => 'alert  alert-danger'));
                                $this->redirect(array('action' => 'forgotAccount', 'main' => true, '?' => array('forgot' => $this->request->params['pass'][0], 'forgotid' => $this->request->params['pass'][1]
                                )));
                            }
                        } else {
                             $this->redirect(array('action' => 'redirection', 'admin' => true, '?' => array('msg' => 'Something went wrong,Contact to admin.'
                                )));
                         
                        }
                    }
                } else {
                      $this->redirect(array('action' => 'redirection', 'admin' => true, '?' => array('msg' => 'Link may be expired.'
                                )));
                  
                }
            }
        }
    }

     public function admin_resetPassword(){
       // pr($this->request->data);
            $email = $this->request->data['email']; 
            if(empty($email)){
                // $this->Session->setFlash('<a href="#" class="close" data-dismiss="alert">&times;</a><span>'.__('Please fill email field in order to forgot password').'</span>','default',array('class'=>'alert  alert-danger'));
                $this->Session->setFlash(__('Please fill email field in order to forgot password'), 'default', array(), 'error');
                            return $this->redirect($this->Auth->logout());
            }
            $user = $this->User->find('first',array('conditions'=>array('User.email'=>$email)));
            //pr( $user); die;
            if(count($user)>0){
                    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                    $key = array(); //remember to declare $pass as an array
                    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                    for ($i = 0; $i < 8; $i++) {
                            $n = rand(0, $alphaLength);
                            $key[] = $alphabet[$n];
                    }
                    $forgotKey = Security::hash(implode($key), 'md5', true);
                    $this->request->data['User']['forgot_key'] = $forgotKey;
                    $this->User->id = $user['User']['id'];
                    if ($this->User->save($this->request->data)){
                    $link = FULL_BASE_URL.$this->base.'/admin/users/forgotAccount?forgot='.urlencode(base64_encode($user['User']['id'])).'&forgotid='.$forgotKey;
                    $project_name = PROJECT_NAME;
                    $to = $_REQUEST['email'];
                    $from = 'localhost@postman';
                    $subject = 'Forget password';
                    $EmailBody = array('email'=>$_REQUEST['email'],'link'=>$link,'project_name'=>$project_name);
                    $emailsend= $this->Basic->sendEmail($to,$from,$subject,$EmailBody,'emailTemplate');
                    // $this->Session->setFlash('<a href="#" class="close" data-dismiss="alert">&times;</a><span>'.__('A link has been sent to your email id, follow that link to reset your password').'</span>','default',array('class'=>'alert  alert-danger'));
                    $this->Session->setFlash(__('A link has been sent to your email id, follow that link to reset your password'), 'default', array(), 'success');

                        return $this->redirect($this->Auth->logout());
                        //  $results = array('mesg'=>"A link has been sent to your email id, follow that link to reset your password",'response'=>'1');
                    } else{
                         $this->Session->setFlash(__('Invalid email account'), 'default', array(), 'error');
                        // $this->Session->setFlash('<a href="#" class="close" data-dismiss="alert">&times;</a><span>'.__('Invalid email account').'</span>','default',array('class'=>'alert  alert-danger'));
                                    return $this->redirect($this->Auth->logout());
                    }
            }
            else{
                // $this->Session->setFlash('<a href="#" class="close" data-dismiss="alert">&times;</a><span>'.__('Invalid email id').'</span>','default',array('class'=>'alert  alert-danger'));
                $this->Session->setFlash(__('Invalid email id'), 'default', array(), 'error');
                            return $this->redirect($this->Auth->logout());
            }
            $this->set('layoutTitle', __('Login Form'));
        }


     public function admin_redirection() {
       // pr($_REQUEST[]); exit;
        $this->layout = 'login';
     //  $this->set(compact('layout_msg',$_REQUEST['msg']));
        $this->set('layout_msg', $_REQUEST['msg']);
    }


 
 

 

}


