<section class="container">
	<div class="row is-table-row" style="min-height: 350px">
		<div class="col-sm-8">
			<?php echo $this->session->flashdata('msg'); ?>
			<?php echo $this->session->flashdata('r_msg'); ?>
			<?php echo $this->session->flashdata('mission'); ?>
			<?php echo $this->session->flashdata('update'); ?>
			<?php echo $this->session->flashdata('verify_msg'); ?>
			<?php $this->load->view('scripts/getToken.php') ?>
			<?php
			if ($_SESSION['activeuser']==TRUE) {
				?>
				<?php foreach($missions as $mission){ ?>
				<div class="mission row" style="padding: 10px">
					<div class="col-xs-8">
						<a href="<?php echo base_url('index.php/missions/missiondetails/').$mission['id']; ?>"><h4 class="missionTitle"><?php echo $mission['titre'] ?></h4></a>
						&nbsp &nbsp &nbsp &nbsp &nbsp<p style="color : grey;display: inline-block; padding: 5px;"><?php $time=explode(" ", $mission['date']);
						$time=explode(":", $time[1]); 
						echo $time[0].':'.$time[1].'  '.$mission['lieu'] ?> </p>
						<?php echo '<div class="missionDesc">'.substr($mission['description'], 0,270).'....'.'</div>' ?> 
					</div>
					<div class="missionpic col-xs-4 text-center">
						<?php if ($logo==0) {
							?>
							<img style="width: 100%; padding: 10px 0" src="<?php echo base_url('assets/images/anonym.png');  ?>" >
							<?php }
							else{?>
							<img style="width: 100%; padding: 10px 0" src="<?php echo base_url('uploads/img_').$mission['id_rec'].'.png?'.randToken();  ?>" ></a>
							<?php 
						}?>
						<a href="<?php echo base_url('index.php/missions/editer/').$mission['id']; ?>"><button class="btn btn-primary">Modifier</button></a>
						<a href="<?php echo base_url('index.php/missions/supprimer/').$mission['id']; ?>" onclick="return confirm('Are you sure?')"><button class="btn btn-danger">Supprimer</button></a>

					</div>
				</div>
				<?php } 
				if (!isset($mission['titre'])) {
					?>
					<div class="row" style="min-height: 350px">
						<div class="col-xs-8">
							<div class="col-xs-12 text-center">
								<?php
								echo "<h3> Il n'y a pas encore de mission</h3>" ?>
								<a href="<?php echo base_url('index.php/missions/creermission/'); ?>">
									<button class="btn btn-primary">1ère mission
									</button>
								</a>
							</div>
						</div>
					</div>
					<?php
				}
			}
			else{?>
			<div class="row" style="min-height: 350px">
				<div class="col-xs-8">
					<div class="col-xs-12 text-center">
						<?php
						echo "<h3> Activez votre compte et commencez Immediatement</h3>" ?>
					</div>
				</div>
			</div>
			<?php
		}?>
	</div>
	<div class="col-sm-4 text-center" id="sidebar">
		<div id="info2">
			<h3>Des freelancers profiles IT?</h3> 
			<p style="color: #0B3C5D"><b>Publier vos missions dés maintenant!</b></p>
			<a href="<?php echo base_url('index.php/recruteurs/creermission'); ?>"><button class="btn" style="background-color:#D9B310;"><b>Publier une mission</b></button></a>
		</div>
	</div>
</div>
</section>