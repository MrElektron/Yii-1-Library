# Каталог книг

Yii 1.1, MySQL, PHP 8.3

## Требования

- PHP 8.3
- MySQL
- Yii 1.x — фреймворк должен лежать рядом с проектом в `../yii-master` (от корня приложения)


## Установка

1. Создать БД: `CREATE DATABASE library CHARACTER SET utf8mb4;`
2. Настроить `protected/config/database.php` (хост, пользователь, пароль)
3. Миграции: `php protected/yiic.php migrate up`

Первый пользователь (admin/123456) создаётся миграцией init.

## Роли

- Гость: просмотр, подписка на авторов, отчёт ТОП-10
- Пользователь: CRUD книг и авторов
