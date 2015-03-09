<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sku'); ?>
		<?php echo $form->textField($model,'sku',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'sku'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
        <?php $categories = Category::model()->findAll();
            echo $form->dropDownList($model, 'category_id', CHtml::listData($categories, 'id', 'title')); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'urlkey'); ?>
        <?php echo $form->textField($model,'urlkey',array('size'=>30,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'urlkey'); ?>
    </div>

    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->