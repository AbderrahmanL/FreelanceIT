<section class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <?php $attributes = array("name" => "registrationform");
      echo form_open_multipart("recruteurs/editer".'/'.$recruteur['id'], $attributes);?>
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
        <?php
        if($recruteur['compte']=='particulier')
        {?>
         <label for="nom">nom</label>
         <input type="text" size="30" name="nom" value="<?php if (isset($_POST['nom']))
 				{	echo set_value('nom');}
 				else
 					echo $recruteur['nom'];?>"/>
         <p>
           <span ><?php echo form_error('nom'); ?></span>
         </p>
         <label for="prenom">prenom</label>
         <input type="text" size="30" name="prenom" value="<?php if (isset($_POST['prenom']))
 				{	echo set_value('prenom');}
 				else
 					echo $recruteur['prenom'];?>"/>
         <p>
           <span ><?php echo form_error('prenom'); ?></span>
         </p>
      <?php } ?>
<?php
       if($recruteur['compte']=='societe')
       {?>
        <label for="nomse" class="societe">Nom de L entreprise </label>
        <input id="sname" type="text" size="30" name="nomse" class="societe" value="<?php if (isset($_POST['nomse']))
       {	echo set_value('nomse');}
       else
         echo $recruteur['nomse'];?>"/>
        <p></p>
        <label for="adresse" class="societe">Adresse </label>
        <input id="at" type="text" size="30" name="adresse" value="<?php if (isset($_POST['adresse']))
       {	echo set_value('adresse');}
       else
         echo $recruteur['adresse'];?>"/>
        <p></p>
        <label for="logo" class="societe">Logo</label>
        <input style="float: none;" type="file" name="logo" class="societe">
        <p></p>
    <?php  } ?>

        <input class="col-sm-2 btn btn-primary" style="height: 40px; width: 90px;" id="btn" type="submit" value="Valider" >
        <a href="<?php echo base_url('index.php/logins/login')?>" onclick="return confirm('Are you sure?')"><div class="col-sm-2 btn btn-default" style="height: 40px; width: 90px; float: right;" id="cancel">Annuler</div></a>
      </fieldset>
      <?php echo form_close(); ?>
      <?php echo $this->session->flashdata('msg'); ?>
      <?php echo $this->session->flashdata('verify_msg'); ?>
    </div>
  </div>
</section>
