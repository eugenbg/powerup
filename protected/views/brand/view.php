<?php
/* @var $this BrandController */
/* @var $model Brand */

$this->menu=array(
	array('label'=>'List Brand', 'url'=>array('index')),
	array('label'=>'Create Brand', 'url'=>array('create')),
	array('label'=>'Update Brand', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Brand', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Brand', 'url'=>array('admin')),
);

?>



<div class="row search-holder" style="margin-bottom: 30px;">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="input-group">
                    <input type="text" class="form-control" id="brand-search" placeholder="Введите модель устройства...">
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

<h1>Модели вашего устройства</h1>

<?php
foreach ($model->getItemsAbcList() as $letter => $items):?>
    <div class="row panel">
        <div class="letter col-md-1 col-xs-2"><?php echo $letter; ?></div>
        <ul class="brand-list col-md-11 col-xs-10">
            <?php foreach ($items as $item):?>
                <li class="item">
                    <a href="<?php echo $this->createUrl('custom/item',
                        array('item'=>$item['id'], 'series'=>$item['series_id'], 'subseries' => $item['subseries_id'])
                    )?>">
                        <?php echo $item['formatted_title']; ?>
                    </a>
                </li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach;?>

<?php if(count($model->getPartsAbcList())): ?>
<h1>Модели аккумулятора</h1>
    <?php foreach ($model->getPartsAbcList() as $letter => $items):?>
        <div class="row panel">
            <div class="letter col-md-1 col-xs-2"><?php echo $letter; ?></div>
            <ul class="brand-list col-md-11 col-xs-10">
                <?php foreach ($items as $item):?>
                    <li class="item">
                        <a href="<?php echo $this->createUrl('custom/item',array('item'=>$item['id']) )?>">
                            <?php echo $item['title']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach;?>
<?php endif; ?>

<?php if(count($model->getSeriesAbcList())): ?>
    <h1>Серии устройств</h1>
    <?php foreach ($model->getSeriesAbcList() as $letter => $items):?>
        <div class="row panel">
            <div class="letter col-md-1 col-xs-2"><?php echo $letter; ?></div>
            <ul class="brand-list col-md-11 col-xs-10">
                <?php foreach ($items as $item):?>
                    <li class="item">
                        <a href="<?php echo $this->createUrl('custom/series',array('series'=>$item['id']) )?>">
                            <?php echo $item['title']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach;?>
<?php endif; ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/app/filter.js'); ?>
<script type="text/javascript">
    Filter.initialize({inputSelector : '#brand-search'})
</script>