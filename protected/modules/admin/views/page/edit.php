<?php
$this->breadcrumbs['Страницы'] = Yii::app()->createUrl('admin/page/index');
$this->breadcrumbs[] = 'Редактирование страницы';
$this->pageTitle = 'Редактирование страницы <b>'.$model->title.'</b>';
?>

<script src="http://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

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
            <?php echo $form->labelEx($model,'content'); ?>
            <?php echo $form->textArea($model,'content', array('class'=>'form-control', 'rows' => 10)); ?>
            <?php echo $form->error($model,'content'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'urlkey'); ?>
            <?php echo $form->textField($model,'urlkey', array('class'=>'form-control', 'rows' => 10)); ?>
            <?php echo $form->error($model,'urlkey'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'meta_description'); ?>
            <?php echo $form->textArea($model,'meta_description', array('class'=>'form-control', 'rows' => 2)); ?>
            <?php echo $form->error($model,'meta_description'); ?>
        </div>

    </div><!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <?php $this->endWidget(); ?>

    <script type="text/javascript">
        $(function () {
            CKEDITOR.replace('Page_content');
        });
    </script>
</div>