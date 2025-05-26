<?php
require_once __DIR__ . '/vendor/autoload.php';

use Hybridauth\Hybridauth;

session_start();

$config = require 'hybridauth.php';

try {
    $providerName = $_GET['provider'];

    $hybridauth = new Hybridauth($config);
    $adapter = $hybridauth->authenticate($providerName);
    $profile = $adapter->getUserProfile();

    $_SESSION['user'] = [
        'name'     => $profile->displayName,
        'email'    => $profile->email,
        'avatar'   => $profile->photoURL,
        'provider' => $providerName
    ];

    header("Location: profile.php");
} catch (\Throwable $e) {
    echo "Ошибка авторизации: " . $e->getMessage();
}
