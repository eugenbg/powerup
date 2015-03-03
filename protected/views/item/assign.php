<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Item', 'url'=>array('index')),
	array('label'=>'Create Item', 'url'=>array('create')),
	array('label'=>'View Item', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Item', 'url'=>array('admin')),
);
?>

<h1>Assign Products to Item <?php echo $model->id; ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'item-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>


    <div class="row">
        <?php echo $form->checkBoxList($model, 'productItemIds', CHtml::listData($products, 'id', 'sku'))?>
        <?php echo $form->error($model,'productItems'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Assign'); ?>
    </div>

<?php $this->endWidget(); ?>