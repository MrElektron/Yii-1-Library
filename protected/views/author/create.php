<?php
$this->pageTitle = 'Добавить автора';
$this->breadcrumbs = array(
	'Авторы' => array('index'),
	'Добавить',
);
?>

<h1>Добавить автора</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
