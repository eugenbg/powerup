<?php

Class Helper {

    public static function convertToBLR ($amount)
    {
        $conversionRate = Yii::app()->settings->get('main', 'usd_blr_conversion');
        return (int) ($amount*$conversionRate/1000);
    }

    public static function getCurrencyPostfix()
    {
        return 'тыс.руб';
    }
}