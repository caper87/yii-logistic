<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля помеченные<span class="required">*</span>, обязательны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php 
		$user = User::current();
		if($user->rules == 1){	
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	
	<?php }else{ 
		 	echo 'Логин: <b>'.$user->username.'</b>'; 
	 	  } 
	 ?>
	 
	<?php 
		$user = User::current();
		if($user->rules == 1){	
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<?php }else{?>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128,'value'=>'')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<?php } ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model, 'phone', array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->textField($model, 'phone',array('placeholder'=>'+38 096 123 45 67'))?>
        <?php echo $form->error($model,'phone'); ?>
    </div>
    
	<?php 
		$user = User::current();
		if($user->rules == 1){	
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>
	<?php }else{ 
		 	echo 'Код пользователя: <b>'.$user->code.'</b>'; 
	 	  } 
	 ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'subm_btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->