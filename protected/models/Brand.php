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
class Brand extends CActiveRecord
{
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
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
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
        $sql =
'SELECT s.* FROM series s
JOIN item i ON i.series_id = s.id
JOIN product_item pi ON pi.item_id = i.id
JOIN product p on p.id = pi.product_id
JOIN category c on c.id = p.category_id
JOIN brand b on b.id = i.brand_id
WHERE s.brand_id = :brand_id AND p.category_id = :category_id
GROUP BY s.id
';

        $rows = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(':category_id' => Yii::app()->params['category']->id, ':brand_id' => $this->id)
        );

        return $rows;
    }

    public function getItemsList()
    {
        $sql =
'SELECT i.* FROM item i
JOIN product_item pi ON pi.item_id = i.id
JOIN product p on p.id = pi.product_id
JOIN category c on c.id = p.category_id
JOIN brand b on b.id = i.brand_id
WHERE i.brand_id = :brand_id AND p.category_id = :category_id AND i.series_id IS NULL
GROUP BY i.id
';

        $rows = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(':category_id' => Yii::app()->params['category']->id, ':brand_id' => $this->id)
        );

        return $rows;
    }

}
