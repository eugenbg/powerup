<?php
/* @var $this ItemController */
/* @var $model Item */

$this->menu=array(
	array('label'=>'List Item', 'url'=>array('index')),
	array('label'=>'Create Item', 'url'=>array('create')),
	array('label'=>'Update Item', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Assign Products', 'url'=>array('assign', 'id'=>$model->id)),
	array('label'=>'Delete Item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Item', 'url'=>array('admin')),
);

$this->pageTitle = "Аккумуляторы для ". $model->title;

?>

<?php foreach($model->getLeadingProducts() as $product):?>
    <h2 class="section-title no-margin-top"><?php echo $product->title; ?></h2>
    <div class="row" style="margin-bottom: 40px;">
        <div class="col-md-4">
            <ul class="bxslider">
                <li><img src="/img/demo/e_product1.jpg"></li>
                <li><img src="/img/demo/e_product2.jpg"></li>
                <li><img src="/img/demo/e_product3.jpg"></li>
                <li><img src="/img/demo/e_product4.jpg"></li>
                <li><img src="/img/demo/e_product5.jpg"></li>
            </ul>

            <div id="bx-pager">
                <a data-slide-index="0" href=""><img src="/img/demo/e_img1.jpg"></a>
                <a data-slide-index="1" href=""><img src="/img/demo/e_img2.jpg"></a>
                <a data-slide-index="2" href=""><img src="/img/demo/e_img3.jpg"></a>
                <a data-slide-index="3" href=""><img src="/img/demo/e_img4.jpg"></a>
                <a data-slide-index="4" href=""><img src="/img/demo/e_img5.jpg"></a>
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
            <div class="e-price">$ <span><?php echo (int)$product->price; ?></span>.00</div>
            <a href="<?php echo $this->createUrl('cart/add', array('product_id' => $product->id, 'item_id' => $model->id)); ?>"
               class="add-to-cart btn btn-ar btn-success btn-sm pull-right">
                <i class="fa fa-shopping-cart"></i> Добавить в корзину
            </a>
        </div>
    </div>
<?php endforeach; ?>

<h2 class="right-line">Другие товары для <?php echo $model->title; ?></h2>
<?php foreach($model->getRelatedProducts() as $product):?>

<div class="col-md-6">
    <div class="ec-box">
        <div class="ec-box-header">
            <a href="<?php echo $this->createUrl('custom/product', array('product' => $product->id, 'category' => $product->category_id, 'item'=>$model->id)); ?>">
                <?php echo $product->category->title . ' - ' . $product->title; ?>
            </a>
        </div>
        <div class="ec-box-footer" style="background: none; ">
            <span class="label label-primary">$ <?php echo $product->price; ?></span>
            <a href="<?php echo $this->createUrl('cart/add', array('product_id' => $product->id)); ?>" class="btn btn-ar btn-success btn-sm pull-right"><i class="fa fa-shopping-cart"></i> Добавить в корзину</a>
        </div>
    </div>
</div>

<?php endforeach; ?>