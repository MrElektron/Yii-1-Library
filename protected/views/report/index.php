<?php
$this->pageTitle = 'ТОП-10 авторов';
$this->breadcrumbs = array('Отчёт');
?>

<h1>ТОП-10 авторов по количеству книг за <?php echo (int)$year; ?> год</h1>

<?php echo CHtml::form(array('/report/index'), 'get'); ?>
	Год: <select name="year">
		<?php foreach ($years as $y): ?>
			<option value="<?php echo $y; ?>" <?php echo $y == $year ? 'selected' : ''; ?>><?php echo $y; ?></option>
		<?php endforeach; ?>
	</select>
	<input type="submit" value="Показать">
</form>

<table class="grid">
	<tr>
		<th>№</th>
		<th>Автор</th>
		<th>Кол-во книг</th>
	</tr>
	<?php foreach ($data as $i => $row): ?>
	<tr>
		<td><?php echo $i + 1; ?></td>
		<td><?php echo CHtml::link(CHtml::encode($row['name']), array('author/view', 'id' => $row['id'])); ?></td>
		<td><?php echo $row['books_count']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php if (empty($data)): ?>
	<tr><td colspan="3">Нет данных за выбранный год</td></tr>
	<?php endif; ?>
</table>
