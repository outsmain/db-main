<?php

/**
 * This is the model class for table "NE_SUBSSTAT".
 *
 * The followings are the available columns in table 'NE_SUBSSTAT':
 * @property string $id
 * @property string $start_date
 * @property string $end_date
 * @property string $node_ip
 * @property string $node_name
 * @property string $int_name
 * @property string $service
 * @property string $sub_service
 * @property integer $prov_subs
 * @property integer $conn_subs
 * @property double $min_line
 */
class NESUBSSTAT extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'NE_SUBSSTAT';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prov_subs, conn_subs', 'numerical', 'integerOnly'=>true),
			array('min_line', 'numerical'),
			array('node_ip, node_name, int_name, sub_service', 'length', 'max'=>64),
			array('service', 'length', 'max'=>11),
			array('start_date, end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, start_date, end_date, node_ip, node_name, int_name, service, sub_service, prov_subs, conn_subs, min_line', 'safe', 'on'=>'search'),
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
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'node_ip' => 'Node Ip',
			'node_name' => 'Node Name',
			'int_name' => 'Int Name',
			'service' => 'Service',
			'sub_service' => 'Sub Service',
			'prov_subs' => 'Prov Subs',
			'conn_subs' => 'Conn Subs',
			'min_line' => 'Min Line',
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
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('node_ip',$this->node_ip,true);
		$criteria->compare('node_name',$this->node_name,true);
		$criteria->compare('int_name',$this->int_name,true);
		$criteria->compare('service',$this->service,true);
		$criteria->compare('sub_service',$this->sub_service,true);
		$criteria->compare('prov_subs',$this->prov_subs);
		$criteria->compare('conn_subs',$this->conn_subs);
		$criteria->compare('min_line',$this->min_line);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NESUBSSTAT the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
