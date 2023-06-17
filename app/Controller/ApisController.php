<?php
App::uses('AppController', 'Controller');

class ApisController extends AppController {

	public function api_registerUser(){
     
			if(!empty($_REQUEST['name'])){
				$this->request->data['User']['name'] = $_REQUEST['name'];
			}

			if(!empty($_REQUEST['password'])){
				$this->request->data['User']['password'] = $_REQUEST['password'];
			}

			if(!empty($_REQUEST['phone'])){
				$this->request->data['User']['phone'] = $_REQUEST['phone'];
			}
			if(!empty($_REQUEST['email'])){
				$this->request->data['User']['email'] = $_REQUEST['email'];
			}

	     	if(!empty($_REQUEST['deviceType'])) {
				 $this->request->data['User']['deviceType'] = $_REQUEST['deviceType'];
				 $this->User->updateAll( array('deviceType' => "''"),array('User.deviceType' => $_REQUEST['deviceType']));
			}

			if(!empty($_REQUEST['deviceToken'])){
				$this->request->data['User']['deviceToken'] = $_REQUEST['deviceToken'];
				$this->User->updateAll( array('deviceToken' => "''"),array('User.deviceToken' => $_REQUEST['deviceToken']));
			}
 
			if(!empty($_REQUEST['userType'])){
				$this->request->data['User']['userType'] = $_REQUEST['userType'];
			}

			if(!empty($_FILES['image'])){

                if(isset($_FILES['image']) && $_FILES['image']['name'] !== '' && !empty($_FILES['image']['name'])){
					//pr($_FILES['image']); die;
				$file = $_FILES['image'];
				$file = preg_replace("/[^a-zA-Z0-9.]/", "", $file['name']);
				$filename = time().'-'.$file;
				$ext = substr(strtolower(strrchr($file, '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions

				if(in_array($ext, $arr_ext))
				{
				$path="img/users/";
				if(move_uploaded_file($_FILES['image']['tmp_name'],$path.$filename)){
                    $this->request->data['User']['image'] = $path.$filename;
				}
				}else{
					 $this->Basic->response(404,'valid_image');
				}
				}
			}

			if(!empty($_REQUEST['id'])){
				$this->User->id = $_REQUEST['id'];
				$exsitsUser = $this->User->findById($_REQUEST['id']);
				if(!$this->User->exists()){
				$this->Basic->response(401,'user_not_exsists');
				
				}

				$lastId = $_REQUEST['id'];
				$msg = __("user_updated");
			}

			else
			{

				$this->request->data['User']['status'] = '1';

				$msg = __("user_created");
				$this->User->create();
			}

            //pr($this->request->data); die; 
	    if($this->User->save($this->request->data)) {
				if(!empty($this->User->getLastInsertID())) {
					$lastId = $this->User->getLastInsertID();
				}
	
				//$results = array('mesg' => $msg, 'response' => '1','data'=>$this->getUser($lastId));
				$this->Basic->response(200,$msg,$this->getUser($lastId));
			}
			else
			{
				foreach($this->User->validationErrors as $error){
				}
				$this->Basic->response(404,$error[0]);
				//$results = array('mesg' => __($error[0]), 'response' => '0');
			}
	}
    
	public function api_login(){
		if(!empty($_REQUEST['phone']) && !empty($_REQUEST['password']) && !empty($_REQUEST['userType']))
		{
			$pass=Security::hash($_REQUEST['password'], 'md5', true);
			$user = $this->User->find('first',array('conditions'=>array('User.phone'=>$_REQUEST['phone'],'User.password'=>$pass,'User.userType'=>$_REQUEST['userType'])));

			if($user && $user['User']['status'] == 0) {
				$this->Basic->response(404,'user_deactived');
				
			}

			if (!empty($user)) {
				$this->User->id = $user['User']['id'];

				if(!empty($_REQUEST['deviceType'])){
					$this->request->data['User']['deviceType'] = $_REQUEST['deviceType'];
				}

				if(!empty($_REQUEST['deviceToken'])){
					$this->request->data['User']['deviceToken'] = $_REQUEST['deviceToken'];
				}

				if(!empty($_REQUEST['deviceType'])){
					$this->request->data['User']['deviceType'] = $_REQUEST['deviceType'];
					$this->User->updateAll( array('deviceType' => "''"),array('User.deviceType' => $_REQUEST['deviceType']));
				}

				if(!empty($_REQUEST['deviceToken'])){
					$this->request->data['User']['deviceToken'] = $_REQUEST['deviceToken'];
					$this->User->updateAll( array('deviceToken' => "''"),array('User.deviceToken' => $_REQUEST['deviceToken']));
				}

				$this->User->save($this->request->data);
				$this->Basic->response(200,'user_logged_in',$this->getUser($user['User']['id']));
			}
			else {
				$this->Basic->response(404,'email_pass_not_valid');
			}
		}
		else
		{
			$this->Basic->response(404,'required_data');
		}

	}

	public function api_activateAccount(){
		if(!empty($_REQUEST['activation'])){
			$id = base64_decode($_REQUEST['activation']);
		}
		if(!empty($_REQUEST['activationID'])){
			$aId = $_REQUEST['activationID'];
		}
		$user = $this->User->find('first',array('conditions'=> array('User.id' =>$id,'User.activationKey' =>$aId )));

		if(count($user)>0 && !empty($user['User']['activationKey'])){
			$this->request->data['User']['activationKey'] = '';
			$this->request->data['User']['status'] = '1';
			$this->User->id = $user['User']['id'];
			if ($this->User->save($this->request->data)) {
				echo "Your account has been activated successfully.";die;
			}
		}
		else{
			echo "Link may be expired.";die;
		}
	}


	public function api_logout(){
	// logout user

		if(!empty($_REQUEST['id'])){

			$user = $this->User->updateAll( array('deviceToken' => "''",'deviceType'=>"''"),array('User.id' => $_REQUEST['id']));

			if (!empty($user)) {
				$this->Basic->response(200,'user_logged_out');
			}
			else {
				$this->Basic->response(404,'server_error');
			}
		}
		else{
			$this->Basic->response(404,'required_data');
		}
		a:
		echo json_encode($results);
		exit;
	}


	//Category LIST
	public function api_categoryList(){
		$language = $_REQUEST['lang'];
		$this->Category->virtualFields['name'] = "name_$language";
		$cat_list= $this->Category->find('all',array('order'=>'Category.id desc'));
		
		if(!empty($cat_list)){
			$cat_list = Set::extract('/Category/.', $cat_list);
			$this->Basic->response(200,'get_data',$cat_list);
		}
		else
		{
			$this->Basic->response(404,'not_found');
		}
		
	}


	//Sub CategoryList List
	public function api_subcategoryList(){
		$language = $_REQUEST['lang'];
		$cond = array();
		$this->Subcategory->virtualFields['name'] = "Subcategory.name_$language";
		//$this->Subcategory->virtualFields['keyboard'] = "Subcategory.keyboard_$language";

		if( !empty($_REQUEST['cat_id'])){
			$cond['category_id'] = $_REQUEST['cat_id'];
		}
		if( !empty($_REQUEST['keyword'])){
			$cond["FIND_IN_SET(?, Subcategory.keyword)"] = $_REQUEST['keyword'];
		}
		//pr($cond);
		$sub_cat_lists= $this->Subcategory->find('all',array('conditions'=>$cond,'order'=>'Subcategory.id desc'));
		//pr($sub_cat_list); die;
		if(!empty($sub_cat_lists)){
			$sub_cat_lists = Set::extract('/Subcategory/.', $sub_cat_lists);
			foreach($sub_cat_lists as $sub_cat_list){ 
				$shopDatas= $this->Shop->find('all',array('conditions'=>array('Shop.sub_cat'=>$sub_cat_list['id']),'fields'=>array("Shop.id","Shop.total_views"),'order'=>'Shop.id desc'));
				$shopDatasCount = 0;
				if($shopDatas){
                    foreach($shopDatas as $shopData){
						$shopDatasCount  += $shopData['Shop']['total_views'];
					}    
				}
				$sub_cat_list['shop_count'] =  count($shopDatas);
				$sub_cat_list['shop_views'] =  $shopDatasCount;
				$sub_cat_list['notifyCount'] = 0;
				$sub_cat_listsArr[] = $sub_cat_list;
			}
			$this->Basic->response(200,'get_data',$sub_cat_listsArr);
		}else{
			$this->Basic->response(404,'not_found');
		}
	}
	
	// public function api_keyboardList(){
	// 	$language = $_REQUEST['lang'];
	// 	$cond = array();
		
	// 	$this->Subcategory->virtualFields['keyboard'] = "keyboard_$language";
    //     $cond['Subcategory.keyboard !='] = '';
	// 	$sub_cat_list= $this->Subcategory->find('all',array('conditions'=>$cond,'fields'=>array('Subcategory.keyboard'),'order'=>'Subcategory.keyboard asc'));
		
	// 	if(!empty($sub_cat_list)){
	// 		$sub_cat_list_arr = array();
	// 		$sub_cat_list = Set::extract('/Subcategory/.', $sub_cat_list);
	// 		foreach($sub_cat_list as $key){
	// 			$keyboarddata = explode(',',$key['keyboard']);
	// 			if($keyboarddata){
	// 				foreach($keyboarddata as $key1){ //pr($key1);
	// 					if(!empty($_REQUEST['keyword'])){
	// 						if(stripos(strtolower($key1), strtolower($_REQUEST['keyword'])) === FALSE){
							
	// 						}else{
	// 							if(!empty($key1) && is_null($this->searchForId($key1, $sub_cat_list_arr))){
	// 								$sub_cat_list_arr[] = array('key'=>$key1);
	// 							} 
	// 						}
    //                 	}else{
	// 						if(!empty($key1) && is_null($this->searchForId($key1, $sub_cat_list_arr))){
	// 							$sub_cat_list_arr[] = array('key'=>$key1);
	// 						}
	// 					}
	// 				 }
	// 			}
	// 		}
	// 		if(!empty($sub_cat_list_arr)){
    //             $this->Basic->response(200,'get_data',$sub_cat_list_arr);
	// 		}else{
	// 			$this->Basic->response(404,'not_found');
	// 		}
			
	// 	}else{
	// 		$this->Basic->response(404,'not_found');
	// 	}
	// }
	
	public function api_keyboardList(){
		$language = $_REQUEST['lang'];
		$cond = array();
		
		$this->Keyword->virtualFields['name'] = "Keyword.name_$language";
        $cond['Keyword.name like'] = '%' . $_REQUEST['keyword'] . '%';
		$keyword_lists= $this->Keyword->find('all',array('conditions'=>$cond,'fields'=>array('Keyword.id','Keyword.name'),'order'=>'Keyword.name asc'));
		//pr($keyword_lists); die;
		
		if(!empty($keyword_lists)){
			
			$keyword_lists = Set::extract('/Keyword/.', $keyword_lists);
			$this->Basic->response(200,'get_data',$keyword_lists);
			$this->Basic->response(200,'get_data',$keyword_lists);
			
		}else{
			$this->Basic->response(404,'not_found');
		}
	}
	
	public function api_addressList(){
		$language = $_REQUEST['lang'];
		$this->Office->virtualFields['location'] = "Office.location_$language";
		$this->Office->virtualFields['address'] = "Office.address_$language";
		$office_lists= $this->Office->find('all',array('order'=>'Office.id desc'));
		
		if(!empty($office_lists)){
			$office_lists = Set::extract('/Office/.', $office_lists);
			$this->Basic->response(200,'get_data',$office_lists);
		}
		else
		{
			$this->Basic->response(404,'not_found');
		}
		
	}
	
	public function api_deleteGallery(){
		$language = $_REQUEST['lang'];
		
		if(!empty($_REQUEST['id'])){
			$this->Gallery->deleteAll(array('Gallery.id'=>explode(',',$_REQUEST['id'])));
			$this->Basic->response(200,'get_data');
		}
		else
		{
			$this->Basic->response(404,'required_data');
		}
		
	}
	
	public function api_deleteVideo(){
		$language = $_REQUEST['lang'];
		
		if(!empty($_REQUEST['id'])){
			$this->Video->deleteAll(array('Video.id'=>explode(',',$_REQUEST['id'])));
			$this->Basic->response(200,'get_data');
		}
		else
		{
			$this->Basic->response(404,'required_data');
		}
		
	}
	
	public function api_addVideo(){
		$language = $_REQUEST['lang'];
		
		if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['video_url']) && !empty($_REQUEST['shop_id']) ){
			$this->request->data['Video']['user_id'] = $_REQUEST['user_id'];
			$this->request->data['Video']['video_url'] = $_REQUEST['video_url'];
			$this->request->data['Video']['shop_id'] = $_REQUEST['shop_id'];
			$this->Video->save($this->request->data);
			$this->Basic->response(200,'get_data');
		}
		else
		{
			$this->Basic->response(404,'required_data');
		}
		
	}
	
	public function api_addGallery(){
		$language = $_REQUEST['lang'];
		
		if(!empty($_REQUEST['currency']) && !empty($_REQUEST['price']) && !empty($_REQUEST['shop_id']) && !empty($_REQUEST['desc']) ){
			$this->request->data['Gallery']['currency'] = $_REQUEST['currency'];
			$this->request->data['Gallery']['price'] = $_REQUEST['price'];
			$this->request->data['Gallery']['shop_id'] = $_REQUEST['shop_id'];
			$this->request->data['Gallery']['desc'] = $_REQUEST['desc'];

			if(!empty($_FILES['image'])){
				if(isset($_FILES['image']) && $_FILES['image']['name'] !== '' && !empty($_FILES['image']['name'])){
					$file = $_FILES['image'];
					$file = preg_replace("/[^a-zA-Z0-9.]/", "", $file['name']);
					$filename = time().'-'.$file;
				$ext = substr(strtolower(strrchr($file, '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions

				if(in_array($ext, $arr_ext))
				{
				$path="img/gallery/";
				if(move_uploaded_file($_FILES['image']['tmp_name'],$path.$filename)){

				$this->request->data['Gallery']['image'] = $path.$filename;
				}
				}else{
					$this->Basic->response(404,'valid_image');
				
				}
				}
			}

			$this->Gallery->save($this->request->data);
			$this->Basic->response(200,'get_data');
		}
		else
		{
			$this->Basic->response(404,'required_data');
		}
		
	}
	
	public function api_updateService(){
		$language = $_REQUEST['lang'];
		
		if(!empty($_REQUEST['services_ids']) && !empty($_REQUEST['shop_id']) ){
			$services = explode(',',$_REQUEST['services_ids']);
			$this->request->data['ShopService']['shop_id'] = $_REQUEST['shop_id'];
			foreach($services as $service){
			$services = explode(',',$_REQUEST['services_ids']);
				$this->request->data['ShopService']['service_id'] = $service;
				$this->ShopService->create();
				$this->ShopService->save($this->request->data);
			}
			$this->Basic->response(200,'get_data');
		}
		else
		{
			$this->Basic->response(404,'required_data');
		}
		
	}
	
	public function api_updateTime(){
		$language = $_REQUEST['lang'];
		
		if(!empty($_REQUEST['time']) && !empty($_REQUEST['id']) ){
			$time = json_decode($_REQUEST['time']);
			//pr($time); 
			
			$this->request->data['WorkingHour']['saturday_from'] = $time[0]->fromTime;
			$this->request->data['WorkingHour']['saturday_to'] = $time[0]->toTime;
			
			$this->request->data['WorkingHour']['sunday_from'] = $time[1]->fromTime;
			$this->request->data['WorkingHour']['sunday_to'] = $time[1]->toTime;

			$this->request->data['WorkingHour']['monday_from'] = $time[2]->fromTime;
			$this->request->data['WorkingHour']['monday_to'] = $time[2]->toTime;

			$this->request->data['WorkingHour']['tuesday_from'] = $time[3]->fromTime;
			$this->request->data['WorkingHour']['tuesday_to'] = $time[3]->toTime;

			$this->request->data['WorkingHour']['wednesday_from'] = $time[4]->fromTime;
			$this->request->data['WorkingHour']['wednesday_to'] = $time[4]->toTime;

			$this->request->data['WorkingHour']['thursday_from'] = $time[5]->fromTime;
			$this->request->data['WorkingHour']['thursday_to'] = $time[5]->toTime;

			$this->request->data['WorkingHour']['friday_from'] = $time[6]->fromTime;
			$this->request->data['WorkingHour']['friday_to'] = $time[6]->toTime;

            //pr($this->request->data); die; 
			$this->WorkingHour->id = $_REQUEST['id'];
		    $this->WorkingHour->save($this->request->data);
			$this->Basic->response(200,'get_data');
		}
		else
		{
			$this->Basic->response(404,'required_data');
		}
		
	}

	public function api_updateShop(){
     
		if(isset($_REQUEST['online'])){
			$this->request->data['Shop']['online'] = $_REQUEST['online'];
		}

		if(isset($_REQUEST['chat'])){
			$this->request->data['Shop']['chat'] = $_REQUEST['chat'];
		}
		
		if(isset($_REQUEST['open'])){
			$this->request->data['Shop']['open'] = $_REQUEST['open'];
		}

		if(!empty($_REQUEST['shop_id'])){
			$this->Shop->id = $_REQUEST['shop_id'];
		}
        else
		{
            $this->Basic->response(401,'not_found');
		}

		//pr($this->request->data); die; 
	    if($this->Shop->save($this->request->data)) {
			$this->Basic->response(200,'get_data',$this->getShop($_REQUEST['shop_id']));
		}
		else
		{
			foreach($this->User->validationErrors as $error){
			}
			$this->Basic->response(404,$error[0]);
			//$results = array('mesg' => __($error[0]), 'response' => '0');
		}
    }
	
	public function api_sendNotify(){
        //shop_id,provider_id,title,description
		if(!empty($_REQUEST['shop_id']) && !empty($_REQUEST['title']) && !empty($_REQUEST['description'])){
            $users = $this->Bookmark->find('list',array('conditions'=>array('Bookmark.shop_id'=>$_REQUEST['shop_id'],'Bookmark.status'=>'1'),'fields'=>array('Bookmark.user_id')));
			
			if($users){
				$this->Basic->saveNotify($_REQUEST['shop_id'],$users,$_REQUEST['title'],$_REQUEST['description']);
				$this->Basic->response(200,'get_data');
			}else{
				$this->Basic->response(404,'get_data');
			}
		}else{
			$this->Basic->response(404,'required_data');
		}
		a:
		echo json_encode($results);
		exit;
	}

	public function api_getShop(){

		if(!empty($_REQUEST['shop_id'])){
            if(!empty($_REQUEST['user_id'])){
				$shop = $this->getShop($_REQUEST['shop_id'],$_REQUEST['user_id']);
			}else{
                $shop = $this->getShop($_REQUEST['shop_id']);
			}
			
			if($shop){
				$this->Shop->updateAll(array('Shop.total_views' => 'Shop.total_views + 1'),array('Shop.id' => $_REQUEST['shop_id']));

				$this->Basic->response(200,'get_data',$shop);
			}else{
				$this->Basic->response(404,'not_found');
			}
		}else{
			$this->Basic->response(404,'required_data');
		}
		a:
		echo json_encode($results);
		exit;
	}
	
	public function api_getallShop(){
        // recommend,near_by, top-rated,recently changed 
		// if(!empty($_REQUEST['shop_id'])){

			
			// get recommended shop
			$order = 'Shop.id DESC';
			$rcond = array();
			$rcond['Shop.recommend'] = '1';
			if(!empty($_REQUEST['subcat_id'])){
				//$rcond['Shop.sub_cat'] = $_REQUEST['subcat_id'];
				$rcond['FIND_IN_SET(?, Shop.sub_cat)'] = $_REQUEST['subcat_id'];
			}
			$recommends = $this->Shop->find('list',array('conditions'=>$rcond,'order'=>$order));
			//pr($recommends); die;
			if(!empty($recommends)){
				foreach($recommends as $shop){
					$shopArr['recommended'][] = $this->getShop($shop);
				}
			}else{
				$shopArr['recommended'] = array();
			}
			 
			// get near by shop
			$condNear = array();
			if(!empty($_REQUEST['subcat_id'])){
				//$condNear['FIND_IN_SET(?, Shop.sub_cat)'] = $_REQUEST['subcat_id'];
				$condNear['FIND_IN_SET(?, Shop.sub_cat)'] = $_REQUEST['subcat_id'];
			}
			if(!empty($_REQUEST['lat']) && !empty($_REQUEST['lng'])){
				$latitude = $_REQUEST['lat'];
				$longitude = $_REQUEST['lng'];
				$this->Shop->virtualFields
				= array('distance'
				=> '(3959 * acos (cos ( radians('.$latitude.') )
				* cos( radians( Shop.lat ) )
				* cos( radians( Shop.lng )
				- radians('.$longitude.') )
				+ sin ( radians('.$latitude.') )
				* sin( radians( Shop.lat ) )))');
		
				//$condNear['Shop.distance <'] = 1;
		        $order = 'Shop.distance DESC';
				}
		    else
			{
				$this->Shop->virtualFields['distance'] = '0.00';
				
			}
            
			$nears = $this->Shop->find('list',array('conditions'=>$condNear,'fields'=>array('id','distance'),'order'=>$order));
			//pr($nears); die;
			if(!empty($nears)){
				foreach($nears as $shop =>$distance){
					$shopdata = $this->getShop($shop);
					$shopdata['distance'] = round($distance,'2');
					$shopArr['near_by'][] = $shopdata;
				}
			}else{
				$shopArr['near_by'] = array();
			}
			
			$condRate = array();
			if(!empty($_REQUEST['subcat_id'])){
				//$condRate['Shop.sub_cat'] = $_REQUEST['subcat_id'];
				$condRate['FIND_IN_SET(?, Shop.sub_cat)'] = $_REQUEST['subcat_id'];
			}
			// get rated shop
			$rates = $this->Shop->find('list',array('conditions'=>$condRate,'order'=>$order));
			if(!empty($rates)){
				foreach($rates as $shop){
					$shopArr['top_rated'][] = $this->getShop($shop);
				}
			}else{
				$shopArr['top_rated'] = array();
			}
			
			// get recents shop

			$condRecent = array();
			$condRecent['Shop.modified >='] = date('Y-m-d H:i:s', strtotime('-7 days'));
			
			if(!empty($_REQUEST['subcat_id'])){
				//$condRecent['Shop.sub_cat'] = $_REQUEST['subcat_id'];
				$condRecent['FIND_IN_SET(?, Shop.sub_cat)'] = $_REQUEST['subcat_id'];
			}

            $order = 'Shop.modified ASC';
			$recents = $this->Shop->find('list',array('conditions'=>$condRecent,'order'=>$order));
			if(!empty($recents)){
				foreach($recents as $shop){
					$shopArr['recent_changed'][] = $this->getShop($shop);
				}
			}else{
				$shopArr['recent_changed'] = array();
			}
			
			//pr($shopArr); die;
			if($shopArr){
				
				$this->Basic->response(200,'get_data',$shopArr);
			}else{
				$this->Basic->response(404,'not_found');
			}
		// }else{
		// 	$this->Basic->response(404,'required_data');
		// }
		a:
		echo json_encode($results);
		exit;
	}
	
	public function api_getallRecommendShop(){
        // recommend,near_by, top-rated,recently changed 
		// if(!empty($_REQUEST['shop_id'])){
		   $cond = $filterdata = array();
		   $cond['Shop.recommend'] = '1';
		   if(!empty($_REQUEST['filter'])){
			 $filterdata  = explode(',',$_REQUEST['filter']);
		   }
		   //pr($filterdata); die;
		   if(!empty($_REQUEST['subcat_id'])){
			   //$cond['Shop.sub_cat'] = $_REQUEST['subcat_id'];
			   $cond['FIND_IN_SET(?, Shop.sub_cat)'] = $_REQUEST['subcat_id'];
		   }
		   $order = 'Shop.id DESC';

		   if(!empty($_REQUEST['filter']) && in_array("1", $filterdata)){
			  $cond['Shop.open'] = '1';
			  
           }


		   if(!empty($_REQUEST['filter']) && in_array("2", $filterdata)){
			   $cond['Shop.online'] = '1';
			   //$recommends = $this->Shop->find('list',array('conditions'=>$cond,'order'=>$order));
		   }
			
		   if(!empty($_REQUEST['filter'])  && in_array("3", $filterdata)){
			   if(!empty($_REQUEST['user_id'])){
				   $shops = $this->Bookmark->find('list',array('conditions'=>array('Bookmark.user_id'=>$_REQUEST['user_id'],'Bookmark.status'=>'1'),'fields'=>array('Bookmark.shop_id')));
			       $cond['Shop.id'] = $shops;
			   }
			  
			  //$recommends = $this->Shop->find('list',array('conditions'=>$cond,'order'=>$order));

		   }
			
		   if(!empty($_REQUEST['filter']) && in_array("4", $filterdata)){
			  $cond['Shop.chat'] = '1';
			   //$recommends = $this->Shop->find('list',array('conditions'=>$cond,'order'=>$order));
		   }
           //pr($cond); die;
		   $recommends = $this->Shop->find('list',array('conditions'=>$cond,'order'=>$order));
			if(!empty($recommends)){
				foreach($recommends as $shop){
					if(!empty($_REQUEST['user_id'])){
						$shopData = $this->getShop($shop,$_REQUEST['user_id']);
					}else{
						$shopData = $this->getShop($shop);
					}
				    $shopArr[] = $shopData;
				}
			}else{
				$shopArr = array();
			} 
		   
		  	//pr($shopArr); die;
			if($shopArr){
				$this->Basic->response(200,'get_data',$shopArr);
			}else{
				$this->Basic->response(404,'not_found');
			}
		// }else{
		// 	$this->Basic->response(404,'required_data');
		// }
		a:
		echo json_encode($results);
		exit;
	}

	public function api_getallNearShop(){
        // recommend,near_by, top-rated,recently changed 
		// if(!empty($_REQUEST['shop_id'])){
			 // get near by shop
			 $cond = $filterdata = array();
			if(!empty($_REQUEST['subcat_id'])){
				//$cond['Shop.sub_cat'] = $_REQUEST['subcat_id'];
				$cond['FIND_IN_SET(?, Shop.sub_cat)'] = $_REQUEST['subcat_id'];
			}

			if(!empty($_REQUEST['filter'])){
				$filterdata  = explode(',',$_REQUEST['filter']);
		    }

		    $order = 'Shop.id DESC';
			
			if(!empty($_REQUEST['lat']) && !empty($_REQUEST['lng'])){
				$latitude = $_REQUEST['lat'];
				$longitude = $_REQUEST['lng'];
				$this->Shop->virtualFields
				= array('distance'
				=> '(3959 * acos (cos ( radians('.$latitude.') )
				* cos( radians( Shop.lat ) )
				* cos( radians( Shop.lng )
				- radians('.$longitude.') )
				+ sin ( radians('.$latitude.') )
				* sin( radians( Shop.lat ) )))');
		
				//$condNear['Shop.distance <'] = 1;
				$order = 'Shop.distance DESC';
				}
			else
			{
				$this->Shop->virtualFields['distance'] = '0.00';
				
			}

		    if(!empty($_REQUEST['filter']) && in_array("1", $filterdata)){
				$cond['Shop.open'] = '1';
				//$nears = $this->Shop->find('list',array('conditions'=>$cond,'fields'=>array('id','distance'),'order'=>$order));
			}
  
  
			if(!empty($_REQUEST['filter']) && in_array("2", $filterdata)){
				 $cond['Shop.online'] = '1';
				// $nears = $this->Shop->find('list',array('conditions'=>$cond,'fields'=>array('id','distance'),'order'=>$order));
			}
			  
			if(!empty($_REQUEST['filter']) && in_array("3", $filterdata)){
				if(!empty($_REQUEST['user_id'])){
					$shops = $this->Bookmark->find('list',array('conditions'=>array('Bookmark.user_id'=>$_REQUEST['user_id'],'Bookmark.status'=>'1'),'fields'=>array('Bookmark.shop_id')));
					$cond['Shop.id'] = $shops;
				}
				//$nears = $this->Shop->find('list',array('conditions'=>$cond,'fields'=>array('id','distance'),'order'=>$order));
  
			}
			  
			if(!empty($_REQUEST['filter']) && in_array("4", $filterdata)){
				 $cond['Shop.chat'] = '1';
				 
			}
            $nears = $this->Shop->find('list',array('conditions'=>$cond,'fields'=>array('id','distance'),'order'=>$order)); 
			if(!empty($nears)){
				foreach($nears as $shop =>$distance){
					if(!empty($_REQUEST['user_id'])){
						$shopData = $this->getShop($shop,$_REQUEST['user_id']);
					}else{
						$shopData = $this->getShop($shop);
					}
					//pr($shopData);
				    //$shopArr[] = $shopData;
					$shopData['distance'] = round($distance,'2');
					$shopArr[] = $shopData;
				}
			}else{
				$shopArr = array();
			}
		   
		   //pr($shopArr); die;
			if($shopArr){
				
				$this->Basic->response(200,'get_data',$shopArr);
			}else{
				$this->Basic->response(404,'not_found');
			}
		// }else{
		// 	$this->Basic->response(404,'required_data');
		// }
		a:
		echo json_encode($results);
		exit;
	}
	
	public function api_getallRatedShop(){
        // recommend,near_by, top-rated,recently changed 
		// if(!empty($_REQUEST['shop_id'])){
		$cond = $filterdata = array();
		$order = 'Shop.id DESC';

        if(!empty($_REQUEST['subcat_id'])){
			//$cond['Shop.sub_cat'] = $_REQUEST['subcat_id'];
			$cond['FIND_IN_SET(?, Shop.sub_cat)'] = $_REQUEST['subcat_id'];
		}
		
		if(!empty($_REQUEST['filter'])){
			$filterdata  = explode(',',$_REQUEST['filter']);
		}

		if(!empty($_REQUEST['filter']) && in_array("1", $filterdata)){
			$cond['Shop.open'] = '1';
			//$rates = $this->Shop->find('list',array('conditions'=>$cond,'order'=>$order));
		}


		if(!empty($_REQUEST['filter']) && in_array("2", $filterdata)){
			 $cond['Shop.online'] = '1';
			// $rates = $this->Shop->find('list',array('conditions'=>$cond,'order'=>$order));
		}
		  
		if(!empty($_REQUEST['filter']) && in_array("3", $filterdata)){
			if(!empty($_REQUEST['user_id'])){
				$shops = $this->Bookmark->find('list',array('conditions'=>array('Bookmark.user_id'=>$_REQUEST['user_id'],'Bookmark.status'=>'1'),'fields'=>array('Bookmark.shop_id')));
				$cond['Shop.id'] = $shops;
			}
			//$rates = $this->Shop->find('list',array('conditions'=>$cond,'order'=>$order));

		}
		  
		if(!empty($_REQUEST['filter']) && in_array("4", $filterdata)){
			 $cond['Shop.chat'] = '1';
			 
		}
		$rates = $this->Shop->find('list',array('conditions'=>$cond,'order'=>$order));
			
			if(!empty($rates)){
				foreach($rates as $shop){
					if(!empty($_REQUEST['user_id'])){
						$shopData = $this->getShop($shop,$_REQUEST['user_id']);
					}else{
						$shopData = $this->getShop($shop);
					}
				    $shopArr[] = $shopData;
				}
			}else{
				$shopArr = array();
			} 
		    
			//pr($shopArr); die;
			if($shopArr){
				
				$this->Basic->response(200,'get_data',$shopArr);
			}else{
				$this->Basic->response(404,'not_found');
			}
		// }else{
		// 	$this->Basic->response(404,'required_data');
		// }
		a:
		echo json_encode($results);
		exit;
	}

	public function api_getallRecentShop(){
        // recommend,near_by, top-rated,recently changed 
		// if(!empty($_REQUEST['shop_id'])){
			$cond = $filterdata = array();
			
			if(!empty($_REQUEST['filter'])){
				$filterdata  = explode(',',$_REQUEST['filter']);
			}

			if(!empty($_REQUEST['subcat_id'])){
				//$cond['Shop.sub_cat'] = $_REQUEST['subcat_id'];
				$cond['FIND_IN_SET(?, Shop.sub_cat)'] = $_REQUEST['subcat_id'];
			}
 
			$cond['Shop.modified >='] = date('Y-m-d H:i:s', strtotime('-7 days'));
			$order = 'Shop.modified ASC';
	
			if(!empty($_REQUEST['filter']) && in_array("1", $filterdata)){
				$cond['Shop.open'] = '1';
			}
	
	
			if(!empty($_REQUEST['filter']) && in_array("2", $filterdata)){
				 $cond['Shop.online'] = '1';
			}
			  
			if(!empty($_REQUEST['filter']) && in_array("3", $filterdata)){
				if(!empty($_REQUEST['user_id'])){
					$shops = $this->Bookmark->find('list',array('conditions'=>array('Bookmark.user_id'=>$_REQUEST['user_id'],'Bookmark.status'=>'1'),'fields'=>array('Bookmark.shop_id')));
					$cond['Shop.id'] = $shops;
				}
			}
			  
			if(!empty($_REQUEST['filter']) && in_array("4", $filterdata)){
				 $cond['Shop.chat'] = '1';
				 
			}

			$recents = $this->Shop->find('list',array('conditions'=>$cond,'order'=>$order)); 
			if(!empty($recents)){
				foreach($recents as $shop){
					if(!empty($_REQUEST['user_id'])){
						$shopData = $this->getShop($shop,$_REQUEST['user_id']);
					}else{
						$shopData = $this->getShop($shop);
					}
				    $shopArr[] = $shopData;
				}
			}else{
				$shopArr = array();
			}
		   
            
			//pr($shopArr); die;
			if($shopArr){
				
				$this->Basic->response(200,'get_data',$shopArr);
			}else{
				$this->Basic->response(404,'not_found');
			}
		// }else{
		// 	$this->Basic->response(404,'required_data');
		// }
		a:
		echo json_encode($results);
		exit;
	}

    public function api_myShops(){

		if(!empty($_REQUEST['user_id'])){
		   $shops = $this->Shop->find('list',array('conditions'=>array('Shop.user_id'=>$_REQUEST['user_id']),'fields'=>array('Shop.id')));
		   if($shops){
			   foreach($shops as $shop){
				   if(!empty($_REQUEST['user_id'])){
						  $shopData = $this->getShop($shop,$_REQUEST['user_id']);
				   }else{
					   $shopData = $this->getShop($shop);
				   }
				   $shopArr[] = $shopData;
			   }
			   $this->Basic->response(200,'get_data',$shopArr);
		   }else{
			   $this->Basic->response(404,'not_found');
		   }
		}else{
				$this->Basic->response(404,'required_data');
		}
	   a:
	   echo json_encode($results);
	   exit;
   }

	public function api_getFavShop(){

		 if(!empty($_REQUEST['user_id'])){
			$shops = $this->Bookmark->find('list',array('conditions'=>array('Bookmark.user_id'=>$_REQUEST['user_id'],'Bookmark.status'=>'1'),'fields'=>array('Bookmark.shop_id')));
			if($shops){
				foreach($shops as $shop){
					if(!empty($_REQUEST['user_id'])){
                           $shopData = $this->getShop($shop,$_REQUEST['user_id']);
					}else{
                        $shopData = $this->getShop($shop);
					}
					$shopArr[] = $shopData;
				}
				$this->Basic->response(200,'get_data',$shopArr);
			}else{
				$this->Basic->response(404,'not_found');
			}
		 }else{
		 	    $this->Basic->response(404,'required_data');
		 }
		a:
		echo json_encode($results);
		exit;
	}
	
	public function api_getGallery(){

		if(!empty($_REQUEST['shop_id'])){
			$id = $_REQUEST['shop_id'];
			$galleryeList = $this->Gallery->find('all',array('conditions'=>array('Gallery.shop_id'=>$id),'fields'=>array("image","price","currency","desc")));
            
		    if(!empty($galleryeList)){
				$galleryeList = Set::extract('/Gallery/.', $galleryeList);
			}

			$videoList = $this->Video->find('all',array('conditions'=>array('Video.shop_id'=>$id),'fields'=>array("id","video_url")));
            
		    if(!empty($videoList)){
				$videoList = Set::extract('/Video/.', $videoList);
			}

		  
		   if($galleryeList || $videoList){
			  
			  $this->Basic->response(200,'get_data',array('images'=>$galleryeList,'videos'=>$videoList));
		   }else{
			   $this->Basic->response(404,'not_found');
		   }
		}else{
				$this->Basic->response(404,'required_data');
		}
	   a:
	   echo json_encode($results);
	   exit;
   }

	public function api_makeFav() {

        $language = $_REQUEST['lang'];
        if (!empty($_REQUEST['user_id']) && !empty($_REQUEST['shop_id']) && isset($_REQUEST['status'])) {
            $this->request->data['Bookmark']['user_id'] = $_REQUEST['user_id'];
            $this->request->data['Bookmark']['shop_id'] = $_REQUEST['shop_id'];
            $this->request->data['Bookmark']['status'] = $_REQUEST['status'];
			$dataExsists = $this->Bookmark->findByUserIdAndShopId($_REQUEST['user_id'],$_REQUEST['shop_id']);
			if(!empty($dataExsists)){
                $this->Bookmark->id = $dataExsists['Bookmark']['id'];
			}else{
				$this->Bookmark->create();
			}
            if ($this->Bookmark->save($this->request->data)) {

                $this->Basic->response(200,'get_data');
            } else {
                $this->Basic->response(404,'server_error');
            }
        } else {
            $this->Basic->response(404,'required_data');
        }

        a:
        echo json_encode($results);
        exit;
	}
	
	public function api_giveRating() {

        $language = $_REQUEST['lang'];
        if (!empty($_REQUEST['shop_id']) && !empty($_REQUEST['user_id'])) {
            $this->request->data['Rating']['user_id'] = $_REQUEST['user_id'];
			$this->request->data['Rating']['shop_id'] = $_REQUEST['shop_id'];
			if(!empty($_REQUEST['rating'])){
				$this->request->data['Rating']['rating'] = $_REQUEST['rating'];
			}
			if(!empty($_REQUEST['comment'])){
				$this->request->data['Rating']['comment'] = $_REQUEST['comment'];
			}
            //$this->request->data['Rating']['status'] = $_REQUEST['status'];
			$dataExsists = $this->Rating->findByUserIdAndShopId($_REQUEST['user_id'],$_REQUEST['shop_id']);
			if(!empty($dataExsists)){
                $this->Rating->id = $dataExsists['Rating']['id'];
			}else{
				$this->Rating->create();
			}
            if ($this->Rating->save($this->request->data)) {

                $this->Basic->response(200,'get_data');
            } else {
                $this->Basic->response(404,'server_error');
            }
        } else {
            $this->Basic->response(404,'required_data');
        }

        a:
        echo json_encode($results);
        exit;
	}

	public function api_getUser(){

		if(!empty($_REQUEST['user_id'])){
			$user = $this->getUser($_REQUEST['user_id']);
			if($user){
				$this->Basic->response(200,'get_data',$user);
			}else{
				$this->Basic->response(404,'not_found');
			}
		}else{
			$this->Basic->response(404,'required_data');
		}
		a:
		echo json_encode($results);
		exit;
	}

	public function api_contact(){

		if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['message']) && !empty($_REQUEST['email'])){

			$this->request->data['Contact']['user_id'] = $_REQUEST['user_id'];
			$this->request->data['Contact']['email'] = $_REQUEST['email'];
			if(!empty($_REQUEST['message'])){
				$this->request->data['Contact']['message'] = $_REQUEST['message'];
			}
			if($this->Contact->save($this->request->data)){
				$this->Basic->response(200,'conatct_saved');
			}else{
				$this->Basic->response(404,'server_error');
			}
		}else{
			$this->Basic->response(404,'required_data');
		}
  	}

	
	public function api_privacy(){

		$language = $_REQUEST['lang'];
		$terms = $this->Privacy->find('first',array('fields'=>array("info_$language")));
		//pr($terms); die;
		if(!empty($terms)){
			$this->Basic->response(200,'get_data',$terms['Privacy']["info_$language"]);
		}
		else
		{
			$this->Basic->response(404,'not_found');
		}
	}
	

