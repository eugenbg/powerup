<?php
/* @var $this DefaultController */

$this->breadcrumbs[] = 'Фиды';
$this->pageTitle = 'Сгенеренные фиды';


$this->pageTitle = 'Фиды';
$dataProvider = new CActiveDataProvider('Feed');
?>

<div class="box-body">
    <button type="submit" class="btn btn-primary" onclick="window.location='/admin/feed/generate/type/<?php echo Feed::TYPE_KEYWORDS ?>'">Создать фид <?php echo $model->labels[Feed::TYPE_KEYWORDS] ?></button>
    <button type="submit" class="btn btn-primary" onclick="window.location='/admin/feed/generate/type/<?php echo Feed::TYPE_ADWORDS ?>'">Создать фид <?php echo $model->labels[Feed::TYPE_ADWORDS] ?></button>
    <button type="submit" class="btn btn-primary" onclick="window.location='/admin/feed/generate/type/<?php echo Feed::TYPE_DIRECT ?>'">Создать фид <?php echo $model->labels[Feed::TYPE_DIRECT] ?></button>
</div>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'product-grid',
    'dataProvider'=> $model->search(),
    'filter'=>$model,
    'columns' => array(
        //'id',
        //'sku',
        array(
            'header' => 'Дата',
            'name'=>'date',
        ),
        array(
            'header' => 'Тип',
            'name'=>'type',
            'value'=> '$data->labels[$data->type]'
        ),
        'link' => array(
            'class' => 'CLinkColumn',
            'label' => 'скачать',
            'urlExpression' => 'Yii::app()->request->baseUrl . $data->file',
        )
    )
));