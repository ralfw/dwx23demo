<?php

/**
 * Created by PhpStorm.
 * User: win 7
 * Date: 3/4/2016
 * Time: 11:25 AM
 */
App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class SubcategoriesController extends AppController {

    public $layout = 'admin';
    public $uses = array('User');

     public function admin_listSubcategory($id=null) {
        $categories = $this->Category->find('list', array('fields' => array('Category.id', 'Category.name_en')));
        $this->set(compact('categories'));
        $cond = array();
        $cond['category_id'] = $id;
        if (!empty($this->passedArgs['text'])) {
             $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
           
            'LOWER(Subcategory.name_en) like' => '%' . $capital_search . '%',
            'Subcategory.name_ar like' => '%' . $this->passedArgs['text'] . '%',
            'Subcategory.name_ku like' => '%' . $this->passedArgs['text'] . '%',
            // 'Category.name_en like' => '%' . $this->passedArgs['text'] . '%',
            // 'Category.name_ar like' => '%' . $this->passedArgs['text'] . '%',
            // 'Category.name_ku like' => '%' . $this->passedArgs['text'] . '%',
            );
            $text = $this->passedArgs['text'];
        }

        $subcategories = $this->paginate = array(
            'conditions' => $cond,
            'order' => 'Subcategory.id desc',
            'limit' =>20,
        );

        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $subcategories = $this->paginate('Subcategory');
            $this->set(compact('subcategories'));
            $this->render('/Elements/list_subcategories');
        }
        $cat_id = $id; 
        $category_data = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));

        $subcategories = $this->paginate('Subcategory');
        $this->set(compact('subcategories'));
        $this->set(compact('cat_id','category_data'));
       
        $this->set('layoutTitle', __('List Subcategory'));
    }


    public function admin_addSubcategory() {
      $categories = $this->Category->find('list', array('fields' => array('Category.id', 'Category.name_en')));
      
    $keyword_en  = $this->Keyword->find('list', array('fields' => array('Keyword.id', 'Keyword.name_en')));
    // $keyword_ar = $this->Keyword->find('list', array('fields' => array('Keyword.id', 'Keyword.name_ar')));
    // $keyword_ku  = $this->Keyword->find('list', array('fields' => array('Keyword.id', 'Keyword.name_ku')));
      $this->set(compact('categories','keyword_en'));

        if ($this->request->is('post')) {
           if (isset($this->request->data['Subcategory']['image']) && $this->request->data['Subcategory']['image']['name'] !== '' && !empty($this->request->data['Subcategory']['image']['name'])) {
                $name = $this->request->data['Subcategory']['image'];
                if ($name['size'] >= 2000000) {
                    $this->Session->setFlash('Photo size must be less tha 2MB', 'default', array(), 'error');
                    goto a;
                }
                //$file = $name['name'];
                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '_' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($ext, $arr_ext)) {
                //$upload_pathx = FULL_BASE_URL.$this->webroot.'img/categories/';
                    $path = 'img/category/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['Subcategory']['image'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } else {
                    $this->Session->setFlash('Please only upload images (gif, png, jpg, jpeg)', 'default', array(), 'error');
                    goto a;
                }
            } else {
                $this->request->data['Subcategory']['image'] = '';
            }
            $this->Subcategory->create();
           
           $reid =  $this->request->data['Subcategory']['category_id'];
           if(!empty($this->request->data['Subcategory']['keyword'])){
              $word = implode(',', $this->request->data['Subcategory']['keyword']);
              $this->request->data['Subcategory']['keyword'] = $word;
           }
           //pr($this->request->data); exit;

            if ($this->Subcategory->save($this->request->data)) {
            
              $this->Session->setFlash(__('New subcategory is added successfully'), 'default', array(), 'success');
                $this->redirect(array("controller" => "subcategories",
                    "action" => 'listSubcategory',
                    'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                   $reid, 'listSubcategory'));
            } else {
                $errorArray = "<ul>";
                foreach ($this->Subcategory->validationErrors as $error) {
                    $errorArray .= "<li>";
                    $errorArray .= $error[0];
                    $errorArray .= "</li>";
                } $errorArray .= "</ul>";
                $this->Session->setFlash(__($error[0]), 'default', array(), 'error');
            }
        }
        a:
        $this->set('layoutTitle', __('Add Subcategory'));
    }

   
    public function admin_editSubcategory($id = null, $action = null) {
        if (!$id || !$action) {
            $this->Session->setFlash(__('Please provide a Subcategory id'), 'default', array(), 'error');
            $this->redirect(array("controller" => "subcategories",
                "action" => $action,
                "page" => $this->passedArgs['page']));
        }
        $keyword_en  = $this->Keyword->find('list', array('fields' => array('Keyword.id', 'Keyword.name_en')));
        $categories = $this->Category->find('list', array('fields' => array('Category.id', 'Category.name_en')));
        $this->set(compact('keyword_en'));
        $subcategories = $this->Subcategory->findById($id);
        $ky = $subcategories['Subcategory']['keyword'];
        $keyword = explode(',', $ky);
        // $keyword = $this->Keyword->find('list', array('conditions' => array('Keyword.id'=>$ky)));
         $this->set(compact('keyword'));
       
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Subcategory->id = $id;
            if (isset($this->request->data['Subcategory']['image']) && $this->request->data['Subcategory']['image']['name'] !== '' && !empty($this->request->data['Subcategory']['image']['name'])) {
                $name = $this->request->data['Subcategory']['image'];
                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '-' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('png', 'jpeg', 'jpg');
                if (in_array($ext, $arr_ext)) {
                    $path = 'img/category/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['Subcategory']['image'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } else {
                    $this->Session->setFlash(__('Please only upload images (gif, png, jpg, jpeg)'), 'default', array(), 'error');
                    $this->redirect(array("controller" => "subcategories",
                        "action" => $action,
                        "page" => $this->passedArgs['page']));

                    goto a;
                }
            } else {
                $old_img = $this->request->data['Subcategory']['old_image'];
                $this->request->data['Subcategory']['image'] = $old_img;
            }
             if(!empty($this->request->data['Subcategory']['keyword'])){
              $word = implode(',', $this->request->data['Subcategory']['keyword']);
              $this->request->data['Subcategory']['keyword'] = $word;
           }
            $reid = $this->request->data['Subcategory']['category_id'];
//pr($this->request->data); exit;
            if ($this->Subcategory->save($this->request->data)) {
               
                 $lastId = $this->Subcategory->getLastInsertID(); 
                   

                $this->Session->setFlash(__('Subcategory has been updated successfully'), 'default', array(), 'success');
                 $this->redirect(array("controller" => "subcategories",
                    "action" => $action,
                    'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                   $reid, 'listSubcategory'));

            } else {
               $errorArray = "<ul>";
                foreach ($this->Subcategory->validationErrors as $error) {
                    $errorArray .= "<li>";
                    $errorArray .= $error[0];
                    $errorArray .= "</li>";
                } $errorArray .= "</ul>";
                $this->Session->setFlash(__($error[0]), 'default', array(), 'error');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $subcategories;
        }
         a:

        $this->set(compact('subcategories', 'categories'));
        $this->set('layoutTitle', __('Edit Subcategory'));
    }

    public function admin_viewSubcategory($id = null,$action = null) {
        if (!$id) {
            $this->Session->setFlash('Record not found', 'default', array(), 'error');
            return $this->redirect($this->referer());
        }
        $this->Subcategory->id = $id;
        if (!$this->Subcategory->exists()) {
            $this->Session->setFlash('Subcategory does not exist', 'default', array(), 'error');
            return $this->redirect($this->referer());
        }
        $subcategories = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $id)));
         $keywords = $this->Subcategory->find('list', array('conditions' => array('Subcategory.id' => $id),'fields' => array('Subcategory.keyword')));

         $keyw_id = explode(',', $keywords[$id]);
          $keys = array();
         if(!empty($keyw_id)){
            
            for ($i=0; $i < count($keyw_id); $i++) { 
             $value= $this->Keyword->find('first', array('conditions' => array('Keyword.id' => $keyw_id[$i])));
             if(!empty($value)){
                $keys[] = $value['Keyword'];
            }else{
                $keys[] = array();
             
         }
         }
        

         //$keys = $this->Keyword->find('all', array('conditions' => array('Keyword.id' => $keywords[$id])));
            }
        //  pr($keys);
        // exit;

       $this->set(compact('subcategories', 'text','keys'));
     $this->set('layoutTitle', 'Subcategory detail');
    }

    public function admin_deleteSubcategory() {
        $cat_data = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $_REQUEST['id'])));
        $cat_id = $cat_data['Subcategory']['category_id'];
        $cond = array();
        $cond['category_id'] = $cat_data['Subcategory']['category_id'];
        if (!empty($this->passedArgs['text'])) {
            $capital_search = ucfirst($this->passedArgs['text']);
            $cond['or'] = array(
             'Subcategory.name_en like' => '%' . $capital_search . '%',
            'Subcategory.name_ar like' => '%' . $capital_search . '%',
            'Subcategory.name_ku like' => '%' . $capital_search . '%',
            
            // 'Category.name_en like' => '%' . $this->passedArgs['text'] . '%',
            // 'Category.name_ar like' => '%' . $this->passedArgs['text'] . '%',
            // 'Category.name_ku like' => '%' . $this->passedArgs['text'] . '%',
           
            );
            $text = $this->passedArgs['text'];
        }
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $id = $_REQUEST['id'];
            $this->Subcategory->delete($id);
            // $this->Session->setFlash(__('Subcategory has been deleted successfully'), 'default', array(), 'success');
            $subcategories = $this->paginate = array(
                'conditions' => $cond,
                'order' => 'Subcategory.id desc',
                'limit' => 20,
            );
            
            $subcategories = $this->paginate('Subcategory');
            $this->set(compact('subcategories'));
            $this->set(compact('cat_id'));
            $this->render('/Elements/list_subcategories');
        }
    }

}
