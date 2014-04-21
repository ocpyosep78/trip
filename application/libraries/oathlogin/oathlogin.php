<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class oathlogin {
	function __construct() {
		$this->ci = get_instance();
	}
	
	function userDetails($user_session) {
		$row_id = mysql_real_escape_string($user_session);
		$query = mysql_query("SELECT * FROM `users` WHERE id = '$row_id'") or die(mysql_error());
		$row=mysql_fetch_array($query);
	    return $row;
	}

    function user_signup($userData, $loginProvider, $user_type) {
		// result
		$result = array( 'status' => false );
		
		// set email
		$email = $userData['email'];
		if ($loginProvider == 'microsoft' ) {
			$email = $userData->emails->account;
		} else if ($loginProvider == 'linkedin') {
			$email = $userData['email-address'];
		}
		
		// model name
		if ($user_type == 'traveler') {
			$model_name = 'traveler_model';
		} else if ($user_type == 'member') {
			$model_name = 'member_model';
		}
		
		// user
		$user = $this->ci->$model_name->get_by_id(array( 'email' => $email ));
		
		// new user
		if (count($user) == 0) {
			// param update
			$param_update = array();
			
			if ($loginProvider == 'facebook') {
				// biodata
				$param_update['email'] = $userData['email'];
				$param_update['first_name'] = $userData['first_name'];
				$param_update['last_name'] = $userData['last_name'];
				$param_update['alias'] = get_name($param_update['first_name'].' '.$param_update['last_name']);
				$param_update['register_date'] = $this->ci->config->item('current_datetime');
				
				// set provider
				$param_update['provider'] = $loginProvider;
				$param_update['provider_id'] = $userData['id'];
			}
			else if ($loginProvider == 'google') {
				$email =mysql_real_escape_string($userData['email']);
			    $name =mysql_real_escape_string($userData['name']);
				$first_name=mysql_real_escape_string($userData['given_name']);
				$last_name=mysql_real_escape_string($userData['family_name']);
				$gender=mysql_real_escape_string($userData['gender']);
				$birthday=mysql_real_escape_string($userData['birthday']);
				$picture=mysql_real_escape_string($userData['picture']);
				$provider_id =mysql_real_escape_string($userData['id']);
			}
			else if ($loginProvider == 'microsoft') {
			    $name =$userData->name;
			    $first_name =$userData->first_name;
			    $last_name =$userData->last_name;
			    $provider_id =$userData->id;
			    $gender=$userData->gender;
			    $email=$userData->emails->account;
			    $email2=$userData->emails->preferred;
			    $birthday=$userData->birth_day.'-'.$userData->birth_month.'-'.$userData->birth_year;
			}
			else if ($loginProvider == 'linkedin') {
				$email= mysql_real_escape_string($userData['email-address']);
				$provider_id= mysql_real_escape_string($userData['id']);
				$first_name= mysql_real_escape_string($userData['first-name']);
				$last_name= mysql_real_escape_string($userData['last-name']);
				$name =$first_name.' '.$last_name;
			}
			else {
				echo "$loginProvider error to insert record.";
				exit;
			}
			
			// update record
			$result_update = $this->ci->$model_name->update($param_update);
			
			// set result
			$user = $this->ci->$model_name->get_by_id(array( 'id' => $result_update['id'] ));
			$result = array( 'status' => true, 'user' => $user );
		}
		
		// old user
		else {
			// set result
			$result = array( 'status' => true, 'user' => $user );
		}
		
		return $result;
	}
}