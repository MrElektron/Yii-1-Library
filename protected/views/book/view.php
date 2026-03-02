<?php
$this->pageTitle = $model->title;
$this->breadcrumbs = array(
	'Книги' => array('index'),
	$model->title,
);
?>

<h1><?php echo CHtml::encode($model->title); ?></h1>

<table class="detail-view">
<tr><th>Год</th><td><?php echo CHtml::encode($model->year); ?></td></tr>
<tr><th>ISBN</th><td><?php echo CHtml::encode($model->isbn); ?></td></tr>
<tr><th>Авторы</th><td>
	<?php
	foreach ($model->authors as $a) {
		echo CHtml::link(CHtml::encode($a->name), array('author/view', 'id' => $a->id)) . ' ';
	}
	?>
</td></tr>
<?php if ($model->cover_image): ?>
<tr><th>Обложка</th><td>
	<?php
	$path = Yii::app()->baseUrl . '/uploads/' . $model->cover_image;
	echo CHtml::image($path, '', array('style' => 'max-width:200px'));
	?>
</td></tr>
<?php endif; ?>
<tr><th>Описание</th><td><?php echo nl2br(CHtml::encode($model->description)); ?></td></tr>
</table>

<p>
<?php if (Yii::app()->user->checkAccess('manageBooks')): ?>
	<?php echo CHtml::link('Редактировать', array('update', 'id' => $model->id)); ?> |
	<?php echo CHtml::link('Удалить', array('delete', 'id' => $model->id), array('confirm' => 'Удалить?')); ?> |
<?php endif; ?>
	<?php echo CHtml::link('Назад', array('index')); ?>
</p>
