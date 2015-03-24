var cart = new BaseClass();

cart.map = {
    'cart' : '.mini-cart-holder'
}

cart.init = function()
    {
        var me = this
        $(document).on('click', '.add-to-cart', function(event){
            event.preventDefault();
            me.addToCart(event);
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

jQuery(document).ready(function () {
    cart.init()
})