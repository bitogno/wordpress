<?php

  define('DIRECTORY', '../uploads');
	require_once 'connection.php';
	require_once("../../wp-load.php");
	require_once 'functions.php';

// On charge le fichier XML
// $xml=simplexml_load_file('https://fr-fr.roomlala.com/prod/file/welchome/ad_en_ca.xml');
	$xml=simplexml_load_file('testRoomlala.xml');
$count = 0;
$count_img = 1;
// On le parcourt
foreach($xml as $property){

  // Pour chaque propriété, on a :

  $id = (int)$property->id;
  $url = (string)$property->url;
  $title = (string)$property->title;
  $type = (string)$property->type;
  $ad_type = (string)$property->ad_type;
  $content = (string)$property->content;
  foreach($property->price as $price){
    switch($price['period']){
      case 'daily':
      $price_daily = (int)$price;
      break;
      case 'weekly':
      $price_weekly = (int)$price;
      break;
      case 'monthly':
      $price_monthly = (int)$price;
      break;
    }
  }

  $city = (string)$property->city;
  $country = (string)$property->country;
  $postcode = (int)$property->postcode;
  $latitude = floatval((string)$property->latitude);
  $longitude = floatval((string)$property->longitude);

  // Un peu tricky ici ; soit on stocke un tableau d'objets "image" (URL + titre de l'image)
  // Soit on le fait à l'arrache et on stocke image1 = http://url_image.fr , titre_image_1 = "titre", image2 = ... etc., plus facile à mettre dans postmeta
  // Je fais un exemple des deux

  $picturePartner = $property->pictures->picture->picture_url->__toString();


  // Solution 2 :
  $picture1 = (string) $property->pictures[0]->picture_url;
  $title_picture_1 = (string) $property->pictures[0]->picture_title;
  // etc etc pour picture2, 3...


  $available_from = (string)$property->available_from;
  $bedrooms = (int)$property->bedrooms;
  $double_bed = (int)$property->double_bed;
  $single_bed = (int)$property->single_bed;
  $sofa_bed = (int)$property->sofa_bed;
  $capacity = (int)$property->capacity;
  $floor_area = (int)$property->floor_area;
  $date = (string)$property->date;
  $datemodification = (string)$property->datemodification;
  $currency = (string)$property->currency;
  $type_annonce = (string)$property->type_annonce;

  $map = array();
  $map['addess'] = "";
  $map['latitude'] = $latitude;
  $map['longitude'] = $longitude;

  // Une fois qu'on a tous les éléments, on crée un nouveau post avec les éléments de base de la propriété :
  // EXEMPLE, où on récupère en même temps l'ID du post pour ensuite rajouter les metadata :
  $new_property = array(
    'post_author'=>4,
    'post_title'=>$title,
    'post_content' =>$content,
    'post_status'=>'publish',
    'comment_status'=>"open",
    'post_name'=>$title,
    'post_type'=>'opalestate_property',
    'post_excerpt'=>$picturePartner,
    'guid'=>$url
  );
  $post_id = wp_insert_post($new_property);

  $picturePartner = preg_replace('/\s+/', '', $picturePartner);  var_dump($picturePartner);


  $img_name = (string)$count_img;
  if(get_http_response_code($picturePartner) != "200"){
      echo "error";
  }else{
    echo "yo";
      $imageReceived = file_get_contents($picturePartner);
      file_put_contents("../uploads/".$img_name.".jpeg", $imageReceived);
      $attachment = array(
        'post_author' => 4,
        'post_mime_type' => 'image/jpeg',
        'post_title' => 'thumbnail Roomlala',
        'post_content' => '',
        'post_status' => 'inherit'
      );
      $attach_id = wp_insert_attachment( $attachment, "../uploads/".$img_name.".jpeg", $post_id );
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      $attach_data = wp_generate_attachment_metadata( $attach_id, "../uploads/".$img_name.".jpeg" );
      $res1 = wp_update_attachment_metadata( $attach_id, $attach_data );
      $res2 = set_post_thumbnail( $post_id, $attach_id );
      $count_img = $count_img +1;
  }


  // Ensuite on update les métadata, une fois que la nouvelle propriété (le nouveau post) est créé
  // EXEMPLE (à modifier)
  update_post_meta($post_id, 'url_roomlala', $url);
  update_post_meta($post_id, 'opalestate_ppt_map_latitude', $latitude);
  update_post_meta($post_id, 'opalestate_ppt_map_longitude', $longitude);
  update_post_meta($post_id, 'opalestate_ppt_zipcode', $postcode);
  update_post_meta($post_id, 'opalestate_ppt_enablemapview', "1");
  //update_post_meta($post_id, 'opalestate_property_gallery', $longitude);
  update_post_meta($post_id, 'opalestate_ppt_price', $price_monthly);
  update_post_meta($post_id, 'opalestate_ppt_pricelabel', "par mois");
  update_post_meta($post_id, 'opalestate_ppt_bedrooms', $bedrooms);
  update_post_meta($post_id, 'opalestate_ppt_areasize', $floor_area);
  update_post_meta($post_id, 'opalestate_ppt_agent', "9753");
  update_post_meta($post_id, '_wp_trash_meta_status', "publish");
  update_post_meta($post_id, 'opalestate_ppt_address', $city);
  update_post_meta($post_id, 'opalestate_ppt_map', $map);


	$sql = "INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
	VALUES ($post_id, 165, 0)";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

  $count = $count+1;


  // //Alertes mail
  // $sql = "SELECT id, post_author FROM wp_posts WHERE post_type ='mailalert'";
  // $resultAlert = $conn->query($sql);
  // if ($resultAlert->num_rows > 0) {
  //   // output data of each row
  //   while($row = $resultAlert->fetch_assoc()) {
  //       $bool = "salut";
  //       $metas = get_post_meta( $row['id'], $key = '', $single = false );
  //       var_dump($metas);
  //       if (array_key_exists('type', $metas)) {
  //         if(strcmp((string)$metas['type'][0], "Colocation") != 0){
  //           $bool = "non";
  //         }
  //       }
  //       echo "type ".$bool;
  //       if (array_key_exists('location', $metas)) {
  //         if($metas['location'][0] != $city){
  //           $bool = "non";
  //         }
  //       }
  //       echo "location ".$bool;
  //       if (array_key_exists('priceLow', $metas)) {
  //         if($metas['priceLow'][0] > $price_monthly){
  //           $bool = "non";
  //         }
  //       }
  //       echo "priceLow ".$bool;
  //       if (array_key_exists('priceHigh', $metas)) {
  //         if($metas['priceHigh'][0] < $price_monthly){
  //           $bool = "non";
  //         }
  //       }
  //       echo "priceHigh ".$bool;
  //       if (array_key_exists('surfaceLow', $metas)) {
  //         if($metas['surfaceLow'][0] > $floor_area){
  //           $bool = "non";
  //         }
  //       }
  //       echo "surfaceLow ".$bool;
  //       if (array_key_exists('surfaceHigh', $metas)) {
  //         if($metas['surfaceHigh'][0] < $floor_area){
  //           $bool = "non";
  //         }
  //       }
  //       echo "surfaceHigh ".$bool;
  //       if($bool == "salut"){
  //         // Le message
  //         $message = "Bonjour Madame Monsieur,\r\nUn bien sur le site Dodoum correspond à vos recherches.\r\nNous vous invitons à le consulter à l'adresse suivante :\r\n".$url."\r\nBonne journée à vous.\r\nL'équipe Dodoum";

  //         // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
  //         $message = wordwrap($message, 70, "\r\n");

  //         // Envoi du mail
  //         mail((string)$metas['email'][0], 'Nouveau bien Dodoum', $message);
  //       }
  //   }
  // } else {
  //     echo "0 results";
  // }
}

  function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
  }
?>