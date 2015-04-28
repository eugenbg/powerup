<?php

$this->breadcrumbs[] = 'Страницы';
$this->pageTitle = 'Список страниц';


$this->pageTitle = 'Продукты';
$dataProvider = new CActiveDataProvider('Page');

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=> $dataProvider,
    'columns' => array(
        'id',
        'title',
        'edit' => array(
            'class' => 'CLinkColumn',
            'label' => 'редактировать',
            'urlExpression' => 'Yii::app()->createUrl("/admin/page/edit/?id=" . $data->id)',
        )
    )
));
