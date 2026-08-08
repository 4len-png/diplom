USE szipsc_schemes;

INSERT INTO materials (title, class_level, subject, subject_label, file_path, sort_order) VALUES
('Моя первая книга', 1, 'reading', 'Чтение', 'files/Книига Сканирование.pdf', 1),
('Эпоха рисования форм', 1, 'drawing', 'Рисование', 'files/Эпоха рисования форм.pdf', 2),
('Математика 1 класс. Тренировочные задания', 1, 'math', 'Математика', 'files/Математика_1_класс_тренировочные_задания_с_нумерацией.pdf', 3),
('В помощь классному учителю 1 класса. Обучение грамоте', 1, 'literacy', 'Грамота', 'files/Обучение грамоте.pdf', 4),
('Геометрия в символах', 7, 'geometry', 'Геометрия', 'files/Геометрия в символах.pdf', 1);

INSERT INTO books (title, image_path, video_path, detail_path, sort_order) VALUES
('Сказка о светлячке', 'images/books/firefly.svg', 'videos/firefly.MP4', 'books/book_firefly.php', 1),
('Розовый куст и аморфа', 'images/books/bush.svg', 'videos/bush.MP4', 'books/book_bush.html', 2),
('Улитка', 'images/books/snail.svg', 'videos/snail.MP4', 'books/book_snail.php', 3),
('Путешествия листика', 'images/books/listik.svg', 'videos/listik.MP4', 'books/book_listik.php', 4),
('Геометрия жизни', 'images/books/geometry.svg', 'videos/geometry.MP4', 'books/book_geometry.php', 5),
('Лови момент', 'images/books/moment.svg', 'videos/moment.MP4', 'books/book_moment.php', 6);