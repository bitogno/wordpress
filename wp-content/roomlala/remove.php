<?php
	require_once 'connection.php';
	require_once("../../wp-load.php");
	require_once 'functions.php';

  $sql = "SELECT id FROM wp_posts WHERE post_author='4'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $sql = "DELETE FROM wp_postmeta WHERE post_id='".$row["id"]."'";

      if ($conn->query($sql) === TRUE) {
          echo "Record deleted successfully";
      } else {
          echo "Error deleting record: " . $conn->error;
      }

      wp_delete_post( $row["id"], $force_delete );
    }
} else {
    echo "0 results";
}
?>