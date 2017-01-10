<?php
global $wpdb;
$wpdb->insert( 
  'wp_kanban_boards', 
  array( 
    'title' => 'value1', 
    'user_id_author' => 123 
  )
);

?>