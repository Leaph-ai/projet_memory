<?php
require "Model/cards.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    if (isset($_GET['action']) && $_GET['action'] === 'export') {
        $user_id = (int)$_SESSION['user_id'];
        $time_taken = isset($_GET['score']) ? cleanString($_GET['score']) : null;
        $date = isset($_GET['date']) ? cleanString($_GET['date']) : null;
        $level = isset($_GET['difficulty_level']) ? cleanString($_GET['difficulty_level']) : null;

        $res = insertScore($pdo, $user_id, $time_taken, $date, $level);

        if ($res > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Score ajouté avec succès']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Échec de l\'insertion du score']);
        }
    }

}

