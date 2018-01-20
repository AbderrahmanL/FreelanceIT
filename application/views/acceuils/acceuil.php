<!DOCTYPE html>
<html>
<head>
	<title>FreelanceIT Welcome</title>
	<meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/acceuil.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/header.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('foundation/css/footer.css'); ?>">
</head>
<body>
  <?php $this->load->view('layouts/header');?>
  <section class="container">
    <div class="row is-table-row" style="min-height: 350px">
     <div class="col-sm-8">
       <div id="mission">
         <table class="table-stripped table-hover table-responsive">
           <tr ><td rowspan="11"></td></tr>
           <h3 style="color: #328CC1;"> Dernières Missions</h3>
           <?php foreach($missions as $mission){ ?>
           <tr>
             <td >
               <a href="<?php echo base_url('index.php/missions/missiondetails/').$mission['id']; ?>" style="text-decoration: none;" >
                <?php $time=explode(" ", $mission['date']);
                $time=explode(":", $time[1]); 
                echo "<i style=\"color:#3D5761\">".$time[0].':'.$time[1]."&nbsp&nbsp&nbsp"."  </i><b style=\"color:inherit\">".$mission['titre'].'</b>' ?> 
              </a>
            </td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <div class="col-sm-4 text-center" id="sidebar">
      <div id="info" style="color: #DDD">
        <h3>Gratuit pour les Freelancers</h3> 
        <p><b>Chargez votre cv et explorez toutes les missions!</b></p>
        <a href="<?php echo base_url('index.php/consultants/postuler'); ?>"><button class="btn" style="background-color:#D9B310"><b>Proposer mon CV</b></button></a>
      </div>
      <div id="info2">
        <h3>Des freelancers profiles IT?</h3> 
        <p style="color: #0B3C5D"><b>Publier vos missions dés maintenant!</b></p>
        <a href="<?php echo base_url('index.php/recruteurs/creermission'); ?>"><button class="btn" style="background-color:#D9B310;"><b>Publier une mission</b></button></a>
      </div>
    </div>
  </div>
</section>