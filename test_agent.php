<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Методическая копилка</title>
    <link rel="stylesheet" href="style/normalize.css?v=20260519">
    <link rel="stylesheet" href="style/header.css?v=20260519">
    <link rel="stylesheet" href="style/style__guides.css?v=20260519">
    <link rel="stylesheet" href="style/style__agent.css?v=20260519">
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
                <h1 class="head-name_title-top">Спроси у ИИ агента про книги</h1>


                <p class="exampleText"><b>Например:</b></p>
                <ul class="selectText">
                    <li>Как с Вами связаться?</li>
                    <li>Подбери книгу для 7 класса</li>
                    <li>Хочу научиться рисовать</li>
                    <li>Нужна хорошая книга в подарок</li>
                </ul>
            </div>
            <div class="head-search">
                <p class="head-search_title">ИИ агент</p>
                <div class="head-search_input">
                    <textarea id="AGENT_INPUT">подбери мне книгу по рисованию</textarea>



                    <button type="button" id="AGENT_SEND">Отправить</button>



                    <script>
                        document.addEventListener('DOMContentLoaded', function () {


                            document.querySelectorAll('.selectText li').forEach(function (ITEM) {
                                ITEM.addEventListener('click', function () {
                                    const TEXTAREA = document.getElementById('AGENT_INPUT');
                                    TEXTAREA.value = this.innerText;
                                    TEXTAREA.focus();
                                });
                            });

                            const INPUT = document.getElementById('AGENT_INPUT');
                            const BUTTON = document.getElementById('AGENT_SEND');
                            const LOADING = document.getElementById('LOADING');
                            const RESPONSE = document.querySelector('.response');

                            BUTTON.addEventListener('click', async function () {

                                const QUERY = INPUT.value;

                                if (!QUERY.trim()) {
                                    return;
                                }

                                LOADING.style.display = 'block';
                                RESPONSE.innerHTML = '';

                                try {
                                    const RES = await fetch('/ajax/getAgent.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                                        },
                                        body: 'message=' + encodeURIComponent(QUERY)
                                    });

                                    const HTML = await RES.text();

                                    RESPONSE.innerHTML = HTML;

                                } catch (E) {
                                    RESPONSE.innerHTML = 'Ошибка запроса';
                                } finally {
                                    LOADING.style.display = 'none';
                                }
                            });

                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="guides__edu ai-block" >
            <div id="LOADING" style="display:none;">Загрузка...</div>
            <div class="response"></div>
            <div class="guides__class">                                                                 <!-- 1 Класс -->
                <div class="guides__big">
                    <h1 class="guides__title">1 Класс</h1>
                    <a href="files/Книига Сканирование.pdf" class="guides__text" download>1. Моя первая книга</a><br>
                    <a href="files/Эпоха рисования форм.pdf" class="guides__text" download>2. Эпоха рисования форм</a><br>
                    <a href="files/Математика_1_класс_тренировочные_задания_с_нумерацией.pdf" class="guides__text" download>3. Математика 1 класс. Тренировочные задания для учащихся и учащих</a><br>
                    <a href="files/Обучение грамоте.pdf" class="guides__text" download>4. В помощь классному учителю 1 класса. Обучение граммоте</a><br>
                </div>
            </div>
            <div class="guides__class">
                <div class="guides__big">
                    <h1 class="guides__title">7 Класс</h1>                                              <!-- 7 Класс -->
                    <a href="files/Геометрия в символах.pdf" class="guides__text" download>1. Геометрия в символах.</a>
                </div>
            </div>
        </div>
    </main>
    <?php require 'components/footer.php'?>
</div>
<script src="scrypts/guides-search.js?v=20260519"></script>
</body>