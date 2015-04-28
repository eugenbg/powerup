<?php
$this->breadcrumbs['Брэнды'] = Yii::app()->createUrl('admin/brand/index');
$this->breadcrumbs[] = 'Редактирование брэнда';
$this->pageTitle = 'Редактирование брэнда <b>'.$model->title.'</b>';

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
            <label>Картинки</label>
            <?php $this->widget('CMultiFileUpload', array(
                'name' => 'images',
                'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
                'duplicate' => 'Duplicate file!', // useful, i think
                'denied' => 'Invalid file type', // useful, i think
                'max' => 5
            )); ?>
            <div class="pics">
                <?php foreach ($model->getImages() as $image):?>
                    <div class="pic">
                        <a href="<?php echo Yii::app()->createUrl('/admin/brand/deleteimage',
                            array('entity_id' => $model->id, 'image_id' => $image->id)); ?>"
                            <span class="remove-pic glyphicon glyphicon-remove"></span>
                        </a>
                        <img src="<?php echo $image->thumbnail_file; ?>"/>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="clearfix"></div>
        </div>

    </div><!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <?php $this->endWidget(); ?>

</div>