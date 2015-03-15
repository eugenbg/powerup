<?php $this->beginContent('/layouts/main'); ?>
<div class="col-md-8">
    <section>
        <?php echo $content; ?>
    </section>
</div>
<div class="col-md-4">
    <aside class="sidebar">
        <?php if(!Yii::app()->user->isGuest) $this->widget('UserMenu'); ?>
    </aside>
</div>
<?php $this->endContent(); ?>