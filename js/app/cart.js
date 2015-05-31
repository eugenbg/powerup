var cart = new BaseClass();

cart.map = {
    'cart' : '.mini-cart-holder',
    'fullCart' : '.full-cart-holder',
    'delivery' : '#delivery-method',
    'payment' : '#payment-method'
}

cart.init = function()
    {
        var me = this
        $(document).on('click', '.add-to-cart', function(event){
            event.preventDefault();
            me.addToCart(event);
        })
        $(document).on('click', '.delete-from-cart', function(event){
            event.preventDefault();
            me.deleteFromCart(event);
        })
        $(document).on('click', '#refresh-cart', function(event){
            event.preventDefault();
            me.refreshCart(event);
        })
        $(document).on('click', '#shopping-cart-icon, .top-nav .popover', function(){
            $('.mini-cart').toggle()
            if($('.mini-cart').is(':visible'))
            {
                $('.top-nav .popover').hide()
            }
            else
            {
                $('.mini-cart-holder .popover').show()
            }
        })

        $(document).on('change', 'input[name=delivery-method], input[name=payment]', function(){
            me.refreshCart(event);
        })

        $('[data-toggle="tooltip"]').tooltip()

        $(document).on('click', '.submit-cart', function(){
            me.submitOrder();
        })

    }

cart.addToCart = function(event)
{
    this.map.button = $(event.target);
    $.ajax(
        $(this.map.button).attr('href'),
        {
            success: function(data){
                this.update(data)
                $('#shopping-cart-icon').click()
            }.bind(this)
        }
    )
}

cart.deleteFromCart = function(event)
{
    $.ajax(
        '/cart/delete',
        {
            data: $(event.target).data(),
            success: function(data){
                this.update(data)
            }.bind(this)
        }
    )
}

cart.refreshCart = function()
{
    $.ajax(
        '/cart/update',
        {
            data: $('#cart-form').serialize(),
            success: function(data){
                this.update(data)
                $('[data-toggle="tooltip"]').tooltip()
            }.bind(this)
        }
    )
}

cart.submitOrder = function ()
{
    $('#cart-form').submit()

/*
    $.ajax(
        '/checkout/validateOrder',
        {
            data: $('#cart-form').serialize(),
            success: function(data){
                if(data.status = 'success')
                {
                }
            }.bind(this)
        }
    )
*/
}

jQuery(document).ready(function () {
    cart.init()
})