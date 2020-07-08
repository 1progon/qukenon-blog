<?php

require_once __DIR__ . '/vendor/autoload.php';
$time = time();

defined('ABS_PATH') or die('У Вас нет доступа');
//content_access from wp template single file
defined('CONTENT_ACCESS') or die('У Вас нет доступа');

if (isset($_SESSION['yandexPayment'])) {
    echo '<div class="flash-message">' . $_SESSION['yandexPayment'] . '</div>';

    unset($_SESSION['yandexPayment']);
}

require_once ABS_PATH . '/views/skins-block.php';

?>

<link rel="stylesheet" href="/old-blog/skins-market/skins-style.css">
<script type="module" src="/old-blog/skins-market/assets/js/skins-group.js"></script>
