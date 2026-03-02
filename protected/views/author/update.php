<?php
$this->pageTitle = 'Редактировать: ' . $model->name;
$this->breadcrumbs = array(
	'Авторы' => array('index'),
	$model->name => array('view', 'id' => $model->id),
	'Редактировать',
);
?>

<h1>Редактировать: <?php echo CHtml::encode($model->name); ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
