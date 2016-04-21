<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
  //'Пользователи'=>array('index'),
  //$model->id=>array('view','id'=>$model->id),
	'Редактирование пользователя',
);

$user = User::current();
if($user->rules == 1){	
		
	$this->menu=array(
	array('label'=>'Управление пользователями', 'url'=>array('admin')),
	array('label'=>'Создать пользователя', 'url'=>array('create')),
	array('label'=>'Просмотр пользователя', 'url'=>array('view', 'id'=>$model->id)),
	);
	
}else{
	
	$this->menu=array(	
		array('label'=>'Редактировать профиль', 'url'=>array('update', 'id'=>$model->id)),	
	);
}
?>

<h1>Редактирование пользователя <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>