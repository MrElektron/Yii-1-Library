<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'book-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Поля с <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'year'); ?>
		<?php echo $form->numberField($model, 'year', array('min' => 1, 'max' => 2100)); ?>
		<?php echo $form->error($model, 'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'isbn'); ?>
		<?php echo $form->textField($model, 'isbn', array('size' => 30)); ?>
		<?php echo $form->error($model, 'isbn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'cover_image'); ?>
		<?php echo $form->fileField($model, 'cover_image'); ?>
		<?php if ($model->cover_image): ?>
			<br><?php echo CHtml::image(Yii::app()->baseUrl . '/uploads/' . $model->cover_image, '', array('style' => 'max-width:100px')); ?>
		<?php endif; ?>
		<?php echo $form->error($model, 'cover_image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'description'); ?>
		<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
		<?php echo $form->error($model, 'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'authorIds'); ?>
		<?php
		$authors = Author::model()->findAll(array('order' => 'name'));
		$list = CHtml::listData($authors, 'id', 'name');
		echo $form->listBox($model, 'authorIds', $list, array(
			'multiple' => true,
			'size' => 8,
			'style' => 'width:300px',
		));
		?>
		<?php echo $form->error($model, 'authorIds'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>
