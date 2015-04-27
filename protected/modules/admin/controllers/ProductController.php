<?php

class ProductController extends Controller
{

    public $layout = 'main';

    public function actionIndex()
	{
        $model = new Product();
        $this->render('index', array('model' => $model));
	}

    public function actionEdit($id)
    {
        $model = Product::model()->findByPk($id);
        if(isset($_POST['Product']))
        {
            $model->attributes = $_POST['Product'];

            if($model->save() && Image::saveImages($model))
            {
                Yii::app()->user->setFlash('success', 'Успешно сохранено');
                $this->forward('product/index');
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
        $this->forward($this->createUrl('/admin/product/edit/', array('id'=>$product_id)));
    }
}