<?php
/**
 * @var PDO $pdo
 */
require "Model/register.php";
$action = 'create';
$errors = [];
if (!empty($_GET['id'])) {
    $action = 'edit';
    $user = getUserRegister($pdo, $_GET['id']);
    if(!is_array($user)) {
        $errors = $user;
    }
}

if (isset($_POST['create_button'])) {
    $username = !empty($_POST['username']) ? cleanString($_POST['username']) : null;
    $password = !empty($_POST['pass']) ? cleanString($_POST['pass']) : null;
    $confirmation = !empty($_POST['confirmation']) ? cleanString($_POST['confirmation']) : null;
    $group = !empty($_POST['group']) ? cleanString($_POST['group']) : 1; // Default to 1
    $enabled = !empty($_POST['enabled']) ? cleanString($_POST['enabled']) : true; // Default to true
    if ($password !== $confirmation) {
        $errors[] = "Le mot de passe et sa confirmation sont différents";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $newUser = insertUserRegister($pdo, $username, $password, $group, $enabled);
        if (is_bool($newUser) && $newUser) {
            header('Location: index.php');
            exit();
        } else {
            $errors[] = $newUser;
        }
    }
}

require "View/register.php";
?>
