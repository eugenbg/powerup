<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

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
        'data'=>$model,
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
    <div class="e-price">$ <span><?php echo (int)$model->price; ?></span>.00</div>
    <a href="#" class="btn btn-ar btn-block btn-success"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
</div>