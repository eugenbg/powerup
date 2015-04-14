<?php

Class Helper {

    public static function convertToBLR ($amount)
    {
        $conversionRate = Yii::app()->params['usd-blr'];
        return (int) ($amount*$conversionRate/1000);
    }

    public static function getCurrencyPostfix ()
    {
        return 'тыс.руб';
    }
}