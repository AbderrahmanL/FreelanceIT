<!DOCTYPE html>
<html>
<head>
	<title>FreelanceIT Welcome</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'> 
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/inscription.css'); ?>" >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/header.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/footer.css'); ?>">
</head>
<body>
	<?php $this->load->view('layouts/header');?>
	<section class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<?php $attributes = array("name" => "registrationform");
				echo form_open_multipart("recruteurs/inscriptionRecruteur", $attributes);?>
				<fieldset class="fieldset">
					<legend>Inscription Recruteur</legend>
					<label for="compte">Compte </label>
					<select name="compte" id="myselect">
						<option value="societe" 
						<?php 
						if($this->input->post('compte')=='societe'){
							echo 'selected="selected"';
						} ?>>societe</option>
						<option value="particulier" 
						<?php  
						if($this->input->post('compte')=='particulier'){
							echo 'selected="selected"';
						} ?>>particulier</option>
					</select><br>
					<label for="login">Email</label>
					<input type="text" size="30" name="login" value="<?php echo set_value('login'); ?>" required>
					<p>
						<span ><?php echo form_error('login'); ?></span>
					</p>
					<label for="pass">Mot de passe</label>
					<input type="Password" size="30" name="pass" required>
					<p>
						<span><?php echo form_error('pass'); ?></span>
					</p>
					<label for="cpass">Confirmation</label>
					<input type="Password" size="30" name="cpass" required>
					<p>
						<span><?php echo form_error('cpass'); ?></span>
					</p>
					<label for="nom" class="particulier">Nom </label>
					<input id="fname" type="text" size="30" name="nom"  class="particulier" value="<?php echo set_value('nom'); ?>" >
					<p></p>
					<label for="prenom" class="particulier">Prenom </label>
					<input id="lname" type="text" size="30" name="prenom" class="particulier" value="<?php echo set_value('prenom'); ?>" >
					<p></p>
					<label for="nomse" class="societe">Nom de L'entreprise </label>
					<input id="sname" type="text" size="30" name="nomse" class="societe" value="<?php echo set_value('nomse'); ?>" >
					<p></p>
					<label for="adresse" class="societe">Adresse </label>
					<input id="at" type="text" size="30" name="adresse" value="<?php echo set_value('adresse'); ?>" class="societe" >
					<p></p>
					<label for="logo" class="societe">Logo</label>
					<input style="float: none;" type="file" name="logo" class="societe">
					<p></p>
					<input class="col-sm-2 btn btn-primary" style="height: 40px; width: 90px;" id="btn" type="submit" value="Valider" >
					<a href="<?php echo base_url('index.php/logins/login')?>" onclick="return confirm('Are you sure?')"><div class="col-sm-2 btn btn-default" style="height: 40px; width: 90px; float: right;" id="cancel">Annuler</div></a>
				</fieldset>
				<?php echo form_close(); ?>
				<?php echo $this->session->flashdata('msg'); ?>
				<?php echo $this->session->flashdata('verify_msg'); ?>
			</div>
		</div>
	</section>
	<script src='https://code.jquery.com/jquery-3.1.0.min.js'></script>
	<script src="<?php echo base_url('foundation/js/switchform.js'); ?>"></script>

