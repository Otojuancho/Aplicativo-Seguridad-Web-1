<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <link rel="stylesheet" href="libs/css/contenedor.css?v=<?php  echo rand(); ?>
" />
</head>

<?php  require_once 'libs/php/funciones.php'; require_once 'libs/php/db_tools.php'; LimpiarEntradas(); IniciarSesionSegura(); try { if (isset($_POST['anticsrf']) && $_POST['anticsrf'] == $_SESSION['anticsrf']) { if (isset($_POST['btnsalir']) && $_POST['btnsalir'] == 'salir') { cerrarsesion(); die; } } if (isset($_SESSION['loguser'])) { $spb35309 = Foto($_SESSION['loguser']); } else { header('Location:index.php'); die; } $sp197250 = rand(1000, 9999); $_SESSION['anticsrf'] = $sp197250; } catch (\Throwable $spbc0671) { } $sp197250 = rand(1000, 9999); $_SESSION['anticsrf'] = $sp197250; ?>

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
<br><br><br><br><br><br>
<div >
    <a class="boton" href="articulos.php" >Ver articulos</a>
    <a class="boton" href="mensajes.php" >Ver mensajes</a>
    <a class="boton" href="perfil.php" >Mi perfil</a>
</div>
</body>
</html><?php 