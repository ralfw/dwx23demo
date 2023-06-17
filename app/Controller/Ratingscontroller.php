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
 * Overrating this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class RatingsController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $layout = 'admin';
    public $components = array('Paginator');

  

    public function admin_listRating() {
        $cond = array();
        if (!empty($this->passedArgs['text'])) {
            $cond['or'] = array(
                'User.name like' => '%' . $this->passedArgs['text'] . '%',
                'Driver.name like' => '%' . $this->passedArgs['text'] . '%',
                'Rating.rating like' => '%' . $this->passedArgs['text'] . '%',
                'Rating.created like' => '%' . $this->passedArgs['text'] . '%',
                
            );
            $text = $this->passedArgs['text'];
        }
        
        $ratings = $this->paginate = array(
            'conditions' => $cond,
            'order' => 'Rating.id DESC',
            'limit' => 10,
        );
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $ratings = $this->paginate('Rating');
            $this->set(compact('ratings', 'text'));
            $this->render('/Elements/list_ratings');
        }
        $ratings = $this->paginate('Rating');
        //pr($ratings);die;
        $this->set(compact('ratings', 'text'));
        $this->set('layoutTitle', __('Review List'));
    }

    public function admin_deleteRating() {
        $cond = array();
        if (!empty($this->passedArgs['text'])) {
            $cond['or'] = array(
                'User.name like' => '%' . $this->passedArgs['text'] . '%',
                'Driver.name like' => '%' . $this->passedArgs['text'] . '%',
                'Rating.rating like' => '%' . $this->passedArgs['text'] . '%',
                'Rating.created like' => '%' . $this->passedArgs['text'] . '%',
            );
            $text = $this->passedArgs['text'];
        }
        
        if ($this->request->is("ajax")) {
            $this->autoRender = false;
            $id = $_REQUEST['id'];
            $this->Rating->delete($id);
            $ratings = $this->paginate = array(
                'conditions' => $cond,
                'order' => 'Rating.id DESC',
                'limit' => 10,
            );
            $ratings = $this->paginate('Rating');
            $this->set(compact('ratings', 'text'));
            $this->render('/Elements/list_ratings');
        }
    }

    

}
