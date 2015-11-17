<?php

class ProductController extends AdminController
{

    public $layout = 'main';

    public function actionIndex()
	{
        $model = new Product('search');
        if(isset($_GET['Product']))
        {
            $model->attributes=$_GET['Product'];
        }

        $this->render('index', array('model' => $model));
	}

    public function actionEdit($id)
    {
        $model = Product::model()->with('productAttributes')->findByPk($id);
        if(isset($_POST['Product']))
        {
            $model->attributes = $_POST['Product'];

            if($model->save() && Image::saveImages($model))
            {
                Yii::app()->user->setFlash('success', 'Продукт успешно сохранен');

                /**
                 * if products is saved, try to save its attributes
                 */
                if(isset($_POST['ProductAttributes']))
                {
                    $attributesModel = $model->productAttributes;
                    $attributesModel->attributes = $_POST['ProductAttributes'];
                    if(!$attributesModel->save())
                    {
                        Yii::app()->user->setFlash('error', 'Произошла ошибка при сохранении доп. аттрибутов');
                        $errors = $model->getErrors();
                    }
                }
                $this->redirect(array('/admin/product/edit', 'id'=>$model->id));
            }
            else
            {
                Yii::app()->user->setFlash('error', 'Произошла ошибка при сохранении продукта');
                $errors = $model->getErrors();
            }
        }

        $this->render('edit', array('model' => $model, 'attributesModel' => $model->productAttributes));
    }

}