<?php
/* @var $this DefaultController */

$this->breadcrumbs[] = 'Серии';
$this->pageTitle = 'Список серий';


$this->pageTitle = 'Серии';
$dataProvider = new CActiveDataProvider('Series');

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=> $dataProvider,
    'columns' => array(
        'id',
        'title',
        'urlkey',
        'edit' => array(
            'class' => 'CLinkColumn',
            'label' => 'редактировать',
            'urlExpression' => 'Yii::app()->createUrl("/admin/series/edit/?id=" . $data->id)',
        )
    )
));
