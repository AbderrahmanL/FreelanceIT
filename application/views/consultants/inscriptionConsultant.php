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
				echo form_open("consultants/inscriptionConsultant", $attributes);?>
				<fieldset class="fieldset">
					<legend>Inscription Consultant</legend>
					<h4 class="alert alert-success text-center" style="padding: 5px;margin-bottom: 2px">Saisissez vos informations personnelles puis validez (tous les champs sont requis)</h4>
					<h5 class="alert alert-info text-center" style="padding: 5px"><b>Vous serez capable de consulter, postuler GRATUITEMENT au missions dés validation de l'inscription</b></h5>
					<label for="login">Email</label>
					<input type="text" size="30" name="login" required value="<?php echo set_value('login'); ?>" >
					<p>
						<span ><?php echo form_error('login'); ?></span>
					</p>
					<label for="pass">Mot de passe</label>
					<input type="Password" size="30" required name="pass" >
					<p>
						<span><?php echo form_error('pass'); ?></span>
					</p>
					<label for="cpass">Confirmation</label>
					<input type="Password" size="30" required name="cpass" >
					<p>
						<span><?php echo form_error('cpass'); ?></span>
					</p>
					<label for="civilite">Civilité</label>
					<select name="civilite">
						<option>Mr</option>
						<option>Mme</option>
						<option>Mlle</option>
					</select><br>
					<label for="nom">Nom</label>
					<input type="text" size="30" name="nom" required value="<?php echo set_value('nom'); ?>"/>
					<p >
						<span ><?php echo form_error('nom'); ?></span>
					</p>
					<label for="prenom">Prenom</label>
					<input type="text" size="30" name="prenom" required value="<?php echo set_value('prenom'); ?>"/>
					<p>
						<span ><?php echo form_error('prenom'); ?></span>
					</p>
					<label for="specialite">Specialité</label>
					<select name="specialite">
						<option>.net</option>
						<option>jee</option>
						<option>architect-network</option>
						<option>admin-bd</option>
						<option>front-end</option>
						<option>audit</option>
					</select><br>
					<input class="col-sm-2 btn btn-primary" style="height: 40px; width: 90px;" id="btn" type="submit" value="Valider" >
					<a href="<?php echo base_url('index.php/logins/login')?>" onclick="return confirm('Are you sure?')"><div class="col-sm-2 btn btn-default" style="height: 40px; width: 90px; float: right;" id="cancel">Annuler</div></a>
				</fieldset>
				<?php echo form_close(); ?>
				<?php echo $this->session->flashdata('msg'); ?>
				<?php echo $this->session->flashdata('verify_msg'); ?>
			</div>
		</div>
	</section>
