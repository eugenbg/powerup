<?php

/**
 * This is the model class for table "series_subseries".
 *
 * The followings are the available columns in table 'series_subseries':
 * @property integer $id
 * @property integer $series_id
 * @property integer $subseries_id
 */
class SeriesSubseries extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'series_subseries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('series_id, subseries_id', 'required'),
			array('series_id, subseries_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, series_id, subseries_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'series_id' => 'Series',
			'subseries_id' => 'Subseries',
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
		$criteria->compare('series_id',$this->series_id);
		$criteria->compare('subseries_id',$this->subseries_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SeriesSubseries the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getSubSeriesIdByUrlkeyAndParent(Series $series, $urlkey)
    {
        $sql =
<<<EOF
SELECT s.id FROM series s
JOIN series_subseries ss ON s.id = ss.subseries_id
WHERE s.urlkey = :urlkey AND ss.series_id = :series_id
EOF;
        $SeriesId = Yii::app()->db->createCommand($sql)->queryScalar(
            array(':urlkey' => $urlkey, ':series_id' => $series->id)
        );

        return $SeriesId;
    }

}
