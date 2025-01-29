<?php
/**
 * @var PDO $pdo
 */
require './index.php';
require './includes/database.php';
require  './vendor/autoload.php';


$faker = Faker\Factory::create('fr_FR');

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');

$pdo->exec('TRUNCATE TABLE users');
$pdo->exec('TRUNCATE TABLE `groups`');
$pdo->exec('TRUNCATE TABLE score');

$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

echo "suppression des tables users, groups et score\n";


for ($i = 1; $i <= 2; $i++) {
    if ($i == 2) {$group = "admin";} else {$group = "user";}
    $query = "INSERT INTO `groups` (`group`) VALUES (:group)";

    $prep = $pdo->prepare($query);
    $prep->bindValue(':group', $group);

    try
    {
        $prep->execute();
    } catch (PDOException $e) {
        echo "erreur : " . $e->getCode() . ' :</b> ' . $e->getMessage();
    }
}

echo "remplissage de user 1 et admin\n";

for ($i = 1; $i <= 2; $i++){
    if ($i == 1) {
        $user = "admin";
        $password = "1234";
        $group = "2";
    } else {
        $user = "user1";
        $password = "1234";
        $group = "1";
    }
    $query="INSERT INTO users (username, password, group_id, enabled) VALUES 
            (:username, :password, :group_id, :enabled)";
    $prep = $pdo->prepare($query);

    $enabled = "1";
    $password = password_hash($password, PASSWORD_DEFAULT);

    $prep->bindValue(':username', $user);
    $prep->bindValue(':password', $password);
    $prep->bindValue(':group_id', $group);
    $prep->bindValue(':enabled', $enabled);


    try
    {
        $prep->execute();
    } catch (PDOException $e) {
        echo "erreur : " . $e->getCode() . ' :</b> ' . $e->getMessage();
    }

}

echo "table Groupes remplie\n";

$query_user = "INSERT INTO `users` (`username`, `password`, `group_id`, `enabled`) 
               VALUES (:username, :password, :group_id, :enabled)";

$prep_user = $pdo->prepare($query_user);

for ($i = 0; $i < 40; $i++) {
    $username = $faker->firstName() . rand(1, 1000);
    $password = $faker->word();
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $group_id = 1;
    $enabled = $faker->boolean();

    $prep_user->bindValue(':username', $username);
    $prep_user->bindValue(':password', $password_hash);
    $prep_user->bindValue(':group_id', $group_id, PDO::PARAM_INT);
    $prep_user->bindValue(':enabled', $enabled, PDO::PARAM_INT);

    try
    {
        $prep_user->execute();
    } catch (PDOException $e) {
        echo "erreur : " . $e->getCode() . ' :</b> ' . $e->getMessage();
    }

    $time_taken = $faker->numberBetween( 30, 300);
    $date_played = $faker->dateTimeBetween('-1 week', 'now')->format('Y-m-d');
    $difficulty_level = $faker->numberBetween(1, 3);

    $query_score = "INSERT INTO `score` (`user_id`, `time_taken`, `date_played`, `difficulty_level`) 
                    VALUES (:user_id, :time_taken, :date_played, :difficulty_level)";
    $prep_score = $pdo->prepare($query_score);

    $prep_score->bindValue(':user_id', $i + 1, PDO::PARAM_INT);  // Utilise l'id de l'utilisateur inséré (de 1 à 10)
    $prep_score->bindValue(':time_taken', $time_taken);
    $prep_score->bindValue(':date_played', $date_played);
    $prep_score->bindValue(':difficulty_level', $difficulty_level, PDO::PARAM_INT);

    try
    {
        $prep_score->execute();
    } catch (PDOException $e) {
        echo "erreur : " . $e->getCode() . ' :</b> ' . $e->getMessage();
    }

    $prep->closeCursor();

}
echo "10 utilisateurs et leurs scores ont été insérés\n";


?>