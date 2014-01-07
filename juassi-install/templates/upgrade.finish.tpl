<div class="content">
	<?php if (!isset($this->message)): ?>
	<div class="alert alert-info">Upgrade completed.</div>
	<p>Installation log has been also saved to temporary folder.</p>
	<div id="upgrade-log"><?php echo $this->log ?></div>
	<div id="upgrade-log-legend">
		<h6>Legend</h6>
		<p><span class="label label-success">SUCCESS</span> <b>File successfully written</b> &mdash; <i>file has been overwritten by the file that comes in the patch</i>.</p>
		<p><span class="label label-important">ERROR</span> <b>The checksum is not equal</b> &mdash; <i>file md5() hash checksum does not match the default one that comes with Subrion software. It's possible this file was modified on your server</i>.</p>
	</div>
	<?php endif ?>
</div>

<div class="form-actions">
	<a href="<?php echo URL_HOME . 'admin/' ?>" class="btn btn-large btn-primary">to Admin panel <i class="icon-cog icon-white"></i></a>
	<a href="<?php echo URL_HOME ?>" class="btn btn-large btn-primary">to Home page <i class="icon-arrow-right icon-white"></i></a>
</div>