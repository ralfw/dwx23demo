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
class ServicesController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('User', 'Order', 'OrderItem', 'Product', 'Category', 'Discloser', 'Term', 'Welcome', 'About', 'Privacy','Service');
    public $layout = 'admin';
    public $components = array('Paginator');

    
 public function admin_addService(){
    if($this->request->is('post')){
          if (isset($this->request->data['Service']['image']) && $this->request->data['Service']['image']['name'] !== '' && !empty($this->request->data['Service']['image']['name'])) {
        $name = $this->request->data['Service']['image'];
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
        $this->request->data['Service']['image'] = $path . $filename;
        $multi_image[] = $filename;
        }
        } else {
        $this->Session->setFlash('Please only upload images (gif, png, jpg, jpeg)', 'default', array(), 'error');
        goto a;
        }
    } 
    else 
    {
    $this->request->data['Service']['image'] = '';
    }


    if ($this->Service->save($this->request->data)) 
    {
        $this->Session->setFlash(__('The service has been added successfully'), 'default', array(), 'success');
        $this->redirect(array('action' => 'listService'));

    } 
    else 
    {
        $errorArray = "<ul>";
        foreach ($this->Service->validationErrors as $error) {
        $errorArray .= "<li>";
        $errorArray .= $error[0];
        $errorArray .= "</li>";
        } $errorArray .= "</ul>";
        $this->Session->setFlash(__($error[0]), 'default', array(), 'error');
    }

    }
    a:
      $this->set('layoutTitle',__('Add Service'));
   }

    public function admin_editService($id = null, $action = null){
         if (!$id || !$action) {
            $this->Session->setFlash(__('Please provide a service id'), 'default', array(), 'error');
            $this->redirect(array("controller" => "services",
                "action" => $action,
                "page" => $this->passedArgs['page']));
        }
        $services = $this->Service->findById($id);
      //  pr($category); exit;
        if ($this->request->is('post') || $this->request->is('put')) {
            if (isset($this->request->data['Service']['image']) && $this->request->data['Service']['image']['name'] !== '' && !empty($this->request->data['Service']['image']['name'])) {
                $name = $this->request->data['Service']['image'];
                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '-' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('png', 'jpeg', 'jpg');
                if (in_array($ext, $arr_ext)) {
                    $path = 'img/basic/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['Service']['image'] = $path . $filename;
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
                $old_img = $this->request->data['Service']['old_image'];
                $this->request->data['Service']['image'] = $old_img;
            }

            $this->Service->id = $id;
            if ($this->Service->save($this->request->data)) {
                $this->Session->setFlash(__('Service has been updated successfully'), 'default', array(), 'success');
                $this->redirect(array("controller" => "services",
                    "action" => $action,
                    "page" => $this->passedArgs['page']));
                } 
                else
                {
                $errorArray = "<ul>";
                foreach ($this->Service->validationErrors as $error) {
                    $errorArray .= "<li>";
                    $errorArray .= $error[0];
                    $errorArray .= "</li>";
                }
                $errorArray .= "</ul>";
                $this->Session->setFlash(__($error[0]), 'default', array(), 'error');
                return $this->redirect($this->referer());
            }
        }

        if (!$this->request->data) {
            $this->request->data = $services;
        }
        a:
        $this->set(compact('services'));
        $this->set('layoutTitle', __('Edit Service'));

    }

    public function admin_listService(){
     $cond = array();
       
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(Service.name_en) like' => '%' . $capital_search . '%',
                'LOWER(Service.name_ar) like' => '%' . $capital_search . '%',
                'LOWER(Service.name_ku) like' => '%' . $capital_search . '%',
            );
            $text = $this->passedArgs['text'];
        }
        $services = $this->paginate = array(
            'conditions' => $cond,
            'limit' => 10,
            'order' => 'Service.id DESC',
        );
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $services = $this->paginate('Service');
            $this->set(compact('services', 'text'));
            $this->render('/Elements/list_services');
        }

        $services = $this->paginate('Service');
        $this->set(compact('services', 'text'));
        $this->set('layoutTitle', __('Services list'));

    }

    public function admin_changeproviderStatus(){
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

    public function admin_deleteService() {
        $cond = array();
         // $cond['User.userType'] = '2';
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(Service.name_en) like' => '%' . $capital_search . '%',
                'LOWER(Service.name_ar) like' => '%' . $capital_search . '%',
                'LOWER(Service.name_ku) like' => '%' . $capital_search . '%',
            );
            $text = $this->passedArgs['text'];
        }
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $id = $_REQUEST['id'];
            $this->Service->delete($id);
          
            $services = $this->paginate = array(
                'conditions' => $cond,
                'order' => 'Service.id DESC',
                'limit' => 10,
            );
            $services = $this->paginate('Service');
            $this->set(compact('services', 'text'));
            $this->render('/Elements/list_services');
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
        $user_data = $this->User->find('all', array('conditions'=>array('User.userType'=>'2')));
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

     public function admin_redirection() {
       // pr($_REQUEST[]); exit;
        $this->layout = 'login';
     //  $this->set(compact('layout_msg',$_REQUEST['msg']));
        $this->set('layout_msg', $_REQUEST['msg']);
    }


 
 

 

}


