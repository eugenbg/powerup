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

        $sql =
'SELECT i.* FROM item i
JOIN product_item pi ON pi.item_id = i.id
JOIN product p on p.id = pi.product_id
JOIN category c on c.id = p.category_id
JOIN brand b on b.id = i.brand_id
WHERE i.brand_id = :brand_id AND p.category_id = :category_id AND i.series_id = :series_id
GROUP BY i.id
';

        $rows = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(':category_id' => Yii::app()->params['category']->id,
                ':brand_id' => Yii::app()->params['brand']->id,
                ':series_id' => $this->id )
        );

        $this->items = $rows;
        return $this->items;
    }

    public function getItemsAbcList()
    {
        $abcList = array();
        foreach ($this->getItemsList() as $item)
        {
            $letter = mb_strtoupper(substr($item['title'], 0, 1));
            $abcList[$letter][] = $item;
        }

        ksort($abcList);

        return $abcList;
    }


}
