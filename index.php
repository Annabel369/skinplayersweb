<?php
include "config.php";

if (isset($_GET["id"], $_GET["rs"], $_GET["t_model"], $_GET["ct_model"], $_GET["img"], $_GET["img2"])) {
    $steamid = $_GET['id']; $rs = $_GET['rs']; $t_model =  $_GET['t_model']; $ct_model =  $_GET['ct_model']; $img =  $_GET['img']; $img2 =  $_GET['img2'];
} else {
    $steamid = ''; $rs = ''; $t_model =  ''; $ct_model =  ''; $img =  ''; $img2 =  '';
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
$sql  = mysqli_query($conn, "SELECT * FROM playermodelchanger");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skin Players | Dashboard</title>
    <link rel="icon" href="favicon.ico">
    
    <!-- Modern Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="modern.css">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include "home.php"; ?>

    <div class="container py-5 animate-fade-in">
        <!-- Header Section -->
        <header class="d-flex align-items-center justify-content-between mb-5 glass-panel p-4">
            <div class="d-flex align-items-center gap-3">
                <img src="OIG2.jpg" alt="Logo" class="rounded-circle" style="width: 80px; height: 80px; border: 2px solid var(--accent-indigo);">
                <div>
                    <h1 class="h3 mb-1 text-gradient fw-bold">Skin Players Dashboard</h1>
                    <p class="text-secondary small mb-0">Custom Admin & VIP Management Web v2.0</p>
                </div>
            </div>
            <?php if ($steamid): ?>
            <div class="text-end">
                <span class="d-block text-secondary small">LOGGED IN AS</span>
                <span class="accent-indigo fw-bold"><?php echo $steamid; ?></span>
                <div class="accent-cyan small">Status: <?php echo $rs; ?></div>
            </div>
            <?php endif; ?>
        </header>

        <!-- Server Status Section -->
        <section class="mb-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="accent-indigo h4 mb-0">■</span>
                <h2 class="h5 mb-0 text-uppercase fw-bold">Server Network</h2>
            </div>
            
            <div class="row g-3">
                <?php
                $link = "Server.xml";
                if (file_exists($link)) {
                    $xml = simplexml_load_file($link)->channel;
                    foreach ($xml->item as $item) { ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="glass-card">
                                <div class="server-label">Server Host</div>
                                <h3 class="h6 fw-bold mb-3"><?php echo mb_convert_encoding($item->title, 'ISO-8859-1', 'UTF-8'); ?></h3>
                                
                                <div class="row g-2 mb-4 text-center">
                                    <div class="col-4">
                                        <div class="text-secondary small">Players</div>
                                        <div class="fw-bold accent-indigo"><?php echo mb_convert_encoding($item->playes, 'ISO-8859-1', 'UTF-8'); ?></div>
                                    </div>
                                    <div class="col-4 border-start border-end border-opacity-10">
                                        <div class="text-secondary small">Map</div>
                                        <div class="fw-bold accent-cyan"><?php echo mb_convert_encoding($item->map, 'ISO-8859-1', 'UTF-8'); ?></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-secondary small">IP</div>
                                        <div class="fw-bold" style="font-size: 0.7rem;"><?php echo $ip_usuario; ?></div>
                                    </div>
                                </div>
                                <a href="steam://connect/<?php echo $ip_usuario . ":" . mb_convert_encoding($item->port, 'ISO-8859-1', 'UTF-8'); ?>" class="btn-modern w-100 justify-content-center">
                                    CONNECT SERVER
                                </a>
                            </div>
                        </div>
                    <?php }
                }
                ?>
            </div>
        </section>

        <hr>

        <!-- Skin Selection Section -->
        <form action="update.php" method="get">
            <div class="row g-4">
                <!-- Preview Side (Left/Center) -->
                <div class="col-lg-8">
                    <div class="glass-panel p-4 h-100">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="accent-indigo h4 mb-0">■</span>
                            <h2 class="h5 mb-0 text-uppercase fw-bold">Agent Preview</h2>
                        </div>
                        
                        <div class="row text-center align-items-center">
                            <div class="col-6">
                                <div class="mb-2 accent-indigo fw-bold small">COUNTER-TERRORIST</div>
                                <div class="glass-card p-0 overflow-hidden" style="min-height: 250px; display: flex; align-items: center; justify-content: center;">
                                    <?php if ($ct_model != "" && $img != ""): ?>
                                        <img id="image" src="<?php echo $img; ?>" alt="CT Preview" style="max-height: 240px; width: auto; object-fit: contain;">
                                        <div class="p-2 position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 small fw-bold">
                                            <?php echo strtoupper($ct_model); ?>
                                        </div>
                                    <?php else: ?>
                                        <img id="image" src="img/counter-strike-2-changes.jpg" alt="Default CT" style="max-height: 240px; width: auto; object-fit: contain; opacity: 0.5;">
                                        <div class="p-2 position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 small">CT DEFAULT</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2 accent-purple fw-bold small">TERRORIST</div>
                                <div class="glass-card p-0 overflow-hidden" style="min-height: 250px; display: flex; align-items: center; justify-content: center;">
                                    <?php if ($t_model != "" && $img2 != ""): ?>
                                        <img id="image2" src="<?php echo $img2; ?>" alt="T Preview" style="max-height: 240px; width: auto; object-fit: contain;">
                                        <div class="p-2 position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 small fw-bold">
                                            <?php echo strtoupper($t_model); ?>
                                        </div>
                                    <?php else: ?>
                                        <img id="image2" src="img/Is-Counter-Strike.jpg" alt="Default T" style="max-height: 240px; width: auto; object-fit: contain; opacity: 0.5;">
                                        <div class="p-2 position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 small">T DEFAULT</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selection Side (Right) -->
                <div class="col-lg-4">
                    <div class="glass-panel p-4 mb-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold small accent-indigo">SKIN SELECT CT</label>
                            <select class="form-select" onchange="changingSelection(this)">
                                <option value="">Default</option>
                                <?php
                                $link_skins = "Skin_Players.xml";
                                if (file_exists($link_skins)) {
                                    $xml_skins = simplexml_load_file($link_skins)->channel;
                                    foreach ($xml_skins->item as $item) {
                                        if (mb_convert_encoding($item->side, 'ISO-8859-1', 'UTF-8') == "CT" || mb_convert_encoding($item->side, 'ISO-8859-1', 'UTF-8') == "ALL") {
                                            echo "<option value='" . mb_convert_encoding($item->title, 'ISO-8859-1', 'UTF-8') . "'>" . mb_convert_encoding($item->title, 'ISO-8859-1', 'UTF-8') . "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold small accent-purple">SKIN SELECT T</label>
                            <select class="form-select" onchange="changingSelection2(this)">
                                <option value="">Default</option>
                                <?php
                                if (file_exists($link_skins)) {
                                    foreach ($xml_skins->item as $item) {
                                        if (mb_convert_encoding($item->side, 'ISO-8859-1', 'UTF-8') == "T" || mb_convert_encoding($item->side, 'ISO-8859-1', 'UTF-8') == "ALL") {
                                            echo "<option value='" . mb_convert_encoding($item->title, 'ISO-8859-1', 'UTF-8') . "'>" . mb_convert_encoding($item->title, 'ISO-8859-1', 'UTF-8') . "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small accent-cyan">STEAMID64</label>
                            <select class="form-select" name="steamid" id="steamid">
                                <option value="<?php echo $steamid; ?>"><?php echo $steamid ?: 'Select SteamID'; ?></option>
                                <?php while ($resultado = mysqli_fetch_array($sql)): ?>
                                    <option value="<?= $resultado['steamid'] ?>"><?= $resultado['steamid'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn-modern w-100 justify-content-center">
                            APPLY SELECTION
                        </button>
                    </div>

                    <div class="glass-panel p-4">
                        <div class="accent-indigo fw-bold small mb-2">USEFUL COMMANDS</div>
                        <div class="bg-black bg-opacity-50 p-2 rounded small" style="font-family: monospace; font-size: 0.75rem;">
                            <div class="mb-1 text-secondary">!rcon pmc_resynccache</div>
                            <div class="mb-1 text-secondary">!modeladmin reload</div>
                            <div class="mb-1 text-secondary">!rcon sv_cheats 1</div>
                            <div class="mb-1 text-secondary">thirdperson</div>
                        </div>
                    </div>
                </div>
            </div>

            <input type='hidden' id='t_model' name='t_model' value=''>
            <input type='hidden' id='ct_model' name='ct_model' value=''>
            <input type='hidden' id='img' name='img' value=''>
            <input type='hidden' id='img2' name='img2' value=''>
        </form>

        <footer class="mt-5 pt-4 border-top border-opacity-10 text-center">
            <span class="text-secondary small">© 2024 SKIN PLAYERS Web v2.0 | Designed by Astral & Antigravity</span>
        </footer>
    </div>

    <!-- Script connection to existing logic -->
    <script src="skins.js"></script>
</body>
</html>