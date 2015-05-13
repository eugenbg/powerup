<?php

/**
 * This is the model class for table "frontend_category".
 *
 * The followings are the available columns in table 'frontend_category':
 * @property integer $id
 * @property string $title
 * @property integer $product_category_id
 *
 * The followings are the available model relations:
 * @property ProductCategory $productCategory
 * @property FrontendCategoryItemCategory[] $frontendCategoryItemCategories
 */
class FrontendCategory extends MyActiveRecord
{
    public $brands;

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'frontend_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, product_category_id', 'required'),
			array('product_category_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, product_category_id, urlkey', 'safe', 'on'=>'search'),
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
			'productCategory' => array(self::BELONGS_TO, 'ProductCategory', 'product_category_id'),
			'frontendCategoryItemCategories' => array(self::HAS_MANY, 'FrontendCategoryItemCategory', 'frontend_category_id'),
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
			'product_category_id' => 'Product Category',
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
		$criteria->compare('product_category_id',$this->product_category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your MyActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FrontendCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getBrandsAbcList()
    {
        $abcList = array();
        foreach ($this->getBrandsList() as $item)
        {
            $letter = mb_strtoupper(substr($item['title'], 0, 1));
            $abcList[$letter][] = $item;
        }

        ksort($abcList);

        return $abcList;
    }

    public function getBrandsList()
    {
        if(count($this->brands))
            return $this->brands;

        $sql =
<<<EOF
SELECT b.* FROM brand b
JOIN item i ON i.brand_id = b.id
JOIN item_item_category iic ON iic.item_id = i.id
JOIN frontend_category_item_category fcic ON fcic.item_category_id = iic.item_category_id
JOIN product_item pi ON pi.item_id = i.id
JOIN product p ON pi.product_id = p.id
JOIN frontend_category fc ON fcic.frontend_category_id = fc.id
JOIN product_category pc ON p.category_id = pc.id AND fc.product_category_id = pc.id
WHERE fc.id = :frontend_category_id AND p.status = 1
GROUP BY b.id
EOF;
        $rows = Yii::app()->db->createCommand($sql)->queryAll(true, array(':frontend_category_id' => $this->id));
        if(count($rows))
        {
            $this->brands = $rows;
        }
        return $this->brands;
    }

    public function getItemCategoryTitle($case, $n = 'single') //падеж, число
    {
        $itemCategory = $this->frontendCategoryItemCategories[0]->itemCategory;
        $itemCategoryTitle = json_decode($itemCategory->title_wordforms);
        return $itemCategoryTitle->{$n}->{$case};
    }


}
