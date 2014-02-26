<?php

/**
 * This is the model class for table "USERNAME".
 *
 * The followings are the available columns in table 'USERNAME':
 * @property integer $ID
 * @property string $NAME
 * @property string $FULL_NAME
 * @property string $COMMENT
 * @property string $PASSWORD
 * @property string $EMAIL
 * @property string $GROUPNAME_ID
 * @property string $ACCESSGROUP_ID
 * @property string $LAST_LOGIN_DATE
 * @property string $LAST_LOGIN_IP
 */
class UserLogin extends CActiveRecord
{
	public $PASSWORD2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'USERNAME';
	}

	 public function validatePassword($password) {
		//return true;
		return md5($password) === $this->PASSWORD;
		
}
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NAME, FULL_NAME, PASSWORD, EMAIL', 'length', 'max'=>64),
			array('COMMENT', 'length', 'max'=>256),
			array('GROUPNAME_ID, ACCESSGROUP_ID', 'length', 'max'=>11),
			array('LAST_LOGIN_IP', 'length', 'max'=>32),
			array('LAST_LOGIN_DATE', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, NAME, FULL_NAME, COMMENT, PASSWORD, EMAIL, GROUPNAME_ID, ACCESSGROUP_ID, LAST_LOGIN_DATE, LAST_LOGIN_IP', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		
		return array(
		'group'=>array(self::BELONGS_TO, 'GROUPNAME', 'GROUPNAME_ID'),
		'acces'=>array(self::BELONGS_TO, 'ACCESSNAME', 'ID'),
	//	'GROUPNAME'=>array(self::BELONGS_TO, 'ID', 'GROUPNAME_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'NAME' => 'Name',
			'FULL_NAME' => 'Full Name',
			'COMMENT' => 'Comment',
			'PASSWORD' => 'Password',
			'PASSWORD2' => 'Password2',
			'EMAIL' => 'Email',
			'GROUPNAME_ID' => 'Groupname',
			'ACCESSGROUP_ID' => 'Accessgroup',
			'LAST_LOGIN_DATE' => 'Last Login Date',
			'LAST_LOGIN_IP' => 'Last Login Ip',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('NAME',$this->NAME,true);
		$criteria->compare('FULL_NAME',$this->FULL_NAME,true);
		$criteria->compare('COMMENT',$this->COMMENT,true);
		$criteria->compare('PASSWORD',$this->PASSWORD,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('GROUPNAME_ID',$this->GROUPNAME_ID,true);
		$criteria->compare('ACCESSGROUP_ID',$this->ACCESSGROUP_ID,true);
		$criteria->compare('LAST_LOGIN_DATE',$this->LAST_LOGIN_DATE,true);
		$criteria->compare('LAST_LOGIN_IP',$this->LAST_LOGIN_IP,true);
		$criteria->with=array('group');
		$criteria->with=array('acces');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserLogin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
