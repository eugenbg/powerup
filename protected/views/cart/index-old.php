<h1>Корзина</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'cart-form',
    'enableAjaxValidation'=>true,
    'action' => $this->createUrl('cart/update'),
)); ?>
    <?php echo CHtml::hiddenField('redirect' , 'cart', array('id' => 'redirect')); ?>
    <?php foreach ($cartItems as $model): ?>
        <div class="row">
            <?php echo $model->cartItem->title; ?> : добавлено
            <?php
            echo $form->textField($model,'qty',
                array('name'=>'cart['.$model->cartKey.']', 'id'=>$model->cartKey)
            ); ?>
            шт. : всего <?php echo $model->cartItem->getSumPrice(); ?>$
            <?php echo $form->error($model,'qty'); ?>
        </div>
    <?php endforeach; ?>
    <div class="row submit">
        <?php echo CHtml::submitButton('Обновить корзину'); ?>
    </div>
<?php $this->endWidget(); ?>
<div class="row submit">
    <?php echo CHtml::Button('Оформить заказ', array('id'=>'place-order')); ?>
</div>
</div>
<script type="text/javascript">
    $('#cart-form').on('submit', function(e)
    {
        e.preventDefault();
        $('#redirect').val('cart')
        cart.validateSubmit()
    })

    $('#cart-form').find('input').on('focus', function () {
        $(this).parent().find('.errorMessage').fadeOut().html('')
    })

    $('#place-order').on('click', function()
    {
        $('#redirect').val('checkout')
        cart.validateSubmit()
    })


    /*
    cart object
     */
    var cart = {}

    cart.validated = false

    cart.validateSubmit = function()
    {
        var postData = {
            data : $('#cart-form').serializeArray(),
            ajax : 'cart-form'
        }
        $.ajax(
            '<?php echo $this->createUrl('cart/validate');?>',
            {
                data: $('#cart-form').serializeArray(),
                method: 'POST',
                dataType: 'JSON',
                success: function(response){
                    if(!$.isEmptyObject(response))
                    {
                        for (key in response) { //iterate models with errors
                            var error = response[key]
                            var id = key.replace('CartItem_','').replace('_qty','')
                            for (var i = 0; i < error.length; i++) { //iterate errors
                                $('#'+id).parent().find('.errorMessage').html(error[i]).show()
                            }
                        }
                        cart.validated = false;
                    }
                    else
                    {
                        cart.validated = true;
                        cart.submit()
                    }
                }
            } //ajax settings
        ) //ajax
    }

    cart.submit = function ()
    {
        $('#cart-form').unbind('submit').submit()
    }

</script>