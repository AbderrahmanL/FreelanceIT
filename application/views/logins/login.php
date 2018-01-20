<!DOCTYPE html>
<html>
<head>
	<title>FreelanceIT Welcome</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/login.css'); ?>" >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/header.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/footer.css'); ?>">
</head>
<?php $this->load->view('layouts/header.php');?>
<section class="container">
	<div class="row text-center">
		<div class="col-sm-7">
			<div id="conec" > Connexion Recruteur</div>
			<div id="compte" class="disp"><a href="<?php echo base_url('index.php/recruteurs/inscriptionRecruteur'); ?>">1ère visite? créer un compte</a></div>
			<div id="oubli" class="disp"><a href="#">un oubli?</a></div>
			<div id="form">
				<?php $attributes = array("name" => "registrationform");
				echo form_open("logins/login", $attributes);?>
				<div class="inp"> <input type="email" size="30" name="r_login" placeholder="identifiant de l'entreprise" required></div>
				<div class="inp"> <input type="password" size="30" placeholder="Mot De Passe" name="r_pass" required></div>
				<div class="btns"> <input id="btn" type="submit" value="Connexion" ></div>
				<?php echo form_close(); ?>
				<?php echo $this->session->flashdata('r_msg'); ?>
			</div>
		</div>
		<div class="col-sm-5">
			<div id="conection" > Connexion Consultant</div>
			<div id="compt" class="disp"><a href="<?php echo base_url('index.php/consultants/inscriptionConsultant'); ?>">1ère visite? créer un compte</a></div>
			<div id="oubl" class="disp"><a href="#">un oubli?</a></div>
			<div id="form">
				<?php $attributes = array("name" => "registrationform");
				echo form_open("logins/login", $attributes);?>
				<div class="inp"> <input type="email" size="30" name="login" placeholder="identifiant de l utilisateur" required></div>
				<div class="inp"> <input type="password" size="30" placeholder="Mot De Passe" name="pass" required></div>
				<div class="btns" > <input id="btn" type="submit" value="Connexion" name="btn" ></div>
				<?php echo form_close(); ?>
				<?php echo $this->session->flashdata('msg'); ?>
			</div>
		</div>
	</div>
</section>
