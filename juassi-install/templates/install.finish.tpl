<div class="row">
	<div class="span4">
		<h3>Installation log</h3>
		<?php if (empty($this->description)): ?>
		<p>You can also copy the content to that file. You can see it in a box after you
			<a href="javascript:void(0);" onclick="if (document.getElementById('file_content').style.display=='block') { document.getElementById('file_content').style.display='none';} else {document.getElementById('file_content').style.display='block'}">click here</a>.</p>
		<?php endif ?>
		<p><strong>Thank you for choosing C-Blog.</strong></p>
	</div>
	<div class="span8">
		<div class="well">
			<div>
				<h4>Database Installation</h4>
				<?php if ($this->message): ?>
				<div class="alert alert-error">Error during MySQL queries execution:</div>
				<?php echo $this->message ?>
				A copy of the configuration file will be downloaded
				to your computer when you click the button 'Download config.inc.php'.
				You should upload this file to the same directory where you have Subrion CMS.
				Once this is done you should log in using the admin credentials you provided on the previous form and
				configure the software according to your needs.
				<?php else: ?>
				<div class="alert alert-success">OK</div>
				<?php endif ?>
			</div>
			<div>
				<h4>Configuration File</h4>
				<?php if ($this->description): ?>
				<div class="alert alert-error">Error during configuration write:</div>
				<?php echo $this->description ?><br />
				You MUST save config.inc.php file to your local PC and then upload to C-Blog includes directory.
				<?php else: ?>
				<div class="alert alert-success">Configuration file has been saved. Please change permissions to unwritable for secure reason!</div>
				<?php endif ?>
				<form method="post" action="<?php echo URL_INSTALL ?><?php echo $this->module ?>/download/">
					<input type="hidden" value="<?php echo iaHelper::_html($this->config) ?>" name="config_content" />
					<button type="submit" class="btn btn-success btn-plain"><i class="icon-download-alt icon-white"></i> Download config file</button>
				</form>
			</div>
			<div>
				<h4>Installation Folder</h4>
				<div class="alert alert-message">In safety purposes you now have to remove the <em style="white-space: nowrap;">/install/modules/module.install.php</em> file.</div>
			</div>
		</div>
	</div>
</div>

<div style="<?php if (empty($this->description)): ?>display: none; '<?php endif ?>margin: auto; border: 1px solid #777; background-color: #ededed; padding:10px;overflow:auto;width:650px;" id="file_content" class="well">
	<?php echo highlight_string($this->config, true) ?>
</div>

<div class="form-actions">
	<a href="<?php echo URL_INSTALL ?><?php echo $this->module ?>/configuration/" class="btn btn-large"><i class="icon-arrow-left"></i> Back</a>
	<a href="<?php echo URL_INSTALL ?><?php echo $this->module ?>/plugins/" class="btn btn-large btn-info"><i class="icon-download icon-white"></i> Install Plugins</a>
	<a href="<?php echo URL_HOME ?>admin/" class="btn btn-large btn-primary"><i class="icon-cog icon-white"></i> to Admin panel</a>
	<a href="<?php echo URL_HOME ?>" class="btn btn-large btn-primary"><i class="icon-home icon-white"></i> to Home page</a>
</div>
