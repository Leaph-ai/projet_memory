<?php
/**
 * @var PDO $pdo
 */
require "Model/login.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && (($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') || str_starts_with($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded'))) {
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $pass = !empty($_POST['pass']) ? $_POST['pass'] : null;
    if(
        !empty($username) &&
        !empty($pass)
    ) {
        $username = cleanString($username);
        $pass = cleanString($pass);

        $user = getUser($pdo, $username);

        if (empty($user)) {
            $errors = ["L'utilisateur n'existe pas"];
            header("Content-Type: application/json");
            echo json_encode(['errors' => $errors]);
            exit();
        }
        /*if (is_array($user)){
               $isMatchPassword = password_verify($pass, $user['password']);
        }*/

        $isMatchPassword = is_array($user) && password_verify($pass, $user['password']);
        if($isMatchPassword && $user['enabled']) {
            $_SESSION['auth'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_username'] = $user['username'];
            $_SESSION[$user['group_id'] === 1 ? 'user' : ($user['group_id'] === 2 ? 'admin' : '')] = $user['group_id'];
            header("Content-Type: application/json");
            echo json_encode(['authentication' => true]);
            exit();
        } elseif (!$user['enabled'] && $isMatchPassword) {
            $errors[] = 'Votre compte est désactivé';
        }
        else {
            $errors[] = 'L\'identification a echoue';
        }
    }
    if (!empty($errors)) {
        header("Content-Type: application/json");
        echo json_encode(['errors' => $errors]);
        exit();
    }
}


require "View/login.php";
