<?php foreach ($boards as $board) : ?>
<div class="list-group task-move-list-board-statuses task-move-list-board-statuses-<?php echo $board->id ?>" data-board-id="<?php echo $board->id ?>" style="display: none;">
	<?php foreach ( $board->statuses as $status_id => $status ) : ?>
		<a href="#" class="list-group-item" data-status-id="<?php echo $status_id ?>" data-board-id="<?php echo $board->id ?>" data-dismiss="modal">
			<h3 class="h4"><?php echo $status->title ?></h3>
			<div class="task-handle" style="background-color: <?php echo $status->color_hex ?>"></div>
		</a><!-- list-group-item -->
	<?php endforeach // statuses ?>
</div><!-- list-group -->
<?php endforeach; // boards ?>