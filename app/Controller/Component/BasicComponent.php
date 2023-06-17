<?php

App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class BasicComponent extends Component {

	//public $uses = array('User'); 

   public function __construct() {
         $this->User = ClassRegistry::init('User');
         $this->Notification = ClassRegistry::init('Notification');
         $this->Setting = ClassRegistry::init('Setting');
        //$this->Location = ClassRegistry::init('Location');
   }

   public function logData($fn, $input) {
        $result = json_encode($input);
        $data = date('Y-m-d H:i:s') . "  http://ec2-54-201-91-176.us-west-2.compute.amazonaws.com/api/apis/" . $fn . "?data=" . $result . "";
        $fp = fopen('api_data.txt', 'a+');
        fwrite($fp, print_r($data . "\n\n", TRUE));
        fclose($fp);
   }
    
   public function saveNotify($shop_id,$users,$title,$message){ 
       
        $data['Notification']['shop_id']  =  $shop_id;
        $data['Notification']['users']  =  implode(',',$users);
        $data['Notification']['desc']  =  $message;
        $data['Notification']['title']    =  $title;
        $this->Notification->create();
        if($this->Notification->save($data)){
            foreach($users as $user){
                $notifyuser = $this->User->findById($user);
                //pr($notifyuser); die;
                if($notifyuser['User']['deviceType'] == 'ios'){
                    $this->send_inotification($notifyuser['User']['deviceToken'],$title,$message);
                }else if($notifyuser['User']['deviceType'] == 'android'){
                    $this->send_notification($notifyuser['User']['deviceToken'],$message,$title);
                }
            }
        }
        return true;
   }

    public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

   public function getLastQuery() {
        $dbo = ConnectionManager::getDataSource('default');
        $logs = $dbo->getLog();
        $lastLog = end($logs['log']);
        return $lastLog['query'];
   }
   
   public function response($status,$status_message,$data=null) {
      //header("HTTP/1.1 $status $status_message");
      //header($_SERVER['SERVER_PROTOCOL'] . $status_message, true, $status);
      $status_codes = array (
        200 => 'Success',
        401 => 'Unauthorized',
        404 => 'Not Found',
        500 => 'Internal Server Error',
      );
      //$status_string = $status . ' ' . $status_codes[$status];
      $status_string = $status . ' ' . __($status_message);
      header($_SERVER['SERVER_PROTOCOL'] . ' ' . $status_string, true, $status);
      $results = array();
      if(!empty($status_message)){
           //$results['mesg'] = __($status_message);
      }
      if(!empty($data)){
        $results['data'] = $data;
      }else{
        $results['data'] = new StdClass; 
      }
      
      echo json_encode($results);
      exit;
   }

   public function sendEmail($email, $subject, $message) {
        $Email = new CakeEmail();
        //$Email->config('smtp');
        $Email->emailFormat('html');
        $Email->from(array('postmaster@localhost' => PROJECT_NAME));
        $Email->to($email);
        $Email->subject($subject);
        if ($Email->send($message)) {
            return true;
        } else {
            return false;
        }
   }

   public function sendHtmlEmail($to, $from = '', $subject, $body, $template, $attachment = '', $cc = '', $bcc = '') {
    $email = new CakeEmail();

    if (!empty($attachment)) {
        $email->attachments($attachment);
    }

    if (env('HTTP_HOST') == 'localhost') {
        $email->config('default');
    }
    $email->viewVars(array('body' => $body));
    $email->template($template, null);
    $email->emailFormat('html');
    $email->from(array('postmaster@localhost' => PROJECT_NAME));
    $email->to($to);
    if (!empty($cc)) {
        $email->cc($cc);
    }
    if (!empty($bcc)) {
        $email->bcc($bcc);
    }
    $email->subject($subject);


    try {
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

   public function send_inotification($user_id,$title,$msg,$type=null,$ride_id=null) {
		$user = $this->User->findById($user_id); 
	
     	if(!empty($user)){

			$reg_id = $user['User']['deviceToken'];
			
			if($user['User']['userType'] == '1'){
				$passphrase = '12345';
			    $ctx = stream_context_create();
			    stream_context_set_option($ctx, 'ssl', 'local_cert', ROOT.'/app/webroot/GoTaxiDriver.pem');
			}else{
				$passphrase = '12345';
			    $ctx = stream_context_create();
			    stream_context_set_option($ctx, 'ssl', 'local_cert', ROOT.'/app/webroot/GoTaxi_user12345.pem');
			}

        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        
        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        //echo 'Connected to APNS' . PHP_EOL;
        
		$body['aps'] = array(
			'alert' => array("title"=>$title,"body"=>$msg),
			'sound' => 'default',  
			'content-available'=>true,
		);
		
		$body['type'] = !empty($type)?$type:'';
		$body['data'] = array('ride_id' => !empty($ride_id)?$ride_id:'');
			
        // Encode the payload as JSON
        $payload = json_encode($body);
        // Build the binary notification

        $msg = chr(0) . pack('n', 32) . pack('H*', $reg_id) . pack('n', strlen($payload)) . $payload;
        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result) {
            $a = '0';
        } else {
            $a = '1';
        }
        //pr($a); die;
        //return $a;
        fclose($fp);
		}else{
			return true;
		}
        
   }



   public function send_notification($reg_id,$title,$msg) {
        $anroidkey = $this->Setting->findById(1)['Setting'];
        if(!empty($anroidkey['android_key']) && !empty($reg_id) && !empty($anroidkey['enable'])){
			$key = $anroidkey['android_key'];
            $message = array
            (
               'message' => ($msg) ? $msg : '',
               'title' => $title,
            );
            $fields = array
            (
                'to' => $reg_id,
                'data' => $message,
                'priority' => 'high'
            );

            $headers = array
                (
                "Authorization: key=$key",
                'Content-Type: application/json'
            );
           // pr($headers); die;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            } else {
                $data = array('message' => 'success');
                json_encode($data);
            }
        }
		
        return true;
   }  

    
}
