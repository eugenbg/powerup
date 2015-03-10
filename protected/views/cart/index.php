<h1>Корзина</h1>
<?php $cartItems = Yii::app()->shoppingCart->getPositions(); ?>
<?php foreach ($cartItems as $item): ?>
    <p>
        <?php echo $item->title; ?> : добавлено <?php echo $item->getQuantity(); ?>шт. : всего <?php echo $item->getSumPrice(); ?>$
    </p>
<?php endforeach; ?>

<a href="<?php $this->createUrl('checkout'); ?>">Оформить заказ</a>