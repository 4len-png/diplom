<?php
require_once __DIR__ . '/classes/ContentRepository.php';

$materialsByClass = ContentRepository::materialsGroupedByClass();
$subjects = ContentRepository::subjects();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Методическая копилка</title>
    <link rel="stylesheet" href="style/normalize.css?v=20260519">
    <link rel="stylesheet" href="style/style__guides.css?v=20260615-mobile-2">
    <link rel="stylesheet" href="style/header.css?v=20260617-header">
    <link rel="stylesheet" href="style/footer.css?v=20260617-footer">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon/favicon-16x16.png">
    <link rel="manifest" href="images/icon/site.webmanifest">
</head>
<body>
    <div class="wrapper">
        <?php require 'components/header.php'?>
        <main class="main">
            <div class="guides-head">
                <div class="head-name">
                    <h1 class="head-name_title-top">Материалы</h1>
                </div>
            </div>
            <div class="guides-layout">
                <div class="guides__edu">
                    <?php foreach ($materialsByClass as $classLevel => $items): ?>
                        <div class="guides__class" data-class="<?= htmlspecialchars($classLevel, ENT_QUOTES, 'UTF-8') ?>">
                            <div class="guides__big">
                                <h1 class="guides__title"><?= htmlspecialchars($classLevel, ENT_QUOTES, 'UTF-8') ?> класс</h1>
                                <?php foreach ($items as $index => $item): ?>
                                    <a
                                        href="<?= htmlspecialchars($item['file_path'], ENT_QUOTES, 'UTF-8') ?>"
                                        class="guides__text"
                                        data-class="<?= htmlspecialchars((string) $item['class_level'], ENT_QUOTES, 'UTF-8') ?>"
                                        data-subject="<?= htmlspecialchars($item['subject'], ENT_QUOTES, 'UTF-8') ?>"
                                        download
                                    ><?= $index + 1 ?>. <?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?></a><br>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <aside class="head-filters">
                    <p class="head-filters__title">Фильтры</p>
                    <div class="head-filters__buttons">
                        <button class="head-filters__button" type="button" data-filter-mode="class">По классам</button>
                        <button class="head-filters__button" type="button" data-filter-mode="subject">По предметам</button>
                    </div>
                    <div class="head-filters__controls">
                        <label class="head-filters__control" data-filter-control="class" hidden>
                            <span class="head-filters__label">Класс</span>
                            <select class="head-filters__select" data-filter-select="class">
                                <option value="all">Все классы</option>
                                <?php foreach (array_keys($materialsByClass) as $classLevel): ?>
                                    <option value="<?= htmlspecialchars($classLevel, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($classLevel, ENT_QUOTES, 'UTF-8') ?> класс</option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="head-filters__control" data-filter-control="subject" hidden>
                            <span class="head-filters__label">Предмет</span>
                            <select class="head-filters__select" data-filter-select="subject">
                                <option value="all">Все предметы</option>
                                <?php foreach ($subjects as $code => $label): ?>
                                    <option value="<?= htmlspecialchars($code, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                </aside>
            </div>
        </main>
        <?php require 'components/footer.php'?>
    </div>
    <script src="scrypts/guides-filters.js?v=20260522"></script>
</body>
</html>