<?php
require_once 'libs/php/funciones.php'; require_once 'libs/php/db_tools.php'; LimpiarEntradas(); IniciarSesionSegura(); try { if (isset($_SESSION['loguser'])) { $spb35309 = Foto($_SESSION['loguser']); if (isset($_POST['anticsrf']) && $_POST['anticsrf'] == $_SESSION['anticsrf']) { if (isset($_POST['btnsalir']) && $_POST['btnsalir'] == 'salir') { cerrarsesion(); die; } if (isset($_POST['btnActualizar']) && $_POST['btnActualizar'] == 'Actualizar') { if (isset($_POST['txtNueva']) && isset($_POST['txtRepetir'])) { if ($_POST['txtNueva'] != '' && $_POST['txtRepetir'] != '' && $_POST['txtNueva'] == $_POST['txtRepetir']) { $spf3e04e = ActualizarClaveDB($_SESSION['loguser'], md5($_POST['txtNueva']), md5($_POST['txtAnterior'])); if ($spf3e04e == TRUE) { echo '<script language="javascript">
                                alert("Clave actualizada.")
                                window.location.href="index.php";
                                </script>'; die; } else { echo '<script language="javascript">
                                alert("Clave NO actualizada.")
                                window.location.href="contraseña.php";
                                </script>'; die; } } else { echo '<script language="javascript">
                                alert("La contraseña nueva y el repetir contraseña no coiciden.")
                                window.location.href="perfil.php";
                                </script>'; die; } } } } } else { header('Location:index.php'); die; } } catch (\Throwable $spbc0671) { } $sp197250 = rand(1000, 9999); $_SESSION['anticsrf'] = $sp197250; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cambio de clave</title>
  <link rel="stylesheet" href="libs/css/contenedor.css?v=<?php  echo rand(); ?>
" />
</head>
<body>

  <header>
    <div class="menu">
      <nav>
          <ul>
            <li><a href="inicio.php">Inicio</a></li>
            <li><img height="50" src="uploaded_files/images/<?php  echo $spb35309['Foto']; ?>
"></li>
            <li style="color:rgb(255, 255, 255);">Bienvenido: <strong> <?php  echo $spb35309['nombre']; ?>
</strong></li>
            <li style="color:rgb(255, 255, 255);">
                <form method="POST">
                    <input type="hidden" name="anticsrf" value="<?php  echo $sp197250; ?>
">
                    <input class="boton" type="submit" name="btnsalir" value="salir">
                </form>
            </li>
          </ul>
      </nav>
    </div>
  </header>
  <form class="formp" method="post" enctype="multipart/form-data">
            <a class="boton" href="perfil.php">Volver</a>
            <br>
            <div class="form-element">
                <label for="txtAnterior">Clave actual:</label>
                <input class="inputp" type="password" name="txtAnterior" id="txtAnterior" pattern="[A-Za-z0-9 ]{1,}" required>
            </div>
            <div class="form-element">
                <label for="txtNueva">Nueva clave:</label>
                <input class="inputp" type="password" name="txtNueva" id="txtNueva" pattern="[A-Za-z0-9 ]{1,}" required>
            </div>
            <div class="form-element">
                <label for="txtRepetir">Repetir clave:</label>
                <input class="inputp" type="password" name="txtRepetir" id="txtRepetir" pattern="[A-Za-z0-9 ]{1,}" required>
            </div>
            <input type="hidden" name="anticsrf" value="<?php  echo $sp197250; ?>
">
            <input class="boton" type="submit" name="btnActualizar" value="Actualizar">
        </form>
</body>
</html><?php 