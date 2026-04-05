<?php
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Function to get Rank Name (matched with plugin logic)
function getRankName($xp) {
    if ($xp < 100) return "Silver I";
    if ($xp < 300) return "Silver Elite";
    if ($xp < 600) return "Gold Nova I";
    if ($xp < 1000) return "Gold Nova Master";
    if ($xp < 2000) return "Master Guardian Elite";
    if ($xp < 5000) return "Legendary Eagle";
    if ($xp < 10000) return "Supreme Master First Class";
    return "Global Elite";
}

// Get Top 50 Players
$sql = mysqli_query($conn, "SELECT *, (kills/IF(deaths=0,1,deaths)) as kdr FROM lr_users ORDER BY value DESC LIMIT 50");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skin Players | Ranking</title>
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
                <i class="fas fa-trophy fa-3x accent-cyan"></i>
                <div>
                    <h1 class="h4 mb-0 text-gradient fw-bold">GLOBAL LEADERBOARD</h1>
                    <p class="text-secondary small mb-0">Unified Server Ranking System (Levels Ranks)</p>
                </div>
            </div>
            <div class="text-end d-none d-md-block">
                <div class="text-secondary small">Total Players Ranked</div>
                <div class="h4 mb-0 fw-bold accent-indigo"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT steamid FROM lr_users")); ?></div>
            </div>
        </header>

        <section class="glass-panel p-0 overflow-hidden">
            <table class="modern-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Player</th>
                        <th>Rank / Title</th>
                        <th class="text-center">XP</th>
                        <th class="text-center d-none d-md-table-cell">Kills</th>
                        <th class="text-center d-none d-md-table-cell">KDR</th>
                        <th class="text-end px-4">Last Seen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($sql && mysqli_num_rows($sql) > 0): ?>
                        <?php $pos = 1; while($row = mysqli_fetch_array($sql)): ?>
                            <tr class="<?php echo ($pos <= 3) ? 'top-row' : ''; ?>">
                                <td class="text-center">
                                    <?php if ($pos == 1): ?><i class="fas fa-crown text-warning"></i><?php endif; ?>
                                    <?php if ($pos == 2): ?><i class="fas fa-medal text-silver"></i><?php endif; ?>
                                    <?php if ($pos == 3): ?><i class="fas fa-medal text-bronze"></i><?php endif; ?>
                                    <span class="fw-bold <?php echo ($pos <= 3) ? 'accent-indigo' : 'text-secondary'; ?>"><?php echo $pos; ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="https://steamcommunity.com/profiles/<?php echo $row['steamid']; ?>" target="_blank" class="text-decoration-none text-white fw-bold hover-cyan">
                                            <?php echo htmlspecialchars($row['name']); ?>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-opacity-10 border border-opacity-25 <?php echo ($pos <= 3) ? 'bg-cyan text-cyan border-cyan' : 'bg-secondary text-secondary border-secondary'; ?>">
                                        <?php echo getRankName($row['value']); ?>
                                    </span>
                                </td>
                                <td class="text-center fw-bold accent-indigo"><?php echo number_format($row['value']); ?></td>
                                <td class="text-center d-none d-md-table-cell small"><?php echo $row['kills']; ?></td>
                                <td class="text-center d-none d-md-table-cell small">
                                    <span class="<?php echo ($row['kdr'] >= 1.5) ? 'text-success' : 'text-secondary'; ?>">
                                        <?php echo number_format($row['kdr'], 2); ?>
                                    </span>
                                </td>
                                <td class="text-end px-4 small text-secondary"><?php echo date("d/m H:i", strtotime($row['last_connect'])); ?></td>
                            </tr>
                        <?php $pos++; endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-secondary py-5">No rankings found. Start playing to get ranked!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

        <footer class="mt-5 pt-4 border-top border-opacity-10 text-center">
            <span class="text-secondary small">© 2024 SKIN PLAYERS Web v2.0 | Ranking System Active</span>
        </footer>
    </div>

    <style>
        .top-row { background: rgba(99, 102, 241, 0.03); }
        .text-silver { color: #C0C0C0; }
        .text-bronze { color: #CD7F32; }
        .hover-cyan:hover { color: var(--accent-cyan) !important; }
    </style>
</body>
</html>
