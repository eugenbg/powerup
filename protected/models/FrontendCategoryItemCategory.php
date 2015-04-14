<?php

/**
 * This is the model class for table "frontend_category_item_category".
 *
 * The followings are the available columns in table 'frontend_category_item_category':
 * @property integer $id
 * @property integer $frontend_category_id
 * @property integer $item_category_id
 *
 * The followings are the available model relations:
 * @property ItemCategory $itemCategory
 * @property FrontendCategory $frontendCategory
 */
class FrontendCategoryItemCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'frontend_category_item_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('frontend_category_id, item_category_id', 'required'),
			array('frontend_category_id, item_category_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, frontend_category_id, item_category_id', 'safe', 'on'=>'search'),
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
			'itemCategory' => array(self::BELONGS_TO, 'ItemCategory', 'item_category_id'),
			'frontendCategory' => array(self::BELONGS_TO, 'FrontendCategory', 'frontend_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'frontend_category_id' => 'Frontend Category',
			'item_category_id' => 'Item Category',
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
		$criteria->compare('frontend_category_id',$this->frontend_category_id);
		$criteria->compare('item_category_id',$this->item_category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FrontendCategoryItemCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
