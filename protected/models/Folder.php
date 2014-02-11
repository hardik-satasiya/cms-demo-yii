<?php

/**
 * This is the model class for table "folder".
 *
 * The followings are the available columns in table 'folder':
 * @property string $id
 * @property string $group_id
 * @property integer $parent_id
 * @property string $name
 * @property string $status
 * @property string $location
 * @property integer $created_by
 * @property string $created_dt
 * @property integer $updated_by
 * @property string $updated_dt
 * @property string $description
 */
class Folder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Folder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'folder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, name, location, created_by, created_dt, updated_by, updated_dt, description', 'required'),
			array('parent_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('group_id', 'length', 'max'=>11),
			array('name', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			array('location', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_id, parent_id, name, status, location, created_by, created_dt, updated_by, updated_dt, description', 'safe', 'on'=>'search'),
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
			'group_id' => 'Group',
			'parent_id' => 'Parent',
			'name' => 'Name',
			'status' => 'Status',
			'location' => 'Location',
			'created_by' => 'Created By',
			'created_dt' => 'Created Dt',
			'updated_by' => 'Updated By',
			'updated_dt' => 'Updated Dt',
			'description' => 'Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_dt',$this->created_dt,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_dt',$this->updated_dt,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}