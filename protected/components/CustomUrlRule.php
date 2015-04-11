<?php

class CustomUrlRule extends CBaseUrlRule
{
    public $connectionID = 'db';
    public $category = null;
    public $brand = null;
    public $series = null;
    public $subseries = null;
    public $item = null;
    public $product = null;

    public function createUrl($manager,$route,$params,$ampersand)
    {
        if(strpos($route, 'custom') !== false)
        {
            switch ($route) {
                case 'custom/category':
                    return $this->createCategoryUrl($manager,$route,$params,$ampersand);
                case 'custom/brand':
                    return $this->createBrandUrl($manager,$route,$params,$ampersand);
                case 'custom/subseries':
                    return $this->createSubseriesUrl($manager,$route,$params,$ampersand);
                case 'custom/series':
                    return $this->createSeriesUrl($manager,$route,$params,$ampersand);
                case 'custom/item':
                    return $this->createItemUrl($manager,$route,$params,$ampersand);
                case 'custom/product':
                    return $this->createProductUrl($manager,$route,$params,$ampersand);
            }
        }

        return false;  // this rule does not apply
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if(strlen($pathInfo)> 1)
        {
            $params = explode('/', $pathInfo);
            $this->findInstancesFromPath($params);
            if(!$this->category)
            {
                return false;
            }
            $this->setInstancesGlobal();
            return $this->renderRoute();
        }
        else
        {
            return false;
        }
    }

    private function setInstancesGlobal()
    {
        Yii::app()->params['category'] = $this->category;
        Yii::app()->params['brand'] = $this->brand;
        Yii::app()->params['item'] = $this->item;
        Yii::app()->params['product'] = $this->product;
        Yii::app()->params['series'] = $this->series;
        Yii::app()->params['subseries'] = $this->subseries;
    }

    private function renderRoute()
    {
        if($this->category && $this->brand && $this->item && $this->product)
        {
            $_GET['id'] = $this->product->id;
            return 'product/view';
        }
        if($this->category && $this->brand && $this->item)
        {
            $_GET['id'] = $this->item->id;
            return 'item/view';
        }
        if($this->category && $this->brand && $this->series && $this->subseries)
        {
            $_GET['id'] = $this->subseries->id;
            return 'series/view';
        }
        if($this->category && $this->brand && $this->series)
        {
            $_GET['id'] = $this->series->id;
            return 'series/view';
        }
        if($this->category && $this->brand)
        {
            $_GET['id'] = $this->brand->id;
            return 'brand/view';
        }
        if($this->category)
        {
            $_GET['id'] = $this->category->id;
            return 'category/view';
        }

        return false;
    }

    /*
     * finds all available instances specified in path and stores them as public attributes
     * params without instance passed to $_GET using $this->addGetParams($params)
     */
    private function findInstancesFromPath($params)
    {
        if(isset($params[0]))
        {
            $this->category =  FrontendCategory::model()->findByAttributes(array('urlkey'=>$params[0]));
            if($this->category)
            {
                unset($params[0]);
            }
            if(isset($params[1]) && $this->category)
            {
                $this->brand =  Brand::model()->findByAttributes(array('urlkey'=>$params[1]));
                if($this->brand)
                {
                    unset($params[1]);
                }
                if(isset($params[2]) && $this->brand)
                {
                    //it could be series or item
                    $this->series = Series::model()->findByAttributes(array('urlkey'=>$params[2]));
                    if(!$this->series) {
                        $this->item = Item::model()->findByAttributes(array('urlkey' => $params[2]));
                    }
                    if($this->series || $this->item)
                    {
                        unset($params[2]);
                    }
                    if(isset($params[3]) && ($this->series || $this->item) )
                    {
                        if($this->series)
                        {
                            $this->subseries =  Series::model()->findByAttributes(array('urlkey'=>$params[3]));
                            if(!$this->subseries)
                            {
                                $this->item = Item::model()->findByAttributes(array('urlkey' => $params[3]));
                            }
                        }
                        elseif($this->item)
                        {
                            $this->product =  Product::model()->findByAttributes(array('urlkey'=>$params[3]));
                        }
                        if(($this->subseries || $this->item))
                        {
                            unset($params[3]);
                        }
                        if(isset($params[4]) && ($this->subseries || $this->product) )
                        {
                            if($this->subseries)
                            {
                                $this->item = Item::model()->findByAttributes(array('urlkey'=>$params[4]));
                            }
                            if($this->item)
                            {
                                unset($params[4]);
                            }
                            if(isset($params[5]) && $this->item)
                            {
                                $this->product =  Product::model()->findByAttributes(array('urlkey'=>$params[5]));
                                if($this->product)
                                {
                                    unset($params[5]);
                                }
                            }
                        } // params[4]
                    } // params[3]
                } // params[2]
            } // params[1]

            if(count($params) && $this->category) //else just use default yii routing
            {
                $this->addGetParams($params);
            }

        } // params[0]
    }

    private function addGetParams($params)
    {
        foreach($params as $key => $param)
        {
            if(isset($continue) && $continue == 1)
            {
                $continue = 0;
                continue;
            }
            if(isset($params[$key+1]))
            {
                $_GET[$param] = $params[$key+1];
            }
            else
            {
                throw new CHttpException(404,'Wrong url.');
            }
            $continue = 1;
        }
        return true;
    }

    public function createCategoryUrl($manager,$route,$params,$ampersand)
    {
        return FrontendCategory::model()->findByPk($params['category'],array('select'=>'urlkey'))->urlkey;
    }

    public function createBrandUrl($manager,$route,$params,$ampersand)
    {
        $urlKeys = array();
        $category_id  = isset($params['category'])? $params['category'] : Yii::app()->params['category']->id;
        $urlKeys[] =  FrontendCategory::model()->findByPk($category_id, array('select'=>'urlkey'))->urlkey;
        $urlKeys[] =  Brand::model()->findByPk($params['brand'], array('select'=>'urlkey'))->urlkey;
        return $this->generateUrl($urlKeys, $this->getAdditionalParams($params));
    }

    public function createSeriesUrl($manager,$route,$params,$ampersand)
    {
        $urlKeys = array();
        $category_id  = isset($params['category'])? $params['category'] : Yii::app()->params['category']->id;
        $brand_id = isset($params['brand'])? $params['brand'] : Yii::app()->params['brand']->id;
        $urlKeys[] =  FrontendCategory::model()->findByPk($category_id, array('select'=>'urlkey'))->urlkey;
        $urlKeys[] =  Brand::model()->findByPk($brand_id, array('select'=>'urlkey'))->urlkey;
        $urlKeys[] =  Series::model()->findByPk($params['series'], array('select'=>'urlkey'))->urlkey;
        return $this->generateUrl($urlKeys, $this->getAdditionalParams($params));
    }

    public function createSubseriesUrl($manager,$route,$params,$ampersand)
    {
        $urlKeys = array();
        $category_id  = isset($params['category'])? $params['category'] : Yii::app()->params['category']->id;
        $brand_id = isset($params['brand'])? $params['brand'] : Yii::app()->params['brand']->id;
        $series_id = isset($params['series'])? $params['series'] : Yii::app()->params['series']->id;
        $urlKeys[] =  FrontendCategory::model()->findByPk($category_id, array('select'=>'urlkey'))->urlkey;
        $urlKeys[] =  Brand::model()->findByPk($brand_id, array('select'=>'urlkey'))->urlkey;
        $urlKeys[] =  Series::model()->findByPk($series_id, array('select'=>'urlkey'))->urlkey;
        $urlKeys[] =  Series::model()->findByPk($params['subseries'], array('select'=>'urlkey'))->urlkey;
        return $this->generateUrl($urlKeys, $this->getAdditionalParams($params));
    }

    public function createItemUrl($manager,$route,$params,$ampersand)
    {
        $category_id  = isset($params['category'])? $params['category'] : Yii::app()->params['category']->id;
        $brand_id = isset($params['brand'])? $params['brand'] : Yii::app()->params['brand']->id;
        if(isset($params['series']) || Yii::app()->params['series'])
        {
            $series_id = isset($params['series'])? $params['series'] : Yii::app()->params['series']->id;
        }
        if(isset($params['subseries']) || Yii::app()->params['subseries'])
        {
            $subseries_id = isset($params['subseries'])? $params['subseries'] : Yii::app()->params['subseries']->id;
        }
        $urlKeys[] =  FrontendCategory::model()->findByPk($category_id, array('select'=>'urlkey'))->urlkey;
        $urlKeys[] =  Brand::model()->findByPk($brand_id, array('select'=>'urlkey'))->urlkey;
        if(!empty($series_id) && $series_id > 0)
        {
            $urlKeys[] =  Series::model()->findByPk($series_id, array('select'=>'urlkey'))->urlkey;
        }
        if(isset($subseries_id) && $subseries_id > 0)
        {
            $urlKeys[] =  Series::model()->findByPk($subseries_id, array('select'=>'urlkey'))->urlkey;
        }
        $urlKeys[] = Item::model()->findByPk($params['item'], array('select'=>'urlkey'))->urlkey;
        return $this->generateUrl($urlKeys, $this->getAdditionalParams($params));
    }

    public function createProductUrl($manager,$route,$params,$ampersand)
    {
        $category_id  = isset($params['category'])? $params['category'] : Yii::app()->params['category']->id;
        $brand_id = isset($params['brand'])? $params['brand'] : Yii::app()->params['brand']->id;
        if(isset($params['series']) || Yii::app()->params['series'])
        {
            $series_id = isset($params['series'])? $params['series'] : Yii::app()->params['series']->id;
        }
        if(isset($params['subseries']) || Yii::app()->params['subseries'])
        {
            $subseries_id = isset($params['subseries'])? $params['subseries'] : Yii::app()->params['subseries']->id;
        }
        $item_id = isset($params['item'])? $params['item'] : Yii::app()->params['item']->id;

        $urlKeys[] =  FrontendCategory::model()->findByPk($category_id, array('select'=>'urlkey'))->urlkey;
        $urlKeys[] =  Brand::model()->findByPk($brand_id, array('select'=>'urlkey'))->urlkey;
        if(isset($series_id) && $series_id)
        {
            $urlKeys[] =  Series::model()->findByPk($series_id, array('select'=>'urlkey'))->urlkey;
        }
        if(isset($subseries_id) && $subseries_id)
        {
            $urlKeys[] =  Series::model()->findByPk($subseries_id, array('select'=>'urlkey'))->urlkey;
        }
        $urlKeys[] =  Item::model()->findByPk($item_id, array('select'=>'urlkey'))->urlkey;
        $urlKeys[] =  Product::model()->findByPk($params['product'], array('select'=>'urlkey'))->urlkey;
        return $this->generateUrl($urlKeys, $this->getAdditionalParams($params));
    }

    private function getAdditionalParams($params)
    {
        unset($params['category']);
        unset($params['brand']);
        unset($params['series']);
        unset($params['subseries']);
        unset($params['item']);
        unset($params['product']);
        return $params;
    }

    private function generateUrl($urlKeys, $additionalParams)
    {
        $url = implode('/',$urlKeys);
        if(count($additionalParams))
        {
            $url .= '/' . implode('/',$additionalParams);
        }
        return $url;
    }

}