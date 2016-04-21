<?php

class SiteController extends Controller
{
	public function filters()
	{
	    return array(
	        'accessControl', // perform access control for CRUD operations
	    );
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
                        'class'     =>'CCaptchaAction',
                        'maxLength' => 6,
                        'minLength' => 4,
                        'foreColor' => 0x667e9a,
                        'testLimit' => 2,
            ),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	
	public function accessRules()
	{
	    return array(
	        array('allow',
	            'actions'=>array('login','logout','registration','captcha','error'), //'login','logout','registration'
	            'users'=>array('*'),
	        ),
	        array('allow',
	            'actions'=>array('index','contact'),
	            'users'=>array('admin','demo7'),
	        ),
	        array('allow',
	            'actions'=>array('index'),
	            'users'=>array('@'),
	        ),
	        array('deny',  // deny all users
	            'users'=>array('*'),
	        ),
	    );
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->redirect('index.php/site/login');
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 *
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionRegistration() {
        if (Yii::app()->user->isGuest) {
  
            $user = new User;
  
            /*
            * Ajax валидация
            */
           // $this->performAjaxValidation($user);
 
            if(empty($_POST['User'])) {
                /*
                * Если форма не отправленна, то выводим форму
                */
                $this->render('registration', array('model' => $user));
 
            } else {
                /*
                * Форма получена
                */
                $user->attributes = $_POST['User'];
 
                /*
                * Валидация данных
                */
                if($user->validate('reg')) {
                    /*
                    * Если проверка пройдена, проверяем на уникальность имя
                    * пользователя и e-mail
                    */
                    if($user->model()->count("email = :email",
                        array(':email' => $user->email))) {
 
                        $user->addError('email', 'E-mail уже занят');
                        $this->render("registration", array('model' => $user));
 
                    } else if($user->model()->count("username = :username",
                        array(':username' => $user->username))) {
 
                        $user->addError('username', 'Имя пользователя уже занято');
                        $this->render("registration", array('model' => $user));
 
                    } else {
                        /*
                        * Если проверки пройдены шифруем пароль, генерируем код
                        * активации аккаунта, а также устанавливаем время регистрации
                        * и роль по умолчанию для пользователя
                        */
                        $user->password      = User::hashPassword($user->password);
                        //$user->activationKey = substr(md5(uniqid(rand(), true)), 0, rand(10, 15));
                        $user->rules        = '2';
 
                        /*
                        * Проверяем если добавление пользователя прошло успешно
                        * устанавливаем ему права.
                        */
                        if($user->save()) {
                        	$this->render("regOk");
                            //$role = new AuthAssignment();
                            //$role->itemname = 'User';
                            //$role->userid   = $user->id;
                            $email = Yii::app()->email;
							$email->to = 'zhres777@yandex.ru';
							$email->subject = 'Регистрация нового пользователя';
							$email->message = 'На вашем сайте был зарегистрирован новый пользователь, его логин: '.$user->username.'<br> Посмотреть на <a href="http://errror87.tmweb.ru/index.php/user/admin">сайте</a>';
							$email->send();
						} else {
                            throw new CHttpException(403, 'Ошибка добавления в базу данных.');
                        }
                            //if($role->save()) {
                                /*
                                * Если роль успешно добавилась, выводим сообщение
                                * об успешной регистрации и отправляем код активации аккаунта
                                *
                                $this->render("regOk");
 
                                //$this->activationKey($user);
 
                            } else {
                                throw new CHttpException(403, 'Ошибка добавления в базу данных.');
                            }
                        } else {
                            throw new CHttpException(403, 'Ошибка добавления в базу данных.');
                        }*/
                    }
                } else {
                    /*
                    * Не прошел валидацию
                    */
                    $this->render('registration', array('model' => $user));
                    //echo 'Не получилось';
                }
            }
        } else {
            /*
            * Если пользователь залогинен редиректим обратно
            */
            $this->redirect(Yii::app()->user->returnUrl);
        }
    }
    
    
	
}
