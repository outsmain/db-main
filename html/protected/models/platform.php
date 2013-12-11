<?php

/**
 * This is the model class for table "PLATFORM".
 *
 * The followings are the available columns in table 'PLATFORM':
 * @property string $ID
 * @property string $NAME
 * @property string $COMMENT
 * @property string $LOGO
 * @property string $HOMEPAGE
 */
class PLATFORM extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'PLATFORM';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NAME', 'length', 'max'=>45),
			array('COMMENT, LOGO, HOMEPAGE', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, NAME, COMMENT, LOGO, HOMEPAGE', 'safe', 'on'=>'search'),
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

	public static function getflatformid()
	{  // show dropdown
		return CHtml::listData(PLATFORM::model()->findAll(),'ID','ID');  // ACCESSGROUP_ID คือฟิลที่ต้องการเรียกไปแสดงบน dropdown
	}
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'NAME' => 'Name',
			'COMMENT' => 'Comment',
			'LOGO' => 'Logo',
			'HOMEPAGE' => 'Homepage',
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
		$criteria->compare('NAME',$this->NAME,true);
		$criteria->compare('COMMENT',$this->COMMENT,true);
		$criteria->compare('LOGO',$this->LOGO,true);
		$criteria->compare('HOMEPAGE',$this->HOMEPAGE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PLATFORM the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
