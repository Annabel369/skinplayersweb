<?php
include "config.php";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

echo "<h3>Tables in 'cs2_panel':</h3><ul>";
$conn->select_db("cs2_panel");
$res = $conn->query("SHOW TABLES");
if ($res) {
    while($row = $res->fetch_array()) {
        echo "<li>" . $row[0] . "</li>";
    }
} else {
    echo "<li>(No tables or DB error)</li>";
}
echo "</ul>";
?>
