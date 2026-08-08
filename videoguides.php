<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Методическая копилка</title>
    <link rel="stylesheet" href="style/normalize.css?v=20260519">
    <link rel="stylesheet" href="style/style__videoguides.css?v=20260615-mobile">
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
            <div class="description">
                <div class="description__header">
                    <h1 class="description__title">Видеолекции</h1>
                    <p class="description__subtitle">
                        Здесь собраны записи уроков, структурированные по классам
                    </p>
                </div>
                <div class="description__content">
                    <div class="description__learns">
                        <p class="description__text-bold">Смотрите уроки и узнавайте:</p>
                        <div class="description__comments-left">
                            <div class="description__comment-right">
                                <p>Подход к обучению</p>
                            </div>
                            <div class="description__comment-left">
                                <p>Особенности провеодения занятий</p>
                            </div>
                            <div class="description__comment-right">
                                <p>Педагогическое видение автора</p>
                            </div>
                        </div>
                    </div>
                    <div class="description__video">
                        <div class="description__circle">
                            <video src="videos/video-smile.mp4" autoplay muted playsinline controls></video>
                        </div>
                    </div>
                    <div class="description__result">
                        <p class="description__text-bold">Они дадут вам:</p>
                        <div class="description__comments-right">
                            <div class="description__comment-left">
                                <p>Опыт, который не подчерпнуть из книг</p>
                            </div>
                            <div class="description__comment-right">
                                <p>Знания, как проходят занятия</p>
                            </div>
                            <div class="description__comment-left">
                                <p>Помощь в раскрытии детских талантов</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video">
                <h1 class="video__title">Видеолекции</h1>
                <div class="video__bricks">
                    <a href="videoguides-4.php" class="video__brick">
                        <p class="video__text">4 класс</p>
                    </a>
                    <a href="videoguides-5.php" class="video__brick">
                        <p class="video__text">5 класс</p>
                    </a>
                    <a href="videoguides-6.php" class="video__brick">
                        <p class="video__text">6 класс</p>
                    </a>
                    <!-- <div class="video__brick">
                        <p class="video__text">7 класс</p>
                    </div> -->
                </div>
            </div>
        </main>
        <?php require 'components/footer.php'?>
    </div>
</body>
</html>
