<?php


//check if the field is set
if(isset($_FILES['upload_file']))
{
    $extension = pathinfo($_FILES['upload_file']['name'], PATHINFO_EXTENSION);
    $new_image_name = time() . "." . $extension;
    move_uploaded_file($_FILES['upload_file']['tmp_name'],'../images/' . $new_image_name);
    


    $data = array(

        'image_source' => "../images/" . $new_image_name
     
    );
    echo json_encode($data);
}


?>
