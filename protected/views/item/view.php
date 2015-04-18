<?php
/* @var $this ItemController */
/* @var $model Item */

$this->pageTitle = $model->getFullTitle();
?>

<?php foreach($model->getLeadingProducts() as $product):?>
    <h2 class="section-title no-margin-top"><?php echo $product->title; ?> - подходит для <?php echo $model->getItemTitle(); ?></h2>
    <div class="row" style="margin-bottom: 40px;">
        <div class="col-md-4">
            <ul class="bxslider">
                <li><img src="/img/no_photo.png"></li>
            </ul>

            <div id="bx-pager">
                <a data-slide-index="0" href=""><img src="/img/no_photo_40x30.png"></a>
            </div>
        </div>
        <div class="col-md-5">
            <h3 class="no-margin-top">Заметка</h3>
            <p class="product-note">
                Повсеместная практика у не брэндовых производителей аккумуляторов для <?php echo $model->getItemCategoryTitle('r', 'plural'); ?> - указывать бОльшую/рекламную мощность на упаковке батарей. Поэтому в некоторых магазинах вы можете увидеть гораздо бОльшую мощность. Мы указываем <b>реальную</b> мощность аккумулятора, не рекламную.
            </p>
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

    <p>
        Выше перечислены все аккумуляторы, которые подойдут к вашей <?php echo $model->getItemCategoryTitle('d'); ?> <?php echo $model->getItemTitle(); ?>.
    </p>
    <p>
        Мы гарантируем, что все перечисленные батареи подходят к <?php echo $model->getItemTitle(); ?> и предоставляем гарантию на аккумулятор длительностью 12 месяцев. Если возникнут неисправности - мы просто заменим аккумулятор на новый. Либо мы можем вернуть деньги в течение 30 дней после покупки.
    </p>
    <p>
        Надеемся Вам понравиться покупать в нашем магазине :)
    </p>


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