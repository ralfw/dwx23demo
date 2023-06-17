<?php

/**

 * Application level Controller

 *

 * This file is application-wide controller file. You can put all

 * application-wide controller-related methods here.

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



App::uses('Controller', 'Controller');



/**

 * Application Controller

 *

 * Add your application-wide methods in the class below, your controllers

 * will inherit them.

 *

 * @package		app.Controller

 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller

 */

class AppController extends Controller {

   public $uses = array('User','Category','Custom','Setting','Subcategory','About','Privacy','Contact','Shop','Service','ShopService','Bookmark','Gallery','WorkingHour','Video','Keyword','Rating','Office');  

   //var $components = array('Paginator');


   public $components = array(

        'Basic',

        'Session',

        'RequestHandler',

        'Auth' => array(

            'loginRedirect' => array(

                'controller' => 'users',

                'action' => 'dashboard',

                'admin' => true

            ),

            'logoutRedirect' => array(

                'controller' => 'users',

                'action' => 'login',

                'admin' => true

            ),

             'authenticate' => array(

                'Form' => array(

				'fields' => array('username' => 'email', 'password'=>'password'),

                    'passwordHasher' => array(

                        'className' => 'Simple',

                        'hashType' => 'md5'

                    ),

                    'authError' => 'Please login to view page',

                    'loginError' => 'Invalid user name and password',

                )

            ),

            'authorize' =>  array('Controller'),

    ));



    public function isAuthorized($user = null) {

        // Any registered user can access public functions

        if ($user['userType'] == '3') {
           return true;
        }
 
        $this->Session->setFlash('<a href="#" class="close" data-dismiss="alert">&times;</a><span>You are not allowed to enter in this area.</span>','default',array('class'=>'alert  alert-danger'));
        $this->redirect($this->Auth->logout());

    }





    public function beforeFilter() {

       $this->Auth->allow('admin_login','admin_logout','admin_forgotAccount','admin_activateAccount','admin_redirection','admin_resetPassword');

		if(isset($this->request->prefix) && ($this->request->prefix == 'api')){

		    $this->Auth->allow();
			if(!empty($_REQUEST['user_id'])){
			 $user = $this->User->find('first',array('conditions'=>array('User.id'=>$_REQUEST['user_id'])));
			 if(!empty($user)){
				  if($user && $user['User']['status'] == '0'){
                     $this->Basic->response(404,'user_deactived');
				  }
			 }else{
				$this->Basic->response(401,'user_not_exsists');
			 }
            }
            if(!empty($_REQUEST['lang'])){
				$language = $_REQUEST['lang'];
			}else{
				$this->Basic->response(404,'Language is required');
			}
            
            if($language == 'ar'){
                $this->Session->write('Config.language', 'ara');
              }else if ($language == 'ku'){
                  $this->Session->write('Config.language', 'kur');
              }else{
                $this->Session->write('Config.language', 'eng');
              }


		}

    $customdata = $this->Custom->find('first');
    $this->set(compact('customdata'));


	//show value of user in setting and option
	$loginuserdata = $this->User->find('first',array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));
	$this->set(compact('loginuserdata'));

    //show value of user in setting and option
    $settingdata = $this->Setting->find('first',array('conditions'=>array('Setting.user_id'=>$this->Session->read('Auth.User.id'))));
    $this->set(compact('settingdata'));
        
		
		
    $this->set('status', array('0'=> __('In active'),'1'=> __('Active')));
    $this->set('currency', array('$' => __('$'), 'د.ع' => __('د.ع')));
    
    }

     

 


	function beforeRender() {
         $this->response->disableCache();
		if($this->name == 'CakeError') {
            //$this->layout = '404';
        }
	}



}
