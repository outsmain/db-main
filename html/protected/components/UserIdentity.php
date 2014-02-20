<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	const ERROR_TIME_INVALID = 67;
	const ERROR_CLIENT_INVALID = 68;

	public function authenticate()
	{	
		$action ="LOGIN";
		$username = strtolower($this->username);  
		$user = UserLogin::model()->find('LOWER(NAME)=?',array($username));
		$result_time = Func::checkAccess($username);
		$result_ip = Func::checkAllowip($username);

    if(!isset($user)){ // === NULL
		$status ="LOGIN_FAILED";
		$this->errorCode = self::ERROR_USERNAME_INVALID;
		Func::add_loglogin($username,$status,$action); 
		
    }
	else if(!$user->validatePassword($this->password)){ 
         $this->errorCode = self::ERROR_PASSWORD_INVALID;
		 $status ="LOGIN_FAILED";
		 Func::add_loglogin($username,$status,$action); 
		}
	else if($result_time == 'ok'){
		$this->errorCode=self::ERROR_USERNAME_INVALID;	
		 $status ="INVALID_TIME";
		Func::add_loglogin($username,$status,$action); 		
		}
	else if($result_time == 'ip'){
		$this->errorCode=self::ERROR_USERNAME_INVALID;	
		 $status ="INVALID_CLIENT";
		Func::add_loglogin($username,$status,$action); 		
		}
	else{ 
		$status ="OK";	
        $this->username = $user->NAME;
		// $user->name; name ชื่อ Field :: name ในตาราง user
        $this->errorCode = self::ERROR_NONE;
		
		 Yii::app()->session['user'] = $this->username;
		 Func::add_loglogin($username,$status,$action); 
		
    }
 
    return $this->errorCode == self::ERROR_NONE;
		}

		
}
