<?php

$currentDir = getcwd();
$uploadDirectory = "/template/slider/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['zip', '7z']; // Get all the file extensions

    $token = $_COOKIE['token'];

    $fileName = $_FILES['photos']['name'];
    $fileSize = $_FILES['photos']['size'];
    $fileTmpName  = $_FILES['photos']['tmp_name'];
    $fileType = $_FILES['photos']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . $token . basename($fileName); 


    if (! in_array($fileExtension,$fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 1000000) {
        $errors[] = "This file is more than 1MB. Sorry, it has to be less than or equal to 1MB";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded";
        } else {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
    ?>