<?php

class BrandController extends AdminController
{

    public $layout = 'main';

    public function actionIndex()
	{
        $this->render('index');
	}

    public function actionEdit($id)
    {
        $model = Brand::model()->findByPk($id);
        if(isset($_POST['Brand']))
        {
            $model->attributes = $_POST['Brand'];
            if($model->save() && Image::saveImages($model))
            {
                Yii::app()->user->setFlash('success', 'Успешно сохранено');
                $this->redirect('/admin/brand/index');
            }
            else
            {
                Yii::app()->user->setFlash('error', 'Произошла ошибка при сохранении');
                $errors = $model->getErrors();
            }
        }
        $this->render('edit', array('model' => $model));
    }

}