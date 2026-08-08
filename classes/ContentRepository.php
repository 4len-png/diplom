<?php
require_once __DIR__ . '/../config/database.php';

class ContentRepository
{
    public static function materials(): array
    {
        $pdo = db();

        if ($pdo && self::tableExists($pdo, 'materials')) {
            $items = $pdo->query('SELECT * FROM materials ORDER BY class_level ASC, sort_order ASC, id ASC')->fetchAll();
            if ($items) {
                return $items;
            }
        }

        return self::fallbackMaterials();
    }

    public static function materialsGroupedByClass(): array
    {
        $groups = [];

        foreach (self::materials() as $item) {
            $class = (string) $item['class_level'];
            $groups[$class][] = $item;
        }

        ksort($groups, SORT_NATURAL);
        return $groups;
    }

    public static function subjects(): array
    {
        $subjects = [];

        foreach (self::materials() as $item) {
            $code = $item['subject'] ?: 'other';
            $subjects[$code] = $item['subject_label'] ?: 'Другое';
        }

        asort($subjects, SORT_NATURAL);
        return $subjects;
    }

    public static function books(): array
    {
        $pdo = db();

        if ($pdo && self::tableExists($pdo, 'books')) {
            $items = $pdo->query('SELECT * FROM books ORDER BY sort_order ASC, id ASC')->fetchAll();
            if ($items) {
                return $items;
            }
        }

        return self::fallbackBooks();
    }

    private static function tableExists(PDO $pdo, string $table): bool
    {
        try {
            $stmt = $pdo->prepare(
                'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = ?'
            );
            $stmt->execute([$table]);
            return (int) $stmt->fetchColumn() > 0;
        } catch (PDOException $error) {
            return false;
        }
    }

    public static function fallbackMaterials(): array
    {
        return [
            ['id' => 1, 'title' => 'Моя первая книга', 'class_level' => 1, 'subject' => 'reading', 'subject_label' => 'Чтение', 'file_path' => 'files/Книига Сканирование.pdf', 'sort_order' => 1],
            ['id' => 2, 'title' => 'Эпоха рисования форм', 'class_level' => 1, 'subject' => 'drawing', 'subject_label' => 'Рисование', 'file_path' => 'files/Эпоха рисования форм.pdf', 'sort_order' => 2],
            ['id' => 3, 'title' => 'Математика 1 класс. Тренировочные задания', 'class_level' => 1, 'subject' => 'math', 'subject_label' => 'Математика', 'file_path' => 'files/Математика_1_класс_тренировочные_задания_с_нумерацией.pdf', 'sort_order' => 3],
            ['id' => 4, 'title' => 'В помощь классному учителю 1 класса. Обучение грамоте', 'class_level' => 1, 'subject' => 'literacy', 'subject_label' => 'Грамота', 'file_path' => 'files/Обучение грамоте.pdf', 'sort_order' => 4],
            ['id' => 5, 'title' => 'Геометрия в символах', 'class_level' => 7, 'subject' => 'geometry', 'subject_label' => 'Геометрия', 'file_path' => 'files/Геометрия в символах.pdf', 'sort_order' => 1],
        ];
    }

    public static function fallbackBooks(): array
    {
        return [
            ['id' => 1, 'title' => 'Сказка о светлячке', 'image_path' => 'images/books/firefly.svg', 'video_path' => 'videos/firefly.MP4', 'detail_path' => 'books/book_firefly.php', 'sort_order' => 1],
            ['id' => 2, 'title' => 'Розовый куст и аморфа', 'image_path' => 'images/books/bush.svg', 'video_path' => 'videos/bush.MP4', 'detail_path' => 'books/book_bush.html', 'sort_order' => 2],
            ['id' => 3, 'title' => 'Улитка', 'image_path' => 'images/books/snail.svg', 'video_path' => 'videos/snail.MP4', 'detail_path' => 'books/book_snail.php', 'sort_order' => 3],
            ['id' => 4, 'title' => 'Путешествия листика', 'image_path' => 'images/books/listik.svg', 'video_path' => 'videos/listik.MP4', 'detail_path' => 'books/book_listik.php', 'sort_order' => 4],
            ['id' => 5, 'title' => 'Геометрия жизни', 'image_path' => 'images/books/geometry.svg', 'video_path' => 'videos/geometry.MP4', 'detail_path' => 'books/book_geometry.php', 'sort_order' => 5],
            ['id' => 6, 'title' => 'Лови момент', 'image_path' => 'images/books/moment.svg', 'video_path' => 'videos/moment.MP4', 'detail_path' => 'books/book_moment.php', 'sort_order' => 6],
        ];
    }
}