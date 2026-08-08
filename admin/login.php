<?php
require_once __DIR__ . '/includes/bootstrap.php';

if (!empty($_SESSION['admin_id'])) {
    redirectTo(adminUrl('index.php'));
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        verifyCsrf();
        $pdo = dbOrFail();
        $stmt = $pdo->prepare('SELECT * FROM admin_users WHERE login = ? LIMIT 1');
        $stmt->execute([trim($_POST['login'] ?? '')]);
        $user = $stmt->fetch();

        if ($user && password_verify($_POST['password'] ?? '', $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_login'] = $user['login'];
            redirectTo(adminUrl('index.php'));
        }

        $error = 'Неверный логин или пароль.';
    } catch (Throwable $exception) {
        $error = $exception->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в админку</title>
    <link rel="stylesheet" href="../style/normalize.css?v=20260519">
    <link rel="stylesheet" href="../style/admin.css?v=20260805-admin">
</head>
<body>
<main class="admin-page">
    <section class="admin-card login-card">
        <h1 class="admin-title">Админка</h1>
        <?php if ($error): ?><p class="admin-message admin-error"><?= h($error) ?></p><?php endif; ?>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrfToken()) ?>">
            <label class="admin-field">
                Логин
                <input type="text" name="login" autocomplete="username" required>
            </label>
            <label class="admin-field">
                Пароль
                <input type="password" name="password" autocomplete="current-password" required>
            </label>
            <div class="admin-actions">
                <button class="admin-button" type="submit">Войти</button>
            </div>
        </form>
    </section>
</main>
</body>
</html>