<ul class="nav nav-tabs" id="tabs-boards" data-current-board-title="<?php echo $current_board->title ?>">
<?php foreach ($boards as $board) : ?>
	<li class="<?php echo $current_board->id == $board->id ? 'active' : '' ?>">
		<a href="#board-<?php echo $board->id ?>" data-toggle="tab">
			<?php echo stripcslashes($board->title) ?>
		</a>
	</li>
<?php endforeach // boards ?>
</ul>