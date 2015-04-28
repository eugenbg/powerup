<?php

class AdminController extends Controller {

    public function actionDeleteimage($entity_id, $image_id)
    {
        $splitControllerName = preg_split('/(?=[A-Z])/', get_class($this));
        $class = $splitControllerName[1];
        Image::deleteImage($class, $entity_id, $image_id);
        $this->redirect(Yii::app()->createUrl('/admin/'.$this->getId().'/edit/id/', array('id'=>$entity_id)));
    }

}