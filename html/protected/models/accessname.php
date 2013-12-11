<?php

/**
 * This is the model class for table "ACCESSNAME".
 *
 * The followings are the available columns in table 'ACCESSNAME':
 * @property string $ID
 * @property string $STARTTIME
 * @property string $ENDTIME
 * @property string $DOW
 * @property string $ALLOWIP
 */
class ACCESSNAME extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ACCESSNAME';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ALLOWIP', 'length', 'max'=>15),
			array('STARTTIME, ENDTIME, DOW', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, STARTTIME, ENDTIME, DOW, ALLOWIP', 'safe', 'on'=>'search'),
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
			'STARTTIME' => 'Starttime',
			'ENDTIME' => 'Endtime',
			'DOW' => 'Dow',
			'ALLOWIP' => 'Allowip',
			'SESSIONTIME_ID' => 'sessiontime_id',
		);
	}
public static function getAccessid()
	{  // show dropdown
		return CHtml::listData(ACCESSNAME::model()->findAll(),'ID','ID');
	}
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('STARTTIME',$this->STARTTIME,true);
		$criteria->compare('ENDTIME',$this->ENDTIME,true);
		$criteria->compare('DOW',$this->DOW,true);
		$criteria->compare('ALLOWIP',$this->ALLOWIP,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ACCESSNAME the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
