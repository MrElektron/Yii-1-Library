<?php

class RegisterForm extends CFormModel
{
	public $username;
	public $password;
	public $passwordRepeat;

	public function rules()
	{
		return array(
			array('username, password, passwordRepeat', 'required'),
			array('username', 'length', 'max' => 128),
			array('username', 'unique', 'className' => 'User', 'attributeName' => 'username'),
			array('password', 'length', 'min' => 6),
			array('passwordRepeat', 'compare', 'compareAttribute' => 'password'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'username' => 'Логин',
			'password' => 'Пароль',
			'passwordRepeat' => 'Повторите пароль',
		);
	}

	public function register()
	{
		if (!$this->validate()) {
			return false;
		}
		$user = new User;
		$user->username = $this->username;
		$user->password = $this->password;
		if ($user->save()) {
			Yii::app()->authManager->assign('user', (string)$user->id);
			return true;
		}
		return false;
	}
}
