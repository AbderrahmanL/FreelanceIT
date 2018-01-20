<section class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 form-groupe">
			<?php $attributes = array("name" => "myform");
			echo form_open("missions/creermission", $attributes);?>
			<fieldset class="fieldset" name="fset">
				<legend>Créer votre mission</legend>
				<label for="titre">Titre</label>
				<input class="form-control" id="titre" type="text" required size="30" name="titre"  value="<?php echo set_value('titre'); ?>" >
				<p>
					<span><?php echo form_error('titre'); ?></span>
				</p>
				<label for="duree">Durée</label>
				<select style="height: 22px" required name="duree">
					<option style="height: 16">1 mois</option>
					<option style="height: 16">2 mois</option>
					<option style="height: 16">3 mois</option>
					<option style="height: 16">4 mois</option>
					<option style="height: 16">5 mois</option>
					<option style="height: 16">6 mois</option>
					<option style="height: 16">7 mois</option>
					<option style="height: 16">8 mois</option>
					<option style="height: 16">9 mois</option>
					<option style="height: 16">10 mois</option>
					<option style="height: 16">11 mois</option>
					<option style="height: 16">1 an</option>
					<option style="height: 16">2 ans</option>
				</select>
				<label for="renouvelable">&nbsp&nbsp&nbspRenouvelable</label>
				<input type="checkbox" name="renouvelable">
				<p></p>
				<label for="lieu">Lieu</label>
				<input class="form-control" id="lieu" type="text" required size="30" name="lieu"  value="<?php echo set_value('lieu'); ?>" >
				<p></p>
				<label for="tarif">Tarif</label>
				<input class="form-control" id="tarif" type="text" required size="30" name="tarif"  value="<?php echo set_value('tarif'); ?>" >
				<p></p>
				<label for="debut">Début</label>
				<input class="form-control" id="debut" type="text" required size="30" name="debut"  value="<?php echo set_value('debut'); ?>" >
				<p></p>	
				<label for="description">Description(draguez le coin pour redimensionner)</label>
				<textarea class="form-control" rows="5" id="description" maxlength="1500" minlength="200" required name="description"  style="resize: vertical;" onKeyUp="saisie()"><?php echo set_value('description'); ?></textarea>
				<p>
					<span><?php echo form_error('description'); ?></span>
				</p>
				<input type="text" id="restant" size="4" readonly style="background:rgba(0,0,0,0);
				border:none; float: left; color: red;"> 
				<p>restant(s) </p>
				<input class="col-sm-2 btn btn-primary" style="height: 40px; width: 90px;" id="btn" type="submit" value="Créer" >
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
		ocument.getElementById('restant').value=0;
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