<?php

class ItemController extends AdminController
{

    public $layout = 'main';

    public function actionIndex()
	{
        $this->render('index');
	}

    public function actionEdit($id)
    {
        $model = Item::model()->findByPk($id);
        if(isset($_POST['Item']))
        {
            $model->attributes = $_POST['Item'];

            if($model->save())
            {
                Yii::app()->user->setFlash('success', 'Успешно сохранено');
                $this->redirect('/admin/item/index');
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