<?php

class SitemapController extends Controller
{
	public function actionGenerate()
	{
        $time = explode(" ",microtime());
        $time = $time[1];

        $pages = $this->getAllPages();
        $sitemap = new SitemapGenerator("http://batareiki.by/");

        // sitemap file name
        $sitemap->sitemapFileName = "sitemap.xml";

        // robots file name
        $sitemap->robotsFileName = "robots.txt";

        foreach ($pages as $url)
        {
            $sitemap->addUrl($url);
        }


        try {
            // create sitemap
            $sitemap->createSitemap();
            // write sitemap as file
            $sitemap->writeSitemap();
            // update robots.txt file
            $sitemap->updateRobots();
        }
        catch (Exception $e) {
            echo $e->getTraceAsString();
        }

        echo "Memory peak usage: ".number_format(memory_get_peak_usage()/(1024*1024),2)."MB";
        $time2 = explode(" ",microtime());
        $time2 = $time2[1];
        echo "<br>Execution time: ".number_format($time2-$time)."s";

    }

    private function getAllPages()
    {
        $pages = array();
        $frontendCategories = FrontendCategory::model()->findAll();
        foreach ($frontendCategories as $frontendCategory)
        {
            $pages[] = $this->createAbsoluteUrl('custom/category', array('category' => $frontendCategory->id));
        }
        foreach ($frontendCategories as $frontendCategory) {
            Yii::app()->params['category'] = $frontendCategory;
            $brands = $frontendCategory->getBrandsList();
            foreach ($brands as $brand)
            {
                $pages[] = $this->createAbsoluteUrl('custom/brand',
                    array('category' => $frontendCategory->id, 'brand' => $brand['id'])
                );
                $brandModel = Brand::model()->findByPk($brand['id']);
                Yii::app()->params['brand'] = $brandModel;
                $series = $brandModel->getSeriesList();
                foreach ($series as $serie)
                {
                    $pages[] = $this->createAbsoluteUrl('custom/series',
                        array(
                            'category' => $frontendCategory->id,
                            'brand' => $brand['id'],
                            'series' => $serie['id']
                        )
                    );
                    $seriesModel = Series::model()->findByPk($serie['id']);
                    Yii::app()->params['series'] = $seriesModel;
                    $subSeries = $seriesModel->getSubseriesList();
                    foreach($subSeries as $subSerie)
                    {
                        $pages[] = $this->createAbsoluteUrl('custom/subseries',
                            array(
                                'category' => $frontendCategory->id,
                                'brand' => $brand['id'],
                                'series' => $serie['id'],
                                'subseries' => $subSerie['id']
                            )
                        );
                    }
                }
                unset(Yii::app()->params['series']);
                $items = array_merge($brandModel->getItemsList(), $brandModel->getPartsList());
                foreach($items as $item)
                {
                    $pages[] = $this->createAbsoluteUrl('custom/item',
                        array(
                            'category' => $frontendCategory->id,
                            'brand' => $brand['id'],
                            'series' => $item['series_id'],
                            'subseries' => $item['subseries_id'],
                            'item' => $item['id'],
                        )
                    );
                }
            }
        }
        $staticPages = Page::model()->findAll();
        foreach($staticPages as $page)
        {
            $pages[] = Yii::app()->getBaseUrl(true) . '/' . $page->urlkey;
        }
        //echo '<pre>';
        //print_r($pages);
        return $pages;
    }

}