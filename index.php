<?php
 include('./librerias/conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h1 style="text-align: center;">Tabla de usuarios de nuestra aplicación</h1>

  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary center-block" data-toggle="modal" data-target="#exampleModal">
  Insertar nuevo usuario
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insertar nuevo usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./create.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Nombre*:</label>
            <input type="text" class="form-control" placeholder="Introduce tu nombre" name="name">
          </div>
          <div class="form-group">
            <label for="email">Email*:</label>
            <input type="email" class="form-control"  placeholder="Introduce tu email" name="email">
          </div>
          <div class="form-group">
            <label for="phone">Contraseña*:</label>
            <input type="text" class="form-control" placeholder="Introduce tu contraseña" name="password">
          </div>
          <div class="form-group">
            <label for="photo">Foto de perfil*:</label>
            <input name="photo" type="file" placeholder="Foto de Perfil" class="form-control"><br><br>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div style="margin-top: 20px;"></div>

<?php
if (isset($_GET['createuser'])) {
  if ($_GET['createuser']=='ok') {
    ?>
    <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Usuario insertado correctamente!</strong>
    </div>
    <?php
  }else if ($_GET['createuser']=='ko') {
    ?>
    <div class="alert alert-warning alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error al insertar el usuario</strong>, vuelve a intentarlo más tarde.
    </div>
    <?php
  }
  else if ($_GET['createuser']=='error') {
    ?>
    <div class="alert alert-warning alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error al insertar el usuario</strong>, rellene todos los campos.
    </div>
    <?php
  }
}

if (isset($_GET['deleteuser'])) {
  if ($_GET['deleteuser']=='ok') {
    ?>
    <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Usuario borrado correctamente!</strong>
    </div>
    <?php
  }else if ($_GET['deleteuser']=='ko') {
    ?>
    <div class="alert alert-danger alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error al borrar el usuario</strong>, vuelve a intentarlo más tarde.
    </div>
    <?php
  }
}

?>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Foto Perfil</th>
      <th scope="col">Correo</th>
      <th scope="col">Password</th>
      <th scope="col">Nombre</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql= "SELECT * FROM users";
      $result = mysqli_query($link,$sql);

      if (!$result) {
        echo "La tabla está vacía";
      }
      else{
        while($row = mysqli_fetch_array($result)){
          echo ' <tr>
      <th scope="row">'.$row["id"].'</th>';
      if ($row['photo'] !== null) {
        echo '<td><img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'" style="width:50px;"></td>';
      }else{
        echo '<td><img src="./images/empty_user.jpg" style="width:50px;"></td>';
      }
      echo '
      <td>'.$row["email"].'</td>
      <td>'.$row["password"].'</td>
      <td>'.$row["name"].'</td>
      <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete'.$row["id"].'"><i class="fa fa-trash"></i></button></td>
    </tr>';
    echo '
    <!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="delete'.$row["id"].'" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de borrar este usuario?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success"><a href="./delete.php?id='.$row["id"].'">Delete</a></button>
      </div>
    </div>
  </div>
</div>
    ';
        }
      }
    ?>

    
  </tbody>
</table>
</div>


</body>
</html>
