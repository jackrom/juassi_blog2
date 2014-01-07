<?php if ($this->errorCode): ?>
	<div class="min-height">
	<?php if ('authorization' == $this->errorCode): ?>
		<div class="alert alert-error">Please log in as an administrator to proceed.</div>
	<?php elseif ('version' == $this->errorCode): ?>
		<div class="alert alert-warning">Incorrect upgrade version specified.</div>
	<?php elseif ('remote' == $this->errorCode): ?>
		<div class="alert alert-error">Could not continue.</div>
		<p>The patch file could not be downloaded because of server settings.</p>
		<p>You have to modify the server settings in order to be able to go ahead.</p>

		<h3>Settings to be modified</h3>
		<ul>
			<li>PHP option <em>allow_url_fopen</em></li>
			<li>PHP extension <em>cUrl</em></li>
		</ul>
	<?php endif ?>
	</div>

	<div class="form-actions">
		<a href="<?php echo URL_INSTALL ?><?php echo $this->module ?>/" class="btn btn-large"><i class="icon-refresh"></i> Refresh</a>
	</div>
<?php else: ?>
	<div class="min-height">
		<p>Getting ready to download the patch file from the Intelliants servers...</p>
		<p>Click &laquo;Next&raquo; button to continue.</p>

		<p style="margin-top: 50px;"><i class="icon-list-alt"></i> <a href="#changelog-details" data-toggle="modal">Show changelog details</a></p>
	</div>

	<div class="form-actions">
		<a href="<?php echo URL_INSTALL ?><?php echo $this->module ?>/download/" class="btn btn-large btn-primary">Next <i class="icon-arrow-right icon-white"></i></a>
	</div>

	<div id="changelog-details" class="modal hide fade" tabindex="-1" data-labelledby="dialog-header" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="dialog-header">Changelog Details</h3>
		</div>
		<div class="modal-body" style="height: 200px;">
			<div class="alert alert-block">Could not get changelog details from Intelliants.</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function()
	{
		$.getJSON('http://tools.subrion.com/changelog.json?fn=?', {version: '<?php echo $this->version ?>'}, function(response)
		{
			$('.modal-body:first', '#changelog-details').html(response.html);
		});
	});
	</script>
<?php endif ?>