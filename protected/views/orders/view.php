<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	$model->id,
);
$user = User::current();
if($user->rules == 1){
	$this->menu=array(
		array('label'=>'Управление заказами', 'url'=>array('admin')),
		//array('label'=>'Заказы', 'url'=>array('index')),
		array('label'=>'Добавить заказ', 'url'=>array('create')),
		array('label'=>'Редактировать заказ', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Удалить заказ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы дуверены, что хотите удалить данный заказ?')),
		
	);
}else{
	$this->menu=array(
		array('label'=>'Все заказы', 'url'=>array('index')),
		array('label'=>'Заказы на рассмотрении', 'url'=>array('inwork')),
		array('label'=>'Выполненные заказы', 'url'=>array('compleate')),
	);
}
?>

<h1>Заказ #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'date_in',
      //'num',
      //'num_place',
		'description:html',
		'comment',
		'delivery',
		'price',
		'insurance',
		'weight',
		'size',
        'plot',
		'date_out',
		'status',
	),
)); ?>
<?php 
	
	$foto = OrdersController::showimg($_GET["id"]);
	foreach($foto as $v){
		echo '<a id="show_foto" href="'.Yii::app()->request->baseUrl.'/images/'.$v->src.'"><img src="'.Yii::app()->request->baseUrl.'/images/'.$v->src.'" alt="" class="order_foto_min" /></a>';
	}
	

 ?>