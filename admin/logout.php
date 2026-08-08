<?php
require_once __DIR__ . '/includes/bootstrap.php';

$_SESSION = [];
session_destroy();
redirectTo(adminUrl('login.php'));