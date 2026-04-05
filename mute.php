<?php
include "config.php";

if (isset($_GET["id"], $_GET["rs"])) {
    $steamid = $_GET['id']; $rs = $_GET['rs'];
} else {
    $steamid = ''; $rs = '';
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Logic synchronized with AdminControl: Using 'mutes' table
$sql = mysqli_query($conn, "SELECT CAST(steamid AS CHAR) AS steamid, reason, unmuted, timestamp FROM mutes ORDER BY timestamp DESC LIMIT 50");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skin Players | Mute List</title>
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
                    <h1 class="h4 mb-0 text-gradient fw-bold">MUTE LIST</h1>
                    <p class="text-secondary small mb-0">Unified Server Punishment Records (AdminControl Sync)</p>
                </div>
            </div>
        </header>

        <section class="glass-panel p-4 overflow-auto">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="accent-indigo h4 mb-0">■</span>
                    <h2 class="h5 mb-0 text-uppercase fw-bold">Recent Mutes</h2>
                </div>
            </div>

            <table class="modern-table">
                <thead>
                    <tr>
                        <th>SteamID</th>
                        <th>Reason</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($sql && mysqli_num_rows($sql) > 0): ?>
                        <?php while($resultado = mysqli_fetch_array($sql)): ?>
                            <tr>
                                <td>
                                    <a href="https://steamcommunity.com/profiles/<?php echo $resultado['steamid']; ?>" target="_blank" class="fw-bold text-decoration-none accent-indigo">
                                        <?php echo $resultado['steamid']; ?>
                                    </a>
                                </td>
                                <td><span class="small"><?php echo $resultado['reason'] ?: 'No reason provided'; ?></span></td>
                                <td><span class="small text-secondary"><?php echo $resultado['timestamp']; ?></span></td>
                                <td>
                                    <?php if ($resultado['unmuted'] == 0): ?>
                                        <span class="badge bg-danger bg-opacity-25 text-danger border border-danger border-opacity-25">ACTIVE</span>
                                    <?php else: ?>
                                        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25">UNMUTED</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-secondary py-5">No records found in 'mutes' table.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

        <footer class="mt-5 pt-4 border-top border-opacity-10 text-center">
            <span class="text-secondary small">© 2024 SKIN PLAYERS Web v2.0 | AdminControl Logic System</span>
        </footer>
    </div>
</body>
</html>