<div class="panel panel-default" id="delivery-method">
    <div class="panel-heading">Выберите доставку</div>
    <div class="panel-body">
        <?php foreach(Yii::app()->params->deliveryMethods as $id => $delivery): ?>
            <?php $chosenDelivery = Yii::app()->shoppingCart->getDeliveryMethod();
            $checked = $chosenDelivery['id'] == $id ? 'checked' : ''; ?>
            <div class="radio">
                <label>
                    <input type="radio" name="delivery" value="<?php echo $id; ?>" <?php echo $checked; ?>>
                    <?php echo $delivery['title']; ?>
                </label>
                        <span class="glyphicon glyphicon-info-sign"
                              data-toggle="tooltip" data-placement="right"
                              title="<?php echo $delivery['info']; ?>"></span>
            </div>
            <div class="delivery-form" <?php echo $checked ? 'style="display:block"' : ''; ?>>
                <?php foreach($delivery['fields'] as $key => $field): ?>
                    <?php if($field['type'] = 'text'): ?>
                        <div class="input-group">
                            <div class="input-group-addon"><?php echo $field['label']; ?></div>
                            <input type="text" class="form-control" name="<?php echo $key; ?>">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>