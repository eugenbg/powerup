<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function __construct($id,$module=null)
    {
        Yii::app()->clientScript->registerCoreScript('jquery');
        $this->addBreadCrumbs();
        parent::__construct($id,$module);
    }

    public function addBreadCrumbs()
    {
        $this->breadcrumbs = array();
        if(is_object(Yii::app()->params['category']))
        {
            if(is_object(Yii::app()->params['brand']))
            {
                $this->breadcrumbs[Yii::app()->params['category']->title] =
                    $this->createUrl('custom/category', array('category' => Yii::app()->params['category']->id));
            }
            else
            {
                $this->breadcrumbs[] = Yii::app()->params['category']->title;
            }
        }

        if(is_object(Yii::app()->params['brand']))
        {
            if(is_object(Yii::app()->params['series']) || is_object(Yii::app()->params['item']))
            {
                $this->breadcrumbs[Yii::app()->params['brand']->title] =
                    $this->createUrl('custom/brand', array('brand' => Yii::app()->params['brand']->id));
            }
            else
            {
                $this->breadcrumbs[] = Yii::app()->params['brand']->title;
            }
        }

        if(is_object(Yii::app()->params['series']))
        {
            if(is_object(Yii::app()->params['subseries']) || is_object(Yii::app()->params['item']))
            {
                $this->breadcrumbs[Yii::app()->params['series']->title] =
                    $this->createUrl('custom/series', array('series' => Yii::app()->params['series']->id));
            }
            else
            {
                $this->breadcrumbs[] = Yii::app()->params['series']->title;
            }
        }

        if(is_object(Yii::app()->params['subseries']))
        {
            if(is_object(Yii::app()->params['item']))
            {
                $this->breadcrumbs[Yii::app()->params['subseries']->title] =
                    $this->createUrl('custom/subseries', array('subseries' => Yii::app()->params['subseries']->id));
            }
            else
            {
                $this->breadcrumbs[] = Yii::app()->params['subseries']->title;
            }
        }

        if(is_object(Yii::app()->params['item']))
        {
            if(is_object(Yii::app()->params['product']))
            {
                $this->breadcrumbs[Yii::app()->params['item']->title] =
                    $this->createUrl('custom/item', array('item' => Yii::app()->params['item']->id));
            }
            else
            {
                $this->breadcrumbs[] = Yii::app()->params['item']->title;
            }
        }

        if(is_object(Yii::app()->params['product']))
        {
            $this->breadcrumbs[Yii::app()->params['product']->title] = '';
        }
    }

    public function jsonResponse($response)
    {
        header('Content-type: application/json');
        echo CJSON::encode($response);
        die();
    }

}