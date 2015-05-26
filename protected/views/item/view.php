<?php
/* @var $this ItemController */
/* @var $model Item */

$this->pageTitle = $model->getFullTitle();
?>

<?php foreach($model->getLeadingProducts() as $product):?>
    <h2 class="section-title no-margin-top"><?php echo $product->title; ?> -  <?php echo $model->getItemTitle(); ?></h2>
    <div class="row" style="margin-bottom: 40px;">
        <div class="col-md-4">
            <?php if(!count($product->getImages())): ?>
            <ul class="bxslider">
                <li><img src="/img/no_photo.png"></li>
            </ul>

            <div id="bx-pager">
                <a data-slide-index="0" href=""><img src="/img/no_photo_40x30.png"></a>
            </div>
            <?php else: ?>
                <ul class="bxslider">
                    <?php foreach($product->getImages() as $image): ?>
                    <li><img src="<?php echo $image->file; ?>"></li>
                    <?php endforeach; ?>
                </ul>

                <div id="bx-pager">
                    <?php
                    $i = 0;
                    foreach($product->getImages() as $image): ?>
                        <a data-slide-index="<?php echo $i; ?>" href=""><img src="<?php echo $image->thumbnail_file; ?>"></a>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-5">
            <h3 class="no-margin-top">Характеристики</h3>
<!--            <noindex>
                <p class="product-note">
                    Повсеместная практика у не брэндовых производителей аккумуляторов для <?php /*echo $model->getItemCategoryTitle('r', 'plural'); */?> - указывать бОльшую/рекламную мощность на упаковке батарей. Поэтому в некоторых магазинах вы можете увидеть гораздо бОльшую мощность. Мы указываем <b>реальную</b> мощность аккумулятора, не рекламную.
                </p>
            </noindex>-->
            <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$product->productAttributes,
                'attributes'=>array(
                    'bb_battery_chemistry',
                    'bb_battery_voltage',
                    'bb_dimensions',
                    'bb_battery_capacity_mah',
                ),
            )); ?>
        </div>
        <div class="col-md-3">
            <div class="e-price">
                <span>
                    <?php echo $product->getPrice(); ?>
                    <?php echo Helper::getCurrencyPostfix(); ?>
                </span>
            </div>
            <a href="<?php echo $this->createUrl('cart/add', array('product_id' => $product->id, 'item_id' => $model->id)); ?>"
               class="add-to-cart btn btn-ar btn-success btn-sm pull-right">
                <i class="fa fa-shopping-cart"></i> Добавить в корзину
            </a>
        </div>
    </div>
<?php endforeach; ?>

    <?php if($model->type == Item::TYPE_MODEL): ?>
    <p>
        Выше перечислены все аккумуляторы, которые подойдут к <?php echo $model->getItemCategoryTitle('d'); ?> <?php echo $model->getItemTitle(true); ?>.
    </p>
    <p>
        Мы гарантируем, что все перечисленные батареи подходят к <?php echo $model->getItemTitle(true); ?> (мы проверяли).
    </p>
    <p>
        <?php echo $model->rand1Texts[$model->rand1]; ?>
    </p>
    <p>
        <?php echo $model->rand2Texts[$model->rand2]; ?>
    </p>
<?php else: ?>
    <p>
        Выше перечислены все аккумуляторы, которые являются аналогом <?php echo $model->getItemTitle(true); ?>
    </p>
    <p>
        Мы гарантируем, что все перечисленные батареи заменят <?php echo $model->getItemTitle(true); ?> (мы проверяли).
    </p>
    <p>
        <?php echo $model->rand1Texts[$model->rand1]; ?>
    </p>
    <p>
        <?php echo $model->rand2Texts[$model->rand2]; ?>
    </p>
<?php endif; ?>
<div class="related-items">
    <h2>Аккумулятор также подходит для следующих моделей устройств:</h2>
    <ul>
        <?php foreach ($product->getAllItems(20, $model) as $item):?>
            <li style="float: left; margin-right: 30px; width: 230px">
                <a href="<?php echo $this->createUrl('custom/item',
                    array('item'=>$item->id, 'brand'=>$item->brand_id,'series'=>$item->series_id, 'subseries' => $item->subseries_id, 'item_urlkey' => $item->urlkey)
                )?>">
                    <?php echo $item->getItemTitle(true); ?>
                </a>
            </li>
        <?php endforeach;?>
    </ul>
    <div class="clearfix"></div>
    <h2>Аккумулятор является аналогом следующих моделей аккумуляторов:</h2>
    <ul>
        <?php foreach ($product->assignedParts as $item):?>
            <li style="float: left; margin-right: 30px; width: 230px">
                <a href="<?php echo $this->createUrl('custom/item',
                    array('item'=>$item->id, 'brand'=>$item->brand_id, 'series'=>$item->series_id, 'subseries' => $item->subseries_id, 'item_urlkey' => $item->urlkey)
                )?>">
                    <?php echo $item->getItemTitle(true); ?>
                </a>
            </li>
        <?php endforeach;?>
    </ul>
</div>

<!--<h2 class="right-line">Другие товары для <?php /*echo $model->title; */?></h2>
<?php /*foreach($model->getRelatedProducts() as $product):*/?>

<div class="col-md-6">
    <div class="ec-box">
        <div class="ec-box-header">
            <a href="<?php /*echo $this->createUrl('custom/product', array('product' => $product->id, 'category' => $product->category_id, 'item'=>$model->id)); */?>">
                <?php /*echo $product->category->title . ' - ' . $product->title; */?>
            </a>
        </div>
        <div class="ec-box-footer" style="background: none; ">
            <span class="label label-primary">$ <?php /*echo $product->price; */?></span>
            <a href="<?php /*echo $this->createUrl('cart/add', array('product_id' => $product->id)); */?>" class="btn btn-ar btn-success btn-sm pull-right"><i class="fa fa-shopping-cart"></i> Добавить в корзину</a>
        </div>
    </div>
</div>

--><?php /*endforeach; */?>