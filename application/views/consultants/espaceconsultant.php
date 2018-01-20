<section class="container">
	<div class="row is-table-row" style="min-height: 350px">
		<div class="col-sm-8">
			<?php $this->load->view('scripts/getToken.php') ?>
			<?php echo $this->session->userdata('msg'); ?>
			<?php echo $this->session->flashdata('verify_msg'); 
			$i=0;
			$j=0;
			$y=0;
			if (!isset($_GET['offset'])) {
				$offset=0;
			}
			else
			{
				$offset=$_GET['offset'];
			}
			$x=10*$offset;
// *********************test sur le status***************************
			if ($_SESSION['activeuser']==TRUE) {
				?>
				<!-- // *********************recherche*************************** -->
				<div class=" research row" style="padding-bottom: 20px">
					<form class="form-group col-sm-12" action="<?php $this->load->view('scripts/getAction.php') ?>" >
						<input type="text" class="form-control" style="max-width: 280px; margin: 0 auto;" name="keyword" placeholder="chercher" value="<?php if (isset($_GET['keyword'])) {
							echo $_GET['keyword'];
						} ?>">
					</form>
				</div>
				<!-- // *********************affichage des boutons de pages *************************** -->
				<?php if (isset($missions[0]['titre'])){?>
				<div class="row" style="padding-bottom: 20px">
					<div class="col-xs-12">
						<?php 
						for ($j=0; $j<ceil(count($missions)/10); $j++) { 
							?>
							<a href="
							<?php $this->load->view('scripts/getAction.php') ?>
							<?php $this->load->view('scripts/getKeyword.php') ?>
							<?php $this->load->view('scripts/getOffset.php')?><?php echo $j; ?>"><button class="btn btn-default" ><?php echo $j+1; ?></button></a>
							<?php }
							?>
						</div>
					</div>
					<?php 
					if ($j==$offset+1 && count($missions)%10!=0) {
						$y=$x+count($missions)%10;
					}
					else
					{
						$y=$x+10;
					}
				}
				else{
					$y=$x;
				}
				?>
				<!-- // *********************affichage des missions*************************** -->
				<?php for($i=$x;$i<$y;$i++){ ?>
				<div class="mission row">
					<div class="col-xs-8">
						<a href="<?php echo base_url('index.php/missions/missiondetails/').$missions[$i]['id']; ?>"><h4 class="missionTitle"><?php echo $missions[$i]['titre'] ?></h4></a>
						&nbsp &nbsp &nbsp &nbsp &nbsp<p style="color : grey;display: inline-block; padding: 5px;"><?php $time=explode(" ", $missions[$i]['date']);
						//to do date for apply
						echo $time[0]." ";
						$time=explode(":", $time[1]); 
						echo $time[0].':'.$time[1].'  '.$missions[$i]['lieu'] ?> </p>
						<?php echo '<div class="missionDesc">'.substr($missions[$i]['description'], 0,270).'....'.'</div>' ?> 
						&nbsp &nbsp &nbsp &nbsp &nbsp<p style="color : grey;display: inline-block; padding: 5px;"><?php 
						echo $missions[$i]['duree'] ?> </p>
					</div>
					<div class="missionpic col-xs-4">
						<?php 
						$logo=$this->Recruteur->getPropertyById($missions[$i]['id_rec'],'logo');
						if ($logo==0) {
							?>
							<img style="width: 100%; padding: 10px 0" src="<?php echo base_url('assets/images/anonym.png');  ?>" >
							<?php }
							else{?>
							<img style="width: 100%; padding: 10px 0" src="<?php echo base_url('uploads/img_').$missions[$i]['id_rec'].'.png?'.randToken();  ?>" >
							<?php 
						}?>
					</div>
				</div>
				<?php }
// *********************FIN affichage des missions***************************
				if (!isset($missions[0]['titre'])) {
					?>
					<div class="row" style="min-height: 350px">
						<div class="col-xs-12">
							<div class="col-xs-12 text-center">
								<?php
								echo "<h3> Pas de missions pour ces critères</h3>" ?>
							</div>
						</div>
					</div>
					<?php
				}?>
				<br>
				<!-- // *********************affichage des boutons de pages *************************** -->
				<?php if (isset($missions[0]['titre'])){?>
				<div class="row" style="padding-bottom: 20px">
					<div class="col-xs-12">
						<?php 
						for ($j=0; $j<ceil(count($missions)/10); $j++) { 
							?>
							<a href="
							<?php $this->load->view('scripts/getAction.php') ?>
							<?php $this->load->view('scripts/getKeyword.php') ?>
							<?php $this->load->view('scripts/getOffset.php') ?><?php echo $j; ?>"><button class="btn btn-default" ><?php echo $j+1; ?></button></a>
							<?php }
							?>
						</div>
					</div>
					<?php }?>
					<?php
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
		<!-- // ********************* SIDEBAR *************************** -->
		<div class="col-sm-4" id="sidebar">
			<div id="info" class="text-center" style="color: #DDD">
				<h3>Gratuit pour les Freelancers</h3> 
				<p><b>Chargez votre cv et explorez toutes les missions!</b></p>
				<a href="<?php echo base_url('index.php/consultants/postuler'); ?>"><button class="btn" style="background-color:#D9B310"><b>Proposer mon CV</b></button></a>
			</div>
			<div class="howlong">
				<h4 style="color: #D9B310">Rechercher par durée</h4> 
				<i class="material-icons" style="color:#D9B310">chevron_right</i><a href="<?php echo base_url("index.php/consultants"); ?><?php $this->load->view('scripts/getKeyword.php') ?>" style="vertical-align: top;">Indifférent</a>
				<p></p>
				<i class="material-icons" style="color:#D9B310">chevron_right</i><a href="<?php echo base_url("index.php/consultants"); ?>/index/1<?php $this->load->view('scripts/getKeyword.php') ?>" style="vertical-align: top;">1 mois à 3 mois</a>
				<p></p>
				<i class="material-icons" style="color:#D9B310">chevron_right</i><a href="<?php echo base_url("index.php/consultants"); ?>/index/2<?php $this->load->view('scripts/getKeyword.php') ?>" style="vertical-align: top;">4 mois à 6 mois</a>
				<p></p>
				<i class="material-icons" style="color:#D9B310">chevron_right</i><a href="<?php echo base_url("index.php/consultants"); ?>/index/3<?php $this->load->view('scripts/getKeyword.php') ?>" style="vertical-align: top;">7 mois à 9 mois</a>
				<p></p>
				<i class="material-icons" style="color:#D9B310">chevron_right</i><a href="<?php echo base_url("index.php/consultants"); ?>/index/4<?php $this->load->view('scripts/getKeyword.php') ?>" style="vertical-align: top;">10 mois à 1an</a>
				<p></p>
				<i class="material-icons" style="color:#D9B310">chevron_right</i><a href="<?php echo base_url("index.php/consultants"); ?>/index/5<?php $this->load->view('scripts/getKeyword.php') ?>" style="vertical-align: top;"> 1 an&nbsp&nbsp <b style="vertical-align: top;"><</b> </a>
			</div>
		</div>
	</div>
</section>
