<?php
session_start();
//require __DIR__ . '/vendor/autoload.php';
?>
<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link href="Includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link  href="Includes/fontawesome/css/all.min.css" rel="stylesheet"/>
        <title>Memory Game</title>
        <link rel="stylesheet" href="Includes/style.css">
    </head>
    <body>
        <div class="container">
            <?php
                require "View/cards.php";
            ?>
        </div>
        <script src="Includes/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="Includes/fontawesome/js/all.min.js"></script>
        <script src="Includes/cards.js"></script>
    </body>

