
<?php


$target_dir = "uploads/";

$filename = $_POST["filename"];

$target_file = $target_dir . $filename;

if (file_exists($_FILES["fileToUpload"]["tmp_name"])) {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        echo json_encode(array("message" => "Upload Success.!"));

    } else {

        echo json_encode(array("message" => "Upload Failed.!"));

    }

} else {
    echo json_encode(array("message" => "No Files Found.!"));
}

?>
