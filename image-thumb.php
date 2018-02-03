<?php
    if (isset($_POST['btn'])){
       
      //  $image=$_POST['image'];
        $filetmp = $_FILES["file_img"]["tmp_name"];

       echo $filename = $_FILES["file_img"]["name"];

        $filetype = $_FILES["file_img"]["type"];
        $filesize = $_FILES["file_img"]["size"];
        $fileinfo = getimagesize($_FILES["file_img"]["tmp_name"]);
        $filewidth = $fileinfo[0];
        $fileheight = $fileinfo[1];
        $filepath = "photo/".$filename;
        $filepath_thumb = "photo/thumb/".$filename;

        if($filetmp == "")
        {
           echo "please select a photo";
        }
        else
        {

           if($filesize > 2097152)
           {
              echo "photo > 2mb";
           }
           else
           {

              if($filetype != "image/jpeg" && $filetype != "image/png" && $filetype != "image/gif")
              {
                 echo "Please upload jpg / png / gif";
              }
              else
              {

                 move_uploaded_file($filetmp,$filepath);

                 if($filetype == "image/jpeg")
                 {
                   $imagecreate = "imagecreatefromjpeg";
                   $imageformat = "imagejpeg";
                 }
                 if($filetype == "image/png")
                 {
                   $imagecreate = "imagecreatefrompng";
                   $imageformat = "imagepng";
                 }
                 if($filetype == "image/gif")
                 {
                   $imagecreate= "imagecreatefromgif";
                   $imageformat = "imagegif";
                 }

                 $new_width = "200";
                 $new_height = "200";

                 $image_p = imagecreatetruecolor($new_width, $new_height);
                 $image = $imagecreate($filepath); //photo folder

                 imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $filewidth, $fileheight);
                 $imageformat($image_p, $filepath_thumb);//thumb folder

     //            $sql = "INSERT INTO upload_img (img_name,img_path,img_type) VALUES ('$filename','$filepath','$filetype')";
     //            $result = mysql_query($sql);

              }

           }
        }
      }
?>
<form method="POST" action="" enctype="multipart/form-data">
<input type="file" name="file_img" required/><br>
 <input name="btn" type="Submit" value="Submit" />

    </form>
