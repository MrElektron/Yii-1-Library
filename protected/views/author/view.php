<?php
$this->pageTitle = $model->name;
$this->breadcrumbs = array(
	'Авторы' => array('index'),
	$model->name,
);
?>

<h1><?php echo CHtml::encode($model->name); ?></h1>

<h3>Книги:</h3>
<ul>
<?php foreach ($model->books as $book): ?>
	<li><?php echo CHtml::link(CHtml::encode($book->title), array('book/view', 'id' => $book->id)); ?>
		(<?php echo $book->year; ?>)
	</li>
<?php endforeach; ?>
<?php if (empty($model->books)): ?>
	<li>Нет книг</li>
<?php endif; ?>
</ul>

<p>
<?php if (Yii::app()->user->checkAccess('manageAuthors')): ?>
	<?php echo CHtml::link('Редактировать', array('update', 'id' => $model->id)); ?> |
	<?php echo CHtml::link('Удалить', array('delete', 'id' => $model->id), array('confirm' => 'Удалить?')); ?> |
<?php endif; ?>
<?php if (Yii::app()->user->checkAccess('subscribeAuthor')): ?>
	<?php echo CHtml::link('Подписаться на новые книги', array('subscribe', 'id' => $model->id)); ?> |
<?php endif; ?>
	<?php echo CHtml::link('Назад', array('index')); ?>
</p>

<?php if (Yii::app()->user->hasFlash('subscribe')): ?>
<div class="flash-success"><?php echo Yii::app()->user->getFlash('subscribe'); ?></div>
<?php endif; ?>
