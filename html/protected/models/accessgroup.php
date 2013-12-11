<?php

/**
 * This is the model class for table "ACCESSGROUP".
 *
 * The followings are the available columns in table 'ACCESSGROUP':
 * @property string $ID
 * @property string $ACCESSGROUP_ID
 * @property string $ACCESSNAME_ID
 */
class ACCESSGROUP extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ACCESSGROUP';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACCESSGROUP_ID, ACCESSNAME_ID', 'required'),
			array('ACCESSGROUP_ID, ACCESSNAME_ID', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, ACCESSGROUP_ID, ACCESSNAME_ID', 'safe', 'on'=>'search'),
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
			'ACCESSGROUP_ID' => 'Accessgroup',
			'ACCESSNAME_ID' => 'Accessname',
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
		$criteria->compare('ACCESSGROUP_ID',$this->ACCESSGROUP_ID,true);
		$criteria->compare('ACCESSNAME_ID',$this->ACCESSNAME_ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getDroupdown()
	{  // show dropdown
		return CHtml::listData(ACCESSGROUP::model()->findAll(),'ACCESSGROUP_ID','ACCESSGROUP_ID');  // ACCESSGROUP_ID คือฟิลที่ต้องการเรียกไปแสดงบน dropdown

	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
