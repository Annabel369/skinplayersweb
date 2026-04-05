<?php
include "config.php";

if (isset($_GET["id"], $_GET["rs"])) {
    $steamid = $_GET['id']; $rs = $_GET['rs'];
} else {
    $steamid = ''; $rs = '';
}

// Connect to 'skins' database as specified in the original logic
$conn = new mysqli($servername, $username, $password, "skins");
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Get registered users (distinct SteamIDs from wp_player_skins in mariusbd)
$sql_users = mysqli_query($conn, "SELECT DISTINCT steamid FROM wp_player_skins ORDER BY steamid DESC LIMIT 20");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skin Players | Custom ID64</title>
    <link rel="icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="modern.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include "home.php"; ?>

    <div class="container py-5 animate-fade-in">
        <header class="d-flex align-items-center justify-content-between mb-5 glass-panel p-4">
            <div class="d-flex align-items-center gap-3">
                <img src="OIG2.jpg" alt="Logo" class="rounded-circle" style="width: 60px; height: 60px; border: 2px solid var(--accent-indigo);">
                <div>
                    <h1 class="h4 mb-0 text-gradient fw-bold">CUSTOM ID64 MANAGEMENT</h1>
                    <p class="text-secondary small mb-0">Direct SteamID Registration & Admin Tools (Skins Database)</p>
                </div>
            </div>
        </header>

        <div class="row g-4">
            <div class="col-lg-5">
                <!-- Registration Card -->
                <div class="glass-panel p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <span class="accent-indigo h4 mb-0">■</span>
                        <h2 class="h5 mb-0 text-uppercase fw-bold">Manual Registration</h2>
                    </div>

                    <form action="insert.php" method="get">
                        <div class="mb-4">
                            <label for="steamid" class="form-label fw-bold small accent-indigo">STEAMID64</label>
                            <input type="number" name="steamid" id="steamid" class="form-control" placeholder="76561198XXXXXXXXX" required>
                            <div class="form-text text-secondary" style="font-size: 0.7rem;">Enter the full 17-digit SteamID64 for the user.</div>
                        </div>

                        <?php if ($rs): ?>
                            <div class="alert alert-info bg-opacity-10 border-info text-info small mb-4 py-2">
                                Status: <?php echo $rs; ?>
                            </div>
                        <?php endif; ?>

                        <div class="d-grid">
                            <button type="submit" class="btn-modern justify-content-center">
                                REGISTER STEAMID
                            </button>
                        </div>
                    </form>
                </div>

                <div class="glass-panel p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="accent-cyan h4 mb-0">i</span>
                        <h2 class="h6 mb-0 text-uppercase fw-bold">Useful Commands</h2>
                    </div>
                    <div class="bg-black bg-opacity-30 p-3 rounded" style="font-family: monospace; font-size: 0.8rem;">
                        <code class="d-block text-secondary mb-2">!rcon css_addadmin <span class="accent-indigo">ID64</span> <span class="accent-purple">Name</span> #group 99 99999</code>
                        <code class="d-block text-secondary">!lr_giveexp <span class="accent-purple">Name</span> 58000</code>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <!-- Registered List -->
                <div class="glass-panel p-4 h-100">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <span class="accent-purple h4 mb-0">■</span>
                        <h2 class="h5 mb-0 text-uppercase fw-bold">Registered Custom IDs</h2>
                    </div>

                    <div class="overflow-auto" style="max-height: 500px;">
                        <table class="modern-table mt-0">
                            <thead>
                                <tr>
                                    <th>Registered SteamID</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($sql_users && mysqli_num_rows($sql_users) > 0): ?>
                                    <?php while($user = mysqli_fetch_array($sql_users)): ?>
                                        <tr>
                                            <td>
                                                <a href="https://steamcommunity.com/profiles/<?php echo $user['steamid']; ?>" target="_blank" class="text-decoration-none accent-indigo fw-bold">
                                                    <?php echo $user['steamid']; ?>
                                                </a>
                                            </td>
                                            <td class="text-end">
                                                <a href="index.php?id=<?php echo $user['steamid']; ?>" class="btn-modern py-1 px-3" style="font-size: 0.75rem;">
                                                    USE AS ADMIN
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-center text-secondary py-5">No SteamIDs registered yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <footer class="mt-5 pt-4 border-top border-opacity-10 text-center">
            <span class="text-secondary small">© 2024 SKIN PLAYERS Web v2.0 | Skins Database Logic System</span>
        </footer>
    </div>
</body>
</html>