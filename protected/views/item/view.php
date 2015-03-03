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

<h1>Products</h1>
<?php foreach($model->productItems as $productItem):
    $product = $productItem->product?>
    <h2><?php echo $product->title; ?></h2>
    <p>sku: <?php echo $product->sku; ?></p>
    <p>price: <?php echo $product->price; ?></p>
<?php endforeach; ?>