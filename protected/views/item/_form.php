<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'brand_id'); ?>
        <?php $brands = Brand::model()->findAll();
        echo $form->dropDownList($model, 'brand_id', CHtml::listData($brands, 'id', 'title')); ?>
		<?php echo $form->error($model,'brand_id'); ?>
	</div>


    <div class="row">
        <?php echo $form->labelEx($model,'series_id'); ?>
        <?php if($model->brand_id > 0):?>
            <?php $series = Series::model()->findAllByAttributes(array('brand_id' => $model->brand_id));?>
            <?php if(count($series)): ?>
                <?php echo $form->dropDownList(
                    $model,
                    'series_id',
                    CHtml::listData($series, 'id', 'title'),
                    array('empty'=>'-- No series --')
                ); ?>
                <?php echo $form->error($model,'series_id'); ?>
            <?php else: ?>
                У брэнда нету серий
            <?php endif; ?>
        <?php else: ?>
            Чтобы выбрать серию, сначала сохраните item с выбранным брэндом
        <?php endif; ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'subseries_id'); ?>
        <?php echo $form->textField($model,'subseries_id'); ?>
        <?php echo $form->error($model,'subseries_id'); ?>
    </div>

    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->