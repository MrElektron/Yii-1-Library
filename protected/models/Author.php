<?php

class Author extends CActiveRecord
{
	public function tableName()
	{
		return 'author';
	}

	public function rules()
	{
		return array(
			array('name', 'required'),
			array('name', 'length', 'max' => 255),
			array('id, name', 'safe', 'on' => 'search'),
		);
	}

	public function relations()
	{
		return array(
			'books' => array(self::MANY_MANY, 'Book', 'book_author(author_id, book_id)'),
			'subscriptions' => array(self::HAS_MANY, 'AuthorSubscription', 'author_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'ФИО',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array('defaultOrder' => 'name'),
		));
	}

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
