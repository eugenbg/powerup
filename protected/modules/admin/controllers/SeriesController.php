<?php

class SeriesController extends AdminController
{

    public $layout = 'main';

    public function actionIndex()
	{
        $this->render('index');
	}

    public function actionEdit($id)
    {
        $model = Series::model()->findByPk($id);
        if(isset($_POST['Series']))
        {
            $model->attributes = $_POST['Series'];

            if($model->save())
            {
                Yii::app()->user->setFlash('success', 'Успешно сохранено');
                $this->redirect('/admin/series/index');
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