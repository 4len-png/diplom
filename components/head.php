<?php
$basePath = $basePath ?? '';
$assetVersion = $assetVersion ?? '20260519';
$pageTitle = $pageTitle ?? '&#1052;&#1077;&#1090;&#1086;&#1076;&#1080;&#1095;&#1077;&#1089;&#1082;&#1072;&#1103; &#1082;&#1086;&#1087;&#1080;&#1083;&#1082;&#1072;';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="<?= $basePath ?>style/normalize.css?v=<?= $assetVersion ?>">
    <link rel="stylesheet" href="<?= $basePath ?>style/style.css?v=<?= $assetVersion ?>">
    <link rel="stylesheet" href="<?= $basePath ?>style/header.css?v=20260617-header">
    <link rel="stylesheet" href="<?= $basePath ?>style/footer.css?v=20260617-footer">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $basePath ?>images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $basePath ?>images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $basePath ?>images/icon/favicon-16x16.png">
    <link rel="manifest" href="<?= $basePath ?>images/icon/site.webmanifest">
</head>