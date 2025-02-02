<?php
/**
 * @var array $users
 * @var int $currentPage
 * @var int $totalPages
 */
require("_partials/errors.php")
?>
<?php if (isset($_GET['success']) && $_GET['success'] === 'toggle'): ?>
    <div class="alert alert-success">L'état du compte a été modifié avec succès.</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">Erreur : <?php echo htmlspecialchars($_GET['error']); ?></div>
<?php endif; ?>

<?php if (isset($_GET['success']) && $_GET['success'] === 'delete'): ?>
    <div class="alert alert-success">L'utilisateur a été supprimé avec succès.</div>
<?php endif; ?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center text-white">Liste des utilisateurs</div>
        <div class="row">

            <div class="mb-3 d-flex justify-content-between">
                <a href="index.php" type="button" class="btn btn-secondary"><i class="fa fa-arrow-left me-2"></i>Retour</a>
                <a href="index.php?component=user" type="button" class="btn btn-primary"><i class="fa fa-plus me-2"></i>Ajouter</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Identifiant</th>
                    <th scope="col">Actif</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"><?php echo $user['id']; ?></th>
                        <td><?php echo $user['username']; ?></td>
                        <td>
                            <a href="index.php?component=users&action=toggle_enabled&id=<?php echo $user['id']; ?>"
                               onclick="return confirm('Êtes-vous sûr de vouloir modifier l\'état de ce compte ?');">
                                <?php if ($user['enabled']): ?>
                                    <i class="fa-solid fa-check text-success"></i>
                                <?php else: ?>
                                    <i class="fa-solid fa-xmark text-danger"></i>
                                <?php endif; ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?component=user&id=<?php echo $user['id']; ?>">
                                <i class="fa fa-edit text-success"></i>
                            </a>
                            <?php if ($user['id'] !== $_SESSION['user_id']) : ?>
                                <a href="index.php?component=users&action=delete&id=<?php echo $user['id']; ?>"
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?');">
                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <nav aria-label="Pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?component=users&page=<?php echo $currentPage - 1; ?>" aria-label="Précédent">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                            <a class="page-link" href="?component=users&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $currentPage == $totalPages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?component=users&page=<?php echo $currentPage + 1; ?>" aria-label="Suivant">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="./assets/js/components/user.js" type="module"></script>
    <script type="module">
        import {handleEnabledClick} from "./assets/js/components/user.js";

        document.addEventListener('DOMContentLoaded', () => {
            handleEnabledClick()
        })
    </script>