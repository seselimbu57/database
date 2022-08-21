<?php
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

  function image_remove($img){
   if(!unlink(UPLOAD_SRC.$img))
     {
       header("location: index.php?alert=img removed failed");
       exit;
     }
  }

  if(isset($_POST['addproduct'])){
    $con = mysqli_connect("localhost","root","","crud");
      print_r($_POST);
      foreach($_POST as $key => $value){
      $_POST[$key] = mysqli_real_escape_string($con,$value);
    
    }
    $imgpath = image_upload($_FILES['couimg']);

    $query="INSERT INTO `products`(`cou_name`, `cou_option`, `cou_intro`, `cou_desc`, `cou_img`) VALUES ('$_POST[couname]','$_POST[couoption]','$_POST[couintro]','$_POST[coudesc]','$imgpath')";
    if(mysqli_query($con,$query))
    {
     header("location:index.php?success=added");
    }
   else
   {
     header("location:index.php?alert=add_failed");
   }
    
  }
  else
  {
    echo"didn't connected.";
  }

if(isset($_GET['rem']) && $_GET['rem']>0){
    $query="SELECT * FROM `products` WHERE `id`='$_GET[rem]'";
    $result=mysqli_query($con,$query);
    $fetch=mysqli_fetch_assoc($result);

    image_remove($fetch['cou_img']);

    $query="DELETE FROM `products` WHERE `id`='$_GET[rem]'";
    if(mysqli_query($con,$query)){
      header("location: index.php?success=removed");
    }
    else{
      header("location: index.php?alert=removed_failed");
    }
  }

  if(isset($_POST['editproduct']))
  {
    foreach($_POST as $key => $value){
      $_POST[$key] = mysqli_real_escape_string($con,$value);
   }

    //  print_r($_POST);
    //  print_r($_FILES);
    //  die();

   if(file_exists($_FILES['couimg']['tmp_name']) || is_uploaded_file($_FILES['couimg']['tmp_name']))
   {
     $query="SELECT * FROM `products` WHERE `id`='$_POST[editpid]'";
     $result=mysqli_query($con,$query);
     $fetch=mysqli_fetch_assoc($result);
  

     image_remove($fetch['cou_img']);

     $imgpath=image_upload($_FILES['couimg']);

     $update="UPDATE `products` SET `cou_name`='$_POST[couname]',`cou_option`='$_POST[couoption]',`cou_intro`='$_POST[couintro]',`cou_desc`='$_POST[coudesc]',`cou_img`='$imgpath' WHERE `id`=$_POST[editpid]";

    }
    else{
      $update="UPDATE `products` SET `cou_name`='$_POST[couname]',`cou_option`='$_POST[couoption]',`cou_intro`='$_POST[couintro]',`cou_desc`='$_POST[coudesc]' WHERE `id`=$_POST[editpid]";
   }
   if(mysqli_query($con,$update)){
    header("location: index.php?success=uploaded");
   }
   else{
    header("location: index.php?alert=update_failed");
   }
 }
?>