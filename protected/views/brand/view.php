<?php
/* @var $this BrandController */
/* @var $model Brand */

$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Brand', 'url'=>array('index')),
	array('label'=>'Create Brand', 'url'=>array('create')),
	array('label'=>'Update Brand', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Brand', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Brand', 'url'=>array('admin')),
);
?>

<h1>View Brand #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>

<h1>Айтемы брэнда</h1>
<ul>
    <?php foreach ($model->items as $item):?>
        <li>
            <a href="<?php echo $this->createUrl('item/view',array('id'=>$item->id)); ?>">
                <?php echo $item->title; ?>
            </a>
        </li>
    <?php endforeach;?>
</ul>

<h1>Серии брэнда</h1>
<ul>
    <?php foreach ($model->series as $series):?>
        <li>
            <a href="<?php echo $this->createUrl('item/view',array('id'=>$series->id)); ?>">
                <?php echo $series->title; ?>
            </a>
        </li>
    <?php endforeach;?>
</ul>
