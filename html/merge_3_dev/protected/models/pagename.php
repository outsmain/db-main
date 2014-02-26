<?php

/**
 * This is the model class for table "PAGENAME".
 *
 * The followings are the available columns in table 'PAGENAME':
 * @property integer $ID
 * @property string $NAME
 * @property string $TITLE
 * @property string $COMMENT
 * @property string $MODELNAME
 * @property string $TYPE
 * @property integer $NEXTPAGE
 * @property integer $PREVPAGE
 */
class PAGENAME extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'PAGENAME';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NEXTPAGE, PREVPAGE', 'numerical', 'integerOnly'=>true),
			array('NAME, TITLE, MODELNAME', 'length', 'max'=>64),
			array('COMMENT', 'length', 'max'=>256),
			array('TYPE', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, NAME, TITLE, COMMENT, MODELNAME, TYPE, NEXTPAGE, PREVPAGE', 'safe', 'on'=>'search'),
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
			'NAME' => 'Name',
			'TITLE' => 'Title',
			'COMMENT' => 'Comment',
			'MODELNAME' => 'Modelname',
			'TYPE' => 'Type',
			'NEXTPAGE' => 'Nextpage',
			'PREVPAGE' => 'Prevpage',
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('NAME',$this->NAME,true);
		$criteria->compare('TITLE',$this->TITLE,true);
		$criteria->compare('COMMENT',$this->COMMENT,true);
		$criteria->compare('MODELNAME',$this->MODELNAME,true);
		$criteria->compare('TYPE',$this->TYPE,true);
		$criteria->compare('NEXTPAGE',$this->NEXTPAGE);
		$criteria->compare('PREVPAGE',$this->PREVPAGE);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function getDroupdowntype()
	{  // show dropdown
		return CHtml::listData(PAGENAME::model()->findAll(),'TYPE','TYPE');  // ACCESSGROUP_ID คือฟิลที่ต้องการเรียกไปแสดงบน dropdown
	}
		public static function getPagename()
	{  // show dropdown
		return CHtml::listData(PAGENAME::model()->findAll(),'ID','TITLE');  // ACCESSGROUP_ID คือฟิลที่ต้องการเรียกไปแสดงบน dropdown
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PAGENAME the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
