<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property integer $id
 * @property string $title
 * @property integer $series_id
 * @property integer $subseries_id
 * @property integer $brand_id
 *
 * The followings are the available model relations:
 * @property Brand $brand
 * @property Series $series
 * @property Series $subseries
 * @property ProductItem[] $productItems
 */
class Item extends MyActiveRecord
{

    const TYPE_MODEL = 3;
    const TYPE_PART = 4;

    /*
     * to store id's of product-item relations (needed for from->checkboxlist to mark checked values)
     */
    public $productItemIds = array();

    public $leadingProducts = array();
    public $relatedProducts = array();

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('urlkey', 'required'),
			array('series_id, subseries_id, brand_id', 'numerical', 'integerOnly'=>true),
			array('title, urlkey', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, series_id, subseries_id, brand_id, urlkey, search_data, type', 'safe', 'on'=>'search'),
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
			'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
			'series' => array(self::BELONGS_TO, 'Series', 'series_id'),
			'subseries' => array(self::BELONGS_TO, 'Series', 'subseries_id'),
			'productItems' => array(self::HAS_MANY, 'ProductItem', 'item_id'),
            'itemItemCategories' => array(self::HAS_MANY, 'ItemItemCategory', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'series_id' => 'Series',
			'subseries_id' => 'Subseries',
			'brand_id' => 'Brand',
            'urlkey' => 'Urlkey',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('series_id',$this->series_id);
		$criteria->compare('subseries_id',$this->subseries_id);
		$criteria->compare('brand_id',$this->brand_id);
        $criteria->compare('urlkey',$this->urlkey,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your MyActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /*
     * helps to populate many-many checkboxes on product assign
     */
    public function afterFind()
    {
        if(!empty($this->productItems))
        {
            foreach($this->productItems as $productItemRelation)
                $this->productItemIds[]=$productItemRelation->product_id;
        }
    }

    public function getLeadingProducts()
    {
        if(count($this->leadingProducts))
        {
            return $this->leadingProducts;
        }
        $this->spreadLeadingRelatedProducts();
        return $this->leadingProducts;
    }

    public function getRelatedProducts()
    {
        if(count($this->relatedProducts))
        {
            return $this->relatedProducts;
        }
        $this->spreadLeadingRelatedProducts();
        return $this->relatedProducts;
    }

    public function spreadLeadingRelatedProducts()
    {
        if(Yii::app()->params['category']) // if we are on frontend
        {
            foreach($this->productItems as $productItem)
            {
                if($product = $productItem->product)
                {
                    if($product && $product->category_id == Yii::app()->params['category']->product_category_id)
                    {
                        $this->leadingProducts[] = $product;
                    }
                    else
                    {
                        $this->relatedProducts[] = $product;
                    }
                }
            }
        }
    }

    public function getFullTitle()
    {
        $itemCategory = $this->itemItemCategories[0]->itemCategory;
        $itemCategoryTitle = json_decode($itemCategory->title_wordforms);
        if($this->type == self::TYPE_MODEL)
        {
            return "Аккумулятор для ".
            $itemCategoryTitle->single->r .
            " " . $this->brand->title .
            ($this->series ? " " . $this->series->title : '') .
            ($this->subseries ? " " . $this->subseries->title : '') .
            " " . $this->title;
        }
        elseif($this->type == self::TYPE_PART)
        {
            return "Аккумулятор ".
            " " . $this->brand->title .
            ($this->series ? " " . $this->series->title : '') .
            ($this->subseries ? " " . $this->subseries->title : '') .
            " " . $this->title;
        }
    }

    public function getItemCategoryTitle($case, $n = 'single') //падеж, число
    {
        $itemCategory = $this->itemItemCategories[0]->itemCategory;
        $itemCategoryTitle = json_decode($itemCategory->title_wordforms);
        return $itemCategoryTitle->{$n}->{$case};
    }

    public function getItemTitle()
    {

        $title = $this->brand->title;
        if($this->series)
        {
            $title .= ' ' . $this->series->title;
        }
        if($this->subseries)
        {
            $title .= ' ' . $this->subseries->title;
        }
        $title .= ' ' . $this->title;
        if($this->type == self::TYPE_PART)
        {
            return 'аналог ' . $title;
        }
        elseif($this->type == self::TYPE_MODEL)
        {
            return 'подходит для ' . $title;
        }

    }
}
