<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Методическая копилка</title>
    <link rel="stylesheet" href="style/normalize.css?v=20260519">
    <link rel="stylesheet" href="style/header.css?v=20260519">
    <link rel="stylesheet" href="style/style__books.css?v=20260519">
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
            <section class="title">
                <div class="title__container">
                    <h1 class="title__name">Книги, которые дети любят</h1>
                    <p class="title__subtitle">Откройте мир добрых и важных историй</p>
                    <img class="title__image" src="images/book-pict.png" alt="">
                </div>
            </section>
            <section class="library">
                <div class="library__container">
                    <div class="library__title">
                        <h1 class="library__name">Библиотека для детей</h1>
                        <p class="library__subtitle">
                            Яркие иллюстрации, высокое качество печати и бумаги позволят скрасить процесс обучения. Сказка «О светлячке, его маленьком фонарике и большой душе» и другие произведения Наталии Фершуковой расскажут ребенку о добром и важном
                        </p>
                    </div>
                    <div class="library__content">
                        <img src="images/library__image-left.png" alt="" class="library__content-left">
                        <div class="library__links">
                            <h1>Для возрастов</h1>
                            <button class="library__btn">
                                <span class="btn__line"></span>
                                <a href="#" class="btn__text">Детского</a>
                                <span class="btn__line"></span>
                            </button>
                            <button class="library__btn">
                                <span class="btn__line"></span>
                                <a href="#" class="btn__text">Маледшего школьного</a>
                                <span class="btn__line"></span>
                            </button>
                        </div>
                        <img src="images/library__image-right.png" alt="" class="library__content-right">
                    </div>
                </div>
            </section>
            <section class="first">
                <div class="first__wrapper">
                    <div class="first__contWrapper">
                        <div class="first__top">
                            <h1 class="first__title-big">моя первая книга</h1>
                            <p class="first__text">Книга, которая знакомит детей с красотой природы через поэзию и анимацию</p>
                        </div>

                        <div class="first__bg"></div>
                        <div class="first__bottom">
                            
                            <h1 class="first__title-small">книга помогает детям</h1>
                            <div class="first__block">    
                                <div class="first__brick">
                                    <p class="first__text">Узнать о смене сезонов</p>
                                </div>
                                <div class="first__brick">
                                    <p class="first__text">Полюбить природу</p>
                                </div>
                                <div class="first__brick">
                                    <p class="first__text">Развить воображение</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="first__illustration">
                        <video src="videos/IMG_0799.mp4" class="first__video" controls autoplay muted></video>
                    </div>
                </div>
            </section>
            <section class="books">
                
                <div class="books_bg"></div>

                <div class="books_container">
                    <h1 class="books_title">Книги</h1>

                    <div class="books-slider">

                        <button class="books-slider__btn books-slider__btn_prev" type="button" aria-label="Предыдущие книги"></button>

                        <div class="books-slider__window">
                            <div class="books-slider__track">
                                <div class="slider_item">
                                    <div class="slider_item-media" data-hover-video>
                                        <img src="images/books/firefly.svg" alt="" class="slider_item-img">
                                        <video src="videos/firefly.MP4" class="slider_item-video" muted loop playsinline></video>
                                    </div>
                                    <p class="slider_item-title">Сказка о светлячке</p>
                                    <a href="books/book_firefly.php" class="slider_item-btn">О книге</a>
                                </div>
                                <div class="slider_item">
                                    <div class="slider_item-media" data-hover-video>
                                        <img src="images/books/bush.svg" alt="" class="slider_item-img">
                                        <video src="videos/bush.MP4" class="slider_item-video" muted loop playsinline></video>
                                    </div>
                                    <p class="slider_item-title">Розовый куст и аморфа</p>
                                    <a href="books/book_bush.html" class="slider_item-btn">О книге</a>
                                </div>
                                <div class="slider_item">
                                    <div class="slider_item-media" data-hover-video>
                                        <img src="images/books/snail.svg" alt="" class="slider_item-img">
                                        <video src="videos/snail.MP4" class="slider_item-video" muted loop playsinline></video>
                                    </div>
                                    <p class="slider_item-title">Улитка</p>
                                    <a href="books/book_snail.php" class="slider_item-btn">О книге</a>
                                </div>
                                <div class="slider_item">
                                    <div class="slider_item-media" data-hover-video>
                                        <img src="images/books/listik.svg" alt="" class="slider_item-img">
                                        <video src="videos/listik.MP4" class="slider_item-video" muted loop playsinline></video>
                                    </div>
                                    <p class="slider_item-title">Путешествия листика</p>
                                    <a href="books/book_listik.php" class="slider_item-btn">О книге</a>
                                </div>
                                <div class="slider_item">
                                    <div class="slider_item-media" data-hover-video>
                                        <img src="images/books/geometry.svg" alt="" class="slider_item-img">
                                        <video src="videos/geometry.MP4" class="slider_item-video" muted loop playsinline></video>
                                    </div>
                                    <p class="slider_item-title">Геометрия жизни</p>
                                    <a href="books/book_geometry.php" class="slider_item-btn">О книге</a>
                                </div>
                                <div class="slider_item">
                                    <div class="slider_item-media" data-hover-video>
                                        <img src="images/books/moment.svg" alt="" class="slider_item-img">
                                        <video src="videos/moment.MP4" class="slider_item-video" muted loop playsinline></video>
                                    </div>
                                    <p class="slider_item-title">Лови момент</p>
                                    <a href="books/book_moment.php" class="slider_item-btn">О книге</a>
                                </div>
                            </div>
                        </div>

                        <button class="books-slider__btn books-slider__btn_next" type="button" aria-label="Следующие книги"></button>

                    </div>
                    
                </div>
            </section>
        </main>
        <?php require 'components/footer.php'?>
    </div>
<script src="scrypts/books-slider.js?v=20260519"></script>
<script src="scrypts/book-hover-video.js?v=20260519"></script>
</body>
</html>
