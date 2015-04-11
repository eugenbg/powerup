<?php

/**
 * This is the model class for table "order_item".
 *
 * The followings are the available columns in table 'order_item':
 * @property integer $id
 * @property integer $status
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $item_id
 * @property integer $qty
 * @property string $price
 * @property string $row_total
 *
 * The followings are the available model relations:
 * @property Order $order
 */
class OrderItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, order_id, product_id, item_id, qty, price, row_total', 'required'),
			array('order_id, product_id, item_id, qty', 'numerical', 'integerOnly'=>true),
			array('price, row_total', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, status, order_id, product_id, item_id, qty, price, row_total', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'status' => 'Status',
			'order_id' => 'Order',
			'product_id' => 'Product',
			'item_id' => 'Item',
			'qty' => 'Qty',
			'price' => 'Price',
			'row_total' => 'Row Total',
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
		$criteria->compare('status',$this->status);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('row_total',$this->row_total,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getFormattedPrice()
    {
        return $this->price . ' ' . Helper::getCurrencyPostfix();
    }

    public function getRowFormattedPrice()
    {
        return $this->row_total . ' ' . Helper::getCurrencyPostfix();
    }

}
