<?php
ini_set('memory_limit', '2048M');
	require_once 'connection.php';
	require_once("../../wp-load.php");
	require_once 'functions.php';
  require_once 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

// On charge le fichier XML
$inputFileName = 'agences-immo.xlsx';

//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
for ($row = 2; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
 
    $new_property = array(
    	'post_author'=>1,
    	'post_title'=>$rowData[0][0],
    	'post_content' =>"Test agence immobilière",
    	'post_status'=>'publish',
    	'comment_status'=>"open",
    	'post_name'=>$rowData[0][0],
    	'post_type'=>'opalestate_agent'
 	);
  	$post_id = wp_insert_post($new_property);


	update_post_meta($post_id, '_thumbnail_id', '11915');
	update_post_meta($post_id, 'opalestate_agt_mobile', '0'.$rowData[0][4]);
	update_post_meta($post_id, 'opalestate_agt_phone', '0'.$rowData[0][4]);
	update_post_meta($post_id, 'opalestate_agt_email', $rowData[0][7]);
	update_post_meta($post_id, 'opalestate_agt_address', $rowData[0][1]." ".$rowData[0][2]." ".$rowData[0][3]);
	//update_post_meta($post_id, 'opalestate_property_gallery', $longitude);
	update_post_meta($post_id, 'opalestate_ppt_price', $price_monthly);
	update_post_meta($post_id, 'opalestate_ppt_pricelabel', "par mois");
	update_post_meta($post_id, 'opalestate_ppt_bedrooms', $bedrooms);
	update_post_meta($post_id, 'opalestate_ppt_areasize', $floor_area);
	update_post_meta($post_id, 'opalestate_ppt_agent', "9753");
	update_post_meta($post_id, '_wp_trash_meta_status', "publish");
	update_post_meta($post_id, 'opalestate_ppt_address', $city);

	if(!term_exists($rowData[0][3], 'opalestate_location')){
		// $sql = "INSERT INTO wp_terms (name, slug, term_group) VALUES ('".$rowData[0][3]."', '".$rowData[0][3]."', 0)";
		$term_id = wp_insert_term($rowData[0][3], "opalestate_location");
		$terms = array($term_id['term_id']);
		wp_set_post_terms( $post_id, $terms, "opalestate_location");
	} else {
		$term_id = term_exists($rowData[0][3], 'opalestate_location');
		$terms = array($term_id['term_id']);
		wp_set_post_terms( $post_id, $terms, "opalestate_location");
	}
}

?>