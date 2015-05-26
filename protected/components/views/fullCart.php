<?php if(!count($cartItems)): ?>
<div class="full-cart-holder">
    <div class="panel panel-default">
        <div class="panel-heading">Корзина</div>
        <div class="panel-body">
            Ваша корзина пуста, наполните её :)
        </div>
    </div>
</div>
<?php else: ?>
<div class="full-cart-holder">
        <div class="panel panel-default">
            <div class="panel-heading">Корзина</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <th width="60%">Товар</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Всего</th>
                        <th></th>
                    </tr>
                    <?php foreach($cartItems as $key => $cartItem): ?>
                        <tr>
                            <td>
                                <?php echo $cartItem->getDynamicTitle(); ?>
                            </td>
                            <td>
                                <?php echo $cartItem->getPrice(); ?>
                                <?php echo Helper::getCurrencyPostfix(); ?>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="number" name="cart[<?php echo $key; ?>]" class="form-control" id="<?php echo $key; ?>" value="<?php echo (int)$cartItem->getQuantity(); ?>">
                                    <div class="hidden-xs input-group-addon">шт.</div>
                                </div>
                            </td>
                            <td>
                                <?php echo $cartItem->getSumPrice(); ?>
                                <?php echo Helper::getCurrencyPostfix(); ?>
                            </td>
                            <td>
                        <span class="glyphicon glyphicon-remove delete-from-cart"
                              data-key="<?php echo $key; ?>"></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if(Yii::app()->shoppingCart->getDeliveryPrice() > 0): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Доставка</td>
                            <td>
                                <?php echo Yii::app()->shoppingCart->getDeliveryPrice(); ?>
                                <?php echo Helper::getCurrencyPostfix(); ?>
                            </td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Всего</th>
                        <th><?php echo Yii::app()->shoppingCart->getBlrTotalCost(); ?></th>
                        <th></th>
                    </tr>
                </table>
            </div>
        </div>
    <button type="button" class="submit-cart btn btn-order btn-lg pull-right">Оформить заказ</button>
    <button type="button" id="refresh-cart" class="btn btn-success btn-lg pull-right">Обновить корзину</button>

</div>
<?php endif; ?>