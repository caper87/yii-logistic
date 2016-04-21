<?php

class OrdersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
	            'actions'=>array('login','logout'),
	            'users'=>array('*'),
	        ),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','indexid', 'view','inwork','compleate'),
				'users'=>array('admin','@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','delimg'),
				'users'=>array('admin'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Orders;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$user = User::current();
		if($user->rules == 1){
			
			$dataProvider=new CActiveDataProvider('Orders');
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
			
		}else{
			
			$dataProvider=new CActiveDataProvider('Orders', array(
			    'criteria'=>array(
			        'condition'=>'code=:code',
			        'params'=>array(':code'=>$user->code)
			    ),
			    //'status'=>'Заказ на рассмотрении',
			    
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
		}
		
	}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Orders('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Orders']))
			$model->attributes=$_GET['Orders'];

		$this->render('admin',array(
			'model'=>$model,
		));
		
	}
	
	public function actionInwork()
	{
		$user = User::current();
		if($user->rules == 1){
			$dataProvider=new CActiveDataProvider('Orders', array(
		        'criteria'=>array(
		            'condition'=>'status=:status',
		             // сортировка сначала по полю read, потом id
		            //'order'=>'read ASC, id DESC',
		            'params'=>array(':status'=>'Заказ на рассмотрении'),
		        ),
		        // количество итемов на стр
		        'pagination'=>array(
		            'pageSize'=>10,
		        ),
		    ));
		    $this->render('index',array(
			'dataProvider'=>$dataProvider,
			));
	    }else{
			$dataProvider=new CActiveDataProvider('Orders', array(
		        'criteria'=>array(
		        	'condition'=>'code=:code AND status=:status',
			        'params'=>array(':code'=>$user->code,':status'=>'Заказ на рассмотрении')
		        ),
		        // количество итемов на стр
		        'pagination'=>array(
		            'pageSize'=>10,
		        ),
		    ));
		    $this->render('index',array(
			'dataProvider'=>$dataProvider,
			));
		}
		
		
		
		
	}

	public function actionCompleate()
	{
		$user = User::current();
		if($user->rules == 1){		
			$dataProvider=new CActiveDataProvider('Orders', array(
		        'criteria'=>array(
		            'condition'=>'status=:status',
		            'params'=>array(':status'=>'Заказ выполнен'),
		        ),
		        'pagination'=>array(
		            'pageSize'=>10,
		        ),
		    ));
			
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
		}else{
			$dataProvider=new CActiveDataProvider('Orders', array(
		        'criteria'=>array(
		        	'condition'=>'code=:code AND status=:status',
			        'params'=>array(':code'=>$user->code,':status'=>'Заказ выполнен')
		        ),
		        // количество итемов на стр
		        'pagination'=>array(
		            'pageSize'=>10,
		        ),
		    ));
		    $this->render('index',array(
			'dataProvider'=>$dataProvider,
			));
		}	
	}
	
	


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Orders the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Orders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Orders $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='orders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public static function addimg($id){
		$output_dir = "images/";
		if(isset($_FILES["myfile"]))
		{
			
			$ret = array();
			
		//	This is for custom errors;	
		/*	$custom_error= array();
			$custom_error['jquery-upload-file-error']="File already exists";
			echo json_encode($custom_error);
			die();
		*/
			$error =$_FILES["myfile"]["error"];
			//You need to handle  both cases
			//If Any browser does not support serializing of multiple files using FormData() 
			if(!is_array($_FILES["myfile"]["name"])) //single file
			{
		 	 	$fileName = $id.'__'.$_FILES["myfile"]["name"];
		 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
		    	$ret[]= $fileName;
		    	
		    	$foto = new Foto;
				$foto->id_order = $id;
			  	$foto->src = $fileName;
			  	$foto->save();
			}
			else  //Multiple files, file[]
			{
			  $fileCount = count($_FILES["myfile"]["name"]);
			  for($i=0; $i < $fileCount; $i++)
			  {
			  	$fileName = $id.'__'.$_FILES["myfile"]["name"][$i];
				move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
			  	$ret[]= $fileName;
			  	
			  	$foto = new Foto;
				$foto->id_order = $id;
			  	$foto->src = $fileName;
			  	$foto->save();
			  	
			  }
			
			}
		    echo json_encode($ret);
		 }
	}
	
	public static function showimg($id){
		//$foto = new Foto;
		$foto = Foto::model()->findAll('id_order=:id_order',array(':id_order'=>$id));
	  	return $foto;
	  
	}
	
	public  function actionDelimg($id){
		$foto = Foto::model()->findByPk($id);
		$foto->delete();
      unlink(Yii::getPathOfAlias('webroot').'/images/'.$foto->src);
		echo'<script> javascript:history.back()</script>';
	}
  
    public static function orderColor($status){
		if($status == 'Заказ выполнен'){
			return 'class="ord_compl"';
		}else{
			return 'class="ord_inwrk"';
		}
	}
}
