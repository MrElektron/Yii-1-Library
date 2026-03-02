<?php
$this->pageTitle = 'Добавить книгу';
$this->breadcrumbs = array(
	'Книги' => array('index'),
	'Добавить',
);
?>

<h1>Добавить книгу</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
