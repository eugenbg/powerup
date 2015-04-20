<?php


class RegisterForm extends CFormModel
{
    public $username;
	public $password;
    public $email;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('password, email, username', 'required'),
			// rememberMe needs to be a boolean
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

    public function register(){
        $model = new User();
        return true;
    }

}
