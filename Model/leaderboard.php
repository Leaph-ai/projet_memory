<?php
function getUsersScore(PDO $pdo): array | string
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT 
                  u.username,
                  s.date_played,
                  s.time_taken,
                  s.difficulty_level
              FROM 
                  scores s
              JOIN 
                  users u ON s.user_id = u.id
              WHERE 
                  (s.difficulty_level, s.time_taken) IN (
                      SELECT 
                          difficulty_level, 
                          MIN(time_taken)
                      FROM 
                          scores
                      GROUP BY 
                          difficulty_level
                  )
              ORDER BY 
                  s.difficulty_level, s.time_taken
              LIMIT 9";
    $prep = $pdo->prepare($query);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return "erreur : ".$e->getCode() .' : '. $e->getMessage();
    }

    $res = $prep->fetchAll();
    $prep->closeCursor();

    return $res;
}