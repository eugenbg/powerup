<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->pageTitle = 'Аккумуляторы для ' .
    Yii::app()->params['category']->getItemCategoryTitle('r', 'plural');

$description = sprintf('%s. Низкие цены, доставка по Беларуси, гарантия 1 год.',
    $this->pageTitle
);

Yii::app()->params['metaDescription'] = $description;


?>

<div class="row search-holder" style="margin-bottom: 30px;">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="input-group">
                    <input type="text" class="form-control" id="brand-search" placeholder="Введите брэнд...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
                </div>
            </div>
            <div class="panel-footer">
                Введите первые буквы брэнда вашего устройства, ссылки отфильтруются
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>

<h1>Брэнды</h1>

<?php foreach ($model->getBrandsAbcList() as $letter => $brands):?>
    <div class="row panel">
        <div class="letter col-md-1 col-xs-2"><?php echo $letter; ?></div>
        <ul class="brand-list col-md-11 col-xs-10">
            <?php foreach ($brands as $brand):?>
                <li class="item">
                    <a href="<?php echo $this->createUrl('custom/brand',array('brand'=>$brand['id']) )?>">
                        <?php echo $brand['title']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach;?>

<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/app/filter.js'); ?>
<script type="text/javascript">
    Filter.initialize({inputSelector : '#brand-search'})
</script>

<p>
    Ищете аккумулятор для <?php echo Yii::app()->params['category']->getItemCategoryTitle('r'); ?>?
    Сначала выберите брэнд, на следующей странице выберите точную модель.
</p>

<p>
    Мы даем гарантию на весь товар - 12 месяцев. <br/>Покупатель может вернуть назад деньги в течение 30 дней, если товар не устраивает.
</p>