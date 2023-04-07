<?php
function ConexionDB() { $sp3feed5 = 'localhost'; $speebe51 = 'parcial3'; $spa7e42c = 'root'; $sped0259 = 'root'; $sp6c7422 = "mysql:host={$sp3feed5};dbname={$speebe51};"; $sp385254 = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); try { $sp270254 = new PDO($sp6c7422, $spa7e42c, $sped0259, $sp385254); return $sp270254; } catch (PDOException $sp3a2819) { echo 'Connection error: ' . $sp3a2819->getMessage(); return NULL; } } function RegistrarUsuarioDB($spb58292, $sp4582fa, $sp71c463, $sp478751, $spb8d554, $sp7edd35, $sp3d7b31, $sp48e600, $spd9b376) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT `Usuario` FROM `usuarios` WHERE `Usuario`= :Usuario'); $spd27843->execute(array(':Usuario' => $spb58292)); $sp5d0379 = $spd27843->fetch(); if ($sp5d0379) { return FALSE; } $sp0b1063 = $sp270254->prepare('INSERT INTO usuarios (Usuario, Clave, Nombres, Apellidos, Correo, Direccion, Num_Hijos, Estado_Civil, Foto)' . 'VALUES (:Usuario, :Clave, :Nombres, :Apellidos, :Correo, :Direccion, :Num_Hijos, :Estado_Civil, :Foto)'); $sp0b1063->bindParam(':Usuario', $spb58292); $sp0b1063->bindParam(':Clave', $sp4582fa); $sp0b1063->bindParam(':Nombres', $sp71c463); $sp0b1063->bindParam(':Apellidos', $sp478751); $sp0b1063->bindParam(':Correo', $spb8d554); $sp0b1063->bindParam(':Direccion', $sp7edd35); $sp0b1063->bindParam(':Num_Hijos', $sp3d7b31); $sp0b1063->bindParam(':Estado_Civil', $sp48e600); $sp0b1063->bindParam(':Foto', $spd9b376); if ($sp0b1063->execute()) { return TRUE; } else { return FALSE; } } return FALSE; } catch (\Throwable $spbc0671) { } } function ValidarLoginDB($spb58292, $sp4582fa) { try { $sp35493b = ''; $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT Usuario FROM usuarios WHERE Usuario = :Usuario AND Clave = :Clave '); $spd27843->execute(array(':Usuario' => $spb58292, ':Clave' => $sp4582fa)); $sp5d0379 = $spd27843->fetch(); if ($sp5d0379) { $sp35493b = md5(time() . $spb58292); } } return $sp35493b; } catch (\Throwable $spbc0671) { } } function Foto($spb58292) { $spb35309 = null; try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT Foto, CONCAT(Nombres,\' \', Apellidos) AS nombre FROM `usuarios` WHERE `Usuario`= :Usuario'); $spd27843->execute(array(':Usuario' => $spb58292)); $spb35309 = $spd27843->fetch(); } } catch (\Throwable $spbc0671) { } return $spb35309; } function ListarDatosDB($spb58292) { $spfb9e01 = array(); try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT Nombres, Apellidos, Correo, Direccion, Num_Hijos, Estado_Civil, Foto FROM `usuarios` WHERE `Usuario`= :Usuario'); $spd27843->execute(array(':Usuario' => $spb58292)); $spfb9e01 = $spd27843->fetch(); } } catch (\Throwable $spbc0671) { } return $spfb9e01; } function ActualizarDatosDB($spb58292, $sp71c463, $sp478751, $spb8d554, $sp7edd35, $sp3d7b31, $sp48e600, $spd9b376) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $sp0b1063 = $sp270254->prepare('UPDATE usuarios SET Nombres = :Nombres, Apellidos = :Apellidos,' . 'Correo = :Correo, Direccion = :Direccion, Num_Hijos = :Num_Hijos,' . 'Estado_Civil = :Estado_Civil, Foto = :Foto WHERE Usuario = :Usuario'); $sp0b1063->bindParam(':Nombres', $sp71c463); $sp0b1063->bindParam(':Apellidos', $sp478751); $sp0b1063->bindParam(':Correo', $spb8d554); $sp0b1063->bindParam(':Direccion', $sp7edd35); $sp0b1063->bindParam(':Num_Hijos', $sp3d7b31); $sp0b1063->bindParam(':Estado_Civil', $sp48e600); $sp0b1063->bindParam(':Foto', $spd9b376); $sp0b1063->bindParam(':Usuario', $spb58292); if ($sp0b1063->execute()) { return TRUE; } else { return FALSE; } } return FALSE; } catch (\Throwable $spbc0671) { } } function ActualizarClaveDB($spb58292, $spdc4d51, $spa535e0) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('UPDATE usuarios SET `Clave` = :Clave WHERE `Usuario` = :Usuario AND `Clave` IN (SELECT `Clave` WHERE `Usuario`= :Usuario AND `Clave` = :Claveantigua)'); $spd27843->execute(array(':Usuario' => $spb58292, ':Clave' => $spdc4d51, ':Claveantigua' => $spa535e0)); if ($spd27843) { return TRUE; } else { return FALSE; } } return FALSE; } catch (\Throwable $spbc0671) { } } function RegistrarArticuloDB($spb58292, $spdc0765, $sp261788) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { if ($sp261788 == 'on') { $spa9d1c5 = 1; $sp23aaf0 = date('Y-m-d'); } else { $spa9d1c5 = 0; $sp23aaf0 = NULL; } $sp0b1063 = $sp270254->prepare('INSERT INTO publicaciones (Publicacion, Autor, Publico, Fecha_publico)' . 'VALUES (:Publicacion,(SELECT Id FROM usuarios WHERE Usuario = :Usuario),:Publico,:Fecha_publico)'); $sp0b1063->bindParam(':Publicacion', $spdc0765); $sp0b1063->bindParam(':Usuario', $spb58292); $sp0b1063->bindParam(':Publico', $spa9d1c5); $sp0b1063->bindParam(':Fecha_publico', $sp23aaf0); if ($sp0b1063->execute()) { return TRUE; } else { return FALSE; } } return FALSE; } catch (\Throwable $spbc0671) { } } function ListarmisArticulosDb($spb58292) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT a.Id, a.Publicacion, a.Publico , a.Fecha_publico FROM publicaciones a INNER JOIN usuarios b ON a.autor = b.Id  WHERE b.Usuario = :Usuario'); $spd27843->execute(array(':Usuario' => $spb58292)); $spc7640e = $spd27843->fetchAll(); if ($spd27843) { return $spc7640e; } else { return $spc7640e; } } return $spc7640e; } catch (\Throwable $spbc0671) { } } function PublicarArticuloDB($spb58292, $sp96ee0a) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT Publico FROM publicaciones WHERE `Id`= :Id'); $spd27843->execute(array(':Id' => $sp96ee0a)); $sp2d8e54 = $spd27843->fetch(); if ($sp2d8e54['Publico'] == 1) { return FALSE; } $sp23aaf0 = date('Y-m-d'); $sp0b1063 = $sp270254->prepare('UPDATE publicaciones SET Publico = \'1\', Fecha_publico = :Fecha_publico WHERE Id = :Id  AND Autor IN (SELECT Id FROM usuarios WHERE `Usuario`= :Usuario)'); $sp0b1063->execute(array(':Usuario' => $spb58292, ':Id' => $sp96ee0a, ':Fecha_publico' => $sp23aaf0)); if ($sp0b1063) { $spd27843 = $sp270254->prepare('SELECT Publico FROM publicaciones WHERE `Id`= :Id'); $spd27843->execute(array(':Id' => $sp96ee0a)); $sp2d8e54 = $spd27843->fetch(); if ($sp2d8e54['Publico'] == 0) { return FALSE; } return TRUE; } else { return FALSE; } } } catch (\Throwable $spbc0671) { return FALSE; } } function DespublicarArticuloDB($spb58292, $sp96ee0a) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT Publico FROM publicaciones WHERE `Id`= :Id'); $spd27843->execute(array(':Id' => $sp96ee0a)); $sp2d8e54 = $spd27843->fetch(); if ($sp2d8e54['Publico'] == 0) { return FALSE; } $sp0b1063 = $sp270254->prepare('UPDATE publicaciones SET Publico = \'0\' WHERE Id = :Id  AND Autor IN (SELECT Id FROM usuarios WHERE `Usuario`= :Usuario)'); $sp0b1063->execute(array(':Usuario' => $spb58292, ':Id' => $sp96ee0a)); if ($sp0b1063) { $spd27843 = $sp270254->prepare('SELECT Publico FROM publicaciones WHERE `Id`= :Id'); $spd27843->execute(array(':Id' => $sp96ee0a)); $sp2d8e54 = $spd27843->fetch(); if ($sp2d8e54['Publico'] == 1) { return FALSE; } return TRUE; } else { return FALSE; } } return FALSE; } catch (\Throwable $spbc0671) { } } function BorrarArticuloDB($spb58292, $sp96ee0a) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $sp0b1063 = $sp270254->prepare('DELETE FROM publicaciones WHERE `Id`= :Id AND Autor IN (SELECT Id FROM usuarios WHERE Usuario = :Usuario)'); $sp0b1063->execute(array(':Usuario' => $spb58292, ':Id' => $sp96ee0a)); if ($sp0b1063) { return TRUE; } else { return FALSE; } } return FALSE; } catch (\Throwable $spbc0671) { } } function ListarArticulosDb() { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT CONCAT(b.Nombres,\' \',b.Apellidos) AS nombre, a.Publicacion, b.Foto, a.Fecha_publico FROM publicaciones a INNER JOIN usuarios b ON a.autor = b.Id  WHERE a.Publico = \'1\''); $spd27843->execute(); $spc7640e = $spd27843->fetchAll(); if ($spd27843) { return $spc7640e; } else { return $spc7640e; } } return $spc7640e; } catch (\Throwable $spbc0671) { } } function RegistrarMensajeDB($spb58292, $sp604ff8, $sp2d7f1a, $spcb6d27) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $sp17d0ad = date('Y-m-d'); $sp0b1063 = $sp270254->prepare('INSERT INTO mensajes (Remitente , Destinatario, Mensaje, Archivo, Fecha_mensaje)' . 'VALUES ((SELECT Id FROM usuarios WHERE Usuario = :Usuario),:Destinatario,:Mensaje,:Archivo,:Fecha_mensaje)'); $sp0b1063->bindParam(':Usuario', $spb58292); $sp0b1063->bindParam(':Destinatario', $sp604ff8); $sp0b1063->bindParam(':Mensaje', $sp2d7f1a); $sp0b1063->bindParam(':Archivo', $spcb6d27); $sp0b1063->bindParam(':Fecha_mensaje', $sp17d0ad); if ($sp0b1063->execute()) { return TRUE; } else { return FALSE; } } return FALSE; } catch (\Throwable $spbc0671) { } } function ListaPersonasDB() { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT Id, CONCAT(Nombres,\' \', Apellidos) AS nombre FROM usuarios'); $spd27843->execute(); $spbef630 = $spd27843->fetchAll(); if ($spd27843) { return $spbef630; } else { return $spbef630; } } return $spbef630; } catch (\Throwable $spbc0671) { } } function ListarMensajesEDB($spb58292) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT CONCAT(b.Nombres,\' \',b.Apellidos) AS nombre, a.Mensaje, b.Foto, a.Fecha_mensaje, a.Archivo FROM mensajes a INNER JOIN usuarios b ON a.Destinatario  = b.Id INNER JOIN usuarios c ON a.Remitente  = c.Id  WHERE c.Usuario = :Usuario'); $spd27843->execute(array(':Usuario' => $spb58292)); $sp2c6cc7 = $spd27843->fetchAll(); if ($spd27843) { return $sp2c6cc7; } else { return $sp2c6cc7; } } return $sp2c6cc7; } catch (\Throwable $spbc0671) { } } function ListarMensajesRDB($spb58292) { try { $sp270254 = ConexionDB(); if ($sp270254 != null) { $spd27843 = $sp270254->prepare('SELECT CONCAT(b.Nombres,\' \',b.Apellidos) AS nombre, a.Mensaje, b.Foto, a.Fecha_mensaje, a.Archivo FROM mensajes a INNER JOIN usuarios b ON a.Remitente  = b.Id INNER JOIN usuarios c ON a.Destinatario  = c.Id WHERE c.Usuario = :Usuario'); $spd27843->execute(array(':Usuario' => $spb58292)); $sp697a52 = $spd27843->fetchAll(); if ($spd27843) { return $sp697a52; } else { return $sp697a52; } } return $sp697a52; } catch (\Throwable $spbc0671) { } }