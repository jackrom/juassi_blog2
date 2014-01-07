<?php foreach ($this->sections as $name => $item): ?>
<div class="row">
	<div class="span4">
		<h3><?php echo $item['title'] ?></h3>
		<p><?php echo $item['desc'] ?></p>
	</div>
	<div class="span8">
		<table class="table table-bordered pre-install">
			<?php if ('recommended' == $name): ?>
			<thead>
			<tr>
				<th>Directive</th>
				<th>Recommended</th>
				<th>Actual</th>
			</tr>
			</thead>
			<?php endif ?>
			<tbody>
			<?php foreach ($this->checks[$name] as $key => $check): ?>
			<tr>
				<td<?php if (isset($check['class'])): ?> class="elem"<?php endif ?> style="width: 220px;">
				<?php echo $check['name'] ?>
				<?php if (isset($check['required'])): ?><span class="label label-warning">Required</span> <?php endif ?>
				</td>
				<?php echo $check['value'] ?>
			</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<?php endforeach ?>

<div class="form-actions">
	<a href="<?php echo URL_INSTALL . $this->module ?>/" class="btn btn-large btn-success"><i class="icon-refresh icon-white"></i> Check</a>
	<?php if ($this->nextButton): ?>
	<a href="<?php echo URL_INSTALL . $this->module ?>/license/" class="btn btn-large btn-primary">Next <i class="icon-chevron-right icon-white"></i></a>
	<?php else: ?>
	<a href="<?php echo URL_INSTALL . $this->module ?>/" class="btn btn-large btn-danger disabled">Next <i class="icon-remove"></i></a>
	<?php endif ?>
</div>