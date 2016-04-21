<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля помеченные <span class="required">*</span>, обязательны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code'); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'date_in'); ?>
		<?php echo $form->textField($model,'date_in'); ?>
		<?php echo $form->error($model,'date_in'); ?>
	</div>

	<!--div class="row">
		<?php echo $form->labelEx($model,'num'); ?>
		<?php echo $form->textField($model,'num'); ?>
		<?php echo $form->error($model,'num'); ?>
	</div>
  	<div class="row">
		<?php echo $form->labelEx($model,'num_place'); ?>
		<?php echo $form->textField($model,'num_place'); ?>
		<?php echo $form->error($model,'num_place'); ?>
	</div-->

<?php if(Yii::app()->controller->action->id === 'create'){ ?>
	<div class="row descr_tbl">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php	echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'id'=>'editor','value'=>'
			<table style="width:100%;border: 1px solid;" >
				<tr>
					<td>№ Места</td>
					<td>Описание груза</td>
					<td>Количество товара в месте</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		' )); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
<?php }else{ ?>	
	<div class="row descr_tbl">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php	echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'id'=>'editor')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
<?php } ?>
	<!--CKEDITOR-->
	<script type="text/javascript">
		var ckeditor1 = CKEDITOR.replace( 'editor' );
		AjexFileManager.init({
			returnTo: 'ckeditor',
			editor: ckeditor1
		});
	</script>
  <p></p>
	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delivery'); ?>
		<span>Морем
			<?php echo $form->radioButton($model,'delivery',array('value'=>'Морем','checked'=>'checked','uncheckValue'=>null)); ?>
		</span>
		<span>Авиа
			<?php echo $form->radioButton($model,'delivery',array('value'=>'Авиа','uncheckValue'=>null)); ?>
		</span>
		<?php echo $form->error($model,'delivery'); ?>
	</div>
<p></p>
	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'insurance'); ?>
		<span>Да
			<?php echo $form->radioButton($model,'insurance',array('value'=>'Да','uncheckValue'=>null)); ?>
		</span>
		<span>Нет
			<?php echo $form->radioButton($model,'insurance',array('value'=>'Нет','checked'=>'checked','uncheckValue'=>null)); ?>
		</span>
		<?php echo $form->error($model,'insurance'); ?>
	</div>
<p></p>
	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'size'); ?>
		<?php echo $form->textField($model,'size'); ?>
		<?php echo $form->error($model,'size'); ?>
	</div>
  
	<div class="row">
		<?php echo $form->labelEx($model,'plot'); ?>
		<?php echo $form->textField($model,'plot'); ?>
		<?php echo $form->error($model,'plot'); ?>
		<span class="form_info" >Вес / объем (поле не обязательно)</span>
	</div>
  
	<div class="row">
		<?php echo $form->labelEx($model,'date_out'); ?>
		<?php echo $form->textField($model,'date_out'); ?>
		<?php echo $form->error($model,'date_out'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<span>На рассмотрении
			<?php echo $form->radioButton($model,'status',array('value'=>'Заказ на рассмотрении','checked'=>'checked','uncheckValue'=>null)); ?>
		</span>
		<span>Выполнен
			<?php echo $form->radioButton($model,'status',array('value'=>'Заказ выполнен','uncheckValue'=>null)); ?>
		</span>
		<?php echo $form->error($model,'status'); ?>
	</div>
	
	
	
<?php 
if(Yii::app()->controller->action->id !== 'create'){
	
	echo'<p></p>';
	echo'<label><b>Загрузка фото</b></label>';
	echo'<div id="fileuploader">+ Фото</div>';
	
	$foto = OrdersController::showimg($_GET["id"]);
	foreach($foto as $v){
		echo '<div class="foto_wrp">';
		echo '<a id="show_foto" class="show_foto" href="'.Yii::app()->request->baseUrl.'/images/'.$v->src.'">Посмотреть</a>';
		echo '<a class="del_foto" href="'.Yii::app()->request->baseUrl.'/index.php/orders/delimg/'.$v->id.'">Удалить фото</a>';
		echo '<a id="show_foto" href="'.Yii::app()->request->baseUrl.'/images/'.$v->src.'"><img src="'.Yii::app()->request->baseUrl.'/images/'.$v->src.'" alt="" class="order_foto" /></a>';
		echo '</div>';
	}
}
 ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'subm_btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->