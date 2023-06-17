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
class ShopsController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('User', 'Order', 'OrderItem', 'Product', 'Category', 'Discloser', 'Term', 'Welcome', 'About', 'Privacy','ShopService');
    public $layout = 'admin';
    public $components = array('Paginator');

 
    
   public function admin_addShop(){

    $provider = $this->User->find('list',array('conditions'=>array('User.userType'=>2)));
    $category = $this->Category->find('list', array('fields'=>array('name_en')));
    $subcategory = $this->Subcategory->find('list', array('fields'=>array('name_en')));
    $service = $this->Service->find('list', array('fields'=>array('name_en')));
   
  
    if ($this->request->is('post')) {
       if (isset($this->request->data['Shop']['image']) && $this->request->data['Shop']['image']['name'] !== '' && !empty($this->request->data['Shop']['image']['name'])) {
                $name = $this->request->data['Shop']['image'];
                if ($name['size'] >= 2000000) {
                    $this->Session->setFlash('Photo size must be less tha 2MB', 'default', array(), 'error');
                    goto a;
                }

                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '_' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($ext, $arr_ext)) {
                    $path = 'img/shop/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['Shop']['image'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } else {
                    $this->Session->setFlash('Please only upload images (gif, png, jpg, jpeg)', 'default', array(), 'error');
                    goto a;
                }
            } else {
                $this->request->data['Shop']['image'] = '';
            }
            $this->Shop->create();
    

         if(!empty($this->request->data['Shop']['sub_cat'])){
            $selected_sizes_comma_seprated = implode(',', $this->request->data['Shop']['sub_cat']);

            $this->request->data['Shop']['sub_cat'] = $selected_sizes_comma_seprated;
         }
          // pr($this->request->data); exit;
         if ($this->Shop->save($this->request->data)) {
          if(!empty($this->Shop->getLastInsertID())) {
            $lastId = $this->Shop->getLastInsertID();
            // $data = array('shop_id' => , );
            }
             $flag = 0;
            if(!empty($this->request->data['Shop']['service_id'])){
             $count = count($this->request->data['Shop']['service_id']);
             for ($i=0; $i < $count; $i++) { 
               // pr($this->request->data['Shop']['service_id'][$i]);
              $service  = $this->request->data['Shop']['service_id'][$i];
               $datas = array('shop_id' =>$lastId,'service_id' =>$service);
               $this->ShopService->create();
               $this->ShopService->save($datas);
               $flag = 1;
             }
            }
            
           
            if($flag == 1){
                $this->Session->setFlash(__('Shop has been added successfully'), 'default', array(), 'success');
                $this->redirect(array("controller" => "shops",
                    "action" => 'listShop',
                    'listShop'));

            }else{
                   $this->Session->setFlash(__('Please select atleast one service for this shop'), 'default', array(), 'error');
                    goto a;
                    //return $this->redirect($this->referer());
            }
            
            } else {
                $errorArray = "<ul>";
                    foreach ($this->Shop->validationErrors as $error) {
                    $errorArray .= "<li>";
                    $errorArray .= $error[0];
                    $errorArray .= "</li>";
                    } $errorArray .= "</ul>";
                $this->Session->setFlash(__('There is some error to save the shop'), 'default', array(), 'error');
            }
    }
    a:
    $this->set(compact('provider','category','subcategory','service'));
    $this->set('layoutTitle', __('Add Shop'));
     
   }
   public function admin_addVideo(){

     if($this->request->is('post') || $this->request->is('put')){
       // pr($this->request->data['Video']['shop_id']); exit;
    $shop_id = $this->request->data['Video']['shop_id'];
    $updateRec = $this->Video->find('first',array('conditions'=>array('Video.shop_id'=>$shop_id)));
    if (!empty($updateRec)) {
        $this->Video->id = $updateRec['Video']['id'];
    } else
        $this->Video->create();
       // pr($this->request->data); exit;

   if ($this->Video->save($this->request->data)) 
   {

        $this->Session->setFlash(__('Video has been added successfully'), 'default', array(), 'success');

        return $this->redirect($this->referer());

    } 
    else 
    {
         $this->Session->setFlash(__('Error in saving, remove following error occured'), 'default', array(), 'error');
          return $this->redirect($this->referer());
    }

    }
      $updateRec = $this->Video->find('first',array('conditions'=>array('Video.shop_id'=>$shop_id)));
      //pr($updateRec); exit;
        if (!empty($updateRec)) {
            $datas = $updateRec;
            $this->set('datas', $datas);
        }
        

     

    a:
      $this->set('datas', $updateRec);
      $this->set('layoutTitle',__('Add Video'));

   }


   public function admin_addHours(){
    if($this->request->is('post') || $this->request->is('put')){
       // pr($this->request->data['WorkingHour']['shop_id']); exit;
    $shop_id = $this->request->data['WorkingHour']['shop_id'];
    $updateRec = $this->WorkingHour->find('first',array('conditions'=>array('WorkingHour.shop_id'=>$shop_id)));

    if (!empty($updateRec)) {
        $this->WorkingHour->id = $updateRec['WorkingHour']['id'];
    } else
        $this->WorkingHour->create();

   if ($this->WorkingHour->save($this->request->data)) 
    {
         //$datas = $updateRec;
        $this->Session->setFlash(__('Working Hour has been added successfully'), 'default', array(), 'success');
       // $this->set('datas', $datas);
        return $this->redirect($this->referer());

    } 
    else 
    {
        // $datas = $this->requested->data;
        // $this->set('datas', $datas);
         $this->Session->setFlash(__('Error in saving, remove following error occured'), 'default', array(), 'error');
         return $this->redirect($this->referer());
    }

    }
     // $updateRec = $this->WorkingHour->find('first',array('conditions'=>array('WorkingHour.shop_id'=>$shop_id)));
        // if (!empty($updateRec)) {
        //     $datas = $updateRec;
            
        // }
    if (!$this->request->data) {
            $this->request->data = $updateRec;
     }
       

    a:
    $this->set('datas', $updateRec);
      $this->set('layoutTitle',__('Add Working Hour'));
   }

   public function admin_addGallery(){

     if ($this->request->is('put') || $this->request->is('post')) {

         if (isset($this->request->data['Gallery']['image']) && $this->request->data['Gallery']['image'][0]['name'] != '') {
               
                $image_container = array();
                 $filesCount = count($this->request->data['Gallery']['image']);

                for ($i = 0; $i < $filesCount; $i++) {
                    $file_data = $this->request->data['Gallery']['image'][$i];
                    if(!empty($file_data)){
                    $name = strtotime(date("Y-m-d h:i:s A")) . '_' . str_ireplace(' ', '_', $file_data['name']);

                    if ($file_data['size'] >= 2000000) {
                        $this->Session->setFlash(__('Photo size must be less then 2MB'), 'default', array(), 'error');
                        return $this->redirect($this->referer());
                    }

                    $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name);
                    $filename = time() . '_' . $file;
                    $ext = substr(strtolower(strrchr($file, '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'png');

                    if (in_array($ext, $arr_ext)) {
                        $path = 'img/users/';
                        if (move_uploaded_file($file_data['tmp_name'], $path . $filename)) {
                            array_push($image_container, $path . $filename);
                        }
                    }
                    else {

                        $this->Session->setFlash(__('gallery images must be jpg, jpeg, png.'), 'default', array(), 'error');
                         goto a;
                    }
                }
                }
                //pr($image_container); exit;
                if (count($image_container) > 0) {
                    if (count($image_container) == 1) {
                        $thumb_image = $image_container[0];
                    } else {
                        $thumb_image = implode(',', $image_container);
                    }
                } else {
                    $thumb_image = '';
                }

                $this->request->data['Gallery']['image'] = $thumb_image;
            }
            else {

                 $this->request->data['Gallery']['image']=''; 
             }
             
            
            $images =  explode(',', $this->request->data['Gallery']['image']);
            // echo count($images); exit;
            $this->request->data['Gallery']['image'] = $images;
           //pr($images); exit;

            for($i=0; $i<count($images); $i++) { 
                $arrayName = array(
                    'shop_id' =>$this->request->data['Gallery']['shop_id'],
                    'price' =>$this->request->data['Gallery']['price'][$i],
                    'image' =>$this->request->data['Gallery']['image'][$i],
                    'currency' =>$this->request->data['Gallery']['currency'][$i] 
                );
            $this->Gallery->create();
                if($this->Gallery->save($arrayName)){
                $flag = 1;
                } else {
                $flag = 0;
                }
            }

            if( $flag == 1){
                $this->Session->setFlash(__('Gallery image has been added successfully'),
                'default', array(), 'success');
                return $this->redirect($this->referer());
            
            }
            else
            {
                $errorArray = "<ul>";
                    foreach ($this->Gallery->validationErrors as $error) {
                    $errorArray .= "<li>";
                    $errorArray .= $error[0];
                    $errorArray .= "</li>";
                    } $errorArray .= "</ul>";
                $this->Session->setFlash(__('There is some error to save the shop'), 'default', array(), 'error');
             // $this->Session->setFlash(__('Gallery image can not added error occured.'),'default', array(), 'error');
            }
          }
      a:
    }


   public function admin_editShop($id = null, $action = null){

    $provider = $this->User->find('list',array('conditions'=>array('User.userType'=>2)));
    $category = $this->Category->find('list', array('fields'=>array('name_en')));
    $subcategory = $this->Subcategory->find('list', array('fields'=>array('name_en')));
    $service = $this->Service->find('list', array('fields'=>array('name_en')));
    $video_data = $this->Video->find('first',array('conditions'=>array('Video.shop_id'=>$id)));
    $working_hours= $this->WorkingHour->find('first',array('conditions'=>array('WorkingHour.shop_id'=>$id)));
    $gallery_image = $this->Gallery->find('all',array('conditions'=>array('Gallery.shop_id'=>$id)));
   // pr($gallery_image); exit;

     if (!$id || !$action) {
            $this->Session->setFlash(__('Please provide a Shop id'), 'default', array(), 'error');
            $this->redirect(array("controller" => "shops",
                "action" => $action,
                "page" => $this->passedArgs['page']));
     }

     $shops = $this->Shop->findById($id);
   
    if(!empty($shops['Shop']['sub_cat'])){
         $subcategory_id =  explode(",", $shops['Shop']['sub_cat']) ;
     }else{
         $subcategory_id =  '';
     }
   
   //pr($subcategory_id); exit;

    $service_id = $this->ShopService->find('list',array('conditions'=>array('ShopService.shop_id'=>$id),'fields'=>array('ShopService.service_id')));

    $shops['Shop']['ids'] =  implode(",", $service_id);
   
     
     if ($this->request->is('post') || $this->request->is('put')) {
      //  pr($this->request->data); exit;
       if (isset($this->request->data['Shop']['image']) && $this->request->data['Shop']['image']['name'] !== '' && !empty($this->request->data['Shop']['image']['name'])) {
                $name = $this->request->data['Shop']['image'];
                $file = preg_replace("/[^a-zA-Z0-9.]/", "", $name['name']);
                $filename = time() . '-' . $file;
                $ext = substr(strtolower(strrchr($file, '.')), 1);
                $arr_ext = array('png', 'jpeg', 'jpg');
                if (in_array($ext, $arr_ext)) {
                    $path = 'img/category/';
                    if (move_uploaded_file($name['tmp_name'], $path . $filename)) {
                        $this->request->data['Shop']['image'] = $path . $filename;
                        $multi_image[] = $filename;
                    }
                } else {
                    $this->Session->setFlash(__('Please only upload images (gif, png, jpg, jpeg)'), 'default', array(), 'error');
                    $this->redirect(array("controller" => "shops",
                        "action" => $action,
                        "page" => $this->passedArgs['page']));

                    goto a;
                }
            } else {
                if(!empty($this->request->data['Shop']['old_image'])){
                    $old_img = $this->request->data['Shop']['old_image'];
                $this->request->data['Shop']['image'] = $old_img;
            }else{
                $this->request->data['Shop']['image'] = '';
            }
                
            }

            $this->Shop->id = $id;
             // pr($this->request->data); exit;
            if(!empty($this->request->data['Shop']['sub_cat'])){
            $selected_sizes_comma_seprated = implode(',', $this->request->data['Shop']['sub_cat']);

            $this->request->data['Shop']['sub_cat'] = $selected_sizes_comma_seprated;
            }

           // pr($this->request->data); exit;
            if ($this->Shop->save($this->request->data)) {
              $flag =0;
             $count = count($this->request->data['Shop']['service_id']);
             for ($i=0; $i < $count; $i++) { 
               // pr($this->request->data['Shop']['service_id'][$i]);
              $service  = $this->request->data['Shop']['service_id'][$i];
               $datas = array('shop_id' =>$id,'service_id'=>$service);
               $this->ShopService->create();
               $this->ShopService->save($datas);
               $flag = 1;
             }
             if($flag == 1){
                $this->Session->setFlash(__('Shop has been added successfully'), 'default', array(), 'success');
                $this->redirect(array("controller" => "shops",
                    "action" => 'listShop',
                    'listShop'));

            }else{
                   $this->Session->setFlash(__('Please select atleast one service for this shop'), 'default', array(), 'error');
                    goto a;
                    //return $this->redirect($this->referer());
            }


                
             // $this->Session->setFlash(__('Shop has been updated successfully'), 'default', array(), 'success');
             // $this->redirect(array("controller" => "shops", "action" => $action));


            } else {
                $this->Session->setFlash(__('The shop can not updated error occured.'), 'default', array(), 'error');
                goto a;
            }
     }

     if (!$this->request->data) {
        $this->request->data = $shops;
     }
      /// pr($shops); exit;
    a:
    $this->set(compact('provider','category','subcategory','service','service_id','subcategory_id'));
     $this->set(compact('gallery_image'));
    $this->set(compact('video_data'));
    $this->set(compact('datas','working_hours'));
    $this->set(compact('shops'));
    $this->set('layoutTitle', __('Edit Shop'));
   }

   public function admin_viewShop($id = null,$action = null) {
            if (!$id) {
                $this->Session->setFlash('Shop not found', 'default', array(), 'error');
                return $this->redirect($this->referer());
            }
            $this->Shop->id = $id;
            if (!$this->Shop->exists()) {
                $this->Session->setFlash('Shop does not exist', 'default', array(), 'error');
                return $this->redirect($this->referer());
            }
            $shops = $this->Shop->find('first', array('conditions' => array('Shop.id' => $id)));
            
            $subcategory = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $shops['Shop']['sub_cat'])));

            $provider = $this->User->find('first', array('conditions' => array('User.id' => $shops['Shop']['user_id'])));
         
            $this->set(compact('shops', 'text','subcategory','provider'));
            echo $this->set('layoutTitle', 'Shop detail');
  }


