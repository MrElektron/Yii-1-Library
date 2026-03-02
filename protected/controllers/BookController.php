<?php

class BookController extends Controller
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
				'actions' => array('index', 'view'),
				'expression' => 'Yii::app()->user->checkAccess("viewBooks")',
			),
			array('allow',
				'actions' => array('create', 'update', 'delete'),
				'expression' => 'Yii::app()->user->checkAccess("manageBooks")',
			),
			array('deny', 'users' => array('*')),
		);
	}

	public function actionIndex()
	{
		$model = new Book('search');
		$model->unsetAttributes();
		if (isset($_GET['Book'])) {
			$model->attributes = $_GET['Book'];
		}
		$this->render('index', array('model' => $model));
	}

	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model = new Book;
		$model->authorIds = array();

		if (isset($_POST['Book'])) {
			$model->attributes = $_POST['Book'];
			$model->authorIds = isset($_POST['Book']['authorIds']) ? $_POST['Book']['authorIds'] : array();
			$model->cover_image = $this->handleCoverUpload($model, 'cover_image');
			if ($model->save()) {
				$this->notifySubscribers($model);
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array('model' => $model));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['Book'])) {
			$model->attributes = $_POST['Book'];
			$model->authorIds = isset($_POST['Book']['authorIds']) ? $_POST['Book']['authorIds'] : array();
			$uploaded = $this->handleCoverUpload($model, 'cover_image');
			if ($uploaded) {
				$model->cover_image = $uploaded;
			}
			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array('model' => $model));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$this->redirect(array('index'));
	}

	protected function loadModel($id)
	{
		$model = Book::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'Книга не найдена');
		}
		return $model;
	}

	// При создании книги — SMS подписчикам каждого автора
	protected function notifySubscribers(Book $book)
	{
		foreach ($book->authors as $author) {
			Yii::app()->sms->notifyNewBook($author, $book);
		}
	}

	protected function handleCoverUpload($model, $attribute)
	{
		$file = CUploadedFile::getInstance($model, $attribute);
		if ($file) {
			$uploadPath = Yii::app()->basePath . '/../uploads/';
			if (!is_dir($uploadPath)) {
				mkdir($uploadPath, 0755, true);
			}
			$ext = pathinfo($file->name, PATHINFO_EXTENSION) ?: 'jpg';
			$filename = uniqid('cover_') . '.' . $ext;
			if ($file->saveAs($uploadPath . $filename)) {
				if ($model->cover_image && file_exists($uploadPath . $model->cover_image)) {
					unlink($uploadPath . $model->cover_image);
				}
				return $filename;
			}
		}
		return $model->cover_image;
	}
}
