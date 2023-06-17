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

class Subcategory extends AppModel {
     var $belongsTo = array(

        'Category'=>array(
            'className'=>'Category',
            'foreignKey'=>'category_id'
        ),
       

    );


public $validate = array(
	
    'name_en' => array(
        'required' => array(
        'rule' => 'notBlank',
        'message' => 'Sub category name is required',
        // 'on' => 'update'
        )
    ),
      'category_id' => array(
        'required' => array(
        'rule' => 'notBlank',
        'message' => 'Category is required',
        // 'on' => 'update'
        )
    ),
   
    
 	// 'image' => array(
 	//     'required' => array(
 	// 	'rule' => 'notBlank',
 	// 	'message' => 'Image is required',
 	//     //  'on' => 'update'
 	//     )
 	// ),
 	
 	
 	
 	
);
}
