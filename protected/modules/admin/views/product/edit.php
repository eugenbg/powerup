<?php
$this->breadcrumbs['Продукты'] = Yii::app()->createUrl('admin/product/index');
$this->breadcrumbs[] = 'Редактирование продукта';
$this->pageTitle = 'Редактирование продукта <b>'.$model->title.'</b>';

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
            <?php echo $form->labelEx($model,'sku'); ?>
            <?php echo $form->textField($model,'sku', array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'sku'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'price'); ?>
            <?php echo $form->textField($model,'price', array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'price'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'market_price'); ?>
            <?php echo $form->textField($model,'market_price', array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'market_price'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->dropDownList($model,'status', $model->statusLabels, array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'inventory'); ?>
            <?php echo $form->textField($model,'inventory', array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'inventory'); ?>
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
                        <a href="<?php echo Yii::app()->createUrl('/admin/product/deleteimage',
                            array('entity_id' => $model->id, 'image_id' => $image->id)); ?>"
                            <span class="remove-pic glyphicon glyphicon-remove"></span>
                        </a>
                        <img src="<?php echo $image->thumbnail_file; ?>"/>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <h3>Аттрибуты</h3>

        <div class="form-group">
            <?php echo $form->labelEx($attributesModel,'bb_battery_capacity_mah'); ?>
            <?php echo $form->textField($attributesModel,'bb_battery_capacity_mah', array('class'=>'form-control')); ?>
            <?php echo $form->error($attributesModel,'bb_battery_capacity_mah'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($attributesModel,'bb_battery_voltage'); ?>
            <?php echo $form->textField($attributesModel,'bb_battery_voltage', array('class'=>'form-control')); ?>
            <?php echo $form->error($attributesModel,'bb_battery_voltage'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($attributesModel,'bb_dimensions'); ?>
            <?php echo $form->textField($attributesModel,'bb_dimensions', array('class'=>'form-control')); ?>
            <?php echo $form->error($attributesModel,'bb_dimensions'); ?>
        </div>

    </div><!-- /.box-body -->


    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
    <?php $this->endWidget(); ?>

</div>