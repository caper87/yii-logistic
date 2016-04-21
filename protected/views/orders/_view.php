<?php
/* @var $this OrdersController */
/* @var $data Orders */
?>

<div class="view">

<?php  
$user = User::current();
if($user->rules == 1){ ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('update', 'id'=>$data->id)); ?>
	<br />
	
<?php }else{ ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
	
<?php } ?>	
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in')); ?>:</b>
	<?php echo CHtml::encode($data->date_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo $data->description; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery')); ?>:</b>
	<?php echo CHtml::encode($data->delivery); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_out')); ?>:</b>
	<?php echo CHtml::encode($data->date_out); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<span <?php  echo OrdersController::orderColor($data->status); ?> >
	<?php echo CHtml::encode($data->status); ?></span>
	<br />
	<br />
	<?php /*
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('num')); ?>:</b>
	<?php echo CHtml::encode($data->num); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('insurance')); ?>:</b>
	<?php echo CHtml::encode($data->insurance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight')); ?>:</b>
	<?php echo CHtml::encode($data->weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size')); ?>:</b>
	<?php echo CHtml::encode($data->size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_out')); ?>:</b>
	<?php echo CHtml::encode($data->date_out); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>