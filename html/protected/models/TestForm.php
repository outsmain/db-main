<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class TestForm extends CFormModel
{
	public $username0;
	public $password0;
	public $username;
	public $password;
	public $password_repeat;
	public $rememberMe;
	public $verifyCode;
	public $approvePolicy;
	public $favcolor;
	public $custom1;
	public $email;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		$CS=Yii::app()->jformvalidate;
		return array(
			
			// default scenario
			array('username0, password0', 'required')
			,
			// scenario 2 : required, length
			// -----------------------------------
			array('username,password', 'required', 'on' =>'form2'),				
			array('password', 'length' ,'min' => 2, 'max' => 10 ,'on' => 'form2'),
			

			
			// scenario 3 : the custom JS validator : min.
			// ---------------------------------------------
			array('custom1',  'required', 'on' => 'form3'),
			array('password', 'required', 'on' => 'form3'),
			
			// the two rules below are equivalent
			
			//array('approvePolicy', 'required' ,'requiredValue' => 1, 'message' => 'Please approve our policy' ,'on' => 'form3'),					
			array('approvePolicy', 'compare' ,'compareValue' => '1', 'message' => 'Please approve our policy' ,'on' => 'form3'),
			
						
			// rule below uses a validator provided with the extension. This validator always return true when 
			// called in the Yii framework. It is only used to add client-side validation rules that are not (yet)
			// implemented as a Yii validator class.
			// Note that since version 1.0.2, the NUMERICAL Yii built-in validator is supported
			
			array('custom1', 'application.extensions.jformvalidate.ECustomJsValidator' ,'on' => 'form3',
				'rules'    => array(
					'min' => 5
				),
				'messages' => array(
					'min' => '{attribute} : enter a numerical value greater than 4 '
				)
			),
			
			//scenario 4
			// ---------------------------------------------
			
			array('username, approvePolicy,favcolor', 'required', 'on' => 'form4'),		

				
			//scenario 5
			// ---------------------------------------------
			
			array('favcolor', 'required' ,'on' => 'form5'),
			
				
			//scenario 6 and 6b
			// ---------------------------------------------
			
			array('username', 'required' ,'on' => 'form6'),
			array('password', 'required' ,'on' => 'form6b'),
						
			// scenario 7 : the custom JS validator : Remote.
			// ---------------------------------------------	
			// ajax remote call to test email uniqueness. The REMOTE method
			// is available in the JQuery Validate plugin
			
			array('email', 'required' ,'on' => 'form7'),
			array('email', 'email' ,'on' => 'form7'),
			array('email', 'application.extensions.jformvalidate.ECustomJsValidator' ,'on' => 'form7',
				'rules'    => array(
					'remote' => 'index.php?r=jsvform/remoteValidate'
				),
				'messages' => array(
					'remote' => '{attribute} already registred'
				)
			),	
			
			// scenario 8 : the COMPARE validator.
			// ------------------------------------
			// Note that if the COMPARE rule does not define any value for the compareAttribute
			// parameter, then by default, Yii is going to assume that the password field
			// will be compared to the password_repeat field.
			
			array('password,username', 'required', 'on' => 'form8'),
			array('password_repeat', 'safe'),
			array('password','compare', 'compareAttribute' => 'password_repeat', 'on' => 'form8'),
			array('username','compare', 'compareValue' => 'yii', 'message' => 'please enter "{value}" as {attribute}', 'on' => 'form8'),
			
			// scenario 9 : the NUMERICAL built-in validator
			// ---------------------------------------------
		
			array('custom1','numerical', 
					'integerOnly' => true,
					'allowEmpty' => false,
					'max' => 12.3, 
					'min' => 0 , 
					'tooBig' => "{attribute} is incorrect ! please enter a value lower than {max} and greater than {min}",
					// if no error message is provided, the default Yii message for this validator
					// is used.										
					 'tooSmall' => "{attribute} should be greater than {min}",
					//'message' => "must be an integer value",									
					'on'  => 'form9'),
			array('verifyCode', 'numerical','allowEmpty' => false, 'integerOnly'=>true,'on'  => 'form9'),
			
			
			// scenario 10 : optional field
			// ---------------------------------------------
			array('username', 'length' ,'min' => 2, 'max' => 10 , 'allowEmpty' => false, 
								'message'=> 'Username is required and contains between {min} and {max} characters',
								'on' => 'form10'),
			array('custom1', 'numerical'  , 'allowEmpty' => true, 'on' => 'form10'),
			array('password', 'required'  , 'on' => 'form10'),
			array('email', 'email','allowEmpty' => true, 'on' => 'form10'),
				
			// scenario 12 : custom validator
			// ---------------------------------------------
			// the first validator is used on the client side only
			array('custom1', 'application.extensions.jformvalidate.ECustomJsValidator' ,'on' => 'form12',
				'rules'    => array(
					'myCustomValidator' => array(
						'param1' => 'some parameter value here',
						'param2' => 'some more parameter value!'
						)
				),
				'messages' => array(
					'myCustomValidator'
				)
			),	
			// the validator below has no equivalent on the client side, it is applied
			// only on server side
			array('custom1', 'myCustomValidator','param1' => 'value1', 'param2' => 'value2', 'on'=> 'form12'),

			// scenario 13 : ajax form submission
			// ---------------------------------------------
			array('username', 'length' ,'min' => 2, 'max' => 10 , 'allowEmpty' => false, 
								'message'=> 'Username is required and contains between {min} and {max} characters',
								'on' => 'form13'),
			//array('approvePolicy', 'required' ,'message' => 'Please approve our policy' ,'on' => 'form12'),
			array('favcolor', 'required' ,'on' => 'form13'),


			// scenario 14a : ajax form submission
			// ---------------------------------------------
			array('username', 'length' ,'min' => 2, 'max' => 10 , 'allowEmpty' => false, 
								'message'=> 'Username is required and contains between {min} and {max} characters',
								'on' => 'form14a'),
			//array('approvePolicy', 'required' ,'message' => 'Please approve our policy' ,'on' => 'form12'),
			array('favcolor', 'required' ,'on' => 'form14a'),							

			// scenario 14b : ajax form submission
			// ---------------------------------------------
			array('username, password', 'length' ,'min' => 2, 'max' => 10 , 'allowEmpty' => false, 
								'message'=> ' {attribute} is required and contains between {min} and {max} characters',
								'on' => 'form14b'),
								
			// scenario 15 : match (regular expression match)
			// ---------------------------------------------
			array('username', 'match' ,'pattern' => '/^[a-z]+$/i','allowEmpty' => false, 
								'message'=> ' {attribute} must match pattern /^[a-z]+$/i ',
								'on' => 'form15'),
			array('password', 'match' ,'pattern' => '/^[a-z0-9 ]+$/','allowEmpty' => false, 
								'message'=> ' {attribute} must match pattern /^[a-z0-9 ]+$/ ',
								'on' => 'form15'),	
			array('custom1', 'match' ,'pattern' => '/^(0( \d|\d ))?\d\d \d\d(\d \d| \d\d )\d\d$/','allowEmpty' => false, 
								'message'=> ' {attribute} is not a valid french phone number. It should match pattern /(0( \d|\d ))?\d\d \d\d(\d \d| \d\d )\d\d/. Try 01 56 88 98 21',
								'on' => 'form15'),									
			// scenario 17 : More checkBoxes
			// ---------------------------------------------
			// safe is not supported
			array('username,password', 'required','on'=>'form17'),	
			
			
			// scenario 19 : Required + requiredValue (since yii 1.0.10)
			// ---------------------------------------------			
			array('username','required', 'requiredValue' => 'a', 'message'=>'please entre value \'{value}\'in field {attribute}', 'on'=>'form19'),
			array('email','required', 'requiredValue' => 'b',  'on'=>'form19'),			
			array('custom1', 'required' ,'on' => 'form19'),

		);
	}

	/**
	 * Declares attribute labels.
	 * If not declared here, an attribute would have a label
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'		=>'Verification Code',
			'custom1' 			=> 'Custom Field',
			'password_repeat' 	=> 'Confirm password',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		$this->addError('password','Incorrect password.');
	}
	public function myCustomValidator($attribute,$params)
	{		
		$this->addError('$attribute','server-side validation failed for rule myCustomValidator and for attribute '.$attribute);
	}
	public function isUniqueMail()
	{
		return ($this->email == "user@yii.com");
	}
}
