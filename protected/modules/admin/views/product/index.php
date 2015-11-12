<?php
/* @var $this DefaultController */

$this->breadcrumbs[] = 'Продукты';
$this->pageTitle = 'Список продуктов';


$this->pageTitle = 'Продукты';
$dataProvider = new CActiveDataProvider('Product');
?>

<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'product-grid',
    'dataProvider'=> $model->search(),
    'filter'=>$model,
    'columns' => array(
        //'id',
        //'sku',
        array(
            'header' => 'Товар',
            'name'=>'title',
        ),
        array(
            'header' => 'Цена',
            'name'=>'title',
        ),
        array(
            'header' => 'Рыночная цена (бел.рубли)',
            'name'=>'market_price',
            'value'=>'$data->market_price > 0 ? Helper::convertToBLR($data->market_price). " " . Helper::getCurrencyPostfix() : ""',
        ),
        array(
            'header' => 'Рыночная цена ($)',
            'name'=>'market_price',
        ),
        'inventory',
        array(
            'header' => 'Статус (вкл/выкл)',
            'name'=>'status',
        ),
        'edit' => array(
            'class' => 'CLinkColumn',
            'label' => 'редактировать',
            'urlExpression' => 'Yii::app()->createUrl("/admin/product/edit/?id=" . $data->id)',
        )
    )
));