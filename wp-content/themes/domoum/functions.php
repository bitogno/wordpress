<?php add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  wp_enqueue_style( 'parent-style', '/wp-content/themes/domoum/style.css' );
}


// // On charge le fichier XML
// $xml=simplexml_load_file('https://fr-fr.roomlala.com/prod/file/welchome/ad_en_ca.xml');
//
// // On le parcourt
// foreach($xml as $property){
//
//   // Pour chaque propriété, on a :
//
//   $id = (int)$property->id;
//   $url = (string)$property->url;
//   $title = (string)$property->title;
//   $type = (string)$property->type;
//   $ad_type = (string)$property->ad_type;
//   $content = (string)$property->content;
//   foreach($property->price as $price){
//     switch($price['period']){
//       case 'daily':
//       $price_daily = (int)$price;
//       break;
//       case 'weekly':
//       $price_weekly = (int)$price;
//       break;
//       case 'monthly':
//       $price_monthly = (int)$price;
//       break;
//     }
//   }
//
//   $city = (string)$property->city;
//   $country = (string)$property->country;
//   $postcode = (int)$property->postcode;
//   $latitude = floatval((string)$property->latitude);
//   $longitude = floatval((string)$property->longitude);
//
//   // Un peu tricky ici ; soit on stocke un tableau d'objets "image" (URL + titre de l'image)
//   // Soit on le fait à l'arrache et on stocke image1 = http://url_image.fr , titre_image_1 = "titre", image2 = ... etc., plus facile à mettre dans postmeta
//   // Je fais un exemple des deux
//   $pictures_array = [];
//   foreach($property->pictures as $picture){
//     $pictures_array[] = $picture;
//   }
//   // Solution 2 :
//   $picture1 = (string) $property->pictures[0]->picture_url;
//   $title_picture_1 = (string) $property->pictures[0]->picture_title;
//   // etc etc pour picture2, 3...
//
//
//   $available_from = (string)$property->available_from;
//   $bedrooms = (int)$property->bedrooms;
//   $double_bed = (int)$property->double_bed;
//   $single_bed = (int)$property->single_bed;
//   $sofa_bed = (int)$property->sofa_bed;
//   $capacity = (int)$property->capacity;
//   $floor_area = (int)$property->floor_area;
//   $date = (string)$property->date;
//   $datemodification = (string)$property->datemodification;
//   $currency = (string)$property->currency;
//   $type_annonce = (string)$property->type_annonce;
//
//   // Une fois qu'on a tous les éléments, on crée un nouveau post avec les éléments de base de la propriété :
//   // EXEMPLE, où on récupère en même temps l'ID du post pour ensuite rajouter les metadata :
//   $new_property = array(
//     'post_author'=>'roomlala',
//     'post_title'=>$title
//   );
//   $post_id = wp_insert_post($new_property);
//
//   // Ensuite on update les métadata, une fois que la nouvelle propriété (le nouveau post) est créé
//   // EXEMPLE (à modifier)
//   update_post_meta($post_id, 'url', $url);
//   update_post_meta($post_id, 'opalestate_property_latitude', $latitude);
//   update_post_meta($post_id, 'opalestate_property_longitude', $longitude);
//   // etc etc
//
//
// }
