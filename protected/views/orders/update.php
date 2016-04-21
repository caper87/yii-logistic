<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Управление заказами', 'url'=>array('admin')),
	array('label'=>'Добавить заказ', 'url'=>array('create')),
	//array('label'=>'Просмотреть заказ', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Заказы на рассмотрении', 'url'=>array('inwork')),
	array('label'=>'Выполненные заказы', 'url'=>array('compleate')),
	
);
?>

<h1>Редактировать заказ <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

	
	
