<?php

class CartController extends Controller
{
    public $layout='//layouts/product';
    private $cartItems = array();

    public function actionIndex()
    {
        $cartItems = array();
        $empty = true;
        foreach (Yii::app()->shoppingCart->getPositions() as $cartKey => $cartItem)
        {
            $empty = false;
            $model = new CartItem();
            $model->qty = $cartItem->getQuantity();
            $model->id = $cartItem->id;
            $model->cartItem = $cartItem;
            $model->cartKey = $cartKey;
            $cartItems[] = $model;
        }
        $this->render('index', array('cartItems'=>$cartItems, 'empty' => $empty));
    }

    public function actionDelete()
    {
        $cartItemKey = Yii::app()->request->getParam('key');
        Yii::app()->shoppingCart->remove($cartItemKey);
        $response = array();
        $response['status'] = 'success';
        $response['cart'] = $this->widget('miniCartWidget', array(), true);
        $response['fullCart'] = $this->widget('fullCartWidget', array(), true);
        $this->jsonResponse($response);
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
        $this->jsonResponse($response);
    }

    public function actionUpdate()
    {
        $response = array();
        $response['status'] = 'success';

        if($delivery = Yii::app()->request->getParam('delivery-method'))
        {
            if($delivery != Yii::app()->shoppingCart->getDeliveryMethodId())
            {
                Yii::app()->shoppingCart->setDeliveryMethod($delivery);
                $this->_saveDeliveryDataInSession();
                $response['delivery'] = $this->renderPartial('_delivery', array(), true);
                //if there's no alternative payment methods
                $deliveryMethod = Yii::app()->shoppingCart->getDeliveryMethod();
                if(count($deliveryMethod['allowed_payment_methods']) == 1)
                    Yii::app()->shoppingCart->setPaymentMethod($deliveryMethod['allowed_payment_methods'][0]);
                //render payment because delivery changed
                $response['payment'] = $this->renderPartial('_payment', array(), true);
                $deliveryChanged = false;
            }
        }
        //will be used when there is more payment methods
        if($payment = Yii::app()->request->getParam('payment') && !isset($deliveryChanged))
        {
            if($payment != Yii::app()->shoppingCart->getPaymentMethodId())
            {
                Yii::app()->shoppingCart->setPaymentMethod($payment);
                $response['payment'] = $this->renderPartial('_payment', array(), true);
            }
        }
        foreach ($this->getCartItems() as $cartKey => $model)
        {
                $product = Yii::app()->shoppingCart->itemAt($cartKey);
                if($model->qty > 0)
                    Yii::app()->shoppingCart->update($product,$model->qty);
        }
        $response['fullCart'] = $this->widget('fullCartWidget', array(), true); //move to _view
        $response['cart'] = $this->widget('miniCartWidget', array(), true);
        $this->jsonResponse($response);
    }

    public function actionValidate()
    {
        echo CActiveForm::validateTabular($this->getCartItems());
        Yii::app()->end();
    }

    protected function getCartItems()
    {
        if(!count($this->cartItems) && isset($_GET['cart']))
        {
            $cartItems = array();
            foreach ($_GET['cart'] as $cartKey => $qty) {
                $model = new CartItem(); //was made for validation, delete it now?
                $model->qty = $qty;
                $cartItems[$cartKey] = $model;
            }
            $this->cartItems = $cartItems;
        }
        return $this->cartItems;
    }

    private function _saveDeliveryDataInSession()
    {
        $deliveryFormData = Yii::app()->request->getParam('delivery');
        $deliveryData = array();
        foreach (Yii::app()->params['deliveryMethods'] as $deliveryMethod)
        {
            if( !$this->_isDeliveryMethodEmpty($deliveryFormData[$deliveryMethod['id']]) )
            {
                $chosenDeliveryId = $deliveryMethod['id'];
                foreach ($deliveryMethod['fields'] as $key => $value)
                {
                    if(isset($deliveryFormData[$chosenDeliveryId][$key]))
                    {
                        $deliveryData[$key] = $deliveryFormData[$chosenDeliveryId][$key];
                    }
                }
            }
        }
        Yii::app()->session['deliveryFormData'] = $deliveryData;
        return true;
    }

    private function _isDeliveryMethodEmpty(array $deliveryMethod)
    {
        foreach ($deliveryMethod as $field)
        {
            if(strlen($field))
                return false;//not empty
        }
        return true;
    }

}