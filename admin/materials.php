<?php
require_once __DIR__ . '/includes/bootstrap.php';
requireAdmin();

$pdo = dbOrFail();
$message = '';
$error = '';
$editing = null;

function subjectCodeFromLabel(string $label): string
{
    $normalized = mb_strtolower(trim($label), 'UTF-8');
    $knownSubjects = [
        'чтение' => 'reading',
        'рисование' => 'drawing',
        'математика' => 'math',
        'грамота' => 'literacy',
        'геометрия' => 'geometry',
    ];

    return $knownSubjects[$normalized] ?? 'subject_' . substr(md5($normalized), 0, 8);
}

function nextMaterialSortOrder(PDO $pdo, int $classLevel): int
{
    $stmt = $pdo->prepare('SELECT COALESCE(MAX(sort_order), 0) + 1 FROM materials WHERE class_level = ?');
    $stmt->execute([$classLevel]);
    return (int) $stmt->fetchColumn();
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        verifyCsrf();
        $action = $_POST['action'] ?? '';

        if ($action === 'delete') {
            $stmt = $pdo->prepare('DELETE FROM materials WHERE id = ?');
            $stmt->execute([(int) ($_POST['id'] ?? 0)]);
            $message = 'Материал удалён.';
        }

        if ($action === 'save') {
            $id = (int) ($_POST['id'] ?? 0);
            $title = trim($_POST['title'] ?? '');
            $classLevel = (int) ($_POST['class_level'] ?? 1);
            $subjectLabel = trim($_POST['subject_label'] ?? 'Другое') ?: 'Другое';
            $subject = subjectCodeFromLabel($subjectLabel);
            $filePath = trim($_POST['current_file_path'] ?? '');
            $uploadedPath = saveUploadedFile('file_upload', 'files', ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png']);

            if ($uploadedPath) {
                $filePath = $uploadedPath;
            }

            if (!$title) {
                throw new RuntimeException('Название материала обязательно.');
            }

            if (!$filePath) {
                throw new RuntimeException('Укажите путь к файлу или загрузите файл.');
            }

            if ($id > 0) {
                $stmt = $pdo->prepare('UPDATE materials SET title = ?, class_level = ?, subject = ?, subject_label = ?, file_path = ? WHERE id = ?');
                $stmt->execute([$title, $classLevel, $subject, $subjectLabel, $filePath, $id]);
                $message = 'Материал обновлён.';
            } else {
                $sortOrder = nextMaterialSortOrder($pdo, $classLevel);
                $stmt = $pdo->prepare('INSERT INTO materials (title, class_level, subject, subject_label, file_path, sort_order) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->execute([$title, $classLevel, $subject, $subjectLabel, $filePath, $sortOrder]);
                $message = 'Материал добавлен.';
            }
        }
    }

    if (isset($_GET['edit'])) {
        $stmt = $pdo->prepare('SELECT * FROM materials WHERE id = ?');
        $stmt->execute([(int) $_GET['edit']]);
        $editing = $stmt->fetch() ?: null;
    }
} catch (Throwable $exception) {
    $error = $exception->getMessage();
}

$items = $pdo->query('SELECT * FROM materials ORDER BY class_level ASC, sort_order ASC, id ASC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Материалы — админка</title>
    <link rel="stylesheet" href="../style/normalize.css?v=20260519">
    <link rel="stylesheet" href="../style/admin.css?v=20260805-admin">
</head>
<body>
<main class="admin-page">
    <div class="admin-shell">
        <header class="admin-header">
            <h1 class="admin-title">Материалы</h1>
            <nav class="admin-nav">
                <a href="index.php">Главная</a>
                <a href="books.php">Книги</a>
                <a href="../guides.php">Открыть страницу</a>
                <a href="logout.php">Выйти</a>
            </nav>
        </header>

        <?php if ($message): ?><p class="admin-message"><?= h($message) ?></p><?php endif; ?>
        <?php if ($error): ?><p class="admin-message admin-error"><?= h($error) ?></p><?php endif; ?>

        <section class="admin-card">
            <h2><?= $editing ? 'Редактировать материал' : 'Добавить материал' ?></h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= h(csrfToken()) ?>">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?= h($editing['id'] ?? '') ?>">
                <div class="admin-grid">
                    <label class="admin-field admin-field--wide">Название
                        <input type="text" name="title" value="<?= h($editing['title'] ?? '') ?>" required>
                    </label>
                    <label class="admin-field">Класс
                        <input type="number" name="class_level" min="1" value="<?= h($editing['class_level'] ?? '1') ?>" required>
                    </label>
                    <label class="admin-field">Предмет
                        <input type="text" name="subject_label" value="<?= h($editing['subject_label'] ?? 'Другое') ?>" placeholder="Математика">
                    </label>
                    <label class="admin-field admin-field--wide">Загрузить файл
                        <input type="file" name="file_upload">
                    </label>
                    <label class="admin-field admin-field--wide">Или путь к текущему файлу
                        <input type="text" name="current_file_path" value="<?= h($editing['file_path'] ?? '') ?>" placeholder="files/name.pdf">
                    </label>
                </div>
                <div class="admin-actions">
                    <button class="admin-button" type="submit">Сохранить</button>
                    <?php if ($editing): ?><a class="admin-button admin-button--light" href="materials.php">Отмена</a><?php endif; ?>
                </div>
            </form>
        </section>

        <section class="admin-card">
            <h2>Список материалов</h2>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead><tr><th>Класс</th><th>Название</th><th>Предмет</th><th>Файл</th><th>Порядок</th><th></th></tr></thead>
                    <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= h($item['class_level']) ?></td>
                            <td><?= h($item['title']) ?></td>
                            <td><?= h($item['subject_label']) ?></td>
                            <td><a href="../<?= h($item['file_path']) ?>" target="_blank"><?= h($item['file_path']) ?></a></td>
                            <td><?= h($item['sort_order']) ?></td>
                            <td>
                                <div class="admin-actions">
                                    <a class="admin-button admin-button--light" href="materials.php?edit=<?= h($item['id']) ?>">Изменить</a>
                                    <form method="post" onsubmit="return confirm('Удалить материал?')">
                                        <input type="hidden" name="csrf_token" value="<?= h(csrfToken()) ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= h($item['id']) ?>">
                                        <button class="admin-button admin-button--danger" type="submit">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>
</body>
</html>