<?php
$this->pageTitle = "Корзина";
?>

<form id="cart-form" action="/checkout/order" method="POST">
    <?php if($empty): ?>
    <p>
        Ваша корзина пуста
    </p>
    <?php else: ?>
    <?php $this->widget('fullCartWidget', array()); ?>
    <div class="clearfix"></div>
    <hr class="dashed">
    <div class="row">
        <div class="col-sm-6">
            <?php $this->renderPartial('_delivery', array()); ?>
        </div>
        <div class="col-sm-6">
            <?php $this->renderPartial('_payment', array()); ?>
        </div>
    </div>
    <hr class="dashed">
    <button type="button" class="submit-cart btn btn-order btn-lg pull-right">Оформить заказ</button>
    <?php endif; ?>
</form>