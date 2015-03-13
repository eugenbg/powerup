<?php

class CartItem extends CFormModel
{
    public $id;
	public $qty;
    public $cartItem;
    public $cartKey;

	public function rules()
	{
		return array(
			// username and password are required
			array('qty', 'required'),
			// rememberMe needs to be a boolean
            array('qty','numerical',
                'integerOnly'=>true,
                'min'=>1,
                'tooSmall'=>'You must order at least 1 piece')
        );
	}
}
