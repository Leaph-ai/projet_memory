<li class="nav-item dropdown --bs-light">
    <a class="nav-link dropdown-toggle text-white d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-user me-2"></i><?php echo $_SESSION['user_username']; ?>
    </a>
    <ul class="dropdown-menu">
        <?php if ($_SESSION['user_username'] === 'admin'): ?>
            <li><a class="dropdown-item" href="index.php?component=users">Utilisateurs</a></li>
            <li><a class="dropdown-item" href="index.php?component=leaderboard">Leaderboard</a></li>
            <li><hr class="dropdown-divider"></li>
        <?php endif; ?>
        <li><a class="dropdown-item" href="index.php?disconnect=true">Se déconnecter</a></li>
    </ul>
</li>