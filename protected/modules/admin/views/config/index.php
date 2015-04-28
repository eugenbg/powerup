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
    </div>
    <div class="col-lg-3">
        <button type="submit" class="btn btn-block btn-info btn-lg">Сохранить</button>
    </div>
<?php echo CHtml::endForm(); ?>