	public function api_forgetPassword(){
		if(isset($_REQUEST['userType']) && isset($_REQUEST['phone'])) {
			$phone = $_REQUEST['phone'];
			$user = $this->User->find('first',array('conditions'=>array('User.phone'=>$phone,'User.userType'=>$_REQUEST['userType'])));
			
			if((count($user)>0)){
				$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
				$key = rand(100000,999999);
				$this->request->data['User']['password'] = $key;
				$this->User->id = $user['User']['id'];
			if ($this->User->save($this->request->data)){
                $this->Basic->response(200,'temporary_password',array('temp_pass'=>$key));
			}else{
				$this->Basic->response(404,'not_found');
			}
		}else{
			$this->Basic->response(404,'not_found');
		}
		}else{
			$this->Basic->response(404,'required_data');
		}
		echo json_encode($results);
		exit;
	}


	public function api_changePassword(){

		if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['oldPass']) && !empty($_REQUEST['newPass']))
		{
			$id = $this->User->find('first',array('conditions'=>array('User.id'=>$_REQUEST['user_id'])));
			$pass=Security::hash($_REQUEST['oldPass'], 'md5', true);
			$userData = $this->User->find('first',array('conditions'=>array('User.id'=>$_REQUEST['user_id'],'User.password'=>$pass,'User.userType !='=>'3')));
			if(!empty($userData)){
				$ids = $userData['User']['id'];
				$this->request->data['User']['password'] = (!empty($_REQUEST['newPass']))?$_REQUEST['newPass']:'';
				$this->request->data['User']['pass'] = (!empty($_REQUEST['newPass']))?$_REQUEST['newPass']:'';
			}
			else
			{
				$this->Basic->response(404,'wrong_password');
			}
			$this->User->id = $ids;
			$user = $this->User->save($this->request->data);

			if ($user) {
				if(!empty($this->User->getLastInsertid())){
					$ids = $this->User->getLastInsertid();
				}
				$this->Basic->response(200,'password_success',$this->getUser($ids));
			}
			else {
				foreach($this->User->validationErrors as $error){
					//$results = array('mesg' => __($error[0]), 'response' => '0');
				}
				$this->Basic->response(404,$error[0]);
			}
		}
		else
		{   
			$this->Basic->response(404,'required_data');
		}
		a:
		echo json_encode($results);
		exit;
	}


	public function api_socialLogin(){
		if(isset($_REQUEST['social_id']) && $_REQUEST['social_id'] !==''){

			$data['User']['social_id'] = $_REQUEST['social_id'];
			$data['User']['name'] = isset($_REQUEST['name']) && $_REQUEST['name'] !==''?$_REQUEST['name']:'';
			
			if(!empty($_REQUEST['deviceToken'])){
				$data['User']['deviceToken'] = $_REQUEST['deviceToken'];
			}
			if(!empty($_REQUEST['email'])){
				$data['User']['email'] = $_REQUEST['email'];
			}
			if(!empty($_REQUEST['phone'])){
				$data['User']['phone'] = $_REQUEST['phone'];
			}
			if(!empty($_REQUEST['socialType'])){
				$data['User']['socialType'] = $_REQUEST['socialType'];
			}
			if(!empty($_REQUEST['deviceType'])){
				$data['User']['deviceType'] = $_REQUEST['deviceType'];
			}

			if(!empty($_FILES['image'])){
				if(isset($_FILES['image']) && $_FILES['image']['name'] !== '' && !empty($_FILES['image']['name'])){
					$file = $_FILES['image'];
					$file = preg_replace("/[^a-zA-Z0-9.]/", "", $file['name']);
					$filename = time().'-'.$file;
				$ext = substr(strtolower(strrchr($file, '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions

				if(in_array($ext, $arr_ext))
				{
				$path="img/users/";
				if(move_uploaded_file($_FILES['image']['tmp_name'],$path.$filename)){

				$data['User']['image'] = $path.$filename;
				}
				}else{
					$this->Basic->response(404,'valid_image');
				
				}
				}
			}
			$data['User']['userType'] = 1;
			$data['User']['status'] = 1;
			$userArr = $this->User->find('first',array('conditions'=>array('User.social_id'=>$_REQUEST['social_id'],'User.userType'=>1)));


			if(count($userArr) >0){
			$data['User']['id'] = $userArr['User']['id'];
			}
			else
			{
				$this->User->create();
			}
	//unset($this->User->validate['email']);

		if($this->User->save($data)){
			if(count($userArr) > 0){
				$userID	 = $userArr['User']['id'];
			}else {
				$userID = $this->User->getLastInsertId();
			}
			//$userDetails = $this->User->findById($userID);
			$this->Basic->response(200,'user_logged_in',$this->getUser($userID));
		}else{
			foreach($this->User->validationErrors as $error){
			}
			$this->Basic->response(404,$error[0]);
		}

		} else{
			$this->Basic->response(404,'required_data');
		}

	}



	public function api_term(){

		$terms = $this->Term->find('first',array('fields'=>array('info')));
		if(!empty($terms)){
			$results = array('mesg' => "Data listed succesfully", 'response' => '1','data'=>$terms['Term']['info']);
		}
		else
		{
			$results = array('mesg' => "No record found", 'response' => '0');
		}
		a:
		echo json_encode($results);
		exit;
	}

	public function api_about(){
		$language = $_REQUEST['lang'];
		$terms = $this->About->find('first',array('fields'=>array("info_$language")));
		//pr($terms); die;
		if(!empty($terms)){
			$this->Basic->response(200,'get_data',$terms['About']["info_$language"]);
		}
		else
		{
			$this->Basic->response(404,'not_found');
		}
		a:
		echo json_encode($results);
		exit;
	}

	#---------Function to fetch user detail ------------#
	public function getUser($id=null,$other_id=null) {

		$user = $this->User->find('first',array('conditions'=>array('User.id'=>$id),'fields'=>array('User.id','User.name','User.email','User.deviceType','User.deviceToken','User.userType','User.image','User.phone')));

		if(!empty($user)){
			$user = $user['User'];
		}

		return $user;
	}
	
	public function getShop($id=null,$user_id=null) {
		//,'fields'=>array('User.id','User.name','User.email','User.deviceType','User.deviceToken','User.userType','User.image','User.phone')
		$language = $_REQUEST['lang'];
		$this->Shop->virtualFields['name'] = "name_$language";
		$this->Shop->virtualFields['address'] = "address_$language";
		$this->Shop->virtualFields['desc'] = "desc_$language";

		$shop = $this->Shop->find('first',array('conditions'=>array('Shop.id'=>$id)));

		if(!empty($shop)){
			unset($shop['Shop']['name_en']);
		    unset($shop['Shop']['name_ar']);
			unset($shop['Shop']['name_ku']);
			
			unset($shop['Shop']['address_en']);
		    unset($shop['Shop']['address_ar']);
			unset($shop['Shop']['address_ku']);
			
			unset($shop['Shop']['desc_en']);
		    unset($shop['Shop']['desc_ar']);
			unset($shop['Shop']['desc_ku']);

			$shop = $shop['Shop'];

            // get services list start
			$serviceList = $this->ShopService->find('list',array('conditions'=>array('ShopService.shop_id'=>$id),'fields'=>array("service_id")));
            
			$this->Service->virtualFields['name'] = "name_$language";
			$ser_list = $this->Service->find('all',array('conditions'=>array('Service.id'=>$serviceList),'fields'=> array('id',"name","image"),'order'=>'Service.id desc'));
			
		    if(!empty($ser_list)){
				$ser_list = Set::extract('/Service/.', $ser_list);
			}
			$shop['services'] = $ser_list;
			// get services list end
			
			// get gallery list start
			$galleryeList = $this->Gallery->find('all',array('conditions'=>array('Gallery.shop_id'=>$id),'fields'=>array("image","price","currency","desc")));
            
		    if(!empty($galleryeList)){
				$galleryeList = Set::extract('/Gallery/.', $galleryeList);
			}
			$shop['galleries'] = $galleryeList;
			// get gallery list end
			
			//get working hours start
			$workingHours = $this->WorkingHour->find('first',array('conditions'=>array('WorkingHour.shop_id'=>$id)));
            //pr($workingHours); die;
		    if(!empty($workingHours)){
				$workingHours = $workingHours['WorkingHour'];
			}else{
				$workingHours =  new stdClass();
			}
			$shop['workingHours'] = $workingHours;
			//get working hours end
			
			// shop fav or not
			if(!empty($user_id)){
				$fav = $this->Bookmark->find('first',array('conditions'=>array('Bookmark.user_id'=>$user_id,'Bookmark.shop_id'=>$id,'Bookmark.status'=>'1')));
				if($fav){
					$shop['fav'] = 1;
				}else{
					$shop['fav'] = 0;
				}
			}else{
                $shop['fav'] = 0;
			}
			
           
			
			
			// get reviews start
			$ratings = $this->Rating->find('all',array('conditions'=>array('Rating.shop_id'=>$id),'order'=>'Rating.id desc'));
			$reviewArr = array();
			$ratingCount = 0;
			if($ratings){
				foreach($ratings as $rating){ //pr($rating); die;
					$user = $this->User->findById($rating['Rating']['user_id']);
					$rating['Rating']['image'] = $user['User']['image'];
					$rating['Rating']['name'] = $user['User']['name'];
					$rating['Rating']['time'] = $this->Basic->time_elapsed_string($rating['Rating']['created']);	
					$reviewArr[] = $rating['Rating'];
					$ratingCount += $rating['Rating']['rating'];
				}
			}
			//echo count($ratings);
			//pr($ratingCount/count($ratings)); die;
			$shop['ratingCount'] = count($ratings);
            $shop['reviews'] = $reviewArr;
			$shop['rating'] = (!empty($ratingCount))?($ratingCount/count($ratings)):0;
			// get reviews end
			$shop['notifyCount'] = 0;
			
		}
		
		return $shop;
	}

	function searchForId($id, $array) {
		foreach ($array as $key => $val) {
			if (strtolower($val['key']) == strtolower($id)) {
				return $key;
			}
		}
		return null;
	}


}
