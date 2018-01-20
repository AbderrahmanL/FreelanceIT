<?php 
if (isset($periode)) {
	echo base_url("index.php/consultants/index/$periode");
}
else
{
	echo base_url("index.php/consultants");
}
?>