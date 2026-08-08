<?php
require_once __DIR__ . '/includes/bootstrap.php';
requireAdmin();

$pdo = dbOrFail();
$message = '';
$error = '';
$editing = null;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        verifyCsrf();
        $action = $_POST['action'] ?? '';

        if ($action === 'delete') {
            $stmt = $pdo->prepare('DELETE FROM books WHERE id = ?');
            $stmt->execute([(int) ($_POST['id'] ?? 0)]);
            $message = 'Книга удалена.';
        }

        if ($action === 'save') {
            $id = (int) ($_POST['id'] ?? 0);
            $imagePath = trim($_POST['current_image_path'] ?? '');
            $videoPath = trim($_POST['current_video_path'] ?? '');

            $uploadedImage = saveUploadedFile('image_upload', 'images/books', ['svg', 'jpg', 'jpeg', 'png', 'webp']);
            $uploadedVideo = saveUploadedFile('video_upload', 'videos', ['mp4', 'webm', 'mov']);

            if ($uploadedImage) {
                $imagePath = $uploadedImage;
            }

            if ($uploadedVideo) {
                $videoPath = $uploadedVideo;
            }

            $data = [
                trim($_POST['title'] ?? ''),
                $imagePath,
                $videoPath ?: null,
                trim($_POST['detail_path'] ?? ''),
                (int) ($_POST['sort_order'] ?? 100),
            ];

            if (!$data[0] || !$data[1] || !$data[3]) {
                throw new RuntimeException('Название, картинка и ссылка на страницу книги обязательны.');
            }

            if ($id > 0) {
                $stmt = $pdo->prepare('UPDATE books SET title = ?, image_path = ?, video_path = ?, detail_path = ?, sort_order = ? WHERE id = ?');
                $stmt->execute([...$data, $id]);
                $message = 'Книга обновлена.';
            } else {
                $stmt = $pdo->prepare('INSERT INTO books (title, image_path, video_path, detail_path, sort_order) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute($data);
                $message = 'Книга добавлена.';
            }
        }
    }

    if (isset($_GET['edit'])) {
        $stmt = $pdo->prepare('SELECT * FROM books WHERE id = ?');
        $stmt->execute([(int) $_GET['edit']]);
        $editing = $stmt->fetch() ?: null;
    }
} catch (Throwable $exception) {
    $error = $exception->getMessage();
}

$items = $pdo->query('SELECT * FROM books ORDER BY sort_order ASC, id ASC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Книги — админка</title>
    <link rel="stylesheet" href="../style/normalize.css?v=20260519">
    <link rel="stylesheet" href="../style/admin.css?v=20260805-admin">
</head>
<body>
<main class="admin-page">
    <div class="admin-shell">
        <header class="admin-header">
            <h1 class="admin-title">Книги</h1>
            <nav class="admin-nav">
                <a href="index.php">Главная</a>
                <a href="materials.php">Материалы</a>
                <a href="../books.php">Открыть страницу</a>
                <a href="logout.php">Выйти</a>
            </nav>
        </header>

        <?php if ($message): ?><p class="admin-message"><?= h($message) ?></p><?php endif; ?>
        <?php if ($error): ?><p class="admin-message admin-error"><?= h($error) ?></p><?php endif; ?>

        <section class="admin-card">
            <h2><?= $editing ? 'Редактировать книгу' : 'Добавить книгу' ?></h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= h(csrfToken()) ?>">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?= h($editing['id'] ?? '') ?>">
                <div class="admin-grid">
                    <label class="admin-field admin-field--wide">Название
                        <input type="text" name="title" value="<?= h($editing['title'] ?? '') ?>" required>
                    </label>
                    <label class="admin-field">Порядок
                        <input type="number" name="sort_order" value="<?= h($editing['sort_order'] ?? '100') ?>">
                    </label>
                    <label class="admin-field">Страница книги
                        <input type="text" name="detail_path" value="<?= h($editing['detail_path'] ?? '') ?>" placeholder="books/book_name.php" required>
                    </label>
                    <label class="admin-field admin-field--wide">Загрузить картинку
                        <input type="file" name="image_upload">
                    </label>
                    <label class="admin-field admin-field--wide">Или путь к картинке
                        <input type="text" name="current_image_path" value="<?= h($editing['image_path'] ?? '') ?>" placeholder="images/books/name.svg">
                    </label>
                    <label class="admin-field admin-field--wide">Загрузить видео для hover
                        <input type="file" name="video_upload">
                    </label>
                    <label class="admin-field admin-field--wide">Или путь к видео
                        <input type="text" name="current_video_path" value="<?= h($editing['video_path'] ?? '') ?>" placeholder="videos/name.MP4">
                    </label>
                </div>
                <div class="admin-actions">
                    <button class="admin-button" type="submit">Сохранить</button>
                    <?php if ($editing): ?><a class="admin-button admin-button--light" href="books.php">Отмена</a><?php endif; ?>
                </div>
            </form>
        </section>

        <section class="admin-card">
            <h2>Список книг</h2>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead><tr><th>Название</th><th>Картинка</th><th>Видео</th><th>Страница</th><th>Порядок</th><th></th></tr></thead>
                    <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= h($item['title']) ?></td>
                            <td><?= h($item['image_path']) ?></td>
                            <td><?= h($item['video_path']) ?></td>
                            <td><a href="../<?= h($item['detail_path']) ?>" target="_blank"><?= h($item['detail_path']) ?></a></td>
                            <td><?= h($item['sort_order']) ?></td>
                            <td>
                                <div class="admin-actions">
                                    <a class="admin-button admin-button--light" href="books.php?edit=<?= h($item['id']) ?>">Изменить</a>
                                    <form method="post" onsubmit="return confirm('Удалить книгу?')">
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