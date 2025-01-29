<?php
function getUsersScoreForCards(PDO $pdo): array | string
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT 
    u.username,
    s.time_taken
FROM 
    scores s
JOIN 
    users u ON s.user_id = u.id
WHERE 
    s.difficulty_level = 1
ORDER BY 
    s.time_taken
limit 10
";

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