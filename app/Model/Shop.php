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

class Shop extends AppModel {
     var $belongsTo = array(
         'User'=>array(
             'className'=>'User',
             'foreignKey'=>'user_id'
         ),  );


public $validate = array(
	'name_en' => array(
 	    'required' => array(
 		'rule' => 'notBlank',
 		'message' => 'Name (English) is required',
 	    // 'on' => 'update'
 	    )
 	),
    'name_ar' => array(
        'required' => array(
        'rule' => 'notBlank',
        'message' => 'Name (Arabic) is required',
        // 'on' => 'update'
        )
     ),
    'name_ku' => array(
        'required' => array(
        'rule' => 'notBlank',
        'message' => 'Name (Kurdish) is required',
        // 'on' => 'update'
        )
     ),
    'email' => array(
        'required' => array(
        'rule' => 'notBlank',
        'message' => 'Email is required',
        )
    ),
    // 'desc_en' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' => 'Description (English) is required',
    //     )
    // ),
    // 'desc_ar' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' => 'Description (Arabic) is required',
    //     )
    // ),
    // 'desc_ku' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' => 'Description (Kurdish) is required',
    //     )
    // ),
    // 'address_en' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' => 'Address (English) is required',
    //     )
    // ),
    // 'address_ar' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' =>  'Address (Arabic) is required',
    //     )
    // ),
    // 'address_ku' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' =>  'Address (Kurdish) is required',
    //     )
    // ),
    // 'lat' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' =>  'Latitude is required',
    //     )
    // ),
	
    // 'lng' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' =>  'Longitude is required',
    //     )
    // ),
    // 'phone1' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' =>  'Phone is required',
    //     )
    // ),
    // 'phone2' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' =>  'Phone is required',
    //     )
    // ),
    // 'phone3' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' =>  'Phone is required',
    //     )
    // ),
    // 'facebook' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' =>  'facebook is required',
    //     )
    // ),
    // 'twitter' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' =>  'twitter is required',
    //     )
    // ),
    // 'snapchat' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' =>  'snapchat is required',
    //     )
    // ),
    // 'instagram' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' => 'instagram is required',
    //     )
    // ),
    // 'cat_id' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' => 'Category is required',
    //     )
    // ),
    //  'service_id' => array(
    //     'required' => array(
    //     'rule' => 'notBlank',
    //     'message' => 'service is required',
    //     )
    // ),
   
   



   );
   
}
