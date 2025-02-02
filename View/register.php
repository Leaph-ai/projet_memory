<?php
/**
 * @var string $action
 */
require("_partials/errors.php")
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Créer votre Compte</div>
        <a href="index.php?" type="button" class="btn btn-secondary"><i class="fa fa-arrow-left me-2"></i>Retour</a>
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
            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" name="<?php echo $action; ?>_button">Créer votre compte</button>
            </div>
        </form>
    </div>
</div>