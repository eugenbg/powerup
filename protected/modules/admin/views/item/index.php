<?php
/* @var $this DefaultController */

$this->breadcrumbs[] = 'Устройства';
$this->pageTitle = 'Список устройств';


$this->pageTitle = 'Устройства';
$dataProvider = new CActiveDataProvider('Item');

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=> $dataProvider,
    'columns' => array(
        'id',
        'title',
        'urlkey',
        'brand' => array(
            'name' => 'Брэнд',
            'value' => '$data->brand->title'
        ),
        'series' => array(
            'name' => 'Серия',
            'value' => '!empty($data->series)? $data->series->title : "-"'
        ),
        'subseries' => array(
            'name' => 'Подсерия',
            'value' => '!empty($data->subseries)? $data->subseries->title : "-"'
        ),
        'edit' => array(
            'class' => 'CLinkColumn',
            'label' => 'редактировать',
            'urlExpression' => 'Yii::app()->createUrl("/admin/item/edit/?id=" . $data->id)',
        )
    )
));
