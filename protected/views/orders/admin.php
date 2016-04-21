<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	//'Заказы'=>array('index'),
	'Управление заказами',
);

$this->menu=array(
	//array('label'=>'Заказы', 'url'=>array('index')),
	array('label'=>'Добавить заказ', 'url'=>array('create')),
	array('label'=>'Заказы на рассмотрении', 'url'=>array('inwork')),
	array('label'=>'Выполненные заказы', 'url'=>array('compleate')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1>Управление заказами</h1>


<?php  /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); */?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'code',
		'date_in',
		//'num',
      //'description:html',
		//'comment',
		//'delivery',
		
		'price',
		'status',
		/*
		'insurance',
		'weight',
		'size',
		'date_out',
		
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
