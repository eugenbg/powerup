<?php
/* @var $this SearchController */

$this->breadcrumbs=array(
	'Поиск',
    $query
);
$this->pageTitle = sprintf('Результаты поиска "%s"', $query);
?>
<?php foreach($result->items as $frontendCategoryId => $items): ?>
    <?php Yii::app()->params['category'] = $result->frontendCategories[$frontendCategoryId]; ?>
    <h3><?php echo $result->frontendCategories[$frontendCategoryId]->title; ?></h3>
    <div class="row panel">
        <ul class="brand-list col-md-11 col-xs-10">
            <?php foreach($items as $item): ?>
                <li class="item">
                    <a href="<?php echo $this->createUrl('custom/item',
                        array('item'=>$item->id, 'category'=>$item->frontendCategoryId, 'brand'=>$item->brand_id, 'series'=>$item->series_id, 'subseries' => $item->subseries_id, 'item_urlkey' => $item->urlkey)
                    )?>">
                        <?php echo $item->getFullTitle(); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>


