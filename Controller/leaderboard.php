<?php
/**
 * @var PDO $pdo
 * @var string $actionName
 */
require "Model/leaderboard.php";

$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$usersPerPage = 10;

$totalEntries = countLeaderboardEntries($pdo);
$totalPages = ceil($totalEntries / $usersPerPage);

$leaderboard = getLeaderboard($pdo, $currentPage, $usersPerPage);

if (!is_array($leaderboard)) {
    $errors[] = $leaderboard;
    $leaderboard = [];
}


if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = cleanString($_GET['id']);

    $query = "DELETE FROM scores WHERE id = :id";
    $prep = $pdo->prepare($query);

    try {
        $prep->bindParam(':id', $id, PDO::PARAM_INT);
        $prep->execute();
    } catch (PDOException $e) {
        $errors[] = "Erreur lors de la suppression : " . $e->getMessage();
    }

    header("Location: index.php?component=leaderboard");
    exit();
}



require "View/leaderboard.php";