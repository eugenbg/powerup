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
        if($type == Feed::TYPE_KEYWORDS)
        {
            $fileName = $this->_generateKeywords();
        }
        elseif ($type == Feed::TYPE_ADWORDS)
        {
            $fileName = $this->_generateAdwords();
        }

        $model = new Feed();
        $model->file = Feed::EXPORT_PATH . DIRECTORY_SEPARATOR . $fileName;
        $model->type = $type;
        $model->save();
        $err = $model->getErrors();

        $this->redirect(array('/admin/feed/index'));
    }


    protected function _generateAdwords()
    {
        $products = Product::model()->findAll('inventory > 0');
        $result = array();
        $topRow = array(
            'Campaign state',
            'Campaign',
            'Budget',
            'Status',
            'Campaign type',
            'Campaign subtype',
            'Bid Strategy Type'
        );
        $defaultRow = array(
            'enabled',
            '',
            '10.00',
            'eligible',
            'Search Only',
            'Standard',
            'cpc'
        );
        $result[] = $topRow;
        foreach ($products as $product)
        {
            $row = $defaultRow;
            $row[1] = $product->code;
            $result[] = $row;
        }

        return $this->_saveFile($result, 'adw.campaign');
    }


    protected function _generateKeywords()
    {
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
                    $seriesTitle = $item['series_title'] ? ' ' . $item['series_title'] : '';
                    $keyList[] = 'аккумулятор ' . $brand['title'] . $seriesTitle . ' ' . $item['title'];
                }
            }
        }
        $fileName = $this->_saveFile($keyList, 'keywords');
        return $fileName;
    }

    protected function _saveFile($keyList, $fileName)
    {
        $folder = dirname(Yii::app()->request->scriptFile) . '/media';
        if(!is_dir($exportFolder = $folder . '/export'))
        {
            mkdir($exportFolder);
        }
        $fileName = $fileName.'.'.date("m.d.Y").'.csv';
        $fp = fopen($exportFolder . DIRECTORY_SEPARATOR . $fileName, 'w');
        foreach ($keyList as $fields) {
            if(!is_array($fields))
            {
                $fields = array($fields);
            }
            fputcsv($fp, $fields, ',', "'");
        }
        return $fileName;
    }


    public function actionDownload()
    {

    }

}