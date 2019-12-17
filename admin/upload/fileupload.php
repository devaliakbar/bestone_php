<?php
if (isset($_POST["Submit1"])) {
    
    $uploadOk = 1;
    
    $fileName    = $_POST["id-up"];
    $extnsn      = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
    $target_file = $_SERVER['DOCUMENT_ROOT'] . "/img/$fileName" . "." . $extnsn;
    
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/$fileName" . "." . "png")) {
        if (!unlink($_SERVER['DOCUMENT_ROOT'] . "/img/$fileName" . "." . "png")) {
            $uploadOk = 0;
            echo ("Error deleting Existing File");
        } else {
            echo ("Deleted Existing File");
        }
    }
    
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/$fileName" . "." . "jpg")) {
        if (!unlink($_SERVER['DOCUMENT_ROOT'] . "/img/$fileName" . "." . "jpg")) {
            $uploadOk = 0;
            echo ("Error deleting Existing File");
        } else {
            echo ("Deleted Existing File");
        }
    }
    
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/$fileName" . "." . "jpeg")) {
        if (!unlink($_SERVER['DOCUMENT_ROOT'] . "/img/$fileName" . "." . "jpeg")) {
            $uploadOk = 0;
            echo ("Error deleting Existing File");
        } else {
            echo ("Deleted Existing File");
        }
    }
    
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/$fileName" . "." . "gif")) {
        if (!unlink($_SERVER['DOCUMENT_ROOT'] . "/img/$fileName" . "." . "gif")) {
            $uploadOk = 0;
            echo ("Error deleting Existing File");
        } else {
            echo ("Deleted Existing File");
        }
    }
    
    /*if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }*/
    
    if ($extnsn != "jpg" && $extnsn != "png" && $extnsn != "jpeg" && $extnsn != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.$target_file";
            
            if(updateUrl($_POST["id-up"],$_POST["id-up"] . "." . $extnsn)){
                echo "Saved to db.";
            }else{
                echo "failed to save db";
            }
            
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
}

function updateUrl($id, $name)
{
    $conn = mysqli_connect("localhost", "bestones_bestone", "bestone$$2019", "bestones_bestone");
    if (!$conn) {
        mysqli_error();
        die();
    }
    $cancelOrder = "UPDATE item SET img_url = '$name' WHERE item.id = '$id';";
    if (mysqli_query($conn, $cancelOrder)) {
        return true;
    } else {
        return false;
    }
}
?>