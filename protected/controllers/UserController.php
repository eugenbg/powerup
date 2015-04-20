<?php

class UserController extends Controller
{
    public $layout='//layouts/product';

    public function actionRegister(){

        $model = new User();
        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            if($model->register())
                $this->redirect(array('registered'));
        }

        // display the login form
        $this->render('register',array('model'=>$model));
    }

    public function actionRegistered()
    {
        $this->render('registered',array());
    }
    
}