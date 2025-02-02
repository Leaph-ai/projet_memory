<div class="col-12 mt-3">
    <div class="d-flex justify-content-start">
        <button id="button_level1" class="btn btn-secondary btn-sm me-2">Niveau 1</button>
        <button id="button_level2" class="btn btn-primary btn-sm me-2">Niveau 2</button>
        <button id="button_level3" class="btn btn-primary btn-sm">Niveau 3</button>
    </div>
</div>
<div class="d-flex">
    <div class="parent"></div>
    <div class="leaderboard ms-auto">
        <?php require 'Controller/leaderboard_game.php'; ?>
    </div>
</div>
<div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
</div>
<p class="countdown">5:00</p>
<div class="col-12 text-center mb-3">
    <button id="start_button" class="btn btn-primary">Commencer</button>
    <button id="reset_button" class="btn btn-danger">Recommencer</button>
</div>
