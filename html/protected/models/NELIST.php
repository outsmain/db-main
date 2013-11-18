<?php

/**
 * This is the model class for table "NE_LIST".
 *
 * The followings are the available columns in table 'NE_LIST':
 * @property integer $id
 * @property string $add_date
 * @property string $update_date
 * @property string $ip_addr
 * @property string $name
 * @property string $comment
 * @property string $site_name
 * @property string $brand
 * @property string $model
 * @property string $sw_ver
 * @property string $ne_type
 * @property string $rw_community
 * @property string $ro_community
 * @property string $level
 * @property integer $is_use
 */
class NELIST extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'NE_LIST';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_use', 'numerical', 'integerOnly'=>true),
			array('ip_addr, name, comment, site_name, sw_ver', 'length', 'max'=>32),
			array('brand, model, rw_community, ro_community', 'length', 'max'=>64),
			array('ne_type', 'length', 'max'=>10),
			array('level', 'length', 'max'=>7),
			array('add_date, update_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, add_date, update_date, ip_addr, name, comment, site_name, brand, model, sw_ver, ne_type, rw_community, ro_community, level, is_use', 'safe', 'on'=>'search'),
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
			'add_date' => 'Add Date',
			'update_date' => 'Update Date',
			'ip_addr' => 'Ip Addr',
			'name' => 'Name',
			'comment' => 'Comment',
			'site_name' => 'Site Name',
			'brand' => 'Brand',
			'model' => 'Model',
			'sw_ver' => 'Sw Ver',
			'ne_type' => 'Ne Type',
			'rw_community' => 'Rw Community',
			'ro_community' => 'Ro Community',
			'level' => 'Level',
			'is_use' => 'Is Use',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('add_date',$this->add_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('ip_addr',$this->ip_addr,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('site_name',$this->site_name,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('sw_ver',$this->sw_ver,true);
		$criteria->compare('ne_type',$this->ne_type,true);
		$criteria->compare('rw_community',$this->rw_community,true);
		$criteria->compare('ro_community',$this->ro_community,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('is_use',$this->is_use);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NELIST the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
