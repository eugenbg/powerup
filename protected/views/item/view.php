<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Item', 'url'=>array('index')),
	array('label'=>'Create Item', 'url'=>array('create')),
	array('label'=>'Update Item', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Assign Products', 'url'=>array('assign', 'id'=>$model->id)),
	array('label'=>'Delete Item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Item', 'url'=>array('admin')),
);
?>

<h1>View Item #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'series_id',
		'subseries_id',
		'brand_id',
	),
)); ?>

<!-- simple list of products for now. To-do: build this list depending on category in the route -->

<h1>Продукты текущей категории</h1>
<?php foreach($model->getLeadingProducts() as $product):?>
    <h2><?php echo $product->title; ?></h2>
    <p>sku: <?php echo $product->sku; ?></p>
    <p>price: <?php echo $product->price; ?></p>
    <p>
        <a href="<?php echo $this->createUrl('cart/add', array('product_id' => $product->id)); ?>">
            Добавить в корзину
        </a>
    </p>
<?php endforeach; ?>

<h1>Продукты других категорий</h1>
<?php foreach($model->getRelatedProducts() as $product):?>
    <h2><?php echo $product->title; ?></h2>
    <p>sku: <?php echo $product->sku; ?></p>
    <p>price: <?php echo $product->price; ?></p>
    <p>
        <a href="<?php echo $this->createUrl('cart/add', array('product_id' => $product->id)); ?>">
            Добавить в корзину
        </a>
    </p>
<?php endforeach; ?>
