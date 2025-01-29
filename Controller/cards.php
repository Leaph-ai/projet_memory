<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    if (isset($_GET['action']) && $_GET['action'] === 'export') {
        $user_id = $_SESSION['user_id'];
        $score =  isset($_GET['score']) ? cleanString(['score']) : null;
        $date =  isset($_GET['date']) ? cleanString(['date']) : null;
        $level = isset($_GET['difficulty_level']) ? cleanString(['difficulty_level']) : null;
        $res = insertScore($pdo, $user_id, $score, $date, $level);
    }
}