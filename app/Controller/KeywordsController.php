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
class KeywordsController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('User', 'Order', 'OrderItem', 'Product', 'Category', 'Discloser', 'Term', 'Welcome', 'About', 'Privacy','Service','Keyword');
    public $layout = 'admin';
    public $components = array('Paginator');

    
public function admin_addKeyword(){

    if($this->request->is('post')){

        $this->Keyword->create();
        if ($this->Keyword->save($this->request->data)) 
        {
            $this->Session->setFlash(__('The Keyword has been added successfully'), 'default', array(), 'success');
            $this->redirect(array('action' => 'listKeyword'));

        } 
        else 
        {
            $errorArray = "<ul>";
            foreach ($this->Keyword->validationErrors as $error) {
                $errorArray .= "<li>";
                $errorArray .= $error[0];
                $errorArray .= "</li>";
            } $errorArray .= "</ul>";
            $this->Session->setFlash(__($error[0]), 'default', array(), 'error');
        }

    }

      $this->set('layoutTitle',__('Add Keyword'));

}

public function admin_editKeyword($id = null, $action = null){
         if (!$id || !$action) {
            $this->Session->setFlash(__('Please provide a keyword id'), 'default', array(), 'error');
            $this->redirect(array("controller" => "keywords",
                "action" => $action,
                "page" => $this->passedArgs['page']));
        }
        $keywords = $this->Keyword->findById($id);
      //  pr($category); exit;
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Keyword->id = $id;
            if ($this->Keyword->save($this->request->data)) {
                $this->Session->setFlash(__('Keyword has been updated successfully'), 'default', array(), 'success');
                $this->redirect(array("controller" => "keywords",
                    "action" => $action,
                    "page" => $this->passedArgs['page']));
                } 
                else
                {
                $errorArray = "<ul>";
                foreach ($this->Keyword->validationErrors as $error) {
                    $errorArray .= "<li>";
                    $errorArray .= $error[0];
                    $errorArray .= "</li>";
                }
                $errorArray .= "</ul>";
                $this->Session->setFlash(__($error[0]), 'default', array(), 'error');
              //  return $this->redirect($this->referer());
            }
        }

        if (!$this->request->data) {
            $this->request->data = $keywords;
        }
        a:
        $this->set(compact('keywords'));
        $this->set('layoutTitle', __('Edit Keyword'));

    }

    public function admin_listKeyword(){
     $cond = array();
       
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(Keyword.name_en) like' => '%' . $capital_search . '%',
                'LOWER(Keyword.name_ar) like' => '%' . $capital_search . '%',
                'LOWER(Keyword.name_ku) like' => '%' . $capital_search . '%',
            );
            $text = $this->passedArgs['text'];
        }
        $keywords = $this->paginate = array(
            'conditions' => $cond,
            'limit' => 10
        );
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $keywords = $this->paginate('Keyword');
            $this->set(compact('keywords', 'text'));
            $this->render('/Elements/list_keywords');
        }

        $keywords = $this->paginate('Keyword');
        $this->set(compact('keywords', 'text'));
        $this->set('layoutTitle', __('Keywords list'));

    }

 
    public function admin_deleteKeyword() {
        $cond = array();
         // $cond['User.userType'] = '2';
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(Keyword.name_en) like' => '%' . $capital_search . '%',
                'LOWER(Keyword.name_ar) like' => '%' . $capital_search . '%',
                'LOWER(Keyword.name_ku) like' => '%' . $capital_search . '%',
            );
            $text = $this->passedArgs['text'];
        }
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $id = $_REQUEST['id'];
            $this->Keyword->delete($id);
          
            $keywords = $this->paginate = array(
                'conditions' => $cond,
                'order' => 'Keyword.id DESC',
                'limit' => 10,
            );
            $keywords = $this->paginate('Keyword');
            $this->set(compact('keywords', 'text'));
            $this->render('/Elements/list_keywords');
        }
    }


 
 

 

}


