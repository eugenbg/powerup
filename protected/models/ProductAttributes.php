<?php

/**
 * This is the model class for table "product_attributes".
 *
 * The followings are the available columns in table 'product_attributes':
 * @property integer $id
 * @property string $bb_battery_decoded
 * @property string $bb_battery_type
 * @property string $color
 * @property string $bb_battery_chemistry
 * @property string $bb_battery_size
 * @property string $bb_battery_voltage
 * @property string $bb_dimensions
 * @property string $bb_battery_capacity_mah
 * @property string $weight
 * @property integer $benmer_description
 * @property string $benmer_price
 * @property integer $benmer_box_qty
 * @property string $benmer_capacity
 * @property string $benmer_voltage
 *
 * The followings are the available model relations:
 * @property Product $id0
 */
class ProductAttributes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_attributes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, bb_battery_decoded, bb_battery_type, color, bb_battery_chemistry, bb_battery_size, bb_battery_voltage, bb_dimensions, bb_battery_capacity_mah, weight, benmer_description, benmer_price, benmer_box_qty, benmer_capacity, benmer_voltage', 'required'),
			array('id, benmer_description, benmer_box_qty', 'numerical', 'integerOnly'=>true),
			array('bb_battery_decoded, bb_battery_type, color, bb_battery_chemistry, bb_battery_size, bb_battery_voltage, bb_dimensions, bb_battery_capacity_mah, benmer_capacity, benmer_voltage', 'length', 'max'=>100),
			array('weight, benmer_price', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, bb_battery_decoded, bb_battery_type, color, bb_battery_chemistry, bb_battery_size, bb_battery_voltage, bb_dimensions, bb_battery_capacity_mah, weight, benmer_description, benmer_price, benmer_box_qty, benmer_capacity, benmer_voltage', 'safe', 'on'=>'search'),
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
			'id0' => array(self::BELONGS_TO, 'Product', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'bb_battery_decoded' => 'Bb Battery Decoded',
			'bb_battery_type' => 'Bb Battery Type',
			'color' => 'Color',
			'bb_battery_chemistry' => 'Тип батареи',
			'bb_battery_size' => '',
			'bb_battery_voltage' => 'Напряжение',
			'bb_dimensions' => 'Размеры',
			'bb_battery_capacity_mah' => 'Мощность',
			'weight' => 'Вес',
			'benmer_description' => 'Benmer Description',
			'benmer_price' => 'Benmer Price',
			'benmer_box_qty' => 'Benmer Box Qty',
			'benmer_capacity' => 'Benmer Capacity',
			'benmer_voltage' => 'Benmer Voltage',
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
		$criteria->compare('bb_battery_decoded',$this->bb_battery_decoded,true);
		$criteria->compare('bb_battery_type',$this->bb_battery_type,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('bb_battery_chemistry',$this->bb_battery_chemistry,true);
		$criteria->compare('bb_battery_size',$this->bb_battery_size,true);
		$criteria->compare('bb_battery_voltage',$this->bb_battery_voltage,true);
		$criteria->compare('bb_dimensions',$this->bb_dimensions,true);
		$criteria->compare('bb_battery_capacity_mah',$this->bb_battery_capacity_mah,true);
		$criteria->compare('weight',$this->weight,true);
		$criteria->compare('benmer_description',$this->benmer_description);
		$criteria->compare('benmer_price',$this->benmer_price,true);
		$criteria->compare('benmer_box_qty',$this->benmer_box_qty);
		$criteria->compare('benmer_capacity',$this->benmer_capacity,true);
		$criteria->compare('benmer_voltage',$this->benmer_voltage,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductAttributes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
