<?php
/**
 * @var array $leaderboard
 * @var int $currentPage
 * @var int $totalPages
 */
require("_partials/errors.php")
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Leaderboard</div>
        <div class="row">

            <div class="mb-3 d-flex justify-content-between">
                <a href="index.php" type="button" class="btn btn-secondary">
                    <i class="fa fa-arrow-left me-2"></i>Retour
                </a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Position</th>
                    <th scope="col">Nom d'utilisateur</th>
                    <th scope="col">Temps</th>
                    <th scope="col">Date Jouée</th>
                    <th scope="col">Niveau de Difficulté</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($leaderboard as $index => $entry): ?>
                    <tr>
                        <th scope="row"><?php echo $index + 1 + ($currentPage - 1) * $usersPerPage; ?></th>
                        <td><?php echo htmlspecialchars($entry['username']); ?></td>
                        <td><?php echo htmlspecialchars($entry['time_taken']); ?> secondes</td>
                        <td><?php echo htmlspecialchars($entry['date_played']); ?></td>
                        <td><?php echo htmlspecialchars($entry['difficulty_level']); ?></td>
                        <td>
                            <a href="index.php?component=leaderboard&action=delete&id=<?php echo $entry['id']; ?>"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entrée ?');">
                                <i class="fa-solid fa-trash-can text-danger"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <nav aria-label="Pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?component=leaderboard&page=<?php echo $currentPage - 1; ?>" aria-label="Précédent">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                            <a class="page-link" href="?component=leaderboard&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $currentPage == $totalPages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?component=leaderboard&page=<?php echo $currentPage + 1; ?>" aria-label="Suivant">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
