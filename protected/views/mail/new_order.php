<p>
    Спасибо за заказ! Номер заказа <?php echo $order->id; ?>
</p>
<p>
    Ваш заказ:
</p>
<ul>
    <?php foreach ($orderItems as $orderItem): ?>
        <li>
            <?php echo $orderItem->title; ?>, <?php echo $orderItem->qty; ?>шт.,
            цена: <?php echo $orderItem->getFormattedPrice(); ?><?php echo $orderItem->qty > 1 ? ', всего:' . $orderItem->row_total .'тыс.руб.' : ''; ?>
        </li>
    <?php endforeach; ?>
</ul>
<p>
    Стоимость доставки <?php echo Yii::app()->shoppingCart->getFormattedDeliveryPrice(); ?><br>
    Всего к оплате <?php echo $order->getFormattedTotalPrice(); ?>
</p>
<p>
    Адрес доставки: <?php echo is_array($order->address) ? implode(',',json_decode($order->address, true)) : $order->address; ?>
</p>
<p>
    Мы скоро перезвоним, чтобы уточнить детали!
</p>