<?php

class DashboardController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	public function filters()
	{
	    return array(
	        'accessControl', // perform access control for CRUD operations
	    );
	}
	
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	
	public function accessRules()
	{
	    return array(
	        array('allow',
	            'actions'=>array('login','logout'),
	            'users'=>array('*'),
	        ),
	        array('allow',
	            'actions'=>array('index'),
	            'users'=>array('admin'),
	        ),
	        array('deny',  // deny all users
	            'users'=>array('*'),
	        ),
	    );
	}
	
	public function actionLogin()
	{
	    $form=new LoginForm;
	    // collect user input data
	    if(isset($_POST['LoginForm']))
	    {
	        $form->attributes=$_POST['LoginForm'];
	        // validate user input and redirect to previous page if valid
	        if($form->validate())
	            $this->redirect(Yii::app()->user->returnUrl);
	    }
	    // display the login form
	    $this->render('login',array('form'=>$form));
	}
	 
	/**
	 * Выход из панели управления и переход на главную страницу.
	 */
	public function actionLogout()
	{
	    Yii::app()->user->logout();
	    $this->redirect(Yii::app()->homeUrl);
	}
}