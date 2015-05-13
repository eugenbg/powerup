<?php $this->pageTitle = 'Добро пожаловать!'; ?>
<div class="home">
    <div class="col-md-4">
        <a href="<?php echo $this->createUrl('custom/category', array('category'=>2)); ?>">
            <img src="/img/home/camera.jpg"/>
        </a>
        <a href="<?php echo $this->createUrl('custom/category', array('category'=>1)); ?>">
            Аккумуляторы для фотоаппаратов
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?php echo $this->createUrl('custom/category', array('category'=>2)); ?>">
            <img src="/img/home/camcoder.jpg"/>
        </a>
        <a href="<?php echo $this->createUrl('custom/category', array('category'=>3)); ?>">
            Аккумуляторы для видеокамер
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?php echo $this->createUrl('custom/category', array('category'=>2)); ?>">
            <img src="/img/home/mobile.jpg"/>
        </a>
        <a href="<?php echo $this->createUrl('custom/category', array('category'=>2)); ?>">
            Для мобильных телефонов
        </a>
    </div>
</div>
