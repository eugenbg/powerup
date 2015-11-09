<?php

class ItemController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/product';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','assign'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * @param $id
	 * @throws CHttpException
	 */
	public function actionView($id)
	{
        $model=Item::model()->with('brand', 'series', 'subseries', 'itemItemCategories')->findByPk($id);
        $frontendCategory = Yii::app()->params['category'];
        $ItemFrontendCategoryMatch = false;
        $allowedItemCategories = array();
        foreach ($frontendCategory->frontendCategoryItemCategories as $allowedItemCategory)
        {
            $allowedItemCategories[] = $allowedItemCategory->item_category_id;
        }
        foreach ($model->itemItemCategories as $itemCategory)
        {
            if(in_array($itemCategory->item_category_id, $allowedItemCategories))
                $ItemFrontendCategoryMatch = true;
        }

		$this->setMeta($model);

        if($ItemFrontendCategoryMatch)
        {
            $this->render('view',array(
                'model'=>$model,
            ));
        }
        else
        {
            throw new CHttpException(404,'Неверный адрес странички');
        }
	}

	public function setMeta($model)
	{
		$products = $model->getLeadingProducts();
		if(count($products) == 1)
		{
			$product = $products[0];
			$title = $model->getFullTitle();
			$title = str_replace('Аккумулятор', 'Аккумулятор (АКБ, батарея)', $title);
			$attributes = $product->productAttributes;
			$price = $product->getPrice() . Helper::getCurrencyPostfix();
			$description = sprintf('%s %s, цена %s. Доставка по Беларуси. Гарантия 12 месяцев',
				$title,
				$attributes->bb_battery_capacity_mah,
				$price
			);
			$description = str_replace('  ', ' ', $description);
			Yii::app()->params['metaDescription'] = $description;
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Item;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Item']))
		{
			$model->attributes=$_POST['Item'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Item']))
		{
			$model->attributes=$_POST['Item'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionAssign($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Item']))
        {
            ProductItem::model()->deleteAll('item_id = :item_id', array(':item_id' => $model->id));
            if(count($_POST['Item']['productItemIds']) && is_array($_POST['Item']['productItemIds']))
            {
                foreach ($_POST['Item']['productItemIds'] as $productId)
                {
                    $productItem = new ProductItem();
                    $productItem->item_id = $model->id;
                    $productItem->product_id = $productId;
                    $productItem->save();
                }
            }
            /* else
            {
                throw new CHttpException(500,'Item must have at least one product!');
            } */

            $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('assign',array(
            'model'=>$model,
            'products'=>Product::getProductsForCheckboxList()
        ));
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Item');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Item('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Item']))
			$model->attributes=$_GET['Item'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Item the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Item::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Item $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