public function admin_listShop(){
       $cond = array();
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(Shop.name_en) like' => '%'. $capital_search .'%',
                'Shop.name_ar like' => '%'. $this->passedArgs['text'] .'%',
                'Shop.name_ku like' => '%'. $this->passedArgs['text'] .'%',
            );
            $text = $this->passedArgs['text'];
        }
        $shops = $this->paginate = array(
            'conditions' => $cond,
            'order' => 'Shop.id DESC',
            'limit' =>20,
        );
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $shops = $this->paginate('Shop');
            $this->set(compact('shops', 'text'));
            $this->render('/Elements/list_shops');
        }
        $shops = $this->paginate('Shop');
       
        $this->set(compact('shops', 'text'));
        $this->set('layoutTitle', __('Shop List'));
     
}

 public function admin_deleteShop() {
      //pr($_REQUEST['id']);die;
        $cond = array();
        if (!empty($this->passedArgs['text'])) {
            $capital_search = strtolower($this->passedArgs['text']);
            $cond['or'] = array(
                'LOWER(Shop.name_en) like' => '%'. $capital_search .'%',
                'Shop.name_ar like' => '%'. $this->passedArgs['text'] .'%',
                'Shop.name_ku like' => '%'. $this->passedArgs['text'] .'%',
            );
            $text = $this->passedArgs['text'];
        }
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $id = $_REQUEST['id'];
            
            $this->Shop->delete($id);
             $shops = $this->paginate = array(
            'conditions' => $cond,
            'order' => 'Shop.id DESC',
            'limit' => 20,
             
        );
            $shops = $this->paginate('Shop');
            $this->set(compact('shops', 'text'));
            $this->render('/Elements/list_shops');
        }
       
        
    }

  function admin_getsubcategory($id = null) {
        if ($id) {
            $allsubcats = array();
            $subcat = $this->Subcategory->find('list', array('fields' => 'Subcategory.name_en',
                'conditions' => array('Subcategory.category_id' => $id)));
        }
        if ($subcat) {
            foreach ($subcat as $key => $value) { //pr($key);
                echo "<option value=" . $key . ">" . $value . "</option>";
            }
        } else {
            echo "<option value=''> First select category to add subcategory </option>";
        }
        exit();
    }

    public function admin_setEnd() { // 14-12-17 set end date
        $start = $_REQUEST['st_date'];
        //$startTime = strtotime ( '+30 mins' , strtotime ( $start ) );
         //$returnTimeFormat = 'G:i';
        //echo date($returnTimeFormat, $start);
        //echo $start;
        $end = '23:30';
        $interval = '30 mins';
        $format = '24';
        $startTime = strtotime($start);
        $endTime = strtotime($end);
        $returnTimeFormat = ($format == '12') ? 'g:i A' : 'G:i';
        $returnTimeFormat1 = 'g:i A';
        $current = time();
        $addTime = strtotime('+' . $interval, $current);
        $diff = $addTime - $current;

        $time = array();
        while ($startTime < $endTime) {
            $time[date($returnTimeFormat, $startTime)] = date($returnTimeFormat1, $startTime);
            $startTime += $diff;
        }
        $time[date($returnTimeFormat, $startTime)] = date($returnTimeFormat1, $startTime);

        echo json_encode($time);
        die;
    }


     public function admin_deleteGallery() {
        $cond = array();
       if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $id = $_REQUEST['id'];
            
            $this->Gallery->delete($id);
             $gallery_image = $this->paginate = array(
            'conditions' => $cond,
            'order' => 'Gallery.id DESC',
            'limit' => 20,
             
        );
            $gallery_image = $this->paginate('Gallery');
            $this->set(compact('gallery_image', 'text'));
            $this->render('/Elements/list_gallery');
        }
       
        
    }



   
   
 
 

 

}


