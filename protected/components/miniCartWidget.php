<?php

class miniCartWidget extends CWidget
{

    public function run()
    {
        $i = 0;
        $miniCartItems = array();
        foreach (Yii::app()->shoppingCart->getPositions() as $key => $cartItem)
        {
            $i++;
            if ($i>3)
                continue;
            $miniCartItems[$key] = $cartItem;
        }

        $this->render('miniCart', array('items'=>$miniCartItems));
    }
}