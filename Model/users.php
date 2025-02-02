<?php
function getUsers(PDO $pdo, int $currentPage = 1, int $usersPerPage = 10): array | string
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Calculer les offsets pour la limitation des résultats
    $offset = ($currentPage - 1) * $usersPerPage;

    $query = "SELECT * FROM users ORDER BY username LIMIT :limit OFFSET :offset";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':limit', $usersPerPage, PDO::PARAM_INT);
    $prep->bindValue(':offset', $offset, PDO::PARAM_INT);

    try {
        $prep->execute();
    } catch (PDOException $e) {
        return "Erreur : " . $e->getCode() . " : " . $e->getMessage();
    }

    $res = $prep->fetchAll();
    $prep->closeCursor();

    return $res;
}

function countUsers(PDO $pdo): int
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT COUNT(*) as total FROM users";
    $prep = $pdo->prepare($query);

    try {
        $prep->execute();
    } catch (PDOException $e) {
        return 0; // Par défaut, renvoyer 0 en cas d'erreur
    }

    $result = $prep->fetch(PDO::FETCH_ASSOC);
    return (int)$result['total'];
}

function toggleEnabled(PDO $pdo, int $id): bool|string
{
    try {
        $query = 'UPDATE `users` SET enabled = NOT enabled WHERE id = :id';
        $prep = $pdo->prepare($query);
        $prep->bindParam(':id', $id, PDO::PARAM_INT);
        $prep->execute();
        return true;
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}

function _delete($pdo, int $id): bool|string
{
    try {
        $query = 'DELETE FROM `users` WHERE id = :id';
        $res = $pdo->prepare($query);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->execute();
        return true; // Succès
    } catch (PDOException $e) {
        if ($e->getCode() == 1451) {
            return "Impossible de supprimer cet utilisateur car des scores lui sont associés.";
        }
        return "Erreur : " . $e->getMessage();
    }
}
