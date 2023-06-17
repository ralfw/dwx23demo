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
class RidesController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $layout = 'admin';
    public $components = array('Paginator');

    public function admin_listCompletedRide() {
	$cond = array();
	if (!empty($this->passedArgs['text'])) {
	    $cond['or'] = array(
		'User.email like' => '%' . $this->passedArgs['text'] . '%',
		'User.name like' => '%' . $this->passedArgs['text'] . '%',
		'User.phone like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.phone like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.email like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.name like' => '%' . $this->passedArgs['text'] . '%',
		'Ride.s_loc like' => '%' . $this->passedArgs['text'] . '%',
		'Ride.d_loc like' => '%' . $this->passedArgs['text'] . '%',
	    );
	    $text = $this->passedArgs['text'];
	}
	$cond['Ride.status'] = array('7', '-1', '-2');
	$rides = $this->paginate = array(
	    'conditions' => $cond,
	    'order' => 'Ride.id DESC',
	    'limit' => 10,
	);
	if ($this->request->is("ajax")) {
	    $this->autoRender = false;
	    $rides = $this->paginate('Ride');
	    $this->set(compact('rides', 'text'));
	    $this->render('/Elements/list_completed_rides');
	}
	$rides = $this->paginate('Ride');
	//pr($rides);die;
	$this->set(compact('rides', 'text'));
	$this->set('layoutTitle', __('Past Ride List'));
    }

    public function admin_viewCompletedRide($id = null) {
	if (!$id) {
	    $this->Session->setFlash('Page not found', 'default', array(), 'error');
	    return $this->redirect($this->referer());
	}
	$this->Ride->id = $id;
	if (!$this->Ride->exists()) {
	    $this->Session->setFlash('Ride does not exist', 'default', array(), 'error');
	    return $this->redirect($this->referer());
	}
	$rides = $this->Ride->find('first', array('conditions' => array('Ride.id' => $id)));
	$this->set(compact('rides', 'text'));
	$this->set('layoutTitle', 'View Detail');
    }

    public function admin_driverEmail($id = null,$amt=null) {

    	if (!$id || !$amt) {
    	    $this->Session->setFlash('Page not found', 'default', array(), 'error');
    	}

    	$this->Ride->id = $id;
    	if (!$this->Ride->exists()) {
    	    $this->Session->setFlash('Ride does not exist', 'default', array(), 'error');
    	    return $this->redirect($this->referer());
    	}

    	else {
    	    $ride = $this->Ride->find('first', array('conditions' => array('Ride.id' => $id)));
    	    if (!empty($ride)) {
    		$email = $ride['Driver']['email'];
    		$messsage = "Hello " . $ride['User']['name'] . ", <br /><br />
                                       Hopefully you are enjoying bussiness with " . PROJECT_NAME . ".<br /><br />
                                        Please pay the commission amount of $<b>" .$amt.
    				    "</b> at our office <br /><br /> Regards,<br /><br />".PROJECT_NAME. " Team";


    		$subject = 'Driver Commision';
    		if ($this->Basic->sendEmail($email, $subject, $messsage)) {
    		    $this->Session->setFlash(__('Email was send successfully'), 'default', array(), 'success');
    		} else {
    		    $this->Session->setFlash(__('Email was not send'), 'default', array(), 'error');
    		}
    	    } else {
    		$this->Session->setFlash(__('Error : Try Again Later'), 'default', array(), 'error');
    	    }
    	}
	return $this->redirect($this->referer());
    }

    public function admin_deleteCompletedRide() {
	$cond = array();
	if (!empty($this->passedArgs['text'])) {
	    $cond['or'] = array(
		'User.email like' => '%' . $this->passedArgs['text'] . '%',
		'User.name like' => '%' . $this->passedArgs['text'] . '%',
		'User.phone like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.phone like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.email like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.name like' => '%' . $this->passedArgs['text'] . '%',
		'Ride.s_loc like' => '%' . $this->passedArgs['text'] . '%',
		'Ride.d_loc like' => '%' . $this->passedArgs['text'] . '%',
	    );
	    $text = $this->passedArgs['text'];
	}
	$cond['Ride.status'] = array('7', '-1', '-2');
	if ($this->request->is("ajax")) {
	    $this->autoRender = false;
	    $id = $_REQUEST['id'];
	    $this->Ride->delete($id);
	    $rides = $this->paginate = array(
		'conditions' => $cond,
		'order' => 'Ride.id DESC',
		'limit' => 10,
	    );
	    $rides = $this->paginate('Ride');
	    $this->set(compact('rides', 'text'));
	    $this->render('/Elements/list_completed_rides');
	}
    }

    public function admin_listOngoingRide() {
	$cond = array();
	if (!empty($this->passedArgs['text'])) {
	    $cond['or'] = array(
		'User.email like' => '%' . $this->passedArgs['text'] . '%',
		'User.name like' => '%' . $this->passedArgs['text'] . '%',
		'User.phone like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.phone like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.email like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.name like' => '%' . $this->passedArgs['text'] . '%',
		'Ride.s_loc like' => '%' . $this->passedArgs['text'] . '%',
		'Ride.d_loc like' => '%' . $this->passedArgs['text'] . '%',
	    );
	    $text = $this->passedArgs['text'];
	}
	$cond['Ride.status'] = array('1', '2', '3', '4', '5', '6');
	$rides = $this->paginate = array(
	    'conditions' => $cond,
	    'order' => 'Ride.id DESC',
	    'limit' => 10,
	);
	if ($this->request->is("ajax")) {
	    $this->autoRender = false;
	    $rides = $this->paginate('Ride');
	    $this->set(compact('rides', 'text'));
	    $this->render('/Elements/list_ongoing_rides');
	}
	$rides = $this->paginate('Ride');
	$this->set(compact('rides', 'text'));
	$this->set('layoutTitle', __('Ongoing Ride List<small>this page will automatically refresh in 20 seconds</small>'));
    }

    public function admin_deleteOngoingRide() {
	$cond = array();
	if (!empty($this->passedArgs['text'])) {
	    $cond['or'] = array(
		'User.email like' => '%' . $this->passedArgs['text'] . '%',
		'User.name like' => '%' . $this->passedArgs['text'] . '%',
		'User.phone like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.phone like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.email like' => '%' . $this->passedArgs['text'] . '%',
		'Driver.name like' => '%' . $this->passedArgs['text'] . '%',
		'Ride.s_loc like' => '%' . $this->passedArgs['text'] . '%',
		'Ride.d_loc like' => '%' . $this->passedArgs['text'] . '%',
	    );
	    $text = $this->passedArgs['text'];
	}
	$cond['Ride.status'] = array('1', '2', '3', '4', '5', '6');
	if ($this->request->is("ajax")) {
	    $this->autoRender = false;
	    $id = $_REQUEST['id'];
	    $this->Ride->delete($id);
	    $rides = $this->paginate = array(
		'conditions' => $cond,
		'order' => 'Ride.id DESC',
		'limit' => 10,
	    );
	    $rides = $this->paginate('Ride');
	    $this->set(compact('rides', 'text'));
	    $this->render('/Elements/list_ongoing_rides');
	}
    }

    public function admin_rideSetting() {
	if ($this->request->is('post')) {
	    $updateRec = $this->Option->find('first', array(
		'conditions' => array('Option.name' => 'ride_cost')));
	    if (!empty($updateRec)) {
		$this->Option->id = $updateRec['Option']['id'];
	    } else
		$this->Option->create();
	    if ($this->Option->save($this->request->data)) {
		$datas = $updateRec;
		$this->Session->setFlash(__('Ride setting has been saved successfully'), 'default', array(), 'success');
		$this->set('datas', $datas);
	    } else {
		$errorArray = "<ul>";
		foreach ($this->Option->validationErrors as $error) {
		    $errorArray .= "<li>";
		    $errorArray .= $error[0];
		    $errorArray .= "</li>";
		}
		$errorArray .= "</ul>";
		$this->Session->setFlash(__($error[0]), 'default', array(), 'error');
		return $this->redirect($this->referer());
		goto a;
	    }
	}
	$updateRec = $this->Option->find('first', array(
	    'conditions' => array('Option.name' => 'ride_cost')));
	if (!empty($updateRec)) {
	    $datas = $updateRec;
	    $this->set('datas', $datas);
	}
	a:
	$this->set('layoutTitle', __('Ride Cost'));
    }

    public function admin_rideDistanceSetting($id = null, $action = null) {
//        if (!$id || !$action) {
//	     $this->Session->setFlash(__('Please fill all data'), 'default', array(), 'error');
//	    $this->redirect(array("controller" => "rides",
//		"action" => 'rideDistanceSetting',
//		"page" => $this->passedArgs['page']));
//	}

	if ($this->request->is('post')) {
	    $updateRec = $this->Option->find('first', array(
		'conditions' => array('Option.name' => 'distance')));
//pr($updateRec);die;
	    if (!empty($updateRec)) {
		$this->Option->id = $updateRec['Option']['id'];
	    } else
		$this->Option->create();
	    if ($this->Option->save($this->request->data)) {
		$datas = $updateRec;
		$this->Session->setFlash(__('Ride setting has been saved successfully'), 'default', array(), 'success');
		$this->set('datas', $datas);
	    } else {
		$errorArray = "<ul>";
		foreach ($this->Option->validationErrors as $error) {
		    $errorArray .= "<li>";
		    $errorArray .= $error[0];
		    $errorArray .= "</li>";
		}
		$errorArray .= "</ul>";
		$this->Session->setFlash(__($error[0]), 'default', array(), 'error');
		return $this->redirect($this->referer());
		goto a;
	    }
	}
	$updateRec = $this->Option->find('first', array(
	    'conditions' => array('Option.name' => 'distance')));
	if (!empty($updateRec)) {
	    $datas = $updateRec;
	    $this->set('datas', $datas);
	}
	a:
	$this->set('layoutTitle', __('Ride Distance'));
    }

    public function admin_minRideCost() {
	if ($this->request->is('post')) {
	    $updateRec = $this->Option->find('first', array(
		'conditions' => array('Option.name' => 'ride_mincost')));
	    if (!empty($updateRec)) {


		$this->Option->id = $updateRec['Option']['id'];
	    } else
		$this->Option->create();
	    if ($this->Option->save($this->request->data)) {
		$datas = $updateRec;
		$this->Session->setFlash(__('Minimum ride cost has been saved successfully'), 'default', array(), 'success');
		$this->set('datas', $datas);
	    } else {
		$errorArray = "<ul>";
		foreach ($this->Option->validationErrors as $error) {
		    $errorArray .= "<li>";
		    $errorArray .= $error[0];
		    $errorArray .= "</li>";
		}
		$errorArray .= "</ul>";
		$this->Session->setFlash(__($error[0]), 'default', array(), 'error');
		return $this->redirect($this->referer());
		goto a;
	    }
	}
	$updateRec = $this->Option->find('first', array(
	    'conditions' => array('Option.name' => 'ride_mincost')));
	if (!empty($updateRec)) {
	    $datas = $updateRec;
	    $this->set('datas', $datas);
	}
	a:
	$this->set('layoutTitle', __('Minimum Ride Cost'));
    }

    public function admin_profit() {

	if ($this->request->is('post')) {
	    $updateRec = $this->Option->find('first', array(
		'conditions' => array('Option.name' => 'admin_profit')));
	    if (!empty($updateRec)) {
		$this->Option->id = $updateRec['Option']['id'];
	    } else
		$this->Option->create();
	    if ($this->Option->save($this->request->data)) {
		$datas = $updateRec;
		$this->Session->setFlash(__('Data has been saved successfully'), 'default', array(), 'success');
		$this->set('datas', $datas);
	    } else {
		$errorArray = "<ul>";
		foreach ($this->Option->validationErrors as $error) {
		    $errorArray .= "<li>";
		    $errorArray .= $error[0];
		    $errorArray .= "</li>";
		}
		$errorArray .= "</ul>";
		$this->Session->setFlash(__($error[0]), 'default', array(), 'error');
		return $this->redirect($this->referer());
		goto a;
	    }
	}
	$updateRec = $this->Option->find('first', array(
	    'conditions' => array('Option.name' => 'admin_profit')));
	if (!empty($updateRec)) {
	    $datas = $updateRec;
	    $this->set('datas', $datas);
	}
	a:
	$this->set('layoutTitle', __('Admin Profit Setting'));
    }

}
