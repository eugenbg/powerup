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
            цена: <?php echo $orderItem->price*10 .'тыс.руб.'; ?><?php echo $orderItem->qty > 1 ? ', всего:' . $orderItem->row_total*10 .'тыс.руб.' : ''; ?>
        </li>
    <?php endforeach; ?>
</ul>
<p>
    Стоимость доставки <?php echo Yii::app()->shoppingCart->getDeliveryPrice()*10 .'тыс.руб.'; ?><br>
    Всего к оплате <?php echo $order->total_price*10 .'тыс.руб.'; ?>
</p>
<p>
    Адрес доставки: <?php echo implode(',',json_decode($order->address, true)); ?>
</p>
<p>
    Мы скоро перезвоним, чтобы уточнить детали!
</p>