<?php

class MyActiveRecord extends CActiveRecord {

    public function getImages()
    {
        return Image::model()->findAllByAttributes(array('entity_type' => get_class($this), 'entity_id' => $this->id));
    }

}