<section class="container">
	<div class="row is-table-row" style="min-height: 350px">
		<div class="col-sm-8">
			<?php  
			echo $this->session->userdata('msg'); ?>
			<div>
				<h3 style="color: #328CC1"><?php echo $mission['titre']?></h3>
				<br>
				<p><b>lieu: </b><?php echo $mission['lieu']?></p>
				<p><b>Debut: </b><?php echo $mission['debut']?></p>
				<p><b>Duree: </b><?php echo $mission['duree']?></p>
				<p><b>Tarif: </b><?php echo $mission['tarif']?></p>
				<br>
				<p><b>Description:</b></p>
				<p style="white-space:pre-wrap;"><?php echo $mission['description']?></p>
			</div>
			<?php 
			if ($_SESSION['who']=='consultant') {
				?>
				<div class="row" style="padding-bottom: 20px">
					<div class="col-md-10 col-md-offset-1 form-groupe apply" >
						<h3>Postuler pour cette mission</h3>
						<h5 class="alert alert-info text-center" style="padding: 5px"><b>Un email sera envoyer avec votre CV attaché</b></h5>
						<?php 
						if ($hascv==1) {
							?>
							<h5 class="alert alert-warning text-center" style="padding: 5px"><b>Vous pouvez choisir un autre cv à envoyer dans la boîte ci-dessous </b></h5>
							<?php $attributes = array("name" => "myform");
							echo form_open("consultants/sendEmail/".$mission['id_rec']);?>
							<fieldset class="fieldset" name="fset">
								<input type="hidden" name="titre"
								value="<?php echo $mission['titre'] ?>" 
								>
								<input type="hidden" name="idMiss"
								value="<?php echo $mission['id'] ?>" 
								>
								<input type="hidden" name="idRec"
								value="<?php echo $mission['id_rec'] ?>" 
								>
								<input type="submit" class="btn btn-primary form-controle" value="Envoyer cv existant">
							</fieldset>
							<?php echo form_close(); ?>
							<?php	
						}
						$attributes = array("name" => "myform");
						echo form_open_multipart("consultants/sendEmail/".$mission['id_rec']);?>
						<fieldset class="fieldset" name="fset">
							<label for="mycv"></label>
							<input type="file" name="mycv" class="form-controle">
							<input type="hidden" name="titre"
							value="<?php echo $mission['titre'] ?>" 
							>
							<input type="hidden" name="idMiss"
							value="<?php echo $mission['id'] ?>"
							>
							<input type="hidden" name="idRec"
							value="<?php echo $mission['id_rec'] ?>" 
							>
							<input type="submit" class="btn btn-success form-controle" value="Envoyer">
						</fieldset>
						<?php echo form_close(); ?>
					</div>
				</div>
				<?php 
			}
			?> 	
		</div>
		<div class="col-sm-4 text-center" id="sidebar">
			<?php 
			if ($_SESSION['who']=='consultant') {
				?>
				<div id="info" style="color: #DDD">
					<h3>Gratuit pour les Freelancers</h3> 
					<p><b>Chargez votre cv et explorez toutes les missions!</b></p>
					<a href="<?php echo base_url('index.php/consultants/postuler'); ?>"><button class="btn" style="background-color:#D9B310"><b>Proposer mon CV</b></button>
					</a>
				</div>
				<?php
			} 
			else{
				?>
				<div id="info2">
					<h3>Des freelancers profiles IT?</h3> 
					<p style="color: #0B3C5D"><b>Publier vos missions dés maintenant!</b></p>
					<a href="<?php echo base_url('index.php/recruteurs/creermission'); ?>"><button class="btn" style="background-color:#D9B310;"><b>Publier une mission</b>
					</button>
				</a>
			</div>
			<?php
		} 
		?>
	</div>
</div>
</section>