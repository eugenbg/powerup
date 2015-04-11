<?php
/* @var $this SeriesController */
/* @var $model Series */

$this->menu=array(
	array('label'=>'List Series', 'url'=>array('index')),
	array('label'=>'Create Series', 'url'=>array('create')),
	array('label'=>'Update Series', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Series', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Series', 'url'=>array('admin')),
);
?>

<div class="row search-holder" style="margin-bottom: 30px;">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="input-group">
                    <input type="text" class="form-control" id="series-search" placeholder="Введите модель устройства...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
            <div class="panel-footer">
                Введите первые буквы модели вашего устройства, ссылки отфильтруются
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>

<h1>Модели устройств</h1>
<?php foreach ($model->getItemsAbcList() as $letter => $items):?>
    <div class="row panel">
        <div class="letter col-md-1 col-xs-2"><?php echo $letter; ?></div>
        <ul class="brand-list col-md-11 col-xs-10">
            <?php foreach ($items as $item):?>
                <li class="item">
                    <a href="<?php echo $this->createUrl('custom/item',array('item'=>$item['id']) )?>">
                        <?php echo $item['formatted_title']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach;?>

<?php if(!$model->isSubseries()): ?>
<h1>Подсерии серии <?php echo $model->title; ?></h1>
    <?php foreach ($model->getSubseriesAbcList() as $letter => $subseries):?>
        <div class="row panel">
            <div class="letter col-md-1 col-xs-2"><?php echo $letter; ?></div>
            <ul class="brand-list col-md-11 col-xs-10">
                <?php foreach ($subseries as $subserie):?>
                    <li class="item">
                        <a href="<?php echo $this->createUrl('custom/subseries',array('subseries'=>$subserie['id']) )?>">
                            <?php echo $subserie['title']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach;?>
<?php endif; ?>

<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/app/filter.js'); ?>
<script type="text/javascript">
    Filter.initialize({inputSelector : '#series-search'})
</script>