<?php
$this->pageTitle = 'Авторы';
$this->breadcrumbs = array('Авторы');
?>

<h1>Авторы</h1>

<?php if (Yii::app()->user->checkAccess('manageAuthors')): ?>
<p><?php echo CHtml::link('Добавить автора', array('create')); ?></p>
<?php endif; ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'name',
		array(
			'class' => 'CButtonColumn',
			'buttons' => array(
				'update' => array('visible' => 'Yii::app()->user->checkAccess("manageAuthors")'),
				'delete' => array('visible' => 'Yii::app()->user->checkAccess("manageAuthors")'),
			),
		),
	),
)); ?>
