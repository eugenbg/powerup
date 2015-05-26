<?php
/* @var $this SearchController */

$this->breadcrumbs=array(
	'Поиск',
    $query
);
$this->pageTitle = 'Результаты поиска';
?>
<?php foreach($result as $frontendCategoryTitle => $items): ?>
    <h3><?php echo $frontendCategoryTitle; ?></h3>
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


