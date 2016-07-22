<?php
/* @var $this DefaultController */

$this->breadcrumbs[] = 'Отчеты';
$this->pageTitle = 'Отчеты';
?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Общая стоимость запасов (цена товаров * запасы)</h3>

        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="display: block;">
        <?php echo $totalPrice; ?> $
    </div>
</div>
