<section class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php $attributes = array("name" => "myform");?>
			<form method="POST" action="<?php echo base_url("index.php/missions/editer").'/'.$mission['id'] ?>">
				<fieldset class="fieldset">
					<legend>Editer votre mission</legend>
					<label for="titre">Titre</label>
					<input class="form-control" id="titre" type="text" required size="30" name="titre"  value="<?php if (isset($_POST['titre'])) 
					{	echo set_value('titre');}
					else
						echo $mission['titre'];?>" >
					<p>
						<span><?php echo form_error('titre'); ?></span>
					</p>
					<label for="duree">Durée</label>
					<input class="form-control" id="duree" type="text" required size="30" name="duree"  value="<?php if (isset($_POST['titre'])) 
					{	echo set_value('duree');}
					else
						echo $mission['duree'];?>" >
					<p></p>
					<label for="lieu">Lieu</label>
					<input class="form-control" id="lieu" type="text" required size="30" name="lieu"  value="<?php if (isset($_POST['titre'])) 
					{	echo set_value('lieu');}
					else
						echo $mission['lieu'];?>" >
					<p></p>
					<label for="debut">Début</label>
					<input class="form-control" id="debut" type="text" required size="30" name="debut"  value="<?php if (isset($_POST['titre'])) 
					{	echo set_value('debut');}
					else
						echo $mission['debut'];?>" >
					<p></p>	
					<label for="description">Description(draguez le coin pour redimensionner)</label>
					<textarea class="form-control" rows="5" id="description" maxlength="1500" minlength="200" required name="description" style="resize: vertical;" onKeyUp="saisie()"><?php if (isset($_POST['titre'])) 
						{	echo set_value('description');}
						else
							echo $mission['description'];?></textarea>
						<p>
							<span><?php echo form_error('description'); ?></span>
						</p>
						<input type="text" id="restant" size="4" readonly style="background:rgba(0,0,0,0);
						border:none; float: left; color: red;"> 
						<p>restant(s) </p>
						<input class="col-sm-2 btn btn-primary" style="height: 40px; width: 90px;" id="btn" type="submit" value="Modifer" >
						<a href="<?php echo base_url('index.php/recruteurs')?>" onclick="return confirm('Are you sure?')"><div class="col-sm-2 btn btn-default" style="height: 40px; width: 90px; float: right;" id="cancel">Annuler</div></a>
					</fieldset>
					<?php echo form_close(); ?>
					<?php echo $this->session->flashdata('msg'); ?>
					<?php echo $this->session->flashdata('verify_msg'); ?>
				</div>
			</div>
		</section>
		<script type="text/javascript">
			min=200;
			max=1500;
			trigmin=0;
			trigmax=0;
			function saisie(){
				if(document.getElementById('description').value.length>min)
				{ 
					if(trigmax==0)
						{alert("ne dépassez pas "+max+" caractères!"); 
					trigmax=1;
				}
				document.getElementById('restant').value=max-document.getElementById('description').value.length;
			} 
			if(document.getElementById('description').value.length>max)
			{ 
				document.getElementById('restant').value=0;
				alert("Vous avez dépassé "+max+" caractères!"); 
				document.getElementById('description').value=document.getElementById('description').value.substring(0,max); 
			} 
			if(document.getElementById('description').value.length<=min)
			{ 
				if(trigmin==0)
					{alert("Faite une description d'au moins "+min+" caractères!");
				trigmin=1;
			}
			document.getElementById('restant').value=min-document.getElementById('description').value.length; 
		}	
	} 

</script>