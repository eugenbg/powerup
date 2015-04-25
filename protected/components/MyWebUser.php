<?php

class MyWebUser extends CWebUser{

    private $_user = null;
    public $loginUrl='/site/login';

    public function init(){
        parent::init();
        if(!$this->getIsGuest()){
            $this->_user = User::model()->findByPk($this->getId());
        }
    }
    public function getUser(){
        return $this->_user;
    }
}