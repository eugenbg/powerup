<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $sku
 * @property string $title
 * @property string $price
 * @property integer $category_id
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property ProductModel[] $productModels
 */
class Product extends MyActiveRecord implements IECartPosition
{

    public $qty;
    public $item; //used when product is a cart item

    public $assignedItems = array();
    public $assignedParts = array();

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, qty', 'numerical', 'integerOnly'=>true),
            array('qty','numerical',
                'integerOnly'=>true,
                'min'=>1,
                'tooSmall'=>'You must order at least 1 piece'),
			array('sku, title, urlkey', 'length', 'max'=>30),
			array('price, market_price', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sku, title, price, category_id, urlkey, market_price', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'productItems' => array(self::HAS_MANY, 'ProductItem', 'product_id'),
            'productAttributes' => array(self::HAS_ONE, 'ProductAttributes', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sku' => 'Sku',
			'title' => 'Title',
			'price' => 'Price',
			'category_id' => 'Category',
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
		$criteria->compare('sku',$this->sku,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('category_id',$this->category_id);
        $criteria->compare('urlkey',$this->urlkey,true);
        $criteria->compare('market_price',$this->market_price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your MyActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getProductsForCheckboxList()
    {
        $criteria = new CDbCriteria;
        $criteria->select = 't.id, t.sku';
        return Product::model()->findAll($criteria);
    }

    /*
     * for compatibility with shopping cart
     */
    public function getId(){
        return 'Product'.$this->id;
    }

    /*
     * for compatibility with shopping cart
     */
    public function getPrice(){
        return Helper::convertToBLR($this->price);
    }

    public function getDynamicTitle()
    {
        if($this->item)
        {
            return sprintf('Аккумулятор для %s %s', $this->item->brand->title ,$this->item->title);
        }
        return 'Аккумлятор ' . $this->title;
    }

    /*
     * TO-DO: move to abstract model
     */
    public function getImages()
    {
        return Image::model()->findAllByAttributes(array('entity_type' => get_class($this), 'entity_id' => $this->id));
    }

    public function getAllItems($limit = 40)
    {
        $criteria = new CDbCriteria();
        $criteria->join = 'JOIN product_item pi ON pi.product_id = :product_id AND pi.item_id = t.id ';
        $criteria->params = array(':product_id' => $this->id);
        //$criteria->limit = $limit;
        //$criteria->compare('type', Item::TYPE_MODEL);
        $items = Item::model()->findAll($criteria);

        $itemQty = 0;
        $partQty = 0;
        foreach($items as $item)
        {
            if($item->type == Item::TYPE_MODEL && $itemQty < $limit)
            {
                $itemQty++;
                $this->assignedItems[] = $item;
            }
            elseif($item->type == Item::TYPE_PART && $partQty < $limit)
            {
                $partQty++;
                $this->assignedParts[] = $item;
            }
        }
        return $this->assignedItems;
    }

}
