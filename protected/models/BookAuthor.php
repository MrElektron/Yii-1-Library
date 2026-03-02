<?php

class BookAuthor extends CActiveRecord
{
	public function tableName()
	{
		return 'book_author';
	}

	public function relations()
	{
		return array(
			'book' => array(self::BELONGS_TO, 'Book', 'book_id'),
			'author' => array(self::BELONGS_TO, 'Author', 'author_id'),
		);
	}

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
