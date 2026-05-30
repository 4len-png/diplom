<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Методическая копилка</title>
    <link rel="stylesheet" href="style/normalize.css?v=20260519">
    <link rel="stylesheet" href="style/header.css?v=20260519">
    <link rel="stylesheet" href="style/style__guides.css?v=20260522-4">
    <link rel="stylesheet" href="style/footer.css?v=20260519">
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
                    <div class="guides__class" data-class="1">
                        <div class="guides__big">
                            <h1 class="guides__title">1 Класс</h1>
                            <a href="files/Книига Сканирование.pdf" class="guides__text" data-class="1" data-subject="reading" target="_blank">1. Моя первая книга</a><br>
                            <a href="files/Эпоха рисования форм.pdf" class="guides__text" data-class="1" data-subject="drawing" target="_blank">2. Эпоха рисования форм</a><br>
                            <a href="files/Математика 1 класс тренировочные задания с нумерацией.pdf" class="guides__text" data-class="1" data-subject="math" target="_blank">3. Математика 1 класс. Тренировочные задания</a><br>
                            <a href="files/Обучение грамоте.pdf" class="guides__text" data-class="1" data-subject="literacy" target="_blank">4. В помощь классному учителю 1 класса. Обучение грамоте</a><br>
                        </div>
                    </div>
                <div class="guides__class" data-class="7">
                    <div class="guides__big">
                        <h1 class="guides__title">7 Класс</h1>
                        <a href="files/Геометрия в символах.pdf" class="guides__text" data-class="7" data-subject="geometry" download>1. Геометрия в символах</a>
                    </div>
                </div>
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
                                <option value="1">1 класс</option>
                                <option value="7">7 класс</option>
                            </select>
                        </label>
                        <label class="head-filters__control" data-filter-control="subject" hidden>
                            <span class="head-filters__label">Предмет</span>
                            <select class="head-filters__select" data-filter-select="subject">
                                <option value="all">Все предметы</option>
                                <option value="reading">Чтение</option>
                                <option value="drawing">Рисование</option>
                                <option value="math">Математика</option>
                                <option value="literacy">Грамота</option>
                                <option value="geometry">Геометрия</option>
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