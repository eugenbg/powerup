<?php $this->breadcrumbs[] = 'Настройки';
$this->pageTitle = 'Настройки';
?>
<?php echo CHtml::form(Yii::app()->createUrl('admin/config/save')); ?>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Главные настройки</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
            <?php echo CHtml::label('Курс доллара', 'main/usd_blr_conversion'); ?>
            <?php echo CHtml::textField('main/usd_blr_conversion', Yii::app()->settings->get('main', 'usd_blr_conversion')); ?>
        </div><!-- /.box-body -->
        <div class="box-body" style="display: block;">
            <?php echo CHtml::label('Контактный email 1', 'main/admin_email_1'); ?>
            <?php echo CHtml::textField('main/admin_email_1', Yii::app()->settings->get('main', 'admin_email_1')); ?>
        </div><!-- /.box-body -->

        <div class="box-body" style="display: block;">
            <?php echo CHtml::label('Контактный email 2', 'main/admin_email_2'); ?>
            <?php echo CHtml::textField('main/admin_email_2', Yii::app()->settings->get('main', 'admin_email_2')); ?>
        </div><!-- /.box-body -->

        <div class="box-body" style="display: block;">
            <?php echo CHtml::label('Контактный email 3', 'main/admin_email_3'); ?>
            <?php echo CHtml::textField('main/admin_email_3', Yii::app()->settings->get('main', 'admin_email_3')); ?>
        </div><!-- /.box-body -->
    </div>

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Meta Description</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
            <?php echo CHtml::label('Meta description item', 'meta_description/item'); ?>
            <?php echo CHtml::textField('meta_description/item', Yii::app()->settings->get('meta_description', 'item')); ?>
        </div><!-- /.box-body -->
        <div class="box-body" style="display: block;">
            <?php echo CHtml::label('Meta description series', 'meta_description/series'); ?>
            <?php echo CHtml::textField('meta_description/series', Yii::app()->settings->get('meta_description', 'series')); ?>
        </div><!-- /.box-body -->
        <div class="box-body" style="display: block;">
            <?php echo CHtml::label('Meta description brand', 'meta_description/brand'); ?>
            <?php echo CHtml::textField('meta_description/brand', Yii::app()->settings->get('meta_description', 'brand')); ?>
        </div><!-- /.box-body -->
        <div class="box-body" style="display: block;">
            <?php echo CHtml::label('Meta description category', 'meta_description/category'); ?>
            <?php echo CHtml::textField('meta_description/category', Yii::app()->settings->get('meta_description', 'category')); ?>
        </div><!-- /.box-body -->
    </div>

    <div class="col-lg-3">
        <button type="submit" class="btn btn-block btn-info btn-lg">Сохранить</button>
    </div>
<?php echo CHtml::endForm(); ?>
