<?php
/**
 * Created by PhpStorm.
 * User: win 7
 * Date: 4/8/2017
 * Time: 3:23 PM
 */
App::uses('AppModel', 'Model');


class Request extends AppModel {
    var $belongsTo = array(
         'User'=>array(
             'className'=>'User',
             'foreignKey'=>'user_id'
         ),

        );


}
