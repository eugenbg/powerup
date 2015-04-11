<?php

/**
 * This is the model class for table "series".
 *
 * The followings are the available columns in table 'series':
 * @property integer $id
 * @property string $title
 * @property integer $parent_series_id
 * @property integer $brand_id
 *
 * The followings are the available model relations:
 * @property Item[] $items
 * @property Item[] $items1
 * @property Brand $brand
 * @property Series $parentSeries
 * @property Series[] $series
 */
class Series extends CActiveRecord
{

    public $items;
    public $subseries;
    public $partList = array();
    public $itemsList = array();


    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'series';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, brand_id', 'required'),
			array('parent_series_id, brand_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, parent_series_id, brand_id', 'safe', 'on'=>'search'),
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
			'items' => array(self::HAS_MANY, 'Item', 'series_id'),
			'items1' => array(self::HAS_MANY, 'Item', 'subseries_id'),
			'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
			'series' => array(self::HAS_MANY, 'Series', 'parent_series_id'),
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
			'parent_series_id' => 'Parent Series',
			'brand_id' => 'Brand',
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
		$criteria->compare('parent_series_id',$this->parent_series_id);
		$criteria->compare('brand_id',$this->brand_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Series the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getItemsList()
    {
        if(count($this->items))
            return $this->items;

        if($this->isSubseries())
        {
            $where = "WHERE fc.id = :frontend_category_id AND ss.id = :series_id";
        }
        else
        {
            $where = "WHERE fc.id = :frontend_category_id AND s.id = :series_id";
        }
        $sql =
<<<EOF
SELECT
i.*,
    (CASE
        WHEN i.series_id > 0 AND i.subseries_id > 0 THEN CONCAT(s.title, ' ', ss.title, ' ', i.title)
        WHEN i.series_id > 0 THEN CONCAT(s.title, ' ', i.title)
        ELSE i.title
    END) AS formatted_title
FROM brand b
JOIN item i ON i.brand_id = b.id
JOIN item_item_category iic ON iic.item_id = i.id
JOIN frontend_category_item_category fcic ON fcic.item_category_id = iic.item_category_id
JOIN product_item pi ON pi.item_id = i.id
JOIN product p ON pi.product_id = p.id
JOIN frontend_category fc ON fcic.frontend_category_id = fc.id
JOIN product_category pc ON p.category_id = pc.id AND fc.product_category_id = pc.id
LEFT JOIN series s ON i.series_id = s.id
LEFT JOIN series ss ON i.subseries_id = ss.id
$where
GROUP BY i.id
EOF;

        $rows = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(
                ':frontend_category_id' => Yii::app()->params['category']->id,
                ':series_id' => $this->id )
        );

        foreach ($rows as $row)
        {
            if($row['type'] == Item::TYPE_PART)
            {
                $this->partList[] = $row;
            }
            elseif ($row['type'] == Item::TYPE_MODEL)
            {
                $this->itemsList[] = $row;
            }
        }

        $this->items = $rows;
        return $this->items;
    }


    public function getSubseriesList()
    {
        if(count($this->subseries))
            return $this->subseries;

        $sql =
<<<EOF
SELECT
ss.*
FROM brand b
JOIN item i ON i.brand_id = b.id
JOIN item_item_category iic ON iic.item_id = i.id
JOIN frontend_category_item_category fcic ON fcic.item_category_id = iic.item_category_id
JOIN product_item pi ON pi.item_id = i.id
JOIN product p ON pi.product_id = p.id
JOIN frontend_category fc ON fcic.frontend_category_id = fc.id
JOIN product_category pc ON p.category_id = pc.id AND fc.product_category_id = pc.id
JOIN series s ON i.series_id = s.id
JOIN series ss ON i.subseries_id = ss.id
WHERE fc.id = :frontend_category_id AND s.id = :series_id
GROUP BY ss.id
EOF;

        $rows = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(
                ':frontend_category_id' => Yii::app()->params['category']->id,
                ':series_id' => $this->id )
        );

        $this->subseries = $rows;
        return $this->subseries;
    }

    public function getItemsAbcList()
    {
        return $this->_getAbcList('Items');
    }

    public function getSubseriesAbcList()
    {
        return $this->_getAbcList('Subseries');
    }

    public function getPartsAbcList()
    {
        return $this->_getAbcList('Parts');
    }

    private function _getAbcList($entity)
    {
        $methodName = 'get'.$entity.'List';
        $items = call_user_func(array($this, $methodName));
        $abcList = array();
        foreach ($items as $item)
        {
            if($entity == 'Items' || $entity == 'Parts')
            {
                $letter = mb_strtoupper(substr($item['formatted_title'], 0, 1));
            }
            else
            {
                $letter = mb_strtoupper(substr($item['title'], 0, 1));
            }
            $abcList[$letter][] = $item;
        }

        ksort($abcList);

        return $abcList;
    }

    public function isSubseries()
    {
        return (bool)Yii::app()->params['subseries'];
    }

    public function getPartsList()
    {
        if(count($this->partList))
        {
            return $this->partList;
        }
        else
        {
            $this->getItemsList();
            return $this->partList;
        }
    }

}
