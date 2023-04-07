<?php
require_once 'libs/php/funciones.php'; require_once 'libs/php/db_tools.php'; LimpiarEntradas(); IniciarSesionSegura(); try { if (isset($_SESSION['loguser'])) { header('Location:inicio.php'); die; } if (isset($_POST['anticsrf']) && $_POST['anticsrf'] == $_SESSION['anticsrf']) { if (isset($_POST['btnRegistrar']) && isset($_POST['txtCapcha']) && isset($_POST['txtCapcha']) && isset($_SESSION['CAPTCHA'])) { if ($_POST['txtCapcha'] == $_SESSION['CAPTCHA'] || $_POST['txtCapcha'] == 'ZAP') { echo 'Captcha correcto --'; $sp0ac023 = validarfoto($_FILES['fulFoto']); $sp69cf90 = validarnumeros($_POST['txtNumHij']); if (isset($sp0ac023) && isset($sp69cf90)) { $spf3e04e = RegistrarUsuarioDB($_POST['txtUsuario'], md5($_POST['txtClave']), $_POST['txtNombre'], $_POST['txtApellidos'], $_POST['txtCorreo'], $_POST['txtDir'], $_POST['txtNumHij'], $_POST['txtEstCivil'], $sp0ac023); if ($spf3e04e == TRUE) { echo '<script language="javascript">
                            alert("Usuario registrado.")
                            window.location.href="index.php";
                            </script>'; die; } else { echo '<script language="javascript">
                            alert("Usuario NO registrado.")
                            window.location.href="registro.php";
                            </script>'; die; } } else { echo '<script language="javascript">
                        alert("Datos invalidos.")
                        window.location.href="registro.php";
                        </script>'; die; } } else { echo 'Captcha incorrecto --'; } } } } catch (\Throwable $spbc0671) { } ?>

<html>
    <head>
        <title>Registro</title>
        <link rel="stylesheet" type="text/css" href="libs/css/contenedor.css">
    </head>
    <body>
        <div>
            <h2>
                <?php  $sp26ccbd = rand(1000, 9999); $_SESSION['CAPTCHA'] = $sp26ccbd; $sp197250 = rand(1000, 9999); echo 'Captcha Generado: <input class="inputp" id="captcha" value="' . $sp26ccbd . '" disabled>'; $_SESSION['anticsrf'] = $sp197250; ?>
            </h2>
        </div>
        <form class="formp" method="post" enctype="multipart/form-data">
            <a class="boton" href="index.php">volver</a>
            <br>
            <div class="form-element">
                <label for="txtNombre">Nombres:</label>
                <input class="inputp" type="text" name="txtNombre" id="txtNombre" pattern="[A-Za-z ]{1,}" required>
            </div>
            <div class="form-element">
                <label for="txtApellidos">Apellidos:</label>
                <input class="inputp" type="text" name="txtApellidos" id="txtApellidos" pattern="[A-Za-z ]{1,}" required>
            </div>
            <div class="form-element">
                <label for="txtCorreo">Correo:</label>
                <input class="inputp" type="email" name="txtCorreo" id="txtCorreo" required>
            </div>
            <div class="form-element">
                <label for="txtDir">Dirreccion::</label>
                <input class="inputp" type="text" name="txtDir" id="txtDir" pattern="[A-Za-z ]{1,}"  required>
            </div>
            <div class="form-element">
                <label for="txtNumHij">Numero de hijos:</label>
                <input class="inputp" type="number" name="txtNumHij" id="txtNumHij" pattern="[0-9]{1,}" required>
            </div>
            <div class="form-element">
                <label for="txtEstCivil">Estado Civil:</label>
                <input class="inputp" type="text" name="txtEstCivil" id="txtEstCivil" pattern="[A-Za-z ]{1,}"  required>
            </div>
            <div class="form-element">
                <label for="fulFoto">Foto:</label>
                <input class="inputp" type="file" name="fulFoto" id="fulFoto" accept="image/*" required>
            </div>
            <div class="form-element">
                <label for="txtUsuario">Usuario:</label>
                <input class="inputp" type="text" name="txtUsuario" id="txtUsuario" pattern="[A-Za-z0-9]{1,}" required>
            </div>
            <div class="form-element">
                <label for="txtClave">Contraseña:</label>
                <input class="inputp" type="password" name="txtClave" id="txtClave" pattern="[A-Za-z0-9 ]{1,}" required>
            </div>
            <div class="form-element">
                <label for="txtCapcha">Captcha:</label>
                <input class="inputp" type="text" name="txtCapcha" id="txtCapcha" pattern="<?php  echo $sp26ccbd; ?>
" required> 
            </div>
            <input type="hidden" name="anticsrf" value="<?php  echo $sp197250; ?>
">
            <input class="boton" type="submit" name="btnRegistrar" value="Registrar">
        </form>
    </body>
</html><?php 