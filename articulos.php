<?php
require_once 'libs/php/funciones.php'; require_once 'libs/php/db_tools.php'; LimpiarEntradas(); IniciarSesionSegura(); try { if (isset($_SESSION['loguser'])) { $spb35309 = Foto($_SESSION['loguser']); if (isset($_POST['anticsrf']) && $_POST['anticsrf'] == $_SESSION['anticsrf']) { if (isset($_POST['btnsalir']) && $_POST['btnsalir'] == 'salir') { cerrarsesion(); die; } if (isset($_POST['txtMensaje']) && $_POST['txtMensaje'] != '') { if (!preg_match('/^(?=.*[A-Za-z])[0-9A-Za-z !@#$%]{1,200}$/', $_POST['txtMensaje'])) { header('Location:articulos.php'); die; } } if (isset($_POST['btnCrear']) && $_POST['btnCrear'] == 'Crear') { $spf3e04e = RegistrarArticuloDB($_SESSION['loguser'], $_POST['txtMensaje'], $_POST['chkPublico']); if ($spf3e04e == TRUE) { header('Location:articulos.php'); die; } } if (isset($_POST['btnPublicar_1']) && $_POST['btnPublicar_1'] == 'Publicar') { $spfd1a70 = PublicarArticuloDB($_SESSION['loguser'], $_POST['txtid']); if ($spfd1a70 == TRUE) { header('Location:articulos.php'); die; } } if (isset($_POST['btnDespublicar_1']) && $_POST['btnDespublicar_1'] == 'Despublicar') { $spb7506a = DespublicarArticuloDB($_SESSION['loguser'], $_POST['txtid']); if ($spb7506a == TRUE) { header('Location:articulos.php'); die; } } if (isset($_POST['btnBorrar_1']) && $_POST['btnBorrar_1'] == 'Borrar') { $sp3b3f1a = BorrarArticuloDB($_SESSION['loguser'], $_POST['txtid']); if ($sp3b3f1a == TRUE) { header('Location:articulos.php'); die; } } } } else { header('Location:index.php'); die; } } catch (\Throwable $spbc0671) { } $sp197250 = rand(1000, 9999); $_SESSION['anticsrf'] = $sp197250; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Articulos</title>
  <link rel="stylesheet" href="libs/css/contenedor.css?v=<?php  echo rand(); ?>
" />
  <script src="libs/js/jquery-3.6.0.min.js"></script>
  <script src="libs/js/main.js"></script>
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
  <div class="wrap">
		<ul class="tabs">
			<li><a href="#tab1"><span class="fa fa-home"></span><span class="tab-text">Todos los artículos</span></a></li>
			<li><a href="#tab2"><span class="fa fa-group"></span><span class="tab-text">Mis artículos</span></a></li>
			<li><a href="#tab3"><span class="fa fa-briefcase"></span><span class="tab-text">Crear artículo</span></a></li>
		</ul>

		<div class="secciones">
			<article id="tab1">
                <?php  try { $sp35cfa7 = ListarArticulosDb(); if (isset($sp35cfa7)) { foreach ($sp35cfa7 as $spb637ea => $sp08694a) { echo '
                            <table class="formp">
                                <tr>
                                    <td><label>' . $sp08694a['nombre'] . '</label></td>
                                    <td><label>' . $sp08694a['Publicacion'] . '</label></td>
                                </tr>
                                <tr>
                                    <td><label><img height="30" src="uploaded_files/images/' . $sp08694a['Foto'] . '"><br></label></td>
                                    <td><label>' . $sp08694a['Fecha_publico'] . '</label></td>
                                </tr>
                            </table>
                            '; } } } catch (\Throwable $spbc0671) { } ?>
			</article>
			<article id="tab2">
                <?php  try { $spd6934c = ListarmisArticulosDb($_SESSION['loguser']); if (isset($spd6934c)) { foreach ($spd6934c as $spb637ea => $sp08694a) { echo '
                            <form class="formp" action="" method="post">
                            <input type="hidden" value="' . $sp08694a['Id'] . '" name="txtid" id="txtid">
                                <div class="form-element">
                                    <label><b>Articulo:</b></label>
                                    <label>' . $sp08694a['Publicacion'] . '</label>
                                </div>
                                <div class="form-element">
                                    <label><b>Es público:</b></label>
                                    <label>'; if ($sp08694a['Publico'] == '1') { echo 'SI'; } else { echo 'NO'; } echo '
                                    </label>
                                </div>
                                <div>
                                    <label><b>Fecha de publicación:</b></label>
                                    <label>' . $sp08694a['Fecha_publico'] . '</label>
                                </div>
                                <br>
                                <input type="hidden" name="anticsrf" value="' . $sp197250 . '">
                                <input class="boton" type="submit" name="btnPublicar_1" value="Publicar">
                                <input class="boton" type="submit" name="btnDespublicar_1" value="Despublicar">
                                <input class="boton" type="submit" name="btnBorrar_1" value="Borrar">
                            </form>
                            '; } } } catch (\Throwable $spbc0671) { } ?>
			</article>
			<article id="tab3">
                <form class="formp" action="" method="post">
                    <div class="form-element">
                        <label for="txtMensaje">Articulo:</label>
                        <textarea class="inputp" type="text" name="txtMensaje" id="txtMensaje" required></textarea>
                    </div>
                    <div class="form-element">
                        <label for="chkPublico">Es público:</label>
                        <input class="inputp" type="checkbox" name="chkPublico" id="chkPublico" >
                    </div>
                    <input type="hidden" name="anticsrf" value="<?php  echo $sp197250; ?>
">
                    <input class="boton" type="submit" name="btnCrear" value="Crear">
                </form>
			</article>
		</div>
	</div>
</body>
</html><?php 