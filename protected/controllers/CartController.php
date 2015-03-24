<?php

class CartController extends Controller
{
    public $layout='//layouts/column2';
    private $cartItems = array();

    public function actionIndex()
    {
        $cartItems = array();
        foreach (Yii::app()->shoppingCart->getPositions() as $cartKey => $cartItem)
        {
            $model = new CartItem();
            $model->qty = $cartItem->getQuantity();
            $model->id = $cartItem->id;
            $model->cartItem = $cartItem;
            $model->cartKey = $cartKey;
            $cartItems[] = $model;
        }
        $this->render('index', array('cartItems'=>$cartItems));
    }

    public function actionAdd()
    {
        $id = Yii::app()->request->getParam('product_id');
        $product = Product::model()->findByPk($id);
        $product->item = Item::model()->findByPk(Yii::app()->request->getParam('item_id'));
        Yii::app()->shoppingCart->put($product);
        $response = array();
        $response['status'] = 'success';
        $response['cart'] = $this->widget('miniCartWidget', array(), true);
        $response['button'] = $this->renderPartial('order-button', array(), true);
        header('Content-type: application/json');
        echo CJSON::encode($response);
        die();
    }

    public function actionUpdate()
    {
        $redirect = Yii::app()->request->getParam('redirect');
        if(!count($this->getCartItems()))
            die('палехче, нету данных в вашем запросе!');
        foreach ($this->getCartItems() as $cartKey => $model) {
            $product = Yii::app()->shoppingCart->itemAt($cartKey);
            Yii::app()->shoppingCart->update($product,$model->qty);
        }
        if($redirect == 'checkout')
            $this->redirect('checkout/index');
        else
            $this->redirect('index');
    }

    public function actionValidate()
    {
        echo CActiveForm::validateTabular($this->getCartItems());
        Yii::app()->end();
    }

    protected function getCartItems()
    {
        if(!count($this->cartItems) && isset($_POST['cart']))
        {
            $cartItems = array();
            foreach ($_POST['cart'] as $cartKey => $qty) {
                $model = new CartItem();
                $model->qty = $qty;
                $cartItems[$cartKey] = $model;
            }
            $this->cartItems = $cartItems;
        }
        return $this->cartItems;
    }

}