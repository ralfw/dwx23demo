<?php

/**
 * Created by PhpStorm.
 * User: win 7
 * Date: 4/8/2017
 * Time: 3:23 PM
 */
App::uses('AppModel', 'Model');
App::uses('Security', 'Utility');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class Gallery extends AppModel {
	

     public $validate = array(
	
    'image' => array(
        'required' => array(
        'rule' => 'notBlank',
        'message' => 'gallery image is required',
        // 'on' => 'update'
        )
    ),
    );

}
