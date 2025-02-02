<?php
/**
 * @var PDO $pdo
 * @var string $actionName
 */
require "model/users.php";

// Valeur de page actuelle
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$usersPerPage = 10;

// Récupérer le nombre total d'utilisateurs
$totalUsers = countUsers($pdo);
$totalPages = ceil($totalUsers / $usersPerPage);

// Récupération des utilisateurs pour la page actuelle
$users = getUsers($pdo, $currentPage, $usersPerPage);

if (!is_array($users)) {
    $errors[] = $users;
}


if (
    isset($_GET['action']) &&
    $_GET['action'] === 'toggle_enabled' &&
    isset($_GET['id']) &&
    is_numeric($_GET['id'])
) {
    $id = cleanString($_GET['id']);

    // Modifier l'état actif/inactif
    $res = toggleEnabled($pdo, (int)$id);

    if ($res === true) {
        // Si la modification a réussi, rediriger avec un paramètre de succès
        header("Location: index.php?component=users&success=toggle");
    } else {
        // Sinon, ajouter une erreur
        header("Location: index.php?component=users&error=" . urlencode($res));
    }
    exit();
}

if(
    isset($_GET['action']) &&
    $_GET['action'] === 'toggle_enabled' &&
    isset($_GET['id']) &&
    is_numeric($_GET['id'])
) {
    $id = cleanString($_GET['id']);
    toggleEnabled($pdo, $id);
    header("Location: index.php?component=users");
}

if (
    isset($_GET['action']) &&
    $_GET['action'] === 'delete' &&
    isset($_GET['id']) &&
    is_numeric($_GET['id'])
) {
    $id = (int) cleanString($_GET['id']);

    $res = _delete($pdo, $id);

    if ($res === true) {
        header("Location: index.php?component=users&success=delete");
    } else {
        // Ajout d'un message d'erreur en cas d'échec
        header("Location: index.php?component=users&error=" . urlencode($res));
    }
    exit();
}

require "view/users.php";
