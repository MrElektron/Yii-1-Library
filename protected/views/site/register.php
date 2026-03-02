<?php
$this->pageTitle = 'Регистрация';
$this->breadcrumbs = array('Регистрация');
?>

<h1>Регистрация</h1>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'register-form',
	'enableAjaxValidation' => false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'username'); ?>
		<?php echo $form->textField($model, 'username'); ?>
		<?php echo $form->error($model, 'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->passwordField($model, 'password'); ?>
		<?php echo $form->error($model, 'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'passwordRepeat'); ?>
		<?php echo $form->passwordField($model, 'passwordRepeat'); ?>
		<?php echo $form->error($model, 'passwordRepeat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Зарегистрироваться'); ?>
	</div>

<?php $this->endWidget(); ?>
