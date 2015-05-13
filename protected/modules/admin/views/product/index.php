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
        'id',
        'sku',
        'title',
        'price',
        'market_price',
        'status',
        'edit' => array(
            'class' => 'CLinkColumn',
            'label' => 'редактировать',
            'urlExpression' => 'Yii::app()->createUrl("/admin/product/edit/?id=" . $data->id)',
        )
    )
));