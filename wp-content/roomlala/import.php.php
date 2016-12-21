<?php
	require_once 'connection.php';
	require_once("../../wp-load.php");
	require_once 'functions.php';

	// $response = file_get_contents('https://fr-fr.roomlala.com/prod/file/welchome/ads_fr.xml');
	// $response = new SimpleXMLElement($response);

	// echo $response;

	// $success = file_get_contents_chunked("https://fr-fr.roomlala.com/prod/file/welchome/ads_fr.xml",4096,function($chunk,&$handle,$iteration){
	    /*
	        * Do what you will with the {&chunk} here
	        * {$handle} is passed in case you want to seek
	        ** to different parts of the file
	        * {$iteration} is the section fo the file that has been read so
	        * ($i * 4096) is your current offset within the file.
	    */

	//     echo $chunk;
	//     echo " -------------------------------------- ";

	// });

	// if(!$success) {
	//     //It Failed
	// }

	file_get_contents("https://fr-fr.roomlala.com/prod/file/welchome/ads_fr.xml");
?>