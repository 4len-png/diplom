<?php
if (PHP_SAPI !== 'cli') {
    exit("Этот файл можно запускать только из терминала.\n");
}

require_once __DIR__ . '/../config/database.php';

$login = $argv[1] ?? null;
$password = $argv[2] ?? null;

if (!$login || !$password) {
    exit("Использование: php tools/create_admin_user.php login password\n");
}

if (mb_strlen($password) < 8) {
    exit("Пароль должен быть не короче 8 символов.\n");
}

$pdo = dbOrFail();
$stmt = $pdo->prepare('INSERT INTO admin_users (login, password_hash) VALUES (?, ?) ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash)');
$stmt->execute([$login, password_hash($password, PASSWORD_DEFAULT)]);

echo "Администратор {$login} создан или обновлён.\n";