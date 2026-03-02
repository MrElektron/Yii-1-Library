<?php

class AuthorSubscription extends CActiveRecord
{
	public function tableName()
	{
		return 'author_subscription';
	}

	public function rules()
	{
		return array(
			array('author_id, phone', 'required'),
			array('author_id', 'numerical', 'integerOnly' => true),
			array('phone', 'match', 'pattern' => '/^[0-9]{10,11}$/', 'message' => 'Номер: 10-11 цифр без +'),
			array('author_id', 'exist', 'className' => 'Author', 'attributeName' => 'id'),
			array('phone', 'validateUniqueSubscription'),
		);
	}

	public function relations()
	{
		return array(
			'author' => array(self::BELONGS_TO, 'Author', 'author_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author_id' => 'Автор',
			'phone' => 'Телефон',
		);
	}

	public function validateUniqueSubscription($attribute, $params)
	{
		$phone = preg_replace('/[^0-9]/', '', $this->phone);
		if (strlen($phone) === 10) {
			$phone = '7' . $phone;
		}
		$exists = self::model()->exists(
			'author_id=:aid AND phone=:p',
			array(':aid' => $this->author_id, ':p' => $phone)
		);
		if ($exists) {
			$this->addError('phone', 'Вы уже подписаны на этого автора с этим номером');
		}
	}

	public function beforeSave()
	{
		if (parent::beforeSave() && $this->isNewRecord) {
			$this->created_at = date('Y-m-d H:i:s');
			// Нормализуем номер к формату 7XXXXXXXXXX
			$this->phone = preg_replace('/[^0-9]/', '', $this->phone);
			if (strlen($this->phone) === 10) {
				$this->phone = '7' . $this->phone;
			}
			return true;
		}
		return false;
	}

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
