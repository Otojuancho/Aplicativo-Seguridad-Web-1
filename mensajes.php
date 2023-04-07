<?php
require_once 'libs/php/funciones.php'; require_once 'libs/php/db_tools.php'; LimpiarEntradas(); IniciarSesionSegura(); try { if (isset($_SESSION['loguser'])) { $spb35309 = Foto($_SESSION['loguser']); if (isset($_POST['anticsrf']) && $_POST['anticsrf'] == $_SESSION['anticsrf']) { if (isset($_POST['btnsalir']) && $_POST['btnsalir'] == 'salir') { cerrarsesion(); die; } if (isset($_POST['btnEnviar']) && $_POST['btnEnviar'] == 'Enviar') { if (isset($_POST['txtMensaje']) && $_POST['txtMensaje'] != '') { if (!preg_match('/^(?=.*[A-Za-z])[0-9A-Za-z !@#$%]{1,200}$/', $_POST['txtMensaje'])) { header('Location:mensajes.php'); die; } } if (!isset($_FILES['fulAdjunto']['name']) || $_FILES['fulAdjunto']['name'] == '') { $sp151ff6 = validarArchivo($_FILES['fulAdjunto']); $spf3e04e = RegistrarMensajeDB($_SESSION['loguser'], $_POST['cmbDestino'], $_POST['txtMensaje'], $sp151ff6); if ($spf3e04e == TRUE) { header('Location:mensajes.php'); die; } } else { $sp151ff6 = validarArchivo($_FILES['fulAdjunto']); if ($sp151ff6 == NULL) { echo '<script language="javascript">
                            alert("Archivo incorrecto.")
                            window.location.href="mensajes.php";
                            </script>'; die; } $spf3e04e = RegistrarMensajeDB($_SESSION['loguser'], $_POST['cmbDestino'], $_POST['txtMensaje'], $sp151ff6); if ($spf3e04e == TRUE) { header('Location:mensajes.php'); die; } } } } } else { header('Location:index.php'); die; } } catch (\Throwable $spbc0671) { } $sp197250 = rand(1000, 9999); $_SESSION['anticsrf'] = $sp197250; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mensajes</title>
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
			<li><a href="#tab1"><span class="fa fa-home"></span><span class="tab-text">Mensaje recibidos</span></a></li>
			<li><a href="#tab2"><span class="fa fa-group"></span><span class="tab-text">Mensajes enviados</span></a></li>
			<li><a href="#tab3"><span class="fa fa-briefcase"></span><span class="tab-text">Crear mensaje</span></a></li>
		</ul>

		<div class="secciones">
			<article id="tab1">
                <?php  try { $sp40df56 = ListarMensajesRDB($_SESSION['loguser']); if (isset($sp40df56)) { foreach ($sp40df56 as $spb637ea => $sp08694a) { echo '
                                <table class="formp">
                                    <tr>
                                        <td><label>' . $sp08694a['nombre'] . '</label></td>
                                        <td><label>' . $sp08694a['Mensaje'] . '</label></td>
                                    </tr>
                                    <tr>
                                        <td><label><img height="30" src="uploaded_files/images/' . $sp08694a['Foto'] . '"><br></label></td>
                                        <td><label>' . $sp08694a['Fecha_mensaje'] . '</label></td>
                                    </tr>
                                    <tr>
                                        <td><label>Arch. Adjunto:</label></td>'; if ($sp08694a['Archivo'] != NULL) { echo '<td><label><a href="uploaded_files/images/' . $sp08694a['Archivo'] . '" download>archivo</a></label></td>'; } echo '</tr>
                                </table>
                            '; } } } catch (\Throwable $spbc0671) { } ?>
			</article>
			<article id="tab2">
                <?php  try { $spb9122a = ListarMensajesEDB($_SESSION['loguser']); if (isset($spb9122a)) { foreach ($spb9122a as $spb637ea => $sp08694a) { echo '
                                <table class="formp">
                                    <tr>
                                        <td><label>' . $sp08694a['nombre'] . '</label></td>
                                        <td><label>' . $sp08694a['Mensaje'] . '</label></td>
                                    </tr>
                                    <tr>
                                        <td><label><img height="30" src="uploaded_files/images/' . $sp08694a['Foto'] . '"><br></label></td>
                                        <td><label>' . $sp08694a['Fecha_mensaje'] . '</label></td>
                                    </tr>
                                    <tr>
                                        <td><label>Arch. Adjunto:</label></td>'; if ($sp08694a['Archivo'] != NULL) { echo '<td><label><a href="uploaded_files/images/' . $sp08694a['Archivo'] . '" download>archivo</a></label></td>'; } echo '</tr>
                                </table>
                            '; } } } catch (\Throwable $spbc0671) { } ?>
			</article>
			<article id="tab3">
                <form class="formp" action="" method="post" enctype="multipart/form-data">
                    <div class="form-element">
                        <label for="cmbDestino">Destinatario:</label>
                        <select class="selectp" name="cmbDestino" id="cmbDestino">
                            <?php  try { $spbef630 = ListaPersonasDB(); if (isset($spbef630)) { foreach ($spbef630 as $spb637ea => $sp08694a) { echo '
                                            <option value="' . $sp08694a['Id'] . '">' . $sp08694a['nombre'] . '</option>
                                        '; } } } catch (\Throwable $spbc0671) { } ?>
                        </select>
                    </div>
                    <div class="form-element">
                        <textarea class="inputp" type="text" name="txtMensaje" id="txtMensaje" required></textarea>
                    </div>
                    <div class="form-element">
                        <label for="fulAdjunto">Arch. Adjunto:</label>
                        <input class="inputp" type="file" name="fulAdjunto" id="fulAdjunto"  >
                    </div>
                    <input type="hidden" name="anticsrf" value="<?php  echo $sp197250; ?>
">
                    <input class="boton" type="submit" name="btnEnviar" value="Enviar">
                </form>
			</article>
		</div>
	</div>
</body>
</html><?php 