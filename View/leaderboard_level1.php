<?php
/**
 * @var array|string $scoresForCards
 */
require("_partials/errors.php")
?>
<div class="row ms-1 mt-4">
    <div class="col">
        <div class="card">
            <div class="card-header text-center text-white bg-success">
                <h1 class="pt-2 pb-2">Leaderboard</h1>
            </div>

            <div class="card-body" style="max-height: 374px; overflow-y: auto;">
                <div class="row">
                    <?php if (is_array($scoresForCards)): ?>
                        <?php foreach ($scoresForCards as $scoreForCard): ?>
                            <div class="col-12 mb-3">
                                <div class="card ms-3 same-size-card">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <h5 class="card-title"><?php echo $scoreForCard['username']; ?></h5>
                                        <p class="card-text">Temps de résolution : <?php echo $scoreForCard['time_taken']; ?> secondes</p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            <?php echo $scoresForCards; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
