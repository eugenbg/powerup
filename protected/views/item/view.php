<?php
/* @var $this ItemController */
/* @var $model Item */

$this->pageTitle = $model->getFullTitle();

?>

<?php foreach($model->getLeadingProducts() as $product):?>
    <h2 class="section-title no-margin-top"><?php echo $product->title; ?></h2>
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
            <h3 class="no-margin-top">Description</h3>
            <p>
                description
            </p>
            <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$product,
                'attributes'=>array(
                    'id',
                    'sku',
                    'title',
                    'price',
                    'category_id',
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