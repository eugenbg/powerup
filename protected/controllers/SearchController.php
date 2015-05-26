<?php

class SearchController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/product';

    public function actionIndex()
	{
        $query = Yii::app()->request->getParam('search_query');
        $cleanQuery = preg_replace('/[^a-zA-Z0-9 +]/', '', $query);
        $queryWords = explode(' ', $cleanQuery);
        $search = new Search();
        $result = $search->query($queryWords);
		$this->render('index', array('result' => $result, 'query' => $query));
	}

}