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
class CategoriesController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $layout = 'admin';
    public $components = array('Paginator');

    public function admin_listCategory() {
        $cond = array();
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(Category.name_en) like' => '%'. $capital_search .'%',
                'Category.name_ar like' => '%'. $this->passedArgs['text'] .'%',
                'Category.name_ku like' => '%'. $this->passedArgs['text'] .'%',
            );
            $text = $this->passedArgs['text'];
        }

        $categories = $this->paginate = array(
            'conditions' => $cond,
            'order' => 'Category.id DESC',
            'limit' =>20,
        );

        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $categories = $this->paginate('Category');
            $this->set(compact('categories', 'text'));
            $this->render('/Elements/list_categories');
        }

        $categories = $this->paginate('Category');
       
        $this->set(compact('categories', 'text'));
        $this->set('layoutTitle', __('List Category'));
    }

    public function admin_addCategory() {
        if ($this->request->is('post')) {
            if (isset($this->request->data['Category']['image']) && $this->request->data['Category']['image']['name'] !== '' && !empty($this->request->data['Category']['image']['name'])) {
                $name = $this->request->data['Category']['image'];
                if ($name['size'] >= 2000000) {
                    $this->Session->setFlash('Photo size must be less tha 2MB', 'default', array(), 'error');
                    goto a;
                }

                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '_' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($ext, $arr_ext)) {
                    $path = 'img/category/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['Category']['image'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } else {
                    $this->Session->setFlash('Please only upload images (gif, png, jpg, jpeg)', 'default', array(), 'error');
                    goto a;
                }
            } else {
                $this->request->data['Category']['image'] = '';
            }
            //pr($this->request->data); exit;

            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Category has been added successfully'), 'default', array(), 'success');
                $this->redirect(array('controller' => 'categories', 'action' => 'listCategory', 'admin' => true));
            } else {
                $this->Session->setFlash('Error in saving, remove following error occured. (gif, png, jpg, jpeg)', 'default', array(), 'error');
            }
        }
        a:
        $this->set('layoutTitle', 'Add Category');
    }

    public function admin_editCategory($id = null, $action = null){
         //pr($this->request->data); exit;
         $categories = $this->Category->find('list');
           if (!$id || !$action) {
            $this->Session->setFlash(__('Please provide a Category id'), 'default', array(), 'error');

            $this->redirect(array("controller" => "categories",
                "action" => $action,
                "page" => $this->passedArgs['page']));
        }
        $category = $this->Category->findById($id);
      //  pr($category); exit;
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Category->id = $id;
            if (isset($this->request->data['Category']['image']) && $this->request->data['Category']['image']['name'] !== '' && !empty($this->request->data['Category']['image']['name'])) {
                $name = $this->request->data['Category']['image'];
                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '-' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('png', 'jpeg', 'jpg');
                if (in_array($ext, $arr_ext)) {
                    $path = 'img/category/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['Category']['image'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } else {
                    $this->Session->setFlash(__('Please only upload images (gif, png, jpg, jpeg)'), 'default', array(), 'error');
                    $this->redirect(array("controller" => "categories",
                        "action" => $action,
                        "page" => $this->passedArgs['page']));

                    goto a;
                }
            } else {
                $old_img = $this->request->data['Category']['old_image'];
                $this->request->data['Category']['image'] = $old_img;
            }



            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Category has been updated successfully'), 'default', array(), 'success');
                $this->redirect(array("controller" => "categories",
                    "action" => $action,
                    "page" => $this->passedArgs['page']));
                } 
                else
                {
                $errorArray = "<ul>";
                foreach ($this->Category->validationErrors as $error) {
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
            $this->request->data = $category;
        }
        a:
        $this->set(compact('category'));
        $this->set('layoutTitle', __('Edit Category'));
   
    }

      public function admin_viewCategory($id = null) {
        if (!$id) {
            $this->Session->setFlash('Record not found', 'default', array(), 'error');
            return $this->redirect($this->referer());
        }
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            $this->Session->setFlash('Subcategory does not exist', 'default', array(), 'error');
            return $this->redirect($this->referer());
        }
       

        $subcategories_list = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $id)));
      
        // pr($subcategories); exit;
       

       $this->set(compact('subcategories_list','text','category_data'));
     $this->set('layoutTitle', 'Subcategory detail');
    }

    public function admin_deleteCategory() {
      //pr($_REQUEST['id']);die;
        $cond = array();
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(Category.name_en) like' => '%'. $capital_search .'%',
                'Category.name_ar like' => '%'. $this->passedArgs['text'] .'%',
                'Category.name_ku like' => '%'. $this->passedArgs['text'] .'%',
            );
            $text = $this->passedArgs['text'];
        }
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $id = $_REQUEST['id'];
            
            $this->Category->delete($id);
             $categories = $this->paginate = array(
            'conditions' => $cond,
            'order' => 'Category.id DESC',
            'limit' => 20,
             
        );
            $categories = $this->paginate('Category');
            $this->set(compact('categories', 'text'));
            $this->render('/Elements/list_categories');
        }
       
        
    }

}
