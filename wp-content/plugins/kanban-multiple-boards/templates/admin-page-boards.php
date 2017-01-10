<link rel="stylesheet" href="<?php echo Kanban::get_instance()->settings->uri ?>/css/admin.css">



<div class="wrap">
	<h1>
		<?php echo __( sprintf( '%s Boards', Kanban::get_instance()->settings->pretty_name ), 'kanban' ); ?>
		<a href="<?php echo sprintf( '%s/%s/board', home_url(), Kanban::$slug ); ?>" class="page-title-action" target="_blank" id="btn-go-to-board" onclick="window.open('<?php echo sprintf( '%s/%s/board', home_url(), Kanban::$slug ); ?>', 'kanbanboard'); return false;">
			<?php echo __( 'Go to your board', 'kanban' ); ?>
		</a>
	</h1>



<?php if ( isset( $_GET['message'] ) ) : ?>
	<div class="updated">
		<p><?php echo $_GET['message']; ?></p>
	</div>
<?php endif // message ?>



	<form action="" method="post" class="tab">
		<ol id="list-boards" class="sortable">
<?php foreach ( $boards as $board_id => $board ) : ?>
	<?php echo Kanban_Template::render_template(sprintf('%s/templates/t-board.php', $plugin_dir_path), (array) $board) ?>
<?php endforeach // boards ?>
		</ol><!-- sortable -->
		<p>
			<button type="button" class="button button-sortable-add" data-t="t-board">
					<?php echo __( 'Add another board', 'kanban' ); ?>
				</button>
		</p>

		<?php submit_button(
			__( 'Save your Boards', 'kanban' ),
				'primary',
				'submit'
		); ?>


		<?php wp_nonce_field( 'kanban-boards', Kanban_Utils::get_nonce() ); ?>

	</form>



</div><!-- wrap -->




<script type="text/html" id="t-board">

<?php include sprintf('%s/templates/t-board.php', $plugin_dir_path) ?>

</script>
