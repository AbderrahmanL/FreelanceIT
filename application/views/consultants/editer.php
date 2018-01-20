<section class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php $attributes = array("name" => "registrationform");?>
			<form method="POST" action="<?php echo base_url("index.php/consultants/editer").'/'.$consultant['id'] ?>">
				<fieldset class="fieldset">
					<legend>Editer Vos informations</legend>
					<label for="passact">Mot de passe actuel</label>
					<input type="Password" size="30" name="passact" >
					<p>
						<span><?php echo form_error('pass'); ?></span>
					</p>
					<label for="pass">Nouveau Mot de passe</label>
					<input type="Password" size="30" name="pass" >
					<p>
						<span><?php echo form_error('pass'); ?></span>
					</p>
					<label for="cpass">Confirmation</label>
					<input type="Password" size="30" name="cpass" >
					<p>
						<span><?php echo form_error('cpass'); ?></span>
					</p>
					<label for="nom">Nom</label>
					<input type="text" size="30" name="nom" value="<?php if (isset($_POST['nom'])) 
					{	echo set_value('nom');}
					else
						echo $consultant['nom'];?>"/>
					<p >
						<span ><?php echo form_error('nom'); ?></span>
					</p>
					<label for="prenom">Prenom</label>
					<input type="text" size="30" name="prenom" value="<?php if (isset($_POST['nom'])) 
					{	echo set_value('prenom');}
					else
						echo $consultant['prenom'];?>"/>
					<p>
						<span ><?php echo form_error('prenom'); ?></span>
					</p>
					<label for="specialite">Specialité</label>
					<select name="specialite">
						<option <?php 
						if($consultant['specialite']=='.net'){
							echo 'selected="selected"';
						} ?>>.net</option>
						<option <?php 
						if($consultant['specialite']=='jee'){
							echo 'selected="selected"';
						} ?>>jee</option>
						<option <?php 
						if($consultant['specialite']=='architect-network'){
							echo 'selected="selected"';
						} ?>>architect-network</option>
						<option <?php 
						if($consultant['specialite']=='admin-bd'){
							echo 'selected="selected"';
						} ?>>admin-bd</option>
						<option <?php 
						if($consultant['specialite']=='front-end'){
							echo 'selected="selected"';
						} ?>>front-end</option>
						<option <?php 
						if($consultant['specialite']=='audit'){
							echo 'selected="selected"';
						} ?>>audit</option>
					</select><br>
					<label style="vertical-align:top">Charger CV</label>&nbsp&nbsp&nbsp&nbsp&nbsp
					<a onClick="MyWindow=window.open('<?php echo base_url('index.php/consultants/charger');?>','MyWindow','width=340,height=120,left=550,top=350'); return false;"><i class="material-icons" id="upicon" style="font-size:24px">file_upload</i></a><br>
					<input class="col-sm-2 btn btn-primary form-control" style="height: 40px;" id="btn" type="submit" value="Valider" >
					<a href="<?php echo base_url('index.php/consultants')?>" onclick="return confirm('Are you sure?')"><div class="col-sm-2 btn btn-default" style="height: 40px; width: 90px; float: right;" id="cancel">Annuler</div></a>
				</fieldset>
				<?php echo form_close(); ?>
				<?php echo $this->session->flashdata('msg'); ?>
				<?php echo $this->session->flashdata('verify_msg'); ?>
			</div>
		</div>
	</section>
