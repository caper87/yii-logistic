<?php
/* @var $this OrdersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Заказы',
);

$user = User::current();
if($user->rules == 1){
	$this->menu=array(
		array('label'=>'Добавить заказ', 'url'=>array('create')),
		array('label'=>'Управление заказами', 'url'=>array('admin')),
		array('label'=>'Заказы на рассмотрении', 'url'=>array('inwork')),
		array('label'=>'Выполненные заказы', 'url'=>array('compleate')),
	);
}else{
	$this->menu=array(
		array('label'=>'Все заказы', 'url'=>array('index')),
		array('label'=>'Заказы на рассмотрении', 'url'=>array('inwork')),
		array('label'=>'Выполненные заказы', 'url'=>array('compleate')),
	);
}
?>

<h1>Список заказов</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
