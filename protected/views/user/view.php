<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
  'Профиль пользователя',
  //$model->id,
);
$user = User::current();
if($user->rules == 1){	
		
	$this->menu=array(
		array('label'=>'Управление пользователями', 'url'=>array('admin')),
		array('label'=>'Создать пользователя', 'url'=>array('create')),
		array('label'=>'Редактирование пользователя', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Удаление пользователя', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить этого пользователя?')),	
	);
	
}else{
	
	$this->menu=array(	
		array('label'=>'Редактировать профиль', 'url'=>array('update', 'id'=>$model->id)),	
	);
}
?>

<h1>Пользователь #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		//'password',
		'email',
		'phone',
		'code',
	),
)); ?>
