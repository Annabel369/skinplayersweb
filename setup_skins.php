<?php
include "config.php";

// Conectar sem selecionar banco de dados primeiro
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// 1. Criar o banco de dados 'skins'
$sql = "CREATE DATABASE IF NOT EXISTS skins";
if ($conn->query($sql) === TRUE) {
    echo "Banco de dados 'skins' criado ou já existente.<br>";
} else {
    die("Erro ao criar banco de dados: " . $conn->error);
}

// Selecionar o banco 'skins'
$conn->select_db("skins");

// 2. Criar Tabelas de Exemplo (baseadas no upSkins)

$tables = [
    "wp_player_skins" => "CREATE TABLE IF NOT EXISTS wp_player_skins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        steamid VARCHAR(32) NOT NULL,
        weapon_defindex INT NOT NULL,
        weapon_paint_id INT NOT NULL,
        weapon_wear FLOAT DEFAULT 0.07,
        weapon_seed INT DEFAULT 0,
        KEY steamid (steamid)
    )",
    "wp_player_agents" => "CREATE TABLE IF NOT EXISTS wp_player_agents (
        id INT AUTO_INCREMENT PRIMARY KEY,
        steamid VARCHAR(32) NOT NULL,
        agent_ct VARCHAR(128),
        agent_t VARCHAR(128),
        KEY steamid (steamid)
    )",
    "wp_player_gloves" => "CREATE TABLE IF NOT EXISTS wp_player_gloves (
        id INT AUTO_INCREMENT PRIMARY KEY,
        steamid VARCHAR(32) NOT NULL,
        weapon_defindex INT NOT NULL,
        KEY steamid (steamid)
    )",
    "wp_player_knife" => "CREATE TABLE IF NOT EXISTS wp_player_knife (
        id INT AUTO_INCREMENT PRIMARY KEY,
        steamid VARCHAR(32) NOT NULL,
        knife VARCHAR(64),
        KEY steamid (steamid)
    )",
    "wp_player_music" => "CREATE TABLE IF NOT EXISTS wp_player_music (
        id INT AUTO_INCREMENT PRIMARY KEY,
        steamid VARCHAR(32) NOT NULL,
        music_id INT NOT NULL,
        KEY steamid (steamid)
    )"
];

foreach ($tables as $name => $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Tabela '$name' preparada.<br>";
    } else {
        echo "Erro na tabela '$name': " . $conn->error . "<br>";
    }
}

echo "<br><strong>Configuração concluída!</strong> Agora você pode usar a página de Skins.";
$conn->close();
?>
