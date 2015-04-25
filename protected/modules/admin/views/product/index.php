<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);

$this->pageTitle = 'Продукты';
$dataProvider = new CActiveDataProvider('Product');

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=> $dataProvider,
    'columns' => array(
        'id',
        'sku',
        'title',
        'edit' => array(
            'class' => 'CLinkColumn',
            'label' => 'редактировать',
            'urlExpression' => 'Yii::app()->createUrl("/admin/product/edit/?id=" . $data->id)',
        )
    )
));
