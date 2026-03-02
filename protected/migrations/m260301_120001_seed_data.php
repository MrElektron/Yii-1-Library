<?php

class m260301_120001_seed_data extends CDbMigration
{
	public function up()
	{
		$authors = array(
			array('name' => 'Лев Толстой'),
			array('name' => 'Фёдор Достоевский'),
			array('name' => 'Александр Пушкин'),
			array('name' => 'Антон Чехов'),
			array('name' => 'Николай Гоголь'),
			array('name' => 'Иван Тургенев'),
			array('name' => 'Михаил Булгаков'),
		);

		foreach ($authors as $a) {
			$this->insert('author', $a);
		}

		$authorIds = $this->getDbConnection()->createCommand('SELECT id FROM author')->queryColumn();

		$books = array(
			array('title' => 'Война и мир', 'year' => 1869, 'isbn' => '978-5-17-090234-1', 'author_idx' => array(0)),
			array('title' => 'Анна Каренина', 'year' => 1877, 'isbn' => '978-5-17-090235-2', 'author_idx' => array(0)),
			array('title' => 'Воскресение', 'year' => 1899, 'isbn' => '978-5-17-090236-3', 'author_idx' => array(0)),
			array('title' => 'Смерть Ивана Ильича', 'year' => 1886, 'isbn' => '978-5-17-090237-4', 'author_idx' => array(0)),
			array('title' => 'Преступление и наказание', 'year' => 1866, 'isbn' => '978-5-17-090238-5', 'author_idx' => array(1)),
			array('title' => 'Идиот', 'year' => 1869, 'isbn' => '978-5-17-090239-6', 'author_idx' => array(1)),
			array('title' => 'Братья Карамазовы', 'year' => 1880, 'isbn' => '978-5-17-090240-7', 'author_idx' => array(1)),
			array('title' => 'Бесы', 'year' => 1872, 'isbn' => '978-5-17-090241-8', 'author_idx' => array(1)),
			array('title' => 'Евгений Онегин', 'year' => 1833, 'isbn' => '978-5-17-090242-9', 'author_idx' => array(2)),
			array('title' => 'Капитанская дочка', 'year' => 1836, 'isbn' => '978-5-17-090243-0', 'author_idx' => array(2)),
			array('title' => 'Пиковая дама', 'year' => 1834, 'isbn' => '978-5-17-090244-1', 'author_idx' => array(2)),
			array('title' => 'Дубровский', 'year' => 1841, 'isbn' => '978-5-17-090245-2', 'author_idx' => array(2)),
			array('title' => 'Вишнёвый сад', 'year' => 1904, 'isbn' => '978-5-17-090246-3', 'author_idx' => array(3)),
			array('title' => 'Три сестры', 'year' => 1901, 'isbn' => '978-5-17-090247-4', 'author_idx' => array(3)),
			array('title' => 'Чайка', 'year' => 1896, 'isbn' => '978-5-17-090248-5', 'author_idx' => array(3)),
			array('title' => 'Мёртвые души', 'year' => 1842, 'isbn' => '978-5-17-090249-6', 'author_idx' => array(4)),
			array('title' => 'Ревизор', 'year' => 1836, 'isbn' => '978-5-17-090250-7', 'author_idx' => array(4)),
			array('title' => 'Тарас Бульба', 'year' => 1835, 'isbn' => '978-5-17-090251-8', 'author_idx' => array(4)),
			array('title' => 'Отцы и дети', 'year' => 1862, 'isbn' => '978-5-17-090252-9', 'author_idx' => array(5)),
			array('title' => 'Рудин', 'year' => 1856, 'isbn' => '978-5-17-090253-0', 'author_idx' => array(5)),
			array('title' => 'Мастер и Маргарита', 'year' => 1967, 'isbn' => '978-5-17-090254-1', 'author_idx' => array(6)),
			array('title' => 'Собачье сердце', 'year' => 1925, 'isbn' => '978-5-17-090255-2', 'author_idx' => array(6)),
			array('title' => 'Белая гвардия', 'year' => 1925, 'isbn' => '978-5-17-090256-3', 'author_idx' => array(6)),
			array('title' => 'Детство', 'year' => 1852, 'isbn' => '978-5-17-090257-4', 'author_idx' => array(0)),
			array('title' => 'Отрочество', 'year' => 1854, 'isbn' => '978-5-17-090258-5', 'author_idx' => array(0)),
			array('title' => 'Юность', 'year' => 1857, 'isbn' => '978-5-17-090259-6', 'author_idx' => array(0)),
			array('title' => 'Хаджи-Мурат', 'year' => 1912, 'isbn' => '978-5-17-090260-7', 'author_idx' => array(0)),
			array('title' => 'Крейцерова соната', 'year' => 1890, 'isbn' => '978-5-17-090261-8', 'author_idx' => array(0)),
			array('title' => 'Бедные люди', 'year' => 1846, 'isbn' => '978-5-17-090262-9', 'author_idx' => array(1)),
			array('title' => 'Игрок', 'year' => 1866, 'isbn' => '978-5-17-090263-0', 'author_idx' => array(1)),
			array('title' => 'Униженные и оскорблённые', 'year' => 1861, 'isbn' => '978-5-17-090264-1', 'author_idx' => array(1)),
			array('title' => 'Подросток', 'year' => 1875, 'isbn' => '978-5-17-090265-2', 'author_idx' => array(1)),
			array('title' => 'Борис Годунов', 'year' => 1825, 'isbn' => '978-5-17-090266-3', 'author_idx' => array(2)),
			array('title' => 'Медный всадник', 'year' => 1833, 'isbn' => '978-5-17-090267-4', 'author_idx' => array(2)),
			array('title' => 'Руслан и Людмила', 'year' => 1820, 'isbn' => '978-5-17-090268-5', 'author_idx' => array(2)),
			array('title' => 'Дядя Ваня', 'year' => 1899, 'isbn' => '978-5-17-090269-6', 'author_idx' => array(3)),
			array('title' => 'Ионыч', 'year' => 1898, 'isbn' => '978-5-17-090270-7', 'author_idx' => array(3)),
			array('title' => 'Дама с собачкой', 'year' => 1899, 'isbn' => '978-5-17-090271-8', 'author_idx' => array(3)),
			array('title' => 'Палата №6', 'year' => 1892, 'isbn' => '978-5-17-090272-9', 'author_idx' => array(3)),
			array('title' => 'Шинель', 'year' => 1842, 'isbn' => '978-5-17-090273-0', 'author_idx' => array(4)),
			array('title' => 'Нос', 'year' => 1836, 'isbn' => '978-5-17-090274-1', 'author_idx' => array(4)),
			array('title' => 'Невский проспект', 'year' => 1835, 'isbn' => '978-5-17-090275-2', 'author_idx' => array(4)),
			array('title' => 'Записки охотника', 'year' => 1852, 'isbn' => '978-5-17-090276-3', 'author_idx' => array(5)),
			array('title' => 'Дворянское гнездо', 'year' => 1859, 'isbn' => '978-5-17-090277-4', 'author_idx' => array(5)),
			array('title' => 'Дым', 'year' => 1867, 'isbn' => '978-5-17-090278-5', 'author_idx' => array(5)),
			array('title' => 'Жизнь и судьба', 'year' => 1959, 'isbn' => '978-5-17-090279-6', 'author_idx' => array(6)),
			array('title' => 'Театральный роман', 'year' => 1937, 'isbn' => '978-5-17-090280-7', 'author_idx' => array(6)),
			array('title' => 'Казаки', 'year' => 1863, 'isbn' => '978-5-17-090281-8', 'author_idx' => array(0)),
			array('title' => 'Севастопольские рассказы', 'year' => 1855, 'isbn' => '978-5-17-090282-9', 'author_idx' => array(0)),
			array('title' => 'Бесы. Часть вторая', 'year' => 1873, 'isbn' => '978-5-17-090283-0', 'author_idx' => array(1)),
			array('title' => 'Записки из мёртвого дома', 'year' => 1862, 'isbn' => '978-5-17-090284-1', 'author_idx' => array(1)),
			array('title' => 'Станционный смотритель', 'year' => 1831, 'isbn' => '978-5-17-090285-2', 'author_idx' => array(2)),
			array('title' => 'Метель', 'year' => 1831, 'isbn' => '978-5-17-090286-3', 'author_idx' => array(2)),
			array('title' => 'Выстрел', 'year' => 1831, 'isbn' => '978-5-17-090287-4', 'author_idx' => array(2)),
			array('title' => 'Скупой рыцарь', 'year' => 1830, 'isbn' => '978-5-17-090288-5', 'author_idx' => array(2)),
			array('title' => 'Человек в футляре', 'year' => 1898, 'isbn' => '978-5-17-090289-6', 'author_idx' => array(3)),
			array('title' => 'Крыжовник', 'year' => 1898, 'isbn' => '978-5-17-090290-7', 'author_idx' => array(3)),
			array('title' => 'О любви', 'year' => 1898, 'isbn' => '978-5-17-090291-8', 'author_idx' => array(3)),
			array('title' => 'Вечер накануне Ивана Купала', 'year' => 1830, 'isbn' => '978-5-17-090292-9', 'author_idx' => array(4)),
			array('title' => 'Майская ночь', 'year' => 1831, 'isbn' => '978-5-17-090293-0', 'author_idx' => array(4)),
			array('title' => 'Ночь перед Рождеством', 'year' => 1832, 'isbn' => '978-5-17-090294-1', 'author_idx' => array(4)),
			array('title' => 'Ася', 'year' => 1858, 'isbn' => '978-5-17-090295-2', 'author_idx' => array(5)),
			array('title' => 'Первая любовь', 'year' => 1860, 'isbn' => '978-5-17-090296-3', 'author_idx' => array(5)),
			array('title' => 'Роман в девяти письмах', 'year' => 1829, 'isbn' => '978-5-17-090297-4', 'author_idx' => array(1)),
			array('title' => 'Гробовщик', 'year' => 1831, 'isbn' => '978-5-17-090298-5', 'author_idx' => array(2)),
			array('title' => 'Барышня-крестьянка', 'year' => 1831, 'isbn' => '978-5-17-090299-6', 'author_idx' => array(2)),
		);

		$now = date('Y-m-d H:i:s');
		$descriptions = array(
			'Роман-эпопея о русском обществе в эпоху войн против Наполеона.',
			'Роман о трагической любви замужней женщины.',
			'История духовного преображения главного героя.',
			'Повесть о смерти чиновника и переосмыслении жизни.',
			'Философский роман о преступлении и совести.',
			'Роман о князе-идиоте и его чистой душе.',
			'Семейная сага с философскими и религиозными вопросами.',
			'Политический роман о революционном движении.',
			'Роман в стихах о жизни светского общества.',
			'Исторический роман о пугачёвском восстании.',
		);

		$idx = 0;
		foreach ($books as $b) {
			$desc = $descriptions[$idx % count($descriptions)];
			$this->insert('book', array(
				'title' => $b['title'],
				'year' => $b['year'],
				'description' => $desc,
				'isbn' => $b['isbn'],
				'cover_image' => null,
				'created_at' => $now,
				'updated_at' => $now,
			));
			$bookId = $this->getDbConnection()->getLastInsertID();
			foreach ($b['author_idx'] as $ai) {
				if (isset($authorIds[$ai])) {
					$this->insert('book_author', array(
						'book_id' => $bookId,
						'author_id' => $authorIds[$ai],
					));
				}
			}
			$idx++;
		}

		$extraTitles = array(
			array('Два гусара', 1856, 0), array('Утро помещика', 1856, 0), array('Люцерн', 1857, 0),
			array('Альберт', 1858, 0), array('Семейное счастие', 1859, 0), array('Поликушка', 1863, 0),
			array('Власть тьмы', 1886, 0), array('Плоды просвещения', 1891, 0), array('Живой труп', 1900, 0),
			array('Двойник', 1846, 1), array('Хозяйка', 1847, 1), array('Слабое сердце', 1848, 1),
			array('Белые ночи', 1848, 1), array('Неточка Незванова', 1849, 1), array('Село Степанчиково', 1859, 1),
			array('Записки из подполья', 1864, 1), array('Вечный муж', 1870, 1), array('Подросток', 1875, 1),
			array('Сказка о царе Салтане', 1831, 2), array('Сказка о мёртвой царевне', 1833, 2),
			array('Сказка о золотом петушке', 1834, 2), array('Полтава', 1829, 2), array('Цыганы', 1824, 2),
			array('Граф Нулин', 1825, 2), array('Домик в Коломне', 1830, 2), array('Скупой рыцарь', 1830, 2),
			array('Степь', 1888, 3), array('Скучная история', 1889, 3), array('Дуэль', 1891, 3),
			array('Попрыгунья', 1892, 3), array('Рассказ неизвестного человека', 1893, 3),
			array('Чёрный монах', 1894, 3), array('Студент', 1894, 3), array('Анна на шее', 1895, 3),
			array('Страшная месть', 1832, 4), array('Иван Фёдорович Шпонька', 1832, 4),
			array('Заколдованное место', 1832, 4), array('Старосветские помещики', 1835, 4),
			array('Вий', 1835, 4), array('Повесть о том, как поссорились', 1835, 4),
			array('Женитьба', 1842, 4), array('Игроки', 1843, 4), array('Петербургские повести', 1835, 4),
			array('Муму', 1854, 5), array('Затишье', 1854, 5), array('Переписка', 1856, 5),
			array('Яков Пасынков', 1855, 5), array('Фауст', 1856, 5), array('Андрей Колосов', 1844, 5),
			array('Три портрета', 1846, 5), array('Бретер', 1847, 5), array('Петушков', 1848, 5),
			array('Дьячок', 1847, 5), array('Дневник лишнего человека', 1850, 5),
			array('Записки юного врача', 1926, 6), array('Морфий', 1927, 6), array('Роковые яйца', 1925, 6),
			array('Дьяволиада', 1924, 6), array('Похождения Чичикова', 1922, 6),
			array('История вчерашнего дня', 1851, 0), array('Набег', 1853, 0), array('Рубка леса', 1855, 0),
			array('Метель', 1856, 0), array('Разжалованный', 1856, 0), array('Из записок князя', 1856, 0),
			array('Три смерти', 1859, 0), array('Холстомер', 1885, 0), array('Отец Сергий', 1898, 0),
			array('Безумие', 1864, 1), array('Крокодил', 1865, 1), array('Скверный анекдот', 1862, 1),
			array('Зимние заметки о летних впечатлениях', 1863, 1), array('Записки из подполья', 1864, 1),
			array('Господин Прохарчин', 1846, 1), array('Роман в девяти письмах', 1847, 1),
			array('Елку и свадьба', 1848, 1), array('Честный вор', 1848, 1), array('Маленький герой', 1857, 1),
			array('Сказка о попе и работнике', 1840, 2), array('Цветок', 1828, 2), array('Египетские ночи', 1835, 2),
			array('Путешествие в Арзрум', 1835, 2), array('История Пугачёва', 1834, 2),
			array('Кавказский пленник', 1821, 2), array('Бахчисарайский фонтан', 1823, 2),
			array('Граф Нулин', 1825, 2), array('Цыганы', 1827, 2), array('Полтава', 1829, 2),
			array('Трагик поневоле', 1889, 3), array('Предложение', 1889, 3), array('Медведь', 1888, 3),
			array('Юбилей', 1891, 3), array('Свадьба', 1890, 3), array('Леший', 1889, 3),
			array('Иванов', 1887, 3), array('Чайка', 1895, 3), array('Дядя Ваня', 1896, 3),
			array('Портрет', 1835, 4), array('Записки сумасшедшего', 1835, 4), array('Коляска', 1836, 4),
			array('Нос', 1836, 4), array('Старосветские помещики', 1835, 4), array('Тарас Бульба', 1835, 4),
			array('Вий', 1835, 4), array('Повесть о капитане Копейкине', 1842, 4),
			array('Любовь к трём апельсинам', 1842, 4), array('Женитьба', 1842, 4),
			array('Часы', 1836, 5), array('Разговор на большой дороге', 1851, 5), array('Гамлет Щигровского уезда', 1849, 5),
			array('Контора', 1856, 5), array('Бригадир', 1847, 5), array('Несчастная', 1869, 5),
			array('Странная история', 1870, 5), array('Степной король Лир', 1870, 5),
			array('Стук... стук... стук!', 1871, 5), array('Вешние воды', 1872, 5),
		);

		foreach ($extraTitles as $et) {
			$isbn = '978-5-17-' . str_pad(rand(100000, 999999), 6, '0') . '-' . rand(1, 9);
			$this->insert('book', array(
				'title' => $et[0],
				'year' => $et[1],
				'description' => $descriptions[array_rand($descriptions)],
				'isbn' => $isbn,
				'cover_image' => null,
				'created_at' => $now,
				'updated_at' => $now,
			));
			$bookId = $this->getDbConnection()->getLastInsertID();
			if (isset($authorIds[$et[2]])) {
				$this->insert('book_author', array(
					'book_id' => $bookId,
					'author_id' => $authorIds[$et[2]],
				));
			}
		}
	}

	public function down()
	{
		$this->delete('book_author');
		$this->delete('book');
		$this->delete('author');
	}
}
