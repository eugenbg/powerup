<?php

class PageController extends Controller
{
    public $layout='//layouts/product';

    public function actionView($id)
	{
        $page = Page::model()->findByPk($id);
        $this->pageTitle = $page->title;
		$this->render('view', array('model' => $page));
	}

}