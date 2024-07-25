<?php

include "config.php";


$conn = new mysqli($servername, $username, $password, 'skins');


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

 
$steamid = $_GET['steamid'];


if ($steamid != ''){

$sql = "	
INSERT INTO wp_player_skins (steamid, weapon_defindex, weapon_paint_id, weapon_wear, weapon_seed) VALUES
('$steamid', '1', '962', '0.07', '0'),
('$steamid', '9', '344', '0.07', '0'),
('$steamid', '5027', '10039', '0.07', '0'),
('$steamid', '525', '38', '0.07', '0'),
('$steamid', '34', '1134', '0.07', '0'),
('$steamid', '7', '180', '0.07', '0'),
('$steamid', '16', '449', '0.07', '0'),
('$steamid', '10', '604', '0.07', '0'),
('$steamid', '19', '611', '0.07', '0'),
('$steamid', '17', '372', '0.7', '0'),
('$steamid', '24', '704', '0.7', '0'),
('$steamid', '26', '1125', '0.07', '0'),
('$steamid', '31', '1172', '0.07', '0'),
('$steamid', '23', '974', '0.07', '0'),
('$steamid', '39', '287', '0.07', '0'),
('$steamid', '61', '1142', '0.07', '0'),
('$steamid', '33', '893', '0.07', '0'),
('$steamid', '35', '263', '0.07', '0'),
('$steamid', '40', '624', '0.07', '0'),
('$steamid', '60', '984', '0.07', '0'),
('$steamid', '63', '269', '0.07', '0'),
('$steamid', '13', '398', '0.07', '0'),
('$steamid', '2', '447', '0.07', '0'),
('$steamid', '3', '464', '0.07', '0'),
('$steamid', '4', '1121', '0.07', '0'),
('$steamid', '38', '518', '0.07', '0'),
('$steamid', '36', '168', '0.07', '0'),
('$steamid', '32', '389', '0.07', '0'),
('$steamid', '27', '499', '0.07', '0'),
('$steamid', '28', '763', '0.07', '0'),
('$steamid', '29', '953', '0', '7'),
('$steamid', '30', '272', '0.07', '0'),
('$steamid', '14', '1148', '0.07', '0'),
('$steamid', '8', '942', '0.07', '0'),
('$steamid', '64', '952', '0.07', '0'),
('$steamid', '523', '416', '0.07', '0');";
$conn->query($sql);//deve ser repetido
	
	
$sql = "
INSERT INTO wp_player_gloves (steamid, weapon_defindex) VALUES
('$steamid', '5027');";
$conn->query($sql);//deve ser repetido

$sql = "
INSERT INTO wp_player_knife (steamid, knife) VALUES
('$steamid', 'weapon_knife_widowmaker');";
$conn->query($sql);//deve ser repetido

$sql = "INSERT INTO wp_player_agents (steamid, agent_ct, agent_t) VALUES 
('$steamid', 'ctm_sas/ctm_sas_variantg', 'tm_professional/tm_professional_varg');";
$conn->query($sql);//deve ser repetido

$sql = "
INSERT INTO wp_player_music (steamid, music_id) VALUES
('$steamid', '35');";// aqui nao retete o query



if ($conn->query($sql) === TRUE) {//o ultimo query e executado aqui
    $rs = "Registration Updated Successfully";
} else {
    $rs = "Error updating the registry:" . $conn->error;
}

$conn->close();
} else {
	 $rs = "Connect Success CSGO";
}



header("Location: skins.php?id=$steamid&rs=$rs");
//exit;


?>