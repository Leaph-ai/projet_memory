<?php


function getLeaderboard(PDO $pdo, int $currentPage = 1, int $usersPerPage = 10): array | string
{
    $offset = ($currentPage - 1) * $usersPerPage;

    $query = "SELECT 
                l.id,
                l.time_taken,
                l.date_played,
                l.difficulty_level,
                u.username
              FROM 
                scores l
              JOIN 
                users u ON l.user_id = u.id
              ORDER BY 
                l.time_taken ASC
              LIMIT 
                :limit OFFSET :offset";

    $prep = $pdo->prepare($query);
    $prep->bindValue(':limit', $usersPerPage, PDO::PARAM_INT);
    $prep->bindValue(':offset', $offset, PDO::PARAM_INT);

    try {
        $prep->execute();
        $res = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();
        return $res;
    } catch (PDOException $e) {
        return "Erreur SQL : " . $e->getMessage();
    }
}

function countLeaderboardEntries(PDO $pdo): int
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT COUNT(*) as total FROM users";
    $prep = $pdo->prepare($query);

    try {
        $prep->execute();
    } catch (PDOException $e) {
        return 0;
    }

    $result = $prep->fetch(PDO::FETCH_ASSOC);
    return (int)$result['total'];
}

