<?php

/**
 * This is the model class for table "USERNAME".
 *
 * The followings are the available columns in table 'USERNAME':
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $comment
 * @property string $password
 * @property string $email
 * @property string $groupname
 * @property string $accessgroup_id
 * @property string $last_login_date
 * @property string $last_login_ip
 */
class UserLogin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'USERNAME';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	 public function validatePassword($password) {
		//return true;
		return md5($password) === $this->PASSWORD;
		
}
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, full_name, password, email', 'length', 'max'=>64),
			array('comment', 'length', 'max'=>256),
			array('groupname, accessgroup_id', 'length', 'max'=>11),
			array('last_login_ip', 'length', 'max'=>32),
			array('last_login_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, full_name, comment, password, email, groupname, accessgroup_id, last_login_date, last_login_ip', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'full_name' => 'Full Name',
			'comment' => 'Comment',
			'password' => 'Password',
			'email' => 'Email',
			'groupname' => 'Groupname',
			'accessgroup_id' => 'Accessgroup',
			'last_login_date' => 'Last Login Date',
			'last_login_ip' => 'Last Login Ip',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('groupname',$this->groupname,true);
		$criteria->compare('accessgroup_id',$this->accessgroup_id,true);
		$criteria->compare('last_login_date',$this->last_login_date,true);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);

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
