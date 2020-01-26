<?php
  include('./librerias/conexion.php');

  $email = $_POST['email'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $imagen_temporal = $_FILES['photo']['tmp_name'];

  if ($email!=="" && $email!=="" && $name!=="" && $imagen_temporal!=="") {

    $foto=file_get_contents($imagen_temporal);
    $sql = "INSERT into users(email, password, name, photo) VALUES (:email, :password, :name, :photo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':photo', $foto);

    if ($stmt->execute()) {
      header("Location:index.php?createuser=ok");
    } else {
        header("Location:index.php?createuser=ko");
      }
  }else{
    header("Location:index.php?createuser=error");
  }



?>