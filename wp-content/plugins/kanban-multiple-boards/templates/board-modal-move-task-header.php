<p>
	<select class="move-task-select-board form-control input-lg">
		<?php foreach ( $boards as $board ) : ?>
			<option value="<?php echo $board->id ?>" <?php echo $board->id == $board_id ? 'selected' : '' ?>>
				<?php echo $board->title ?>
			</option><!-- list-group-item -->
		<?php endforeach // boards ?>
	</select><!-- list-group -->
</p>