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
class  OfficesController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('User', 'Order', 'OrderItem', 'Product', 'Category', 'Discloser', 'Term', 'Welcome', 'About', 'Privacy','Service');
    public $layout = 'admin';
    public $components = array('Paginator');

    
 public function admin_addOffice(){
    if($this->request->is('post')){
        //pr($this->request->data); exit;
  if ($this->Office->save($this->request->data)) 
    {
        $this->Session->setFlash(__('office has been added successfully'), 'default', array(), 'success');
        $this->redirect(array('action' => 'listOffice'));

    } 
    else 
    {
        $errorArray = "<ul>";
        foreach ($this->Office->validationErrors as $error) {
        $errorArray .= "<li>";
        $errorArray .= $error[0];
        $errorArray .= "</li>";
        } $errorArray .= "</ul>";
        $this->Session->setFlash(__($error[0]), 'default', array(), 'error');
    }

    }
    a:
      $this->set('layoutTitle',__('Add Office'));
   }

    public function admin_editOffice($id = null, $action = null){
         if (!$id || !$action) {
            $this->Session->setFlash(__('Please provide a office id'), 'default', array(), 'error');
            $this->redirect(array("controller" => "offices",
                "action" => $action,
                "page" => $this->passedArgs['page']));
        }
        $offices = $this->Office->findById($id);
         //pr($category); exit;
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Office->id = $id;
            if ($this->Office->save($this->request->data)) {
                $this->Session->setFlash(__('Office has been updated successfully'), 'default', array(), 'success');
                $this->redirect(array("controller" => "offices",
                    "action" => $action,
                    "page" => $this->passedArgs['page']));
                } 
                else
                {
                    $errorArray = "<ul>";
                    foreach ($this->Office->validationErrors as $error) {
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
            $this->request->data = $offices;
        }
        a:
        $this->set(compact('offices'));
        $this->set('layoutTitle', __('Edit Office'));

    }

    public function admin_listOffice(){
     $cond = array();
       
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(Office.location_en) like' => '%' . $capital_search . '%',
                'LOWER(Office.location_ar) like' => '%' . $capital_search . '%',
                'LOWER(Office.location_ku) like' => '%' . $capital_search . '%',
            );
            $text = $this->passedArgs['text'];
        }
        $offices = $this->paginate = array(
            'conditions' => $cond,
            'limit' => 10,
            'order' => 'Office.id DESC',
        );
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $offices = $this->paginate('Office');
            $this->set(compact('offices', 'text'));
            $this->render('/Elements/list_offices');
        }

        $offices = $this->paginate('Office');
        $this->set(compact('offices', 'text'));
        $this->set('layoutTitle', __('Office list'));

    }

     public function admin_viewOffice($id = null) {
        if (!$id) {
            $this->Session->setFlash('office not found', 'default', array(), 'error');
            return $this->redirect($this->referer());
        }
        $this->Office->id = $id;
        if (!$this->Office->exists()) {
            $this->Session->setFlash('Office does not exist', 'default', array(), 'error');
            return $this->redirect($this->referer());
        }
       

        $offices = $this->Office->find('first', array('conditions' => array('Office.id' => $id)));
      
        // pr($subcategories); exit;
       

       $this->set(compact('offices'));
     $this->set('layoutTitle', 'Office detail');
    }


  

    public function admin_deleteOffice() {
        $cond = array();
         // $cond['User.userType'] = '2';
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(Office.location_en) like' => '%' . $capital_search . '%',
                'LOWER(Office.location_ar) like' => '%' . $capital_search . '%',
                'LOWER(Office.location_ku) like' => '%' . $capital_search . '%',
            );
            $text = $this->passedArgs['text'];
        }
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $id = $_REQUEST['id'];
            $this->Office->delete($id);
          
            $offices = $this->paginate = array(
                'conditions' => $cond,
                'order' => 'Office.id DESC',
                'limit' => 10,
            );
            $offices = $this->paginate('Office');
            $this->set(compact('offices', 'text'));
            $this->render('/Elements/list_offices');
        }
    }


 
 

 

}


