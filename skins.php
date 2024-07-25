<?php
include "config.php";

if (isset($_GET["id"], $_GET["rs"])) {
	
$steamid = $_GET['id']; $rs = $_GET['rs'];

}else{
	
$steamid = ''; $rs = '';

}

   


$conn = new mysqli($servername, $username, $password, "skins");

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
define('WEB_STYLE_DARK', 'data-bs-theme="dark"');

?>
<!DOCTYPE html>
<html lang="en"<?php if(WEB_STYLE_DARK) echo 'data-bs-theme="dark"'?>>

<head>
<title>Skin Players Custom Admin & VIP</title>



<meta charset="utf-8">
<link rel="icon" href="favicon.ico">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="style2.css">
	
	<script>	
	$(document).ready(function(){
  $('#dropDown').click(function(){
    $('.drop-down').toggleClass('drop-down--active');
  });
});</script>
</head>
<body>
<?php include "home.php";  ?>
<hr>
<form action="insert.php" method="get">
<div class='card-header'>
<h5 class='card-title item-name'><font color='#4682B4'><img src="OIG2.jpg" width="120" height="105" />Skin Players Custom Admin & VIP</img></p></h5>


<table style="width:90%" class="drop-down__button"><font color="white">
<tr><th><font color="white">Server</font></th>	<th><font color="white">Players</font></th>	<th><font color="white">IP</font></th>	<th><font color="white">Port</font></th>	<th><font color="white">Map</font></th>	<th>.</th></tr>
<tr>
<?php
    $link = "Server.xml";
    $xml = simplexml_load_file($link) -> channel;


// Obtém o endereço IP do usuário
$ip_usuario = $_SERVER['REMOTE_ADDR'];

// Exibe o endereço IP na tela





    foreach($xml -> item as $item){?>
		
       <th><marquee><font color='white'><?php echo utf8_decode($item -> title); ?></font></marquee></th>";
		
        <th><font color='white'><?php echo utf8_decode($item -> playes); ?></font></th>";
		<th><font color='white'><?php echo $ip_usuario." : ";//echo utf8_decode($item -> ip); ?></font></th>";
		<th><font color='white'><?php echo utf8_decode($item -> port); ?></font></th>";
		<th><font color='white'><?php echo utf8_decode($item -> map); ?></font></th>";
		<th><button onclick="document.location='steam://connect/<?php  $ip_usuario.":".utf8_decode($item -> port); ?>'">Connect</button></th></tr>
		
   <?php } 
?>
</tr>
</table>
<div class="card-footer">

<center>
<table style="width:50%" >


			<tr>
			<th>
			<label for="cars"><font color='#4682B4'>Id steam64:</font></label>
			
			<input type="number" name="steamid" id="steamid" size="18"/>

			<input type="submit"></th>
				  
				  <th>
				 <?php  echo "<font color=green>".$rs."</font><br/><font color='#4682B4'>Steam</font> " .$steamid;?>
    </th>
			
</tr>


</table></center>
</div>
</div>


</form>
<div style='text-align:left'>
<font color='#4682B4'>Useful commands:</font><p><textarea cols="70" rows="8" disabled>!rcon pmc_resynccache
!modeladmin reload
!rcon sv_cheats 1
thirdperson
!rcon sv_cheats 0
!rcon css_addadmin 76561198115162119 Astral #pmc/admin 99 99999
!lr_giveexp Astral  58000
!rcon mp_roundtime 33 (Ajusta o tempo dos rounds)
!rcon mp_roundtime_defuse (Altera o tempo de detonação da bomba)
!rcon mp_roundtime_hostage (Altera o tempo de dos rounds para jogos com reféns)
!rcon r_drawOtherModels 2 (Permitem ver os modelos atrás de paredes e outras texturas)
!rcon mp_buy_anywhere 1 (Permite que você compre em qualquer lugar do mapa)
!rcon mp_maxmoney (Altera o máximo de dinheiro que um jogador pode ter)
!rcon mp_startmoney (Ajusta o dinheiro inicial na rodada)
!rcon mp_warmup_end (Retira o tempo de aquecimento antes do início da rodada)
!rcon bot_kick (Remove os bots da partida) (editado)
</textarea></p></div>
<hr>

<!--LINK JQUERY-->
<script type="text/javascript" src="skins.js"></script>
<!--PERSONAL SCRIPT JavaScript-->


<div class="container">
		<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
			<div class="col-md-4 d-flex align-items-center">
				<span class="mb-3 mb-md-0 text-body-secondary"><font color='#4682B4'>© 2024 GAMIER NO MORE Web v2.0 by Astral</font></span>
			</div>
		</footer>
	</div>
</body>
<html>