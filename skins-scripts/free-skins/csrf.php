<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("У Вас нет доступа");
}

if (isset($_POST["get"]) && $_POST["get"] == true) {
    $token = '';

    if (isset($_SESSION["skinsTokenCsrf"])) {
        $token = $_SESSION["skinsTokenCsrf"];
    } else {
        $token = bin2hex(random_bytes(32));
        $_SESSION["skinsTokenCsrf"] = $token;
    }

    echo json_encode(["tokenCsrf" => $token]);
    exit;
}

exit;
