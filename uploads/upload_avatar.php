<?php
$token = $_COOKIE['token'];
$currentDir = getcwd();
$uploadDirectory = "/avatar/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['photos']['name'];
    $fileSize = $_FILES['photos']['size'];
    $fileTmpName  = $_FILES['photos']['tmp_name'];
    $fileType = $_FILES['photos']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . $token . basename($fileName); 

    if (! in_array($fileExtension,$fileExtensions)) {
    	$errors[] = "L'extension du fichier n'est pas reconnu";
    }

    if ($fileSize > 100000) {
    	$errors[] = "Le fichier dépasse la taille autorisé";
    }

    if (empty($errors)) {
    	$didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    	if ($didUpload) {
         
        } else {
          echo "Une erreur est survenue";
      }
  } else {
    print_r($errors);
}
?>