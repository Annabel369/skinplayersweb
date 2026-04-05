<nav class="modern-navbar">
    <a href="index.php" class="nav-logo">
        <img src="OIG2.jpg" alt="Logo" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;">
        <span>SKIN PLAYERS</span>
    </a>
    
    <div class="nav-links">
        <a href="index.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">HOME</a>
        <a href="ban.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'ban.php') ? 'active' : ''; ?>">BANS</a>
        <a href="mute.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'mute.php') ? 'active' : ''; ?>">MUTES</a>
        <a href="ranking.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'ranking.php') ? 'active' : ''; ?>">RANKING</a>
        <a href="skins.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'skins.php') ? 'active' : ''; ?>">CUSTOM ID64</a>
    </div>

    <div class="nav-actions">
        <!-- Optional: Add user profile or server status indicator here -->
        <div class="glass-panel" style="padding: 0.5rem 1rem; font-size: 0.8rem; border-radius: 30px;">
            <span class="accent-cyan">●</span> SERVER ONLINE
        </div>
    </div>
</nav>