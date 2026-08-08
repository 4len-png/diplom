<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Методическая копилка</title>
    <link rel="stylesheet" href="../style/normalize.css?v=20260519">
    <link rel="stylesheet" href="../style/style__bff.css?v=20260519">
    <link rel="stylesheet" href="../style/header.css?v=20260617-header">
    <link rel="stylesheet" href="../style/footer.css?v=20260617-footer">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/icon/favicon-16x16.png">
    <link rel="manifest" href="../images/icon/site.webmanifest">
</head>
<body>
    <div class="wrapper">
        
        <header class="header">
            <div class="header__logo">
                <a href="../index.php"><img src="../images/header__logo.png" alt="logo"></a>
            </div>
            <nav class="header__nav">
                <ul class="header__nav-list">
                    <li class="header__nav-title"><a href="../author.php" class="header__nav-link">Об авторе</a></li>
                    <li class="header__nav-title"><a href="../guides.php" class="header__nav-link">Материалы</a></li>
                    <li class="header__nav-title"><a href="../videoguides.php" class="header__nav-link">Видеолекции</a></li>
                    <li class="header__nav-title"><a href="../test_agent.php" class="header__nav-link">&#1042;&#1086;&#1087;&#1088;&#1086;&#1089; &#1089;&#1087;&#1077;&#1094;&#1080;&#1072;&#1083;&#1080;&#1089;&#1090;&#1091;</a></li>
                    <li class="header__nav-title"><a href="../books.php" class="header__nav-link">Книги</a></li>
                </ul>
            </nav>
            <div class="header__profile">
                <div class="header__profile-logo">
                    <img src="../images/profile-logo.png" alt="logo">
                </div>
            </div>
        </header>

        <main class="main">
            <div class="content">
                <div class="back">
                    <a href="../books.php" class="back_button"><img src="../images/arrow.png" alt="" class="arrow">Назад</a>
                </div>
                <div class="info">
                    <div class="content_bg"></div>
                    <div class="info_image">
                        <div class="book-hover-media" data-hover-video>
                            <img src="../images/books/listik.svg" alt="" class="info_image-firefly">
                            <video src="../videos/listik.MP4" class="book-hover-video" muted loop playsinline></video>
                        </div>
                    </div>
                    <section class="info_description">
                        <div class="info_description-text">
                            <h2 class="info_description-title">Путешествие листика</h2>
                            <div class="info_description-author">
                                <p class="info_description-author__black">Автор</p>
                                <p class="info_description-author__pink">Наталия Фершукова</p>
                            </div>
                            <div class="info_description-about">
                                <p class="info_description-about-title">О книге</p>
                                    <p class="info_description-about-text" id="text">
                                        Маленький листик, оторвавшись от мамы-ветки, впервые сталкивается с большим и порой пугающим миром: 
                                        переживает ливень, любуется радугой и в итоге становится частью гербария. 
                                        В этом путешествии он учится понимать себя и окружающих. Книга Наталии Фершуковой показывает, что
                                        <span class="more-text">
                                            мир не так страшен, а бояться — нормально. Яркие иллюстрации Анастасии Вороновой помогают оживить историю. 
                                            Подходит для детей старшего дошкольного и младшего школьного возраста.
                                        </span>
                                        <button class="info__button" id="text__btn">Далее</button>
                                    </p>
                                    
                            </div>
                        </div>
                        <div class="info_descriprion-buttons">
                            <a href="#" class="description_button-buy">Купить</a>
                            <a href="#" class="description_button-cart">Добавить в корзину</a>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
    <script src="../scrypts/more-less.js?v=20260519"></script>
    <script src="../scrypts/book-hover-video.js?v=20260519"></script>
</body>