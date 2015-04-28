<?php
$this->breadcrumbs['Серии'] = Yii::app()->createUrl('admin/series/index');
$this->breadcrumbs[] = 'Редактирование серии';
$this->pageTitle = 'Редактирование серии <b>'.$model->title.'</b>';

?>



<div class="box box-primary">
    <!-- form start -->
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'series-edit-form')); ?>
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
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <?php $this->endWidget(); ?>

</div>