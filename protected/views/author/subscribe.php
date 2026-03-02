<?php
$this->pageTitle = 'Подписка на ' . $author->name;
$this->breadcrumbs = array(
	'Авторы' => array('index'),
	$author->name => array('view', 'id' => $author->id),
	'Подписка',
);
?>

<h1>Подписаться на новые книги: <?php echo CHtml::encode($author->name); ?></h1>

<p>Введите номер телефона для получения SMS о новых книгах этого автора.</p>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'subscription-form',
	'enableAjaxValidation' => false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'phone'); ?>
		<?php echo $form->textField($model, 'phone', array('placeholder' => '79001234567')); ?>
		<?php echo $form->error($model, 'phone'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Подписаться'); ?>
	</div>

<?php $this->endWidget(); ?>
