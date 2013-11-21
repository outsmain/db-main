<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$username = strtolower($this->username);  
    // $this->username; username คือ ชื่อ Textbox ในฟอร์ม Login
 
    $user = UserLogin::model()->find('LOWER(NAME)=?',array($username));
    // UserLogin ชื่อ Model ที่เราสร้างไว้
 
    if(!isset($user)){ // === NULL
        $this->errorCode = self::ERROR_USERNAME_INVALID;
    }else if(!$user->validatePassword($this->password)){ // !== Password
         $this->errorCode = self::ERROR_PASSWORD_INVALID;
    }else{           
        $this->username = $user->NAME;
		
        // $user->name; name ชื่อ Field :: name ในตาราง user
        $this->errorCode = self::ERROR_NONE;
		
		 Yii::app()->session['user'] = $this->username;
		
		// 'session'=>array('timeout'=>60),
		
    }
 
    return $this->errorCode == self::ERROR_NONE;
}
}
