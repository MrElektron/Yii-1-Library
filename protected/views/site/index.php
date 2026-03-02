<?php
$this->pageTitle = Yii::app()->name;
?>
<h1>Каталог книг</h1>
<p><?php echo CHtml::link('Книги', array('/book/index')); ?> | 
   <?php echo CHtml::link('Авторы', array('/author/index')); ?> | 
   <?php echo CHtml::link('Отчёт ТОП-10', array('/report/index')); ?></p>
