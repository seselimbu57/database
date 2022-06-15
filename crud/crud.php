<?
require("connection.php");

function image_upload($img){
  $tmp_loc = $img['tmp_name'];
  $new_name = random_int(11111,99999).$img['name'];
  $new_loc = UPLOAD_SRC.$new_name;

  if(!move_uploaded_file($tmp_loc,$new_loc))
  {
    header("location: index.php?alert=img_upload");
    exit;
  }
  else
  {
   return $new_name;
  }
}

if(isset($_POST['addfooditems']))
{
   print_r($_POST);
   foreach($_POST as $key => $value){
    $_POST[$key] = mysqli_real_escape_string($con,$value);
   }

   $imgpath = image_upload($_FILES['image']);

   $query="INSERT INTO `products'( `image`, `name`, `description`, `price`) VALUES ('$imgpath','$_POST[name]','$_POST[desc]','$_POST[price]')";
   if(mysqli_query($con,$query)){
    header("location:index.php?success=added");
   }
   else{
    header("location:index.php?alert=add_failed");
   }
   print_r($_POST);
}
?>