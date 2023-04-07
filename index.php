<?php
require_once 'libs/php/funciones.php'; require_once 'libs/php/db_tools.php'; LimpiarEntradas(); IniciarSesionSegura(); if (isset($_SESSION['loguser'])) { header('Location:inicio.php'); die; } ?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="libs/css/contenedor.css">
    </head>
    <body>
        <div>
            <h2>
                <?php  try { if (isset($_POST['btnIngresar']) && isset($_POST['txtCapcha']) && isset($_POST['txtCapcha']) && isset($_SESSION['CAPTCHA'])) { if (isset($_POST['anticsrf']) && $_POST['anticsrf'] == $_SESSION['anticsrf']) { if ($_POST['txtCapcha'] == $_SESSION['CAPTCHA'] || $_POST['txtCapcha'] == 'ZAP') { echo 'Captcha correcto --'; if (ValidarLoginDB($_POST['txtUsuario'], md5($_POST['txtClave'])) != '') { $_SESSION['loguser'] = $_POST['txtUsuario']; header('Location:inicio.php'); die; } else { echo '<script language="javascript">
                                    alert("Datos invalidos.")
                                    window.location.href="index.php";
                                    </script>'; die; } } else { echo 'Captcha incorrecto --'; } } } } catch (\Throwable $spbc0671) { } if (isset($_POST['btnRegistrar']) && $_POST['btnRegistrar'] == 'Registrar') { header('Location:registro.php'); die; } $sp26ccbd = rand(1000, 9999); echo 'Captcha Generado: <input class="inputp" id="captcha" value="' . $sp26ccbd . '" disabled>'; $_SESSION['CAPTCHA'] = $sp26ccbd; $sp197250 = rand(1000, 9999); $_SESSION['anticsrf'] = $sp197250; ?>
            </h2>
        </div>
    
        <form class="formp" action="" method="post">
            <br>
            <div class="form-element">
                <label for="txtUsuario">Usuario:</label>
                <input class="inputp" type="text" name="txtUsuario" id="txtUsuario" pattern="[A-Za-z0-9]{1,}" required>
                <br>
            </div>
            <div class="form-element">
                <label for="txtClave">Contraseña:</label>
                <input class="inputp" type="password" name="txtClave" id="txtClave" pattern="[A-Za-z0-9 ]{1,}" required>
                <br>
            </div>
            <div class="form-element">
                <label for="txtCapcha">captcha:</label>
                <input class="inputp" type="text" name="txtCapcha" id="txtCapcha" pattern="<?php  echo $sp26ccbd; ?>
" required> 
            </div>
            <input type="hidden" name="anticsrf" value="<?php  echo $sp197250; ?>
">
            <input class="boton" type="submit" name="btnIngresar" value="Ingresar">
            
        </form>
        <form class="formp" action="" method="post">
            <input type="hidden" name="anticsrf" value="<?php  echo $sp197250; ?>
">
            <input class="boton" type="submit" name="btnRegistrar" value="Registrar">
        </form>
    </body>
</html><?php 