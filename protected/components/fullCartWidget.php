<?php

class fullCartWidget extends CWidget
{

    public function run()
    {
        $this->render('fullCart', array('cartItems'=>Yii::app()->shoppingCart->getPositions()));
    }
}