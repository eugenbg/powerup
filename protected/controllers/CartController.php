<?php

class CartController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionAdd()
    {
        $id = Yii::app()->request->getParam('product_id');
        $product = Product::model()->findByPk($id);
        Yii::app()->shoppingCart->put($product);
        $this->redirect('index');
        Yii::app()->end();
    }
}