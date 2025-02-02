<?php
function insertUserRegister(
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
