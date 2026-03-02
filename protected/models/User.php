<?php

class User extends CActiveRecord
{
	public function tableName()
	{
		return 'user';
	}

	public function rules()
	{
		return array(
			array('username, password', 'required'),
			array('username', 'length', 'max' => 128),
			array('username', 'unique'),
			array('password', 'length', 'min' => 6),
			array('username', 'safe', 'on' => 'search'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Логин',
			'password' => 'Пароль',
		);
	}

	public function beforeSave()
	{
		if (parent::beforeSave()) {
			if ($this->isNewRecord) {
				$this->auth_key = Yii::app()->securityManager->generateRandomString(32);
				$this->created_at = date('Y-m-d H:i:s');
			}
			// Хешируем только сырой пароль (bcrypt hash 60 символов)
			if (!empty($this->password) && strlen($this->password) < 60) {
				$this->password = password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 10]);
			}
			$this->updated_at = date('Y-m-d H:i:s');
			return true;
		}
		return false;
	}

	public function validatePassword($password)
	{
		return password_verify($password, $this->password);
	}

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
