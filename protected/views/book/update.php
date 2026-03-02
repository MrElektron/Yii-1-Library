<?php
$this->pageTitle = 'Редактировать: ' . $model->title;
$this->breadcrumbs = array(
	'Книги' => array('index'),
	$model->title => array('view', 'id' => $model->id),
	'Редактировать',
);
?>

<h1>Редактировать: <?php echo CHtml::encode($model->title); ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
