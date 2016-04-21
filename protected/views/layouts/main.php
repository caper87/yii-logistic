<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">	
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  	<!--ckeditor-->
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ckeditor/ckeditor.js"></script>
	<!--datetime-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.minical.plain.css">
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.minical.plain.js"></script>
	<!--Fancy-->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.fancybox.pack.js?v=2.1.5"></script>

<?php if ((Yii::app()->controller->id === 'orders' && Yii::app()->controller->action->id === 'update') 
|| (Yii::app()->controller->id === 'orders' && Yii::app()->controller->action->id === 'view')) { ?>


<!--image download-->	
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/uploadfile.css" rel="stylesheet">
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.uploadfile.min.js"></script>
	<script>
		$(document).ready(function(){
			
				$("#fileuploader").uploadFile({
				url:'<?php OrdersController::addimg(@$_GET["id"]); ?>', 
				multiple:true,
				fileName:"myfile",
				});
				
				$('#show_foto').fancybox();
				

		});
				
	</script>
<?php } ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
      <div id="logo"><img width=200 src="<?php echo Yii::app()->request->baseUrl; ?>/images/Clip2net_160314191914.png" alt="" /></div>
	</div><!-- header -->

	<div id="mainmenu">
<?php 
	if(!Yii::app()->user->isGuest){
		$user = User::current();
		if($user->rules == 1){
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Главная', 'url'=>array('/site/index')),
					
					array('label'=>'Заказы', 'url'=>array('/orders/admin')),
					//array('label'=>'Добавить заказ', 'url'=>array('/orders/create')),
					array('label'=>'Пользователи', 'url'=>array('/user/admin')),
					//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					//array('label'=>'Contact', 'url'=>array('/site/contact')),
					array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
			));
		}else{
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Главная', 'url'=>array('/site/index')),					
					array('label'=>'Мои заказы', 'url'=>array('/orders/index')),
					array('label'=>'Мой аккаунт', 'url'=>array('/user/view/'.$user->id)),
					array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
			));
		}
	}
?>
	</div><!-- mainmenu -->
	<?php 
	if(!Yii::app()->user->isGuest){
	if(isset($this->breadcrumbs)):
		 $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); 
	 endif;
	 }
	 ?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?><br/>
		All Rights Reserved.<br/>
		
	</div><!-- footer -->

</div><!-- page -->

<script type="text/javascript">
	var $date_field = $('input[name="Orders[date_in]"]');
	$date_field.minical({
		date_format: function(date) {
		  return [date.getFullYear(), date.getMonth() + 1, date.getDate()].join("-");
		}
	})
	var $date_field2 = $('input[name="Orders[date_out]"]');
	$date_field2.minical({
		date_format: function(date) {
		  return [date.getFullYear(), date.getMonth() + 1, date.getDate()].join("-");
		}
	})
</script>
</body>
</html>
