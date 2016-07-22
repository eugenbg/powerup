<?php

Class Helper {

    public static function convertToBLR ($amount, $denominated = false)
    {
        $divider = $denominated ? 10000 : 1000;
        $conversionRate = Yii::app()->settings->get('main', 'usd_blr_conversion');
        return (int) ($amount*$conversionRate/$divider);
    }

    public static function getCurrencyPostfix($denominated = false)
    {
        if($denominated)
        {
            return 'BYN';
        }
        return 'тыс.руб';
    }

}