<?php

/**
 * This is the model class for table "GROUPAUTHORIZE".
 *
 * The followings are the available columns in table 'GROUPAUTHORIZE':
 * @property string $ID
 * @property string $GROUPNAME_ID
 * @property integer $PAGENAME_ID
 * @property string $ACCESSGROUP_ID
 */
class GROUPAUTHORIZE extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'GROUPAUTHORIZE';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GROUPNAME_ID', 'required'),
			array('PAGENAME_ID', 'numerical', 'integerOnly'=>true),
			array('GROUPNAME_ID, ACCESSGROUP_ID', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, GROUPNAME_ID, PAGENAME_ID, ACCESSGROUP_ID', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			//'PAGENAME'=>array(self::BELONGS_TO, 'ID', 'NAME'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'GROUPNAME_ID' => 'Groupname',
			'PAGENAME_ID' => 'Pagename',
			'ACCESSGROUP_ID' => 'Accessgroup',
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
		$criteria->compare('GROUPNAME_ID',$this->GROUPNAME_ID,true);
		$criteria->compare('PAGENAME_ID',$this->PAGENAME_ID);
		$criteria->compare('ACCESSGROUP_ID',$this->ACCESSGROUP_ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GROUPAUTHORIZE the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
