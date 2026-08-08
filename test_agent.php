<?php
require_once __DIR__ . '/classes/ContentRepository.php';

$materialsByClass = ContentRepository::materialsGroupedByClass();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вопрос специалисту</title>
    <link rel="stylesheet" href="style/normalize.css?v=20260519">
    <link rel="stylesheet" href="style/style__agent.css?v=20260617-agent-2">
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

    <main class="agent-page">
        <h1 class="agent-title">Спроси нейросеть про книги</h1>

        <div class="agent-intro">
            <form class="agent-panel" id="AGENT_FORM">
                <p class="agent-panel__title">ИИ агент</p>
                <div class="agent-panel__controls">
                    <textarea id="AGENT_INPUT" name="message" rows="1" placeholder="Задай свой вопрос"></textarea>
                    <button type="submit" id="AGENT_SEND">Отправить</button>
                </div>
            </form>

            <aside class="agent-examples" aria-label="Примеры вопросов">
                <p class="agent-examples__title">Например</p>
                <ul class="agent-examples__list">
                    <li><button class="agent-example" type="button">Как с Вами связаться?</button></li>
                    <li><button class="agent-example" type="button">Подбери книгу для 7 класса</button></li>
                    <li><button class="agent-example" type="button">Хочу научиться рисовать</button></li>
                    <li><button class="agent-example" type="button">Нужна хорошая книга в подарок</button></li>
                </ul>
            </aside>
        </div>

        <section class="agent-answer" aria-live="polite">
            <div id="LOADING" class="agent-loading" hidden>Загрузка...</div>
            <div class="response">
                <p class="response__placeholder">Ответ на вопрос</p>
            </div>
        </section>

        <section class="agent-materials" aria-label="Материалы по классам">
            <?php foreach ($materialsByClass as $classLevel => $items): ?>
                <article class="agent-class-card<?= count($items) <= 1 ? ' agent-class-card--small' : '' ?>">
                    <h2 class="agent-class-card__title"><?= htmlspecialchars($classLevel, ENT_QUOTES, 'UTF-8') ?> класс</h2>
                    <ol class="agent-materials__list">
                        <?php foreach ($items as $item): ?>
                            <li><a href="<?= htmlspecialchars($item['file_path'], ENT_QUOTES, 'UTF-8') ?>" download><?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?></a></li>
                        <?php endforeach; ?>
                    </ol>
                </article>
            <?php endforeach; ?>
        </section>
    </main>

    <?php require 'components/footer.php'?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('AGENT_FORM');
    const input = document.getElementById('AGENT_INPUT');
    const button = document.getElementById('AGENT_SEND');
    const loading = document.getElementById('LOADING');
    const response = document.querySelector('.response');

    document.querySelectorAll('.agent-example').forEach(function (item) {
        item.addEventListener('click', function () {
            input.value = this.innerText;
            input.focus();
        });
    });

    input.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            form.requestSubmit();
        }
    });

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const query = input.value.trim();
        if (!query) {
            input.focus();
            return;
        }

        button.disabled = true;
        loading.hidden = false;
        response.innerHTML = '';

        try {
            const res = await fetch('ajax/getAgent.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: 'message=' + encodeURIComponent(query)
            });

            if (!res.ok) {
                throw new Error('Request failed');
            }

            response.innerHTML = await res.text();
        } catch (error) {
            response.innerHTML = '<p class="response__error">Не получилось отправить вопрос. Попробуйте ещё раз чуть позже.</p>';
        } finally {
            loading.hidden = true;
            button.disabled = false;
        }
    });
});
</script>
</body>
</html>