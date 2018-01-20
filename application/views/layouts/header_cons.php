<!DOCTYPE html>
<html>
<head>
	<title>FreelanceIT Welcome</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'> 
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/cons_space.css'); ?>" >
	<?php  
	if(isset($indice))
	{
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/inscription.css'); ?>" >
		<?php 
	} 
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/header_nav.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/footer.css'); ?>">
</head>
<body>
	<header class="container">
		<div class="row" id="row1">
			<div class="col-sm-8" id="missioncount" ><b>Frelances en ligne - 3000 missions</b></div>
			<div class="col-sm-4 text-right">
				<img src="<?php echo base_url('assets/images/ico/ico-pen.png'); ?>" alt="pen icon" width="15" height="15">&nbsp 
				<a href="<?php echo base_url("index.php/logins/disconnect"); ?>"><b>se déconnecter</b></a>
			</div>
		</div>
		<div class="row" id="row2">
			<a href="<?php echo base_url(''); ?>"><div class="col-xs-4" id="title">
				<h1>FreelanceIT</h1>
			</div></a>
			<div class="col-xs-8 text-right">
				<nav >
					<div class="menubtn">
						<div class="mainitem">
							<img src="<?php echo base_url('assets/images/ico/ico-cv.png'); ?>" alt="cv icon" width="32" height="32">
							<div class="menutext">&nbspMon profile </div>
						</div>
						<div class="drop">
							<a href="<?php 
							if (isset($id_cons)) {
								echo base_url('index.php/consultants/editer/').$id_cons; 
							}
							?>"><div class="item">&nbspEditer</div></a>
							<div class="item">&nbspCV</div>
						</div>
					</div>
					<div class="menubtn">
						<div class="mainitem">
							<img src="<?php echo base_url('assets/images/ico/ico-mission.png'); ?>" alt="research icon" width="32" height="32">
							<div class="menutext">&nbspMission</div>
						</div>
						<div class="drop">
							<div class="item">&nbspOffres de missions</div>
							<div class="item">&nbspMissions favoris</div>
							<a href="<?php 
								echo base_url('index.php/consultants/mesPostul');
							?>"><div class="item">&nbspMes postulations</div></a>
						</div>
					</div>
					<div class="menubtn">
						<div class="mainitem">
							<img src="<?php echo base_url('assets/images/ico/ico-ressource.png'); ?>" alt="resources icon" width="32" height="32">
							<div class="menutext">&nbspRessources</div>
						</div>
						<div class="drop">
							<div class="item">&nbspMission</div>
							<div class="item">&nbspMission</div>
							<div class="item">&nbspMission</div>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</header>