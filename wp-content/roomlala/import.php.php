<?php
	require 'connection.php';
	require_once("../../wp-load.php");

	print_r(get_posts(array('post_type' => 'opalestate_property')));
	echo "Yooooooooooo";
	print_r(get_post_meta(8815, true));
?>