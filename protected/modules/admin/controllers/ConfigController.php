<?php

class ConfigController extends AdminController
{

    public $layout = 'main';

    public function actionIndex()
	{
        $this->render('index');
	}

    public function actionSave()
    {
        $fields = $_POST;
        foreach ($fields as $name => $value)
        {
            $nameParsed = explode('/', $name);
            $configCategory = $nameParsed[0];
            $configItem = $nameParsed[1];
            Yii::app()->settings->set($configCategory, $configItem, $value);
        }

        $this->redirect(Yii::app()->createUrl('admin/config/index'));
    }
}