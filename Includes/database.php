<?php
try{
    $pdo = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER']);
} catch (Exception $e) {
    $errors[] = "Erreur de connexion à la bdd {$e->getMessage()}";
}