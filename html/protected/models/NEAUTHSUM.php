<?php

/**
 * This is the model class for table "NE_AUTHSUM".
 *
 * The followings are the available columns in table 'NE_AUTHSUM':
 * @property string $id
 * @property string $update_date
 * @property string $last_login
 * @property string $sum_dur
 * @property string $sum_type
 * @property string $node_ip
 * @property string $node_name
 * @property string $site_name
 * @property string $node_group
 * @property string $user_name
 * @property string $user_ip
 * @property string $user_group
 * @property integer $accept_num
 * @property integer $reject_num
 * @property double $success_rate
 * @property double $login_rate
 * @property integer $cmd_num
 * @property double $cmd_rate
 */
class NEAUTHSUM extends CActiveRecord
{
	public $StartDate;
	public $EndDate;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'NE_AUTHSUM';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('StartDate, EndDate', 'required'),
			array('accept_num, reject_num, cmd_num', 'numerical', 'integerOnly'=>true),
			array('success_rate, login_rate, cmd_rate', 'numerical'),
			array('sum_dur', 'length', 'max'=>11),
			array('sum_type', 'length', 'max'=>10),
			array('node_ip, node_name, site_name, node_group, user_name, user_ip, user_group', 'length', 'max'=>64),
			array('update_date, last_login', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, update_date, last_login, sum_dur, sum_type, node_ip, node_name, site_name, node_group, user_name, user_ip, user_group, accept_num, reject_num, success_rate, login_rate, cmd_num, cmd_rate', 'safe', 'on'=>'search'),
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
			'update_date' => 'Update Date',
			'last_login' => 'Last Login',
			'sum_dur' => 'Sum Dur',
			'sum_type' => 'Sum Type',
			'node_ip' => 'Node Ip',
			'node_name' => 'Node Name',
			'site_name' => 'Site Name',
			'node_group' => 'Node Group',
			'user_name' => 'User Name',
			'user_ip' => 'User Ip',
			'user_group' => 'User Group',
			'accept_num' => 'Accept Num',
			'reject_num' => 'Reject Num',
			'success_rate' => 'Success Rate',
			'login_rate' => 'Login Rate',
			'cmd_num' => 'Cmd Num',
			'cmd_rate' => 'Cmd Rate',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'summary_type' => 'Summary Type',
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
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('sum_dur',$this->sum_dur,true);
		$criteria->compare('sum_type',$this->sum_type,true);
		$criteria->compare('node_ip',$this->node_ip,true);
		$criteria->compare('node_name',$this->node_name,true);
		$criteria->compare('site_name',$this->site_name,true);
		$criteria->compare('node_group',$this->node_group,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_ip',$this->user_ip,true);
		$criteria->compare('user_group',$this->user_group,true);
		$criteria->compare('accept_num',$this->accept_num);
		$criteria->compare('reject_num',$this->reject_num);
		$criteria->compare('success_rate',$this->success_rate);
		$criteria->compare('login_rate',$this->login_rate);
		$criteria->compare('cmd_num',$this->cmd_num);
		$criteria->compare('cmd_rate',$this->cmd_rate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NEAUTHSUM the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
