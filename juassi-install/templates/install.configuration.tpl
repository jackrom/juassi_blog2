<form action="<?php echo URL_INSTALL ?><?php echo $this->module ?>/configuration/" method="post" class="form-horizontal">

	<div class="row">
		<div class="span4">
			<h3>Common Configuration</h3>
			<p>Configure correct paths and URLs to your C-Blog.</p>
			<p>Please select a template from a list of available templates uploaded to your templates directory.</p>
		</div>
		<div class="span8">
			<div class="well">
				<div class="control-group">
					<label class="control-label">Installation URL:</label>
					<div class="controls">
						<input type="text" value="<?php echo URL_HOME ?>" disabled="disabled" class="disabled" />
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Default Template:</label>
					<div class="controls">
						<?php if (count($this->templates) == 1): ?>
						<select disabled="disabled">
							<option value="<?php echo $this->template ?>"><?php echo ucfirst($this->template) ?></option>
						</select>
						<strong><?php echo $this->templates[0] ?></strong>
						<input type="hidden" name="tmpl" id="tmpl" value="<?php echo $this->templates[0] ?>" />
						<?php else: ?>
						<select name="tmpl" id="tmpl">
							<?php foreach ($this->templates as $entry): ?>
							<option value="<?php echo $entry ?>"<?php if ($this->template == $entry): ?> selected="selected"<?php endif ?>><?php echo ucfirst($entry) ?></option>
							<?php endforeach ?>
						</select>
						<?php endif ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Debug Mode:</label>
					<div class="controls">
						<select name="debug" id="debug">
							<option value="0"<?php if (Helper::getPost('debug', 0) == 0): ?> selected="selected"<?php endif ?>>Do not display errors</option>
							<option value="1"<?php if (Helper::getPost('debug', 0) == 1): ?> selected="selected"<?php endif ?>>Display errors in a special block</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<h3>MySQL Configuration</h3>
			<p>Setting up C-Blog to run on your server involves 3 simple steps...</p>
			<p>Please enter the hostname of the server C-Blog is to be installed on.</p>
			<p>Enter the MySQL username, password and database name you wish to use with C-Blog.</p>
			<p>Enter the a table name prefix to be used by C-Blog and select what to do with existing tables from former installations.</p>
		</div>
		<div class="span8">
			<div class="well">
				<div class="control-group" id="err_dbhost">
					<label class="control-label">DB Hostname:</label>
					<div class="controls">
						<input type="text" name="dbhost" id="dbhost" value="<?php echo Helper::getPost('dbhost', 'localhost') ?>" />
						<span class="help-inline" style="display: none;">Please input correct hostname.</span>
					</div>
				</div>
				<div class="control-group" id="err_dbuser">
					<label class="control-label">DB Username:</label>
					<div class="controls">
						<input type="text" name="dbuser" id="dbuser" value="<?php echo Helper::getPost('dbuser') ?>" />
						<span class="help-inline" style="display: none;">Please input correct username.</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">DB Password:</label>
					<div class="controls">
						<input type="password" name="dbpwd" id="dbpwd" value="" />
					</div>
				</div>
				<div class="control-group" id="err_dbname">
					<label class="control-label">DB Name:</label>
					<div class="controls">
						<input type="text" name="dbname" id="dbname" value="<?php echo Helper::getPost('dbname') ?>" />
						<span class="help-inline" style="display: none;">Please input correct db name.</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">MySQL Port:</label>
					<div class="controls">
						<input type="text" name="dbport" id="dbport" value="<?php echo (int)Helper::getPost('dbport', 3306) ?>" />
					</div>
				</div>
				<div class="control-group" id="err_prefix">
					<label class="control-label">Table Prefix:</label>
					<div class="controls">
						<input type="text" name="prefix" id="prefix" value="<?php echo Helper::getPost('prefix', 'cb' . JUASSI_VER . '_', false) ?>" />
						<span class="help-inline" style="display: none;">Please specify the table prefix.</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="delete_tables">Drop Tables: </label>
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" id="delete_tables" name="delete_tables"<?php if (Helper::getPost('delete_tables', false)): ?> checked="checked"<?php endif ?> />
							Your existing tables will be dropped if checked.
						</label>
					</div>
				</div>
				<input type="hidden" name="db_action" id="db_action" value="1" />
			</div>
		</div>
	</div>


	<div class="row">
		<div class="span4">
			<h3>Administrator Configuration</h3>
			<p>Please set your admin username. It will be used for logging into your admin panel.</p>
			<p>You should input admin password. Make sure your entered passwords match each other.</p>
			<p>Input your email. All the notifications will be sent from this email. It can be changed in your admin panel later.</p>
		</div>
		<div class="span8">
			<div class="well">
				<div class="control-group" id="err_admin_username">
					<label class="control-label">Username:</label>
					<div class="controls">
						<input type="text" name="admin_username" id="admin_username" value="<?php echo Helper::getPost('admin_username', 'admin') ?>" />
						<span class="help-inline" style="display: none;">Please input correct username.</span>
					</div>
				</div>
				<div class="control-group" id="err_admin_password">
					<label class="control-label">Password:</label>
					<div class="controls">
						<input type="password" name="admin_password" id="admin_password" />
						<span class="help-inline" style="display: none;">Please input password.</span>
					</div>
				</div>
				<div class="control-group" id="err_admin_password2">
					<label class="control-label">Confirm Password:</label>
					<div class="controls">
						<input type="password" name="admin_password2" id="admin_password2" />
						<span class="help-inline" style="display: none;">Passwords do not match.</span>
					</div>
				</div>
				<div class="control-group" id="err_admin_email">
					<label class="control-label">Email:</label>
					<div class="controls">
						<input type="text" name="admin_email" id="admin_email" value="<?php echo Helper::getPost('admin_email') ?>" />
						<span class="help-inline" style="display: none;">Please input correct email.</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="form-actions">
		<a href="<?php echo URL_INSTALL ?><?php echo $this->module ?>/license/" class="btn btn-large" tabindex="-1"><i class="icon-chevron-left"></i> Back</a>
		<button type="submit" class="btn btn-large btn-primary" tabindex="1">Install <i class="icon-ok icon-white"></i></button>
	</div>
</form>

<?php if ($this->errorList): ?>
<script type="text/javascript">
	<?php foreach ($this->errorList as $field): ?>
	document.getElementById('err_<?php echo $field ?>').className += ' error';
	document.getElementById('err_<?php echo $field ?>').getElementsByTagName('span')[0].style.display = 'inline';
	<?php endforeach ?>
	document.getElementById('<?php echo $field[0] ?>').focus();
</script>
<?php endif ?>