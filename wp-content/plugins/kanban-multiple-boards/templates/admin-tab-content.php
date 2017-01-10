<div class="tab" id="tab-boards" style="display: none;">

	<ol id="list-boards" class="sortable">
<?php foreach ( $boards as $board_id => $board ) : ?>
		<?php echo Kanban_Template::render_template(sprintf('%s/templates/t-board.php', $plugin_dir_path), (array) $board) ?>
<?php endforeach // boards ?>
	</ol><!-- sortable -->
	<p>
		<button type="button" class="button" id="add-board">
			<?php echo __( 'Add another board', 'kanban' ); ?>
		</button>
	</p>

	<?php submit_button(
		__( 'Save your Settings', 'kanban' ),
			'primary',
			'submit'
	); ?>
</div><!-- tab-boards -->



<script type="text/html" id="t-task-color">

<?php include sprintf('%s/templates/t-board.php', $plugin_dir_path) ?>

</script>



<script>
jQuery(function($)
{


	var t_board = new t($('#t-board').html());

	$('#add-board').on(
		'click',
		function()
		{
			// get count of new boards
			var new_count = $('#list-boards li.new').length;

			// render the new board
			var html = t_board.render();

			// add the board count
			html = html.replace(/\[count\]/g, '[' + new_count + ']');

			// append it
			var $html = $(html).addClass('new').appendTo('#list-boards');

			// replace the names
			$('[data-name]', $html).each(function()
			{
				$(this).attr('name', $(this).attr('data-name') );
			});

			// activate color pickers
			$('.color-picker', $html).wpColorPicker();

			set_positions();
		}
	);

	$('#list-boards').on(
		'click',
		'.delete',
		function()
		{
			$(this)
			.closest('li')
			.slideUp(
				'fast',
				function()
				{
					$(this).remove();
				}
			);
		}
	);


});
</script>



<input type="hidden" name="board_id" value="<?php echo $current_board->id ?>">



<script type="text/html" id="t-board">

<?php include sprintf( '%s/t-board.php', __DIR__ ); ?>

</script>
