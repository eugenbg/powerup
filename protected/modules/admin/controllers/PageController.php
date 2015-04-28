<?php

class PageController extends AdminController
{

    public $layout = 'main';

    public function actionIndex()
	{
        $this->render('index');
	}

    public function actionEdit($id)
    {
        $model = Page::model()->findByPk($id);
        if(isset($_POST['Page']))
        {
            $model->attributes = $_POST['Page'];

            if($model->save())
            {
                Yii::app()->user->setFlash('success', 'Успешно сохранено');
                $this->redirect('/admin/page/index');
            }
            else
            {
                Yii::app()->user->setFlash('error', 'Произошла ошибка при сохранении');
                $errors = $model->getErrors();
            }
        }
        $this->render('edit', array('model' => $model));
    }

    public function actionDeleteimage($product_id, $image_id)
    {
        Image::deleteImage('Product', $product_id, $image_id);
        $this->redirect($this->createUrl('/admin/product/edit/', array('id'=>$product_id)));
    }

}