<?php
require_once 'libs/php/funciones.php'; require_once 'libs/php/db_tools.php'; LimpiarEntradas(); IniciarSesionSegura(); try { if (isset($_SESSION['loguser'])) { $spb35309 = Foto($_SESSION['loguser']); if (isset($_POST['anticsrf']) && $_POST['anticsrf'] == $_SESSION['anticsrf']) { if (isset($_POST['btnsalir']) && $_POST['btnsalir'] == 'salir') { cerrarsesion(); die; } if (isset($_POST['btnActualizar']) && $_POST['btnActualizar'] == 'Actualizar') { if (isset($_FILES['fulFoto']['name']) && $_FILES['fulFoto']['name'] != '') { $sp0ac023 = validarfoto($_FILES['fulFoto']); } else { $sp0ac023 = $spb35309['Foto']; } $sp69cf90 = validarnumeros($_POST['txtNumHij']); if (isset($sp69cf90)) { $spf3e04e = ActualizarDatosDB($_SESSION['loguser'], $_POST['txtNombre'], $_POST['txtApellidos'], $_POST['txtCorreo'], $_POST['txtDir'], $_POST['txtNumHij'], $_POST['txtEstCivil'], $sp0ac023); if ($spf3e04e == TRUE) { echo '<script language="javascript">
                            alert("Usuario actualizado.")
                            window.location.href="index.php";
                            </script>'; die; } else { echo '<script language="javascript">
                            alert("Usuario NO actualizado.")
                            window.location.href="perfil.php";
                            </script>'; die; } } else { echo '<script language="javascript">
                        alert("Datos invalidos.")
                        window.location.href="perfil.php";
                        </script>'; die; } } if (isset($_POST['btnCambio']) && $_POST['btnCambio'] == 'Cambiar Contraseña') { header('Location:contraseña.php'); die; } } } else { header('Location:index.php'); die; } } catch (\Throwable $spbc0671) { } $sp197250 = rand(1000, 9999); $_SESSION['anticsrf'] = $sp197250; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mi Perfil</title>
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
  <?php  try { $sp9916b8 = ListarDatosDB($_SESSION['loguser']); echo '
            <form class="formp" method="post" enctype="multipart/form-data">
                    <a class="boton" href="inicio.php">volver</a>
                    <br>
                    <div class="form-element">
                        <label for="txtNombre">Nombres:</label>
                        <input class="inputp" value= "' . $sp9916b8['Nombres'] . '" type="text" name="txtNombre" id="txtNombre" pattern="[A-Za-z ]{1,}">
                    </div>
                    <div class="form-element">
                        <label for="txtApellidos">Apellidos:</label>
                        <input class="inputp" value= "' . $sp9916b8['Apellidos'] . '" type="text" name="txtApellidos" id="txtApellidos" pattern="[A-Za-z ]{1,}" >
                    </div>
                    <div class="form-element">
                        <label for="txtCorreo">Correo:</label>
                        <input class="inputp" value= "' . $sp9916b8['Correo'] . '" type="email" name="txtCorreo" id="txtCorreo" >
                    </div>
                    <div class="form-element">
                        <label for="txtDir">Dirreccion::</label>
                        <input class="inputp" value= "' . $sp9916b8['Direccion'] . '" type="text" name="txtDir" id="txtDir" pattern="[A-Za-z ]{1,}"  >
                    </div>
                    <div class="form-element">
                        <label for="txtNumHij">Numero de hijos:</label>
                        <input class="inputp" value= "' . $sp9916b8['Num_Hijos'] . '" type="number" name="txtNumHij" id="txtNumHij" pattern="[0-9]{1,}" >
                    </div>
                    <div class="form-element">
                        <label for="txtEstCivil">Estado Civil:</label>
                        <input class="inputp" value= "' . $sp9916b8['Estado_Civil'] . '" type="text" name="txtEstCivil" id="txtEstCivil" pattern="[A-Za-z ]{1,}">
                    </div>
                    <div class="form-element">
                        <label for="fulFoto">Foto:</label>
                        <input class="inputp" type="file" name="fulFoto" id="fulFoto" accept="image/*" >
                    </div>
                    <input type="hidden" name="anticsrf" value="' . $sp197250 . '">
                    <input class="boton" type="submit" name="btnActualizar" value="Actualizar">
                </form>
                <form method="post">
                    <input type="hidden" name="anticsrf" value="' . $sp197250 . '">
                    <input class="boton" type="submit" name="btnCambio" value="Cambiar Contraseña">
                </form>
            '; } catch (\Throwable $spbc0671) { } ?>
</body>
</html><?php 