<?php

// Для RBAC гости должны иметь userid — используем '0', роль guest в auth_assignment
class WebUser extends CWebUser
{
	public function getId()
	{
		return $this->getIsGuest() ? '0' : parent::getId();
	}
}
