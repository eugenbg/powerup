<?php
$this->breadcrumbs['Устройства'] = Yii::app()->createUrl('admin/brand/index');
$this->breadcrumbs[] = 'Редактирование устройства';
$this->pageTitle = 'Редактирование устройства <b>'.$model->title.'</b>';

?>



<div class="box box-primary">
    <!-- form start -->
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'product-edit-form',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>
    <div class="box-body">
        <div class="form-group">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title', array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'urlkey'); ?>
            <?php echo $form->textField($model,'urlkey', array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'urlkey'); ?>
        </div>
        <div class="form-group">
            <?php $brands = Brand::model()->findAll(); ?>
            <?php echo $form->labelEx($model,'brand'); ?>
            <?php echo $form->dropDownList(
                $model,'brand',
                CHtml::listData($brands, 'id', 'title'),
                array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'brand'); ?>
        </div>

    </div><!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <?php $this->endWidget(); ?>

</div>