<?php
require_once '../vendor/autoload.php'; require_once '../libs/php/funciones.php'; require_once '../libs/php/db_tools.php'; LimpiarEntradas(); use Firebase\JWT\JWT; $spb637ea = 'my_secret_key'; $spb01ffd = time(); if ($_SERVER['REQUEST_METHOD'] == 'POST') { $sp707a4f = $_SERVER['HTTP_AUTHORIZATION']; if (substr($sp707a4f, 0, 6) === 'Bearer') { $sp707a4f = str_replace('Bearer ', '', $sp707a4f); try { $spee103d = JWT::decode($sp707a4f, $spb637ea, array('HS256')); $sp5d0379 = strval($spee103d->data->usuario); if (isset($_POST['txtMensaje']) && $_POST['txtMensaje'] != '') { if (!preg_match('/^(?=.*[A-Za-z])[0-9A-Za-z !@#$%]{1,200}$/', $_POST['txtMensaje'])) { echo 'El articulo no se ha publicado'; http_response_code(401); die; } } $spf3e04e = RegistrarArticuloDB($sp5d0379, $_POST['txtMensaje'], $_POST['chkPublico']); if ($spf3e04e == TRUE) { echo 'Articulo creado.'; http_response_code(200); die; } else { echo 'Articulo no creado.'; http_response_code(401); die; } } catch (\Throwable $spbc0671) { echo 'Credenciales erroneas'; http_response_code(401); die; } } else { echo 'Acceso no autorizado'; http_response_code(401); die; } } if ($_SERVER['REQUEST_METHOD'] == 'GET') { $sp707a4f = $_SERVER['HTTP_AUTHORIZATION']; if (substr($sp707a4f, 0, 6) === 'Bearer') { $sp707a4f = str_replace('Bearer ', '', $sp707a4f); try { $spee103d = JWT::decode($sp707a4f, $spb637ea, array('HS256')); $sp5d0379 = strval($spee103d->data->usuario); if (isset($_GET['mis_articulos'])) { $spd6934c = ListarmisArticulosDb($sp5d0379); if (isset($spd6934c)) { foreach ($spd6934c as $spb637ea => $sp08694a) { echo '{{Id => ' . $sp08694a['Id'] . '} '; echo '{Publicacion => ' . $sp08694a['Publicacion'] . '} '; echo '{Publico => '; if ($sp08694a['Publico'] == '1') { echo 'si }'; } else { echo 'no }'; } echo '{Fecha Publicacion => ' . $sp08694a['Fecha_publico'] . '}}'; } http_response_code(200); die; } } else { $sp35cfa7 = ListarArticulosDb(); if (isset($sp35cfa7)) { foreach ($sp35cfa7 as $spb637ea => $sp08694a) { echo '{{Nombre => ' . $sp08694a['nombre'] . '} '; echo '{Publicacion => ' . $sp08694a['Publicacion'] . '} '; echo '{Foto => ' . $sp08694a['Foto'] . '} '; echo '{Fecha Publicacion => ' . $sp08694a['Fecha_publico'] . '}}'; } http_response_code(200); die; } } echo 'Aqui no hay nada.'; http_response_code(401); die; } catch (\Throwable $spbc0671) { echo 'Credenciales erroneas'; http_response_code(401); die; } } else { echo 'Acceso no autorizado.'; http_response_code(401); die; } } if ($_SERVER['REQUEST_METHOD'] == 'PUT') { $sp707a4f = $_SERVER['HTTP_AUTHORIZATION']; if (substr($sp707a4f, 0, 6) === 'Bearer') { $sp707a4f = str_replace('Bearer ', '', $sp707a4f); try { $spee103d = JWT::decode($sp707a4f, $spb637ea, array('HS256')); $sp5d0379 = strval($spee103d->data->usuario); if (isset($_GET['btnPublicar_1']) && $_GET['btnPublicar_1'] == 'Publicar') { $spfd1a70 = PublicarArticuloDB($sp5d0379, $_GET['txtid']); if ($spfd1a70 == TRUE) { echo 'Articulo publico.'; http_response_code(200); die; } echo 'Este articulo no le pertenece o ya estaba publicado.'; http_response_code(401); die; } if (isset($_GET['btnDespublicar_1']) && $_GET['btnDespublicar_1'] == 'Despublicar') { $spb7506a = DespublicarArticuloDB($sp5d0379, $_GET['txtid']); if ($spb7506a == TRUE) { echo 'Articulo Despublicado.'; http_response_code(200); die; } echo 'Este articulo no le pertenece o ya estaba despublicado.'; http_response_code(401); die; } } catch (\Throwable $spbc0671) { echo 'Credenciales erroneas.'; http_response_code(401); die; } } else { echo 'Acceso no autorizado.'; http_response_code(401); die; } } if ($_SERVER['REQUEST_METHOD'] == 'DELETE') { $sp707a4f = $_SERVER['HTTP_AUTHORIZATION']; if (substr($sp707a4f, 0, 6) === 'Bearer') { $sp707a4f = str_replace('Bearer ', '', $sp707a4f); try { $spee103d = JWT::decode($sp707a4f, $spb637ea, array('HS256')); $sp5d0379 = strval($spee103d->data->usuario); if (isset($_GET['btnBorrar_1']) && $_GET['btnBorrar_1'] == 'Borrar') { $sp3b3f1a = BorrarArticuloDB($sp5d0379, $_GET['txtid']); if ($sp3b3f1a == TRUE) { echo 'Articulo Borrado.'; http_response_code(200); die; } echo 'Este articulo no le pertenece o no existe.'; http_response_code(401); die; } http_response_code(200); die; } catch (\Throwable $spbc0671) { echo 'Credenciales erroneas.'; http_response_code(401); die; } } else { echo 'Acceso no autorizado.'; http_response_code(401); die; } }