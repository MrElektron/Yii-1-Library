<?php

class Book extends CActiveRecord
{
	public $authorIds = array();

	public function tableName()
	{
		return 'book';
	}

	public function rules()
	{
		return array(
			array('title', 'required'),
			array('year', 'numerical', 'integerOnly' => true, 'min' => 1, 'max' => 2100),
			array('title', 'length', 'max' => 255),
			array('isbn, cover_image', 'length', 'max' => 255),
			array('description', 'safe'),
			array('authorIds', 'safe'),
			array('id, title, year, isbn', 'safe', 'on' => 'search'),
		);
	}

	public function relations()
	{
		return array(
			'authors' => array(self::MANY_MANY, 'Author', 'book_author(book_id, author_id)'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'year' => 'Год выпуска',
			'description' => 'Описание',
			'isbn' => 'ISBN',
			'cover_image' => 'Фото обложки',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('year', $this->year);
		$criteria->compare('isbn', $this->isbn, true);
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array('defaultOrder' => 'title'),
		));
	}

	public function beforeSave()
	{
		if (parent::beforeSave()) {
			if ($this->isNewRecord) {
				$this->created_at = date('Y-m-d H:i:s');
			}
			$this->updated_at = date('Y-m-d H:i:s');
			return true;
		}
		return false;
	}

	protected function afterFind()
	{
		parent::afterFind();
		$this->authorIds = array();
		foreach ($this->authors as $author) {
			$this->authorIds[] = $author->id;
		}
	}

	protected function afterSave()
	{
		parent::afterSave();
		$this->updateAuthors();
	}

	// Синхронизация связи с авторами — junction-таблица обновляется после каждого save
	protected function updateAuthors()
	{
		Yii::app()->db->createCommand()->delete('book_author', 'book_id=:id', array(':id' => $this->id));
		if (is_array($this->authorIds) && !empty($this->authorIds)) {
			foreach ($this->authorIds as $authorId) {
				if ($authorId) {
					Yii::app()->db->createCommand()->insert('book_author', array(
						'book_id' => $this->id,
						'author_id' => (int)$authorId,
					));
				}
			}
		}
	}

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
