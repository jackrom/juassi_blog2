<?php if ($this->error): ?>
	<div class="min-height">
		<div class="alert alert-error">Unable to download the patch file.</div>
		<p>Could not continue.</p>
	</div>

	<div class="form-actions">
		<a href="<?php echo URL_INSTALL ?><?php echo $this->module ?>/<?php echo $this->step ?>/" class="btn btn-large"><i class="icon-refresh"></i> Try again</a>
	</div>
<?php else: ?>
	<form method="get" action="<?php echo URL_INSTALL ?><?php echo $this->module ?>/finish/">

	<div class="min-height">
		<div class="alert alert-info">Patch file downloaded.</div>
		<p>Patch size is <strong><?php echo number_format($this->size / 1024) ?> Kb</strong>.</p>
		<p>Click <strong>&laquo;Upgrade&raquo;</strong> button to perform the upgrade.</p>
		<p><i class="icon-wrench"></i> <a href="#" id="js-open-details">Advanced options</a>.</p>
		<div class="span3 hide" id="js-advanced-section">
			<label for="option-force">
				<input type="checkbox" name="mode" id="option-force" value="force" /> 
				<span class="label label-info">force file re-upload</span>
			</label>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function()
	{
		$('#js-open-details').click(function(e)
		{
			e.preventDefault();
			$('#js-advanced-section').slideToggle();
		});
	});
	</script>

	<div class="form-actions">
		<button type="submit" class="btn btn-large btn-primary">Upgrade <i class="icon-ok icon-white"></i></button>
	</div>

	</form>
<?php endif ?>