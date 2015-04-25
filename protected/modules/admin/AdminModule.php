<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

        $this->layoutPath = Yii::getPathOfAlias('admin.views.layouts');
        $this->layout = 'main';

        // import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
            'admin.controllers.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			if(!Yii::app()->user->isGuest && Yii::app()->user->getUser()->username == 'admin')
            {
                return true;
            }
            else
            {
                Yii::app()->request->redirect('/site/login');
                return false;
            }
		}
		else
        {
            return false;
        }
	}
}
