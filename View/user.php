<?php
/**
 * @var string $action
 */
require("_partials/errors.php")
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Créer / Modifier un utilisateur</div>
        <a href="index.php?component=users" type="button" class="btn btn-secondary"><i class="fa fa-arrow-left me-2"></i>Retour</a>
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Identifiant</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="pass" name="pass" <?php echo ('create' === $action) ? 'required' : ''; ?>>
            </div>
            <div class="mb-3">
                <label for="confirmation" class="form-label">Confirmation</label>
                <input type="password" class="form-control" id="confirmation" name="confirmation" <?php echo ('create' === $action) ? 'required' : ''; ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Admin/user</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="group" id="user" value="1" <?php echo (isset($user['group_id']) && $user['group_id'] == 1) ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="user">User</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="group" id="admin" value="2" <?php echo (isset($user['group_id']) && $user['group_id'] == 2) ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="admin">Admin</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="enabled" name="enabled" <?php echo (!empty($user['enabled'])) ? 'checked' : null; ?>>
                    <label class="form-check-label" for="enabled">Compte actif</label>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" name="<?php echo $action; ?>_button">Enregistrer</button>
            </div>
        </form>
    </div>
</div>