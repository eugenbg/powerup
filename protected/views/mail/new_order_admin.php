<p>
    Привет админ! Скорее перезвони клиенту! Номер заказа <?php echo $order->id; ?>
</p>
<p>
    Заказ:
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
    <?php $address = json_decode($order->address, true); ?>
    Адрес доставки:<br/>
    <?php foreach ($address as $addressField => $value): ?>
        <?php echo sprintf('%s : %s', $addressField, $value); ?><br/>
    <?php endforeach; ?>
</p>
<p>
    Мы скоро перезвоним, чтобы уточнить детали!
</p>