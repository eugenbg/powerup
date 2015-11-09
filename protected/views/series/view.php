<?php
/* @var $this SeriesController */
/* @var $model Series */

$seriesTitle = Yii::app()->params['series']->title;
$subseriesTitle = !empty(Yii::app()->params['subseries']) ?
    ' ' . Yii::app()->params['subseries']->title : '';


$this->pageTitle = 'Аккумуляторы для ' .
    Yii::app()->params['category']->getItemCategoryTitle('r', 'plural') .
    ' ' . Yii::app()->params['brand']->title .
    ' ' . $seriesTitle . $subseriesTitle;

$description = sprintf('%s. Доставка по Беларуси, низкие цены, гарантия 1 год.',
    $this->pageTitle
);

Yii::app()->params['metaDescription'] = $description;

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

<?php if(!$model->isSubseries() && count($model->getSubseriesAbcList())): ?>
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

<?php $seriesTitle = Yii::app()->params['series']->title; ?>
<?php $subseriesTitle = !empty(Yii::app()->params['subseries']) ?
    ' ' . Yii::app()->params['subseries']->title : ''; ?>

<p>
    Выбирайте модель вашей <?php echo Yii::app()->params['category']->getItemCategoryTitle('r'); ?> <?php echo Yii::app()->params['brand']->title; ?> <?php echo $seriesTitle . $subseriesTitle; ?>, либо модель нужного аккумулятора - если она Вам известна. На следующей странице вы сможете оформить заказ.
</p>

<p>
    Гарантия на наши аккумуляторы - 12 месяцев. Есть возможность вернуть деньги в течение 30 дней после покупки.
</p>


<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/app/filter.js'); ?>
<script type="text/javascript">
    Filter.initialize({inputSelector : '#series-search'})
</script>