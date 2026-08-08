<?php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../classes/ContentRepository.php';

function h(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function adminUrl(string $path = ''): string
{
    return '/diplom.COPY/admin/' . ltrim($path, '/');
}

function redirectTo(string $url): never
{
    header('Location: ' . $url);
    exit;
}

function requireAdmin(): void
{
    if (empty($_SESSION['admin_id'])) {
        redirectTo(adminUrl('login.php'));
    }
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verifyCsrf(): void
{
    $token = $_POST['csrf_token'] ?? '';

    if (!$token || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        throw new RuntimeException('Не удалось проверить форму. Обновите страницу и попробуйте ещё раз.');
    }
}

function saveUploadedFile(string $field, string $targetDir, array $allowedExtensions): ?string
{
    if (empty($_FILES[$field]['name']) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Файл не загрузился. Проверьте размер и попробуйте ещё раз.');
    }

    $extension = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowedExtensions, true)) {
        throw new RuntimeException('Недопустимый тип файла: .' . $extension);
    }

    $projectRoot = dirname(__DIR__, 2);
    $absoluteDir = $projectRoot . DIRECTORY_SEPARATOR . trim($targetDir, '/');

    if (!is_dir($absoluteDir)) {
        mkdir($absoluteDir, 0775, true);
    }

    $originalName = pathinfo($_FILES[$field]['name'], PATHINFO_FILENAME);
    $safeName = preg_replace('/[^\pL\pN\-_ ]/u', '', $originalName) ?: 'file';
    $fileName = date('Ymd_His') . '_' . $safeName . '.' . $extension;
    $absolutePath = $absoluteDir . DIRECTORY_SEPARATOR . $fileName;

    if (!move_uploaded_file($_FILES[$field]['tmp_name'], $absolutePath)) {
        throw new RuntimeException('Не получилось сохранить файл.');
    }

    return trim($targetDir, '/') . '/' . $fileName;
}