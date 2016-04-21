<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	'Добавить заказ',
);

$this->menu=array(
	//array('label'=>'Заказы', 'url'=>array('index')),
	array('label'=>'Управление заказами', 'url'=>array('admin')),
	array('label'=>'Заказы на рассмотрении', 'url'=>array('inwork')),
	array('label'=>'Выполненные заказы', 'url'=>array('compleate')),
);
?>

<h1>Добавить заказ</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>