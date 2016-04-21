<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Добро пожаловать в <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<?php
$user = User::current();
		if($user->rules == 1){
 ?>
<div class="content">
	<?php echo CHtml::link('Создать заказ', array('orders/create'),array('class'=>'subm_btn')); ?>
	<?php echo CHtml::link('Создать пользователя', array('user/create'),array('class'=>'subm_btn')); ?>
</div>
<div class="content">
	<table class="stat_tbl" >
		<tr class="frst_tr">
			<td>Пользователей:</td>
			<td>
			<?php 	echo  User::model()->count();	?></td>
		</tr>
		<tr class="sec_tr">
			<td>Заказов:</td>
			<td><?php echo  Orders::model()->count();?></td>
		</tr>
		<tr class="frst_tr">
			<td>Заказов в обработке:</td>
			<td><?php echo  Orders::model()->count(array(
				'condition'=>'status=:status',
    			'params'=>array(':status'=>'Заказ на рассмотрении')
    		));?></td>
		</tr>
		<tr class="sec_tr">
			<td>Выполненных заказов:</td>
			<td><?php echo  Orders::model()->count(array(
				'condition'=>'status=:status',
    			'params'=>array(':status'=>'Заказ выполнен')
    		));?></td>
		</tr>
	</table>
	
</div>
<?php }else{ ?>
	<p>Здесь можно разместить приветствие, контакты, или форму связи</p>
<?php } ?>
	


