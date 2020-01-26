<?php
  include('./librerias/conexion.php');
  $id = "";
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  // Borramos los valores en la tabla de datos
  $sql = "DELETE from users WHERE id = '".$id."' ";
  $result = mysqli_query($link, $sql);

  if($result){
    header("Location:index.php?deleteuser=ok");
  }else{
    header("Location:index.php?deleteuser=ko");
  }
?>