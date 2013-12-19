<?php

/**
 * This is the model class for table "GROUPNAME".
 *
 * The followings are the available columns in table 'GROUPNAME':
 * @property string $ID
 * @property string $NAME
 * @property string $COMMENT
 * @property string $ACCESSGROUP_ID
 * @property string $PLATFORM_ID
 */
class GROUPNAME extends CActiveRecord
{
	public $PAGENAME_ID;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'GROUPNAME';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NAME', 'length', 'max'=>32),
			array('COMMENT', 'length', 'max'=>256),
			array('ACCESSGROUP_ID', 'length', 'max'=>11),
			array('PLATFORM_ID', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, NAME, COMMENT, ACCESSGROUP_ID, PLATFORM_ID', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
	return array(
		'PAGENAME'=>array(self::BELONGS_TO, 'ID', 'PAGENAME_ID'),
		'group'=>array(self::BELONGS_TO, 'ACCESSNAME', 'ACCESSGROUP_ID'),
		'platform'=>array(self::BELONGS_TO, 'PLATFORM', 'PLATFORM_ID'),
		
		
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
			'COMMENT' => 'Comment',
			'ACCESSGROUP_ID' => 'Accessgroup',
			'PLATFORM_ID' => 'Platform',
			//'PAGENAME_ID' => 'PAGENAME_ID',
		);
	}
	public static function getDroupdownid()
	{  // show dropdown
		return CHtml::listData(GROUPNAME::model()->findAll(),'ID','NAME','');  // ACCESSGROUP_ID คือฟิลที่ต้องการเรียกไปแสดงบน dropdown
	}
	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('NAME',$this->NAME,true);
		$criteria->compare('COMMENT',$this->COMMENT,true);
		$criteria->compare('ACCESSGROUP_ID',$this->ACCESSGROUP_ID,true);
		$criteria->compare('PLATFORM_ID',$this->PLATFORM_ID,true);
		$criteria->with=array('group');
		$criteria->with=array('platform');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GROUPNAME the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	
	}
}
