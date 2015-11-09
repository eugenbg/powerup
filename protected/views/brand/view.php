<?php
/* @var $this BrandController */
/* @var $model Brand */

$this->pageTitle = 'Аккумуляторы для ' .
    Yii::app()->params['category']->getItemCategoryTitle('r', 'plural') .
    ' ' . $model->title;

$description = sprintf('Аккумуляторы (АКБ, батареи) %s %s. Гарантия 12 месяцев. Низкие цены. Доставка по Беларуси.',
    Yii::app()->params['category']->getItemCategoryTitle('r', 'plural'),
    $model->title
);

Yii::app()->params['metaDescription'] = $description;

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

<h1>Выберите модель вашего устройства</h1>

<?php
foreach ($model->getItemsAbcList() as $letter => $items):?>
    <div class="row panel">
        <div class="letter col-md-1 col-xs-2"><?php echo $letter; ?></div>
        <ul class="brand-list col-md-11 col-xs-10">
            <?php foreach ($items as $item):?>
                <li class="item">
                    <a href="<?php echo $this->createUrl('custom/item',
                        array('item'=>$item['id'], 'series'=>$item['series_id'], 'subseries' => $item['subseries_id'], 'item_urlkey' => $item['urlkey'])
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

<p>
    Выбирайте модель вашей <?php echo Yii::app()->params['category']->getItemCategoryTitle('r'); ?> <?php echo $model->title; ?>, либо модель нужного аккумулятора - если она Вам известна. На следующей странице вы сможете оформить заказ.
</p>

<p>
    Гарантия на наши аккумуляторы - 12 месяцев. Есть возможность вернуть деньги в течение 30 дней после покупки.
</p>


<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/app/filter.js'); ?>
<script type="text/javascript">
    Filter.initialize({inputSelector : '#brand-search'})
</script>