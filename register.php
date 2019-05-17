<?php
  include('database.php');
  $idNumber=$_POST['ide'];
  //nombre del archivo
  $file_name = $_FILES['photo']['name'];
  //tipo de archivo
  $file_type = $_FILES['photo']['type'];
  //tamaño del archivo default (kb)
  $file_size = $_FILES['photo']['size'];
  //donde guarda la carpeta
  $file_tmp = $_FILES['photo']['tmp_name'];

//  echo $idNumber."<br>".$file_name."<br>".$file_type."<br>".$file_size."<br>".$file_tmp;
  move_uploaded_file($_FILES['photo']['tmp_name'],"photos/".$_FILES['photo']['name']);
  $photo_url_db= "photos/".$_FILES['photo']['name'];
  $sql="INSERT INTO users (id_number,photo) VALUES($idNumber,'$photo_url_db')";
  $conn->query($sql);
  echo "<script languaje = 'javascript'> alert(':::User has been resgister:::')</script>";
  header ("Refresh:0;url=index.html");
?>
