<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CartForm extends CFormModel
{
	public $qty;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
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
