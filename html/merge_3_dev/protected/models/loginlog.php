<?php

/**
 * This is the model class for table "LOGIN_LOG".
 *
 * The followings are the available columns in table 'LOGIN_LOG':
 * @property string $ID
 * @property string $UPDATE_DATE
 * @property string $USER_NAME
 * @property string $USER_IP
 * @property string $CLIENT_NAME
 * @property string $COMMAND
 * @property string $VALUE
 * @property string $STATUS
 */
class loginlog extends CActiveRecord
{
	public $UPDATE_DATE2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'LOGIN_LOG';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USER_NAME, USER_IP', 'length', 'max'=>32),
			array('CLIENT_NAME', 'length', 'max'=>128),
			array('COMMAND', 'length', 'max'=>6),
			array('VALUE', 'length', 'max'=>256),
			array('STATUS', 'length', 'max'=>15),
			array('UPDATE_DATE', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, UPDATE_DATE, USER_NAME, USER_IP, CLIENT_NAME, COMMAND, VALUE, STATUS', 'safe', 'on'=>'search'),
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
			'ID' => 'ID',
			'UPDATE_DATE' => 'Update Date',
			'USER_NAME' => 'User Name',
			'USER_IP' => 'User Ip',
			'CLIENT_NAME' => 'Client Name',
			'COMMAND' => 'Command',
			'VALUE' => 'Value',
			'STATUS' => 'Status',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('UPDATE_DATE',$this->UPDATE_DATE,true);
		$criteria->compare('USER_NAME',$this->USER_NAME,true);
		$criteria->compare('USER_IP',$this->USER_IP,true);
		$criteria->compare('CLIENT_NAME',$this->CLIENT_NAME,true);
		$criteria->compare('COMMAND',$this->COMMAND,true);
		$criteria->compare('VALUE',$this->VALUE,true);
		$criteria->compare('STATUS',$this->STATUS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return loginlog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
