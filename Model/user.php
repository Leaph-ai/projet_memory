<?php
function getUser(PDO $pdo, int $id): array | string
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT *  FROM users WHERE id = :id";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $res = $prep->fetch();
    $prep->closeCursor();

    return $res;
}

function insertUser(
    PDO $pdo,
    string $username,
    string $pass,
    int $group,
    bool $enabled
): bool | string
{

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="INSERT INTO `users` (username, password, group_id, enabled) VALUES (:username, :password, :group_id, :enabled)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':password', $pass);
    $prep->bindValue(':username', $username);
    $prep->bindValue(':group_id', $group);
    $prep->bindValue(':enabled', $enabled, PDO::PARAM_BOOL);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }
    $prep->closeCursor();

    return true;
}

function updateUser(
    PDO $pdo,
    int $id,
    string $username,
    int $group,
    bool $enabled,
    string $pass = null,
): bool | string
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="UPDATE `users` SET username = :username, `group_id` = :group_id, enabled = :enabled WHERE id = :id";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    $prep->bindValue(':username', $username);
    $prep->bindValue(':group_id', $group);
    $prep->bindValue(':enabled', $enabled, PDO::PARAM_BOOL);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }
    $prep->closeCursor();

    if (null !== $pass) {
        $query="UPDATE `users` SET password = :password WHERE id = :id";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':id', $id, PDO::PARAM_INT);
        $prep->bindValue(':password', $pass);
        try
        {
            $prep->execute();
        }
        catch (PDOException $e)
        {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $prep->closeCursor();
    }

    return true;
}
