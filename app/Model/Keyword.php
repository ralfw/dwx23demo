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

class Keyword extends AppModel {

 public $validate = array(
	
    'name_en' => array(
        'required' => array(
        'rule' => 'notBlank',
        'message' => 'keyword name is required',
        // 'on' => 'update'
        )
    ),
     
 	
 	
 	
 	
);


}
