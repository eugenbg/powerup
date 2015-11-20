<?php

/**
 * This is the model class for table "brand".
 *
 * The followings are the available columns in table 'brand':
 * @property integer $id
 * @property string $title
 *
 * The followings are the available model relations:
 * @property Item[] $items
 * @property Series[] $series
 */
class Brand extends MyActiveRecord
{
    public $itemsList = array();
    public $partList = array();
    public $seriesList = array();

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'brand';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('title', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title', 'safe', 'on'=>'search'),
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
			'items' => array(self::HAS_MANY, 'Item', 'brand_id'),
			'series' => array(self::HAS_MANY, 'Series', 'brand_id'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your MyActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Brand the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /*
     * get list of series that should be shown in this brand in context of given categoryy
     */
    public function getSeriesList()
    {
        if(count($this->seriesList))
            return $this->seriesList;

        $sql=
<<<EOF
SELECT s.* FROM brand b
JOIN item i ON i.brand_id = b.id
JOIN series s ON i.series_id = s.id
JOIN item_item_category iic ON iic.item_id = i.id
JOIN frontend_category_item_category fcic ON fcic.item_category_id = iic.item_category_id
JOIN product_item pi ON pi.item_id = i.id
JOIN frontend_category fc ON fcic.frontend_category_id = fc.id
JOIN product p ON pi.product_id = p.id
JOIN product_category pc ON p.category_id = pc.id AND fc.product_category_id = pc.id
WHERE fc.id = :frontend_category_id AND b.id = :brand_id AND p.status = 1
GROUP BY s.id
EOF;

        $rows = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(':frontend_category_id' => Yii::app()->params['category']->id, ':brand_id' => $this->id)
        );

        $this->seriesList = $rows;

        return $rows;
    }

    public function getItemsList()
    {
        if(count($this->itemsList))
            return $this->itemsList;
        $sql =
<<<EOF
SELECT
i.*, p.inventory, p.code as product_code,
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
WHERE fc.id = :frontend_category_id AND b.id = :brand_id AND p.status = 1
GROUP BY i.id
EOF;

        $rows = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(':frontend_category_id' => Yii::app()->params['category']->id, ':brand_id' => $this->id)
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

        return $this->itemsList;
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

    public function getItemsAbcList()
    {
        return $this->_getAbcList('Items');
    }

    public function getSeriesAbcList()
    {
        return $this->_getAbcList('Series');
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

}
