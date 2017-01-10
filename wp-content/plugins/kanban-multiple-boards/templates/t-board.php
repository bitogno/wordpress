<li>
	<small class="handle"><?php echo __( 'Reorder', 'kanban' ); ?></small>
	<label class="board-name">
		<?php echo __( 'Name', 'kanban' ); ?>:
		<input type="text" name="boards[saved][<?php echo isset($id) ? $id : ''; ?>][title]" data-name="boards[new][count][title]" value="<?php echo isset($title) ? esc_attr(stripcslashes($title)) : ''; ?>">
	</label>
	<input type="hidden" name="boards[saved][<?php echo isset($id) ? $id : ''; ?>][position]" data-name="boards[new][count][position]" value="<?php echo isset($position) ? sprintf('%03d', $position) : ''; ?>" class="position">
<?php if ( isset($id) ) : ?>
	<a href="<?php echo admin_url('admin.php?page=kanban_settings&board_id=' . $id) ?>"><?php echo __( 'Settings', 'kanban' ); ?></a>
	&nbsp;
	<a href="<?php echo admin_url('admin.php?kanban-action=' . wp_create_nonce('kanban_boards_copy') . '&board_id=' . $id) ?>"><?php echo __( 'Copy', 'kanban' ); ?></a>

<?php else : // id ?>
	<span style="opacity: .382;" title="<?php echo __( 'Save your changes to access these settings', 'kanban' ); ?>">
		<?php echo __( 'Settings', 'kanban' ); ?>
	</span>
	&nbsp;
	<span style="opacity: .382;" title="<?php echo __( 'Save your changes to access these settings', 'kanban' ); ?>">
		<?php echo __( 'Copy', 'kanban' ); ?>
	</span>
<?php endif ?>
	<button type="button" class="delete" data-confirm="<?php echo isset($id) ? __('Are you sure? This will remove access to all tasks on this board.', 'kanban') : '' ?>">
		<?php echo __( 'Delete', 'kanban' ); ?>
	</button>
</li>
