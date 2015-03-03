<ul>
    <?php
        $controller = Yii::app()->getController();
        foreach ($controller->menu as $menuItem) :?>
            <li><?php echo CHtml::link($menuItem['label'],$menuItem['url']); ?></li>
    <?php endforeach;?>
	<li><?php echo CHtml::link('Logout',array('site/logout')); ?></li>
</ul>