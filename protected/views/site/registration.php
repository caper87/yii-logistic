<?php
$this->breadcrumbs=array(
        "Регистрация",
);
?>
 
<h1>Регистрация</h1>
 
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
    )); ?>
 
    <p class="note">Поля со <span class="required">*</span> обязательны.</p>
 
    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username' )?>
        <?php echo $form->error($model,'username'); ?>
    </div>
 
    <div class="row">
        <?php echo $form->labelEx($model, 'email', array('class' => 'required')); ?>
        <?php echo $form->textField($model, 'email')?>
        <?php echo $form->error($model,'email'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'phone', array('class' => 'required')); ?>
        <?php echo $form->textField($model, 'phone', array('placeholder'=>'+38 096 123 45 67')); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>
 
    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password') ?>
        <?php echo $form->error($model,'password'); ?>
    </div>
 
    <div class="row">
        <?php echo $form->labelEx($model, 'password2'); ?>
        <?php echo $form->passwordField($model, 'password2') ?>
        <?php echo $form->error($model,'password2'); ?>
    </div>
 
    <div class="row">
        <?php $this->widget('CCaptcha', array('buttonLabel' => '<br>[новый код]')); ?>
        <?php echo $form->label($model, 'captcha'); ?>
        <?=CHtml::activeTextField($model,'captcha'); ?>
    </div>
 
    <div class="row submit">
        <?=CHtml::submitButton('Зарегистрироваться', array('id' => 'submit','class'=>'subm_btn')); ?>
    </div>
 
    <?php $this->endWidget(); ?>
</div><!-- form -->