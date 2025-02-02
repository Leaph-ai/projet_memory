<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
require 'Includes/database.php';
require 'Includes/functions.php';

$errors = [];
if (isset($_GET['disconnect'])) {
    session_destroy();
    header('Location: index.php');
}
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && (($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') || str_starts_with($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded'))) {
    if (isset($_SESSION['auth'])) {
        $actionName = !empty($_GET['action'])
            ? htmlspecialchars($_GET['action'])
            : null;

        if (isset($_GET['component'])) {
            $componentName = cleanString($_GET['component']);
            if (file_exists("Controller/$componentName.php")) {
                require "Controller/$componentName.php";
            }
        }
    } else {
        require "Controller/login.php";
    }
    require "_partials/errors.php";
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="Includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Includes/fontawesome/css/all.min.css" rel="stylesheet" />
    <title>Memory Game</title>
    <link rel="stylesheet" href="Assets/CSS/style.css">
</head>
<body>
<div class="container">
    <div>
        <?php if (isset($_SESSION['auth'])): ?>
            <?php require "_partials/dropdown.php"; ?>
        <?php else: ?>
            <?php
            if (!isset($_GET['component']) || $_GET['component'] !== 'register') {
                require 'Controller/login.php';
                require "Controller/unloggedleaderboard.php";
            }
            ?>
        <?php endif; ?>
    </div>
    <?php
    if (isset($_GET['component'])) {
        $componentName = cleanString($_GET['component']);
        if (($componentName === 'users' || $componentName === 'leaderboard') && $_SESSION['user_username'] !== 'admin') {
            header("Location: index.php");
            exit();
        }

        if (file_exists("Controller/$componentName.php")) {
            require "Controller/$componentName.php";
        }
    } else {
        if (isset($_SESSION['auth'])){
            require "View/cards.php";
        }
    }
    require "_partials/errors.php";
    ?>
</div>
<script src="Includes/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Includes/fontawesome/js/all.min.js"></script>
<script src="Assets/JS/cards.js"></script>
</body>
</html>