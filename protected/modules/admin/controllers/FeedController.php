<?php

class FeedController extends AdminController
{

    public $layout = 'main';

    public function actionIndex()
	{
        $model = new Feed('search');
        if(isset($_GET['Feed']))
        {
            $model->attributes=$_GET['Feed'];
        }

        $this->render('index', array('model' => $model));
	}

    public function actionGenerate($type)
    {
        $model = new Feed();

        $result = array();
        $keyList = array();
        $frontendCategories = FrontendCategory::model()->findAll();
        foreach ($frontendCategories as $frontendCategory) {
            Yii::app()->params['category'] = $frontendCategory;
            $brands = $frontendCategory->getBrandsList();
            foreach ($brands as $brand)
            {
                $brandModel = Brand::model()->findByPk($brand['id']);
                Yii::app()->params['brand'] = $brandModel;
                $items = array_merge($brandModel->getItemsList(), $brandModel->getPartsList());
                foreach($items as $item)
                {
                    if(!$item['inventory'])
                    {
                        continue;
                    }

                    $result[ $item['product_code'] ][] = array(
                        'url'=> $this->createAbsoluteUrl('/custom/item',
                                    array('category' => $frontendCategory->id,
                                        'brand' => $brand['id'],
                                        'series' => $item['series_id'],
                                        'subseries' => $item['subseries_id'],
                                        'item' => $item['id'])
                                ),
                        'keywords' => array(
                            'key1',
                            'key2'
                        )
                    );
                    $keyList[] = 'аккумулятор ' . $brand['title'] . ' ' . $item['title'];
                }
            }
        }

        if($type == Feed::TYPE_KEYWORDS)
        {
            $fileName = $this->_saveKeywords($keyList);
        }

        $model = new Feed();
        $model->file = Feed::EXPORT_PATH . DIRECTORY_SEPARATOR . $fileName;
        $model->type = $type;
        $model->save();
        $err = $model->getErrors();

        $this->redirect(array('/admin/feed/index'));
    }


    protected function _saveKeywords($keyList)
    {
        $folder = dirname(Yii::app()->request->scriptFile) . '/media';
        if(!is_dir($exportFolder = $folder . '/export'))
        {
            mkdir($exportFolder);
        }
        $fileName = 'keywords.'.date("m.d.Y").'.csv';
        $fp = fopen($exportFolder . DIRECTORY_SEPARATOR . $fileName, 'w');
        foreach ($keyList as $fields) {
            if(!is_array($fields))
            {
                $fields = array($fields);
            }
            fputcsv($fp, $fields);
        }
        return $fileName;
    }


    public function actionDownload()
    {

    }

}