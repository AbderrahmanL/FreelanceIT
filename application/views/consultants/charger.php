<section class="container upload">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 form-groupe" >
			<?php $attributes = array("name" => "myform");
			echo form_open_multipart("consultants/do_upload");?>
			<fieldset class="fieldset" name="fset">
				<label for="mycv"></label>
				<input type="file" name="mycv" class="form-controle">
				<input type="submit" class="btn btn-success form-controle" value="Upload" onclick="window.close()">
			</fieldset>
			<?php echo form_close(); ?>
		</div>
	</div>
</section>
<script type="text/javascript">
	window.onunload = function(){
		window.opener.location.reload();
	};
</script>