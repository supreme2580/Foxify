<?php

$target_dir = "uploads/";
$target_file = $target_dir.basename($_FILES["file"]["name"]);
$extension = pathinfo($target_file, PATHINFO_EXTENSION);

$targ_dir = "deparsed/";
$targ_file = $targ_dir.basename($_FILES["file"]["name"]);

if ($target_file != null) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $file = file_get_contents($target_file);
        $data = base64_decode($file);
        if ($data != null) {
            if (unlink($target_file)) {
                $field = fopen($targ_file, "w") or die("Unable to find file");
                fwrite($field, $data);
                fclose($field);
                echo "Success";
            }
            else {
                echo "Something is wrong";
            }
        }
        else {
            echo "Empty";
        }
    }
    else {
        echo "Failed";
    }
}

?>