<div id="js-page-initial">
	<div class="row">
		<?php if ($this->plugins): ?>
		<div class="span4">
			<div id="plugins-control" data-spy="affix" data-offset-top="300">
				<h3>Available plugins</h3>
				<p>You could select plugins you want to install on the right side. Selected plugins will be downloaded from the site of Subrion CMS. Sure, you are able to manage plugins in Admin Panel later.</p>
				<hr>
				<div class="btn-group js-selection-controls">
					<button class="btn btn-small" rel="select">Select all</button>
					<button class="btn btn-small" rel="invert">Invert selection</button>
					<button class="btn btn-small" rel="drop">Clear selection</button>
				</div>
				<p>
					Plugins selected to install: 
					<strong id="js-counter" class="badge badge-inverse">0</strong>
				</p>
				<button class="btn btn-block btn-success" id="js-btn-proceed" disabled="disabled"><i class="icon-download icon-white"></i> Install selected plugins</button>
			</div>
		</div>
		<div class="span8">
			<?php foreach ($this->plugins as $name => $entry): ?>
			<div class="item-plugin">
				<div class="item-plugin-image">
					<img src="<?php echo $entry->logo ?>" alt="<?php echo $entry->title ?>" title="Click to mark to install" width="80" />
				</div>
				<div class="item-plugin-desc">
					<h4><?php echo $entry->title ?></h4>
					<p><?php echo $entry->description ?></p>
					<p>Last Updated: <?php echo date('M d, Y', $entry->date) ?></p>
					<div class="item-plugin-actions">
						<input type="checkbox" name="plugins[]" value="<?php echo $name ?>" id="cb_<?php echo $name ?>" rel="<?php echo $entry->title ?>" />
						<?php if (!isset($entry->installed)): ?>
						<a href="#" class="btn btn-small btn-success plugin-check">Select</a>
						<?php endif ?>
						<a href="<?php echo $entry->url ?>" target="_blank" class="btn btn-small">Details</a>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<?php endif ?>
	</div>

	<div class="form-actions">
		<a href="<?php echo URL_HOME ?>admin/" class="btn btn-large"><i class="icon-cog"></i> to Admin panel</a>
		<a href="<?php echo URL_HOME ?>" class="btn btn-large"><i class="icon-home"></i> to Home page</a>
	</div>
</div>

<div id="js-page-installation-log" style="display: none;">
	<div class="min-height">
		<div id="js-progress-bar" class="alert alert-info">
			Installation is in progress...
			<strong><span id="js-counter-current">1</span> of <span id="js-counter-total"></span></strong>
			<img src="<?php echo URL_INSTALL ?>templates/img/loading.gif" alt="loading..." />
		</div>
		<p>Check the status of plugins you selected to install.</p>
		<p>Missed a plugin? <a href="<?php echo URL_INSTALL ?><?php echo $this->module ?>/<?php echo $this->step ?>/">Show the list again</a>.</p>
		<hr />
		<h2>Plugins installation log</h2>
		<div class="well well-large">
			<ul class="unstyled" id="js-log">
				<li>Started batch installation...</li>
			</ul>
		</div>
	</div>
	<div class="form-actions">
		<a href="<?php echo URL_HOME ?>admin/" class="btn btn-large btn-primary">to Admin panel <i class="icon-cog icon-white"></i></a>
		<a href="<?php echo URL_HOME ?>" class="btn btn-large btn-primary">to Home page <i class="icon-home icon-white"></i></a>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function()
{
	// Check button functionality
	function checkPlugin (which)
	{
		which.attr('checked', 'checked').trigger('change')
		     .parents('.item-plugin').addClass('checked');
		which.next().text('Unmark');
	}
	function uncheckPlugin (which)
	{
		which.removeAttr('checked').trigger('change')
		     .parents('.item-plugin').removeClass('checked');
		which.next().text('Select');
	}

	$('.item-plugin-image').bind('click', function(e)
	{
		$(this).parent().find('.plugin-check').trigger('click');
	});

	$('.plugin-check').bind('click', function(e)
	{
		e.preventDefault();
		$(this).prev().is(':checked')
			? uncheckPlugin($(this).prev())
			: checkPlugin($(this).prev());
	});

	$('input[name="plugins[]"]').bind('change', function()
	{
		var count = $('input[name="plugins[]"]:checked').length;
		$('#js-counter').text(count);
		count ? $('#js-btn-proceed').removeAttr('disabled') : $('#js-btn-proceed').attr('disabled', 'disabled');
	});

	$('.js-selection-controls .btn').bind('click', function()
	{
		var scope = $('input[name="plugins[]"]');
		switch ($(this).attr('rel'))
		{
			case 'drop':
				scope.removeAttr('checked');
				uncheckPlugin(scope);
				break;
			case 'invert':
				scope.each(function(i, entry)
				{
					if ($(entry).is(':checked'))
					{
						uncheckPlugin($(entry));
					} else 
					{
						checkPlugin($(entry));
					}
				});
				break;
			default:
				scope.attr('checked', 'checked');
				checkPlugin(scope);
		}
		$('input[name="plugins[]"]:first').trigger('change');
	});

	$('#js-btn-proceed').bind('click', function(e)
	{
		e.preventDefault();

		$('#js-page-initial').hide();
		$('#js-page-installation-log').fadeIn('slow', function()
		{
			var counter = 0;
			var elementsSet = $('input[name="plugins[]"]:checked');
			$('#js-counter-total').text(elementsSet.length);
			elementsSet.each(function(i, item)
			{
				item = $(item);
 				$.ajax({
					type: 'POST',
					url: '<?php echo URL_INSTALL ?>install/plugins/',
					data: {plugin: item.val()},
					dataType: 'html',
					success: function(resultMessage) {
						counter++;
						$('#js-counter-current').text(counter + 1);
						$('<li>').html('<span class="label">' + item.attr('rel') + '</span> ' + resultMessage).appendTo('#js-log');
						if (elementsSet.length == counter)
						{
							$('#js-progress-bar')
								.toggleClass('alert-info alert-success')
								.text('Installation completed.');
							$('<li>').text('Finished.').appendTo('#js-log');
						}
					}
				});
			});
		});
	});
});
</script>