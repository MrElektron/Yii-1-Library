<?php

class AuthorController extends Controller
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
				'expression' => 'Yii::app()->user->checkAccess("viewAuthors")',
			),
			array('allow',
				'actions' => array('subscribe'),
				'expression' => 'Yii::app()->user->checkAccess("subscribeAuthor")',
			),
			array('allow',
				'actions' => array('create', 'update', 'delete'),
				'expression' => 'Yii::app()->user->checkAccess("manageAuthors")',
			),
			array('deny', 'users' => array('*')),
		);
	}

	public function actionIndex()
	{
		$model = new Author('search');
		$model->unsetAttributes();
		if (isset($_GET['Author'])) {
			$model->attributes = $_GET['Author'];
		}
		$this->render('index', array('model' => $model));
	}

	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	public function actionSubscribe($id)
	{
		$author = $this->loadModel($id);
		$model = new AuthorSubscription;
		$model->author_id = $author->id;

		if (isset($_POST['AuthorSubscription'])) {
			$model->attributes = $_POST['AuthorSubscription'];
			$model->author_id = $author->id;
			if ($model->save()) {
				Yii::app()->user->setFlash('subscribe', 'Вы подписаны на уведомления о новых книгах ' . $author->name);
				$this->redirect(array('view', 'id' => $author->id));
			}
		}

		$this->render('subscribe', array('model' => $model, 'author' => $author));
	}

	public function actionCreate()
	{
		$model = new Author;

		if (isset($_POST['Author'])) {
			$model->attributes = $_POST['Author'];
			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array('model' => $model));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['Author'])) {
			$model->attributes = $_POST['Author'];
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
		$model = Author::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'Автор не найден');
		}
		return $model;
	}
}
