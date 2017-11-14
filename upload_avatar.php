<?php

function createThumbnail($filename) {
    $final_width_of_image = 35;
    $path_to_image_directory = 'uploads/avatar/';
    $path_to_thumbs_directory = 'uploads/avatar/thumb/';
    if(preg_match('/[.](jpg)$/', $filename)) {
        $im = imagecreatefromjpeg($path_to_image_directory . $filename);
    } else if (preg_match('/[.](gif)$/', $filename)) {
        $im = imagecreatefromgif($path_to_image_directory . $filename);
    } else if (preg_match('/[.](png)$/', $filename)) {
        $im = imagecreatefrompng($path_to_image_directory . $filename);
    }

    $ox = imagesx($im);
    $oy = imagesy($im);

    $nx = $final_width_of_image;
    $ny = floor($oy * ($final_width_of_image / $ox));

    $nm = imagecreatetruecolor($nx, $ny);

    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);

    if(!file_exists($path_to_thumbs_directory)) {
      if(!mkdir($path_to_thumbs_directory)) {
         die("There was a problem. Please try again!");
     } 
 }

 imagejpeg($nm, $path_to_thumbs_directory . $filename);
 $tn = '<img src="' . $path_to_thumbs_directory . $filename . '" alt="image" />';
 $tn .= '<br />Congratulations. Your file has been successfully uploaded, and a      thumbnail has been created.';
 // echo $tn;
}


$currentDir = getcwd();
$uploadDirectory = "/uploads/avatar/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['photos']['name'];
    $fileSize = $_FILES['photos']['size'];
    $fileTmpName  = $_FILES['photos']['tmp_name'];
    $fileType = $_FILES['photos']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 


    if (! in_array($fileExtension,$fileExtensions)) {
    	$errors[] = "L'extension du fichier n'est pas reconnu";
    }

    if ($fileSize > 2000000) {
    	$errors[] = "Le fichier dépasse la taille autorisé";
    }

    if (empty($errors)) {
    	$didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    	if ($didUpload) {
            createThumbnail($fileName); 
            echo "Le fichier " . basename($fileName) . " a bien été uploadé";
        } else {
          echo "Une erreur est survenue";
      }
  } else {
     foreach ($errors as $error) {
        echo $error . "Voici les erreurs" . "\n";
    }
}
?>