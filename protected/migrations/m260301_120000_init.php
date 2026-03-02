<?php

class m260301_120000_init extends CDbMigration
{
	public function up()
	{
		// Users
		$this->createTable('user', array(
			'id' => 'pk',
			'username' => 'string NOT NULL',
			'password' => 'string NOT NULL',
			'auth_key' => 'string',
			'created_at' => 'datetime',
			'updated_at' => 'datetime',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
		$this->createIndex('username', 'user', 'username', true);

		// Authors
		$this->createTable('author', array(
			'id' => 'pk',
			'name' => 'string NOT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

		// Books
		$this->createTable('book', array(
			'id' => 'pk',
			'title' => 'string NOT NULL',
			'year' => 'int',
			'description' => 'text',
			'isbn' => 'string',
			'cover_image' => 'string',
			'created_at' => 'datetime',
			'updated_at' => 'datetime',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
		$this->createIndex('isbn', 'book', 'isbn');

		// Book-Author (many-to-many)
		$this->createTable('book_author', array(
			'book_id' => 'int NOT NULL',
			'author_id' => 'int NOT NULL',
			'PRIMARY KEY (book_id, author_id)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
		$this->addForeignKey('fk_book_author_book', 'book_author', 'book_id', 'book', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_book_author_author', 'book_author', 'author_id', 'author', 'id', 'CASCADE', 'CASCADE');

		// Author subscriptions (guests subscribe with phone)
		$this->createTable('author_subscription', array(
			'id' => 'pk',
			'author_id' => 'int NOT NULL',
			'phone' => 'string NOT NULL',
			'created_at' => 'datetime',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
		$this->addForeignKey('fk_subscription_author', 'author_subscription', 'author_id', 'author', 'id', 'CASCADE', 'CASCADE');
		$this->createIndex('author_phone', 'author_subscription', 'author_id,phone', true);

		// RBAC tables
		$this->createTable('auth_item', array(
			'name' => 'varchar(64) NOT NULL',
			'type' => 'int NOT NULL',
			'description' => 'text',
			'bizrule' => 'text',
			'data' => 'text',
			'PRIMARY KEY (name)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

		$this->createTable('auth_item_child', array(
			'parent' => 'varchar(64) NOT NULL',
			'child' => 'varchar(64) NOT NULL',
			'PRIMARY KEY (parent, child)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
		$this->addForeignKey('fk_auth_child_parent', 'auth_item_child', 'parent', 'auth_item', 'name', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_auth_child_child', 'auth_item_child', 'child', 'auth_item', 'name', 'CASCADE', 'CASCADE');

		$this->createTable('auth_assignment', array(
			'itemname' => 'varchar(64) NOT NULL',
			'userid' => 'varchar(64) NOT NULL',
			'bizrule' => 'text',
			'data' => 'text',
			'PRIMARY KEY (itemname, userid)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
		$this->addForeignKey('fk_auth_assignment_item', 'auth_assignment', 'itemname', 'auth_item', 'name', 'CASCADE', 'CASCADE');

		// Demo user (password: 123456)
		$passwordHash = password_hash('123456', PASSWORD_BCRYPT, ['cost' => 10]);
		$this->insert('user', array(
			'username' => 'admin',
			'password' => $passwordHash,
			'auth_key' => 'demo_key_' . uniqid(),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
		$userId = $this->getDbConnection()->getLastInsertID();

		// RBAC: roles and permissions
		$this->insert('auth_item', array('name' => 'guest', 'type' => 2, 'description' => 'Guest'));
		$this->insert('auth_item', array('name' => 'user', 'type' => 2, 'description' => 'Authenticated user'));
		$this->insert('auth_item', array('name' => 'viewBooks', 'type' => 1, 'description' => 'View books'));
		$this->insert('auth_item', array('name' => 'viewAuthors', 'type' => 1, 'description' => 'View authors'));
		$this->insert('auth_item', array('name' => 'subscribeAuthor', 'type' => 1, 'description' => 'Subscribe to author'));
		$this->insert('auth_item', array('name' => 'manageBooks', 'type' => 1, 'description' => 'CRUD books'));
		$this->insert('auth_item', array('name' => 'manageAuthors', 'type' => 1, 'description' => 'CRUD authors'));
		$this->insert('auth_item', array('name' => 'viewReport', 'type' => 1, 'description' => 'View TOP authors report'));

		$this->insert('auth_item_child', array('parent' => 'guest', 'child' => 'viewBooks'));
		$this->insert('auth_item_child', array('parent' => 'guest', 'child' => 'viewAuthors'));
		$this->insert('auth_item_child', array('parent' => 'guest', 'child' => 'subscribeAuthor'));
		$this->insert('auth_item_child', array('parent' => 'guest', 'child' => 'viewReport'));
		$this->insert('auth_item_child', array('parent' => 'user', 'child' => 'guest'));
		$this->insert('auth_item_child', array('parent' => 'user', 'child' => 'manageBooks'));
		$this->insert('auth_item_child', array('parent' => 'user', 'child' => 'manageAuthors'));

		$this->insert('auth_assignment', array('itemname' => 'guest', 'userid' => '0'));
		$this->insert('auth_assignment', array('itemname' => 'user', 'userid' => (string)$userId));
	}

	public function down()
	{
		$this->dropTable('auth_assignment');
		$this->dropTable('auth_item_child');
		$this->dropTable('auth_item');
		$this->dropTable('author_subscription');
		$this->dropTable('book_author');
		$this->dropTable('book');
		$this->dropTable('author');
		$this->dropTable('user');
	}
}
