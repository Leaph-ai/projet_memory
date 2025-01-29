<?php

function insertScore($pdo, $user_id, $score, $date, $level)
{
    $query = "INSERT INTO scores (user_id, score, date_played, difficulty_level) VALUES (:user_id, :score, :date_played, :difficulty_level)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':score', $score, PDO::PARAM_INT);
    $stmt->bindParam(':date_played', $date, PDO::PARAM_STR);
    $stmt->bindParam(':difficulty_level', $level, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount();
}