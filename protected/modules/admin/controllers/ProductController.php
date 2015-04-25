<?php

class ProductController extends Controller
{

    public $layout = 'main';

    public function actionIndex()
	{
        $model = new Product();
        $this->render('index', array('model' => $model));
	}
}