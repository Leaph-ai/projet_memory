<?php
/**
 * @var array|string $scores
 */
require("_partials/errors.php")
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center text-white">Leaderboard</div>
        <div class="row">
            <?php if (is_array($scores)): ?>
                <table class="table">
                    <tbody>
                    <?php foreach ($scores as $score): ?>
                        <tr>
                            <td><?php echo $score['username']; ?></td>
                            <td><?php echo $score['date_played']; ?></td>
                            <td><?php echo $score['time_taken']; ?> secondes</td>
                            <td>Niveau <?php echo $score['difficulty_level']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-danger">
                    <?php echo $scores; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>