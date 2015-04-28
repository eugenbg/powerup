<?php
/* @var $this DefaultController */

$this->breadcrumbs[] = 'Брэнды';
$this->pageTitle = 'Список брэндов';


$this->pageTitle = 'Брэнды';
$dataProvider = new CActiveDataProvider('Brand');

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=> $dataProvider,
    'columns' => array(
        'id',
        'title',
        'urlkey',
        'edit' => array(
            'class' => 'CLinkColumn',
            'label' => 'редактировать',
            'urlExpression' => 'Yii::app()->createUrl("/admin/brand/edit/?id=" . $data->id)',
        )
    )
));
