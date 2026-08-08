<?php
require_once __DIR__ . '/includes/bootstrap.php';
requireAdmin();

$materialsCount = count(ContentRepository::materials());
$booksCount = count(ContentRepository::books());
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <link rel="stylesheet" href="../style/normalize.css?v=20260519">
    <link rel="stylesheet" href="../style/admin.css?v=20260805-admin">
</head>
<body>
<main class="admin-page">
    <div class="admin-shell">
        <header class="admin-header">
            <h1 class="admin-title">Админ-панель</h1>
            <nav class="admin-nav">
                <a href="materials.php">Материалы</a>
                <a href="books.php">Книги</a>
                <a href="../index.php">На сайт</a>
                <a href="logout.php">Выйти</a>
            </nav>
        </header>

        <section class="admin-grid">
            <article class="admin-card">
                <h2>Материалы</h2>
                <p>Сейчас на сайте: <?= $materialsCount ?></p>
                <a class="admin-button" href="materials.php">Редактировать материалы</a>
            </article>
            <article class="admin-card">
                <h2>Книги</h2>
                <p>Сейчас на сайте: <?= $booksCount ?></p>
                <a class="admin-button" href="books.php">Редактировать книги</a>
            </article>
        </section>
    </div>
</main>
</body>
</html>