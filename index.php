<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

if(isset($_POST['submit'])) {
    $image_name=$_FILES['image']['name'];
    $tmp_name=$_FILES['image']['tmp_name'];

    $directory_name='uploaded/';     //folder where image will upload
    $file_name=$directory_name.$image_name;
    move_uploaded_file($tmp_name, $file_name);

    $compress_file="compress_".$image_name;        
    $compressed_img=$directory_name.$compress_file;
    $compress_image=compressImage($file_name,$compressed_img);    
    unlink($file_name);            //delete original file
}

function compressImage($source_image,$compress_image) {
    $image_info=getimagesize($source_image);
    if ($image_info['mime']=='image/jpeg') {
        $source_image=imagecreatefromjpeg($source_image);
        imagejpeg($source_image,$compress_image,35);             //for jpeg or gif, it should be 0-100 
    }
    elseif ($image_info['mime']=='image/png') {
        $source_image=imagecreatefrompng($source_image);
        imagepng($source_image,$compress_image,3);                //for png it should be 0 to 9
    }
    return $compress_image;
}

?>

    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="image" accept="images">
        <input type="submit" value="upload" name="submit">
    </form>
    
</body>
</html>