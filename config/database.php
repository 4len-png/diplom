<?php
const DB_HOST = '127.0.0.1';
const DB_NAME = 'diplom_copy';
const DB_USER = 'szipsc';
const DB_PASS = '';
const DB_CHARSET = 'utf8mb4';

function db(): ?PDO
{
    static $pdo = null;
    static $checked = false;

    if ($checked) {
        return $pdo;
    }

    $checked = true;
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (PDOException $error) {
        $pdo = null;
    }

    return $pdo;
}

function dbOrFail(): PDO
{
    $pdo = db();

    if (!$pdo) {
        throw new RuntimeException('База данных не подключена. Откройте /admin/install.php и выполните установку.');
    }

    return $pdo;
}