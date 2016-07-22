<?php

class ReportController extends AdminController
{

    public $layout = 'main';

    public function actionIndex()
	{
        $products = Product::model()->with('productAttributes')->findAll();
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->getAttribute('price') * $product->getAttribute('inventory');
        }
        $this->render('index', ['totalPrice' => $totalPrice]);
	}
}