<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $sku
 * @property string $title
 * @property string $price
 * property integer $status
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property ProductModel[] $productModels
 */
class Product extends MyActiveRecord implements IECartPosition
{

    public $qty;
    public $item; //used when product is a cart item

    /*
     * used for interlinking in getAllItems()
     */
    public $assignedItems = array();
    public $assignedParts = array();

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public $statusLabels = array(
        self::STATUS_DISABLED => 'выключен',
        self::STATUS_ENABLED => 'включен'
    );

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
			array('qty, status, inventory', 'numerical', 'integerOnly'=>true),
            array('qty','numerical',
                'integerOnly'=>true,
                'min'=>1,
                'tooSmall'=>'You must order at least 1 piece'),
			array('sku, title, urlkey', 'length', 'max'=>30),
			array('price, market_price', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sku, title, price, category_id, urlkey, market_price, status, code, inventory', 'safe', 'on'=>'search'),
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
        Yii:: app () ->cache->flush();
		return array(
			'id' => 'ID',
			'sku' => 'Sku',
			'title' => 'Title',
			'price' => 'Price',
			'category_id' => 'Category',
            'inventory' => 'Запас',
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
        $criteria->compare('urlkey',$this->urlkey,true);
        $criteria->compare('market_price',$this->market_price,true);
        $criteria->compare('status',$this->status,true);

        return new CActiveDataProvider($this, array(
            'pagination'=>array(
                'pageSize'=>50,
            ),
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

    public function getAllItems($limit = 20, $model)
    {
        $frontendCategory = Yii::app()->params['category'];
        $criteria = new CDbCriteria();
        $criteria->join  = 'JOIN product_item pi ON pi.product_id = :product_id AND pi.item_id = t.id ';
        $criteria->join .= 'JOIN item_item_category iic ON iic.item_id = t.id ';
        $criteria->join .= 'JOIN frontend_category_item_category fcic ON fcic.item_category_id = iic.item_category_id';
        $criteria->params = array(':product_id' => $this->id);
        $criteria->compare('fcic.frontend_category_id', $frontendCategory->id);
        $criteria->order = 't.id ASC';
        $criteria->limit = 200;
        $result = Item::model()->findAll($criteria);

        $items = array();
        $parts = array();
        foreach($result as $item)
        {
            if($item->type == Item::TYPE_MODEL)
            {
                $items[] = $item;
            }
            elseif($item->type == Item::TYPE_PART)
            {
                $parts[] = $item;
            }
        }

        if(count($items) < $limit)
        {
            $this->assignedItems = $items;
        }
        else
        {
            $this->assignedItems = $this->_extractClosest($items, $limit, $model);
        }

        if(count($parts) < $limit)
        {
            $this->assignedParts = $parts;
        }
        else
        {
            $this->assignedParts = $this->_extractClosest($parts, $limit, $model);
        }

        return $this->assignedItems;
    }

    /*
     * take n(limit) of models with id higher than model->id.
     * if result is less than limit, take the rest from beginning of array
     */
    private function _extractClosest($items, $limit, $model)
    {
        $itemsResult = array();
        foreach ($items as $item)
        {
            if($item->id > $model->id)
            {
                $itemsResult[] = $item;
            }
            if(count($itemsResult) == $limit)
            {
                break;
            }
        }
        if(count($itemsResult) < $limit)
        {
            $slice = array_slice($items, 0, ($limit - count($itemsResult)));
            $itemsResult = array_merge($slice, $itemsResult);
        }
        return $itemsResult;
    }

}
