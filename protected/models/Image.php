<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property integer $id
 * @property string $entity_type
 * @property integer $entity_id
 * @property string $file
 * @property string $thumbnail_file
 */
class Image extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('entity_type, entity_id, file', 'required'),
			array('entity_id', 'numerical', 'integerOnly'=>true),
			array('entity_type', 'length', 'max'=>10),
			array('file', 'length', 'max'=>256),
			array('thumbnail_file', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, entity_type, entity_id, file, thumbnail_file', 'safe', 'on'=>'search'),
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
			'entity_type' => 'Entity Type',
			'entity_id' => 'Entity',
			'file' => 'File',
			'thumbnail_file' => 'Thumbnail File',
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
		$criteria->compare('entity_type',$this->entity_type,true);
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('thumbnail_file',$this->thumbnail_file,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Image the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * saves images for any given model, entity_id is pk of model, entity_type is model Class
     * @param $model
     * @return array of saved images
     */
    public static function saveImages($model)
    {
        $entity_type = get_class($model);
        $folder = strtolower($entity_type);
        self::makeDirIfNotExists(Yii::getPathOfAlias('webroot')."/media/$folder/");

        $images = CUploadedFile::getInstancesByName('images');
        $returnImages = array();
        if (isset($images) && count($images) > 0) {
            // go through each uploaded image
            foreach ($images as $image => $pic) {
                if ($pic->saveAs(Yii::getPathOfAlias('webroot') . "/media/$folder/" . $pic->name)) {
                    $image = new Image();
                    $image->file = "/media/$folder/" . $pic->name;
                    $image->entity_type = $entity_type;
                    $image->entity_id = $model->id;
                    $image->save();
                    $thumb = self::makeThumbnail($image);
                    $image->thumbnail_file = str_replace(Yii::getPathOfAlias('webroot'), '', $thumb[0]);
                    $image->save();
                    $returnImages[] = $image;
                } else {
                    Yii::app()->user->setFlash('error', "image $image could not be saved!");
                }
            }
        }
        return $returnImages;
    }

    /**
     * @param $model CActiveRecord
     * @return array of image models for provided model
     */
    public static function getModelImages($model)
    {

    }

    public static function makeThumbnail($image)
    {
        Yii::app()->ThumbsGen->thumbWidth = 100;
        Yii::app()->ThumbsGen->thumbHeight = 100;
        $folder = strtolower($image->entity_type);
        Yii::app()->ThumbsGen->baseSourceDir = Yii::getPathOfAlias('webroot')."/media/$folder/";
        Yii::app()->ThumbsGen->baseDestDir = Yii::getPathOfAlias('webroot')."/media/$folder/thumbs/";
        self::makeDirIfNotExists(Yii::app()->ThumbsGen->baseDestDir);
        $fileName = end(explode('/', $image->file));
        Yii::app()->ThumbsGen->nameImages = array($fileName);
        return Yii::app()->ThumbsGen->createThumbnails();
    }

    public static function makeDirIfNotExists($path)
    {
        if(!is_dir($path)) {
            mkdir($path);
            chmod($path, 0755);
        }
    }

}
