<p>
	<small>You are editing</small><br>
	<select id="select-multiple-boards" style="background: white; box-shadow: none; border: 0; font-size: 2em; font-weight: bold; height: auto; padding: 0;">
<?php foreach ( $boards as $board_id => $board ) : ?>
		<option value="<?php echo add_query_arg(array('board_id' => $board->id)) ?>" <?php echo $board->id == $current_board->id ? 'selected' : '' ?>>
			<?php echo stripcslashes($board->title) ?>
		</option>
<?php endforeach // boards ?>
	</select>
</p>