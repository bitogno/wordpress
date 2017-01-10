<div class="modal fade" id="modal-boards">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<p class="h3">Boards:</p>

				<div class="list-group">
<?php foreach ($boards as $board) : ?>
					<a href="#board-<?php echo $board->id ?>" data-toggle="tab" class="list-group-item" data-dismiss="modal">
						<?php echo stripcslashes($board->title) ?>
					</a>
<?php endforeach // boards ?>
				</div><!-- list-group -->
			</div><!-- body -->
		</div>
	</div>
</div>
