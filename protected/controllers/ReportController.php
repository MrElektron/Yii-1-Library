<?php

class ReportController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array('index'),
				'expression' => 'Yii::app()->user->checkAccess("viewReport")',
			),
			array('deny', 'users' => array('*')),
		);
	}

	public function actionIndex()
	{
		$years = Yii::app()->db->createCommand(
			'SELECT DISTINCT year FROM book WHERE year IS NOT NULL ORDER BY year DESC'
		)->queryColumn();
		if (empty($years)) {
			$years = array(date('Y'));
		}

		$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)$years[0];
		if (!in_array($year, $years)) {
			$year = (int)$years[0];
		}

		$sql = "
			SELECT a.id, a.name, COUNT(ba.book_id) as books_count
			FROM author a
			INNER JOIN book_author ba ON ba.author_id = a.id
			INNER JOIN book b ON b.id = ba.book_id AND b.year = :year
			GROUP BY a.id
			ORDER BY books_count DESC
			LIMIT 10
		";
		$data = Yii::app()->db->createCommand($sql)->queryAll(true, array(':year' => $year));

		$this->render('index', array(
			'data' => $data,
			'year' => $year,
			'years' => $years,
		));
	}
}
