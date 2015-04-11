<div class="mini-cart-holder" data-delivery-price="<?php echo Yii::app()->shoppingCart->getDeliveryPrice(); ?>">
    <a class="dropdown-toggle" id="shopping-cart-icon">
        <i class="fa fa-shopping-cart"></i><span>КОРЗИНА</span>
    </a>
    <?php if(Yii::app()->shoppingCart->getItemsCount() > 0): ?>
        <div class="popover fade left in" style="">
            <div class="arrow"></div>
            <div class="popover-content"><?php echo Yii::app()->shoppingCart->getItemsCount(); ?> шт. (<?php echo Yii::app()->shoppingCart->getBlrTotalCost(); ?>)</div>
        </div>
    <?php endif; ?>


    <div class="mini-cart">
        <?php if(count($items)):?>
            <ul class="mini-cart-list list-group">
                <?php foreach($items as $key => $product): ?>
                    <li class="list-group-item cart-item">
                        <span class="glyphicon glyphicon-remove pull-right delete-from-cart"
                              data-key="<?php echo $key; ?>"></span>
                        <span class="model-title">
                            <?php echo $product->getDynamicTitle(); ?>
                        </span>
                        <span class="qty">
                            <?php echo (int)$product->getQuantity(); ?>
                        </span>
                        <span class="mini-cart-x">x</span>
                        <span class="price">
                            <?php echo $product->getPrice(); ?>
                            <?php echo Helper::getCurrencyPostfix(); ?>
                        </span>
                    </li>
                <?php endforeach; ?>
                <li class="list-group-item totals">
                    <span class="total-label">
                        Доставка:
                    </span>
                    <span class="price">
                        <?php echo Yii::app()->shoppingCart->getDeliveryPrice(); ?>
                        <?php echo Helper::getCurrencyPostfix(); ?>
                    </span>
                    <br/>
                    <span class="total-label">
                        Всего:
                    </span>
                    <span class="price">
                        <?php echo Yii::app()->shoppingCart->getBlrTotalCost(); ?>
                    </span>
                </li>
                <li class="list-group-item totals">
                    <a href="<?php echo Yii::app()->controller->createUrl('cart/index'); ?>"
                       class="btn btn-ar btn-order btn-sm">
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


