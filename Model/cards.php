<?php

function insertScore($pdo, $user_id, $time_taken, $date, $level)
{
    $query = "INSERT INTO scores (user_id, time_taken, date_played, difficulty_level) VALUES (:user_id, :time_taken, :date_played, :difficulty_level)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':time_taken', $time_taken, PDO::PARAM_INT);
    $stmt->bindParam(':date_played', $date);
    $stmt->bindParam(':difficulty_level', $level, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount();
}


