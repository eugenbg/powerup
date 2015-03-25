<div class="mini-cart-holder" data-delivery-price="<?php echo Yii::app()->shoppingCart->getDeliveryPrice(); ?>">
    <a class="dropdown-toggle" id="shopping-cart-icon">
        КОРЗИНА <i class="fa fa-shopping-cart"></i>
    </a>
    <?php if(Yii::app()->shoppingCart->getItemsCount() > 0): ?>
        <div class="popover fade left in" style="">
            <div class="arrow"></div>
            <div class="popover-content"><?php echo Yii::app()->shoppingCart->getItemsCount(); ?> шт. (<?php echo Yii::app()->shoppingCart->getCost()*10; ?> тыс.руб)</div>
        </div>
    <?php endif; ?>


    <div class="mini-cart">
        <?php if(count($items)):?>
            <ul class="mini-cart-list list-group">
                <?php foreach($items as $product): ?>
                    <li class="list-group-item cart-item">
                <span class="model-title">
                    <?php echo $product->getDynamicTitle(); ?>
                </span>
                <span class="price">
                    <?php echo (int)$product->price*10; ?> т.р.
                </span>
                <span class="qty">
                    (<?php echo (int)$product->getQuantity(); ?> шт.)
                </span>
                    </li>
                <?php endforeach; ?>
                <li class="list-group-item totals">
            <span class="total-label">
                Всего:
            </span>
            <span class="price">
                <?php echo Yii::app()->shoppingCart->getCost()*10; ?> тыс.руб.
            </span>
                    <a href="<?php echo Yii::app()->controller->createUrl('cart/index'); ?>"
                       class="btn btn-ar btn-success btn-sm pull-right">
                        <i class="fa fa-shopping-cart"></i>
                        Оформить Заказ
                    </a>
                </li>
            </ul>
        <?php else: ?>
            <ul class="mini-cart-list list-group">
                <li class="list-group-item totals">
                    Корзина пуста
                </li>
            </ul>
        <?php endif; ?>
    </div>
</div>


