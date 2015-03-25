<div class="panel panel-default" id="payment-method">
    <div class="panel-heading">Метод оплаты</div>
    <div class="panel-body">
        <?php foreach (Yii::app()->params->paymentMethods as $id => $payment): ?>
            <?php $chosenDelivery = Yii::app()->shoppingCart->getDeliveryMethod();
            if (in_array($id, $chosenDelivery['allowed_payment_methods'])):
                $chosenPayment = Yii::app()->shoppingCart->getPaymentMethod();
                $checked = $chosenPayment['id'] == $id ? 'checked' : ''; ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="payment" value="<?php echo $id; ?>" <?php echo $checked; ?>>
                        <?php echo $payment['title']; ?>
                    </label>
                    <span class="glyphicon glyphicon-info-sign"
                          data-toggle="tooltip" data-placement="right"
                          title="<?php echo $payment['info']; ?>"></span>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>