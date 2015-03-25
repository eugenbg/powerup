<form id="cart-form">
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
    <button type="button" id="submit-cart" class="btn btn-order btn-lg pull-right">Оформить заказ</button>
</form>