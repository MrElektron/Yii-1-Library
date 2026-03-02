<?php
$this->pageTitle = 'Книги';
$this->breadcrumbs = array('Книги');
?>

<h1>Книги</h1>

<?php if (Yii::app()->user->checkAccess('manageBooks')): ?>
<p><?php echo CHtml::link('Добавить книгу', array('create')); ?></p>
<?php endif; ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'title',
		'year',
		'isbn',
		array(
			'class' => 'CButtonColumn',
			'buttons' => array(
				'update' => array('visible' => 'Yii::app()->user->checkAccess("manageBooks")'),
				'delete' => array('visible' => 'Yii::app()->user->checkAccess("manageBooks")'),
			),
		),
	),
)); ?>
