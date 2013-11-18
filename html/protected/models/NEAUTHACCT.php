<?php

/**
 * This is the model class for table "NE_AUTHACCT".
 *
 * The followings are the available columns in table 'NE_AUTHACCT':
 * @property string $id
 * @property string $login_date
 * @property string $status
 * @property string $node_ip
 * @property string $node_name
 * @property string $user_name
 * @property string $user_ip
 * @property string $group_name
 * @property string $priv_name
 * @property string $cmd
 *
 * The followings are the available model relations:
 * @property NeList $nodeIp
 */
class NEAUTHACCT extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'NE_AUTHACCT';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'length', 'max'=>11),
			array('node_ip, node_name, user_name, user_ip, group_name, priv_name, cmd', 'length', 'max'=>64),
			array('login_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login_date, status, node_ip, node_name, user_name, user_ip, group_name, priv_name, cmd', 'safe', 'on'=>'search'),
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
			'nodeIp' => array(self::BELONGS_TO, 'NeList', 'node_ip'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login_date' => 'Login Date',
			'status' => 'Status',
			'node_ip' => 'Node Ip',
			'node_name' => 'Node Name',
			'user_name' => 'User Name',
			'user_ip' => 'User Ip',
			'group_name' => 'Group Name',
			'priv_name' => 'Priv Name',
			'cmd' => 'Cmd',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('login_date',$this->login_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('node_ip',$this->node_ip,true);
		$criteria->compare('node_name',$this->node_name,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_ip',$this->user_ip,true);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('priv_name',$this->priv_name,true);
		$criteria->compare('cmd',$this->cmd,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NEAUTHACCT the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
