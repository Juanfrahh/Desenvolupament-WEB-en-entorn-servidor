<?php// ====== REGISTRO ======
if (isset($_POST['accion']) && $_POST['accion'] === 'registro') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($usuario) && !empty($password)) {
        $check = $conexion->prepare("SELECT COUNT(*) FROM tabla_usuarios WHERE usuario = ?");
        $check->execute([$usuario]);
        $existe = $check->fetchColumn();

        if ($existe > 0) {
            $mensaje = "<p style='color:red;'>⚠️ El usuario '<strong>$usuario</strong>' ya existe.</p>";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // === Validar imagen ===
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
                $tmp = $_FILES['imagen']['tmp_name'];
                $tipo = mime_content_type($tmp);

                if (!in_array($tipo, ['image/png', 'image/jpeg'])) {
                    die("<p style='color:red;'>❌ Solo se permiten imágenes PNG o JPG.</p>");
                }

                // Crear carpeta del usuario
                $rutaUsuario = "img/users/$usuario";
                if (!is_dir($rutaUsuario)) {
                    mkdir($rutaUsuario, 0777, true);
                }

                // Crear imagen grande y pequeña
                $id = uniqid();
                $imgGrande = "$rutaUsuario/{$id}_big.png";
                $imgPequena = "$rutaUsuario/{$id}_small.png";

                // Redimensionar imagenes
                $imagen = ($tipo == 'image/png') ? imagecreatefrompng($tmp) : imagecreatefromjpeg($tmp);

                // Imagen grande
                $grande = imagescale($imagen, 360, 480);
                imagepng($grande, $imgGrande);

                // Imagen pequeña
                $pequena = imagescale($imagen, 72, 96);
                imagepng($pequena, $imgPequena);

                imagedestroy($imagen);
                imagedestroy($grande);
                imagedestroy($pequena);
            } else {
                $imgGrande = NULL;
                $imgPequena = NULL;
            }

            // Insertar usuario
            $stmt = $conexion->prepare("INSERT INTO tabla_usuarios (usuario, password, img_grande, img_pequena) VALUES (?, ?, ?, ?)");
            $stmt->execute([$usuario, $passwordHash, $imgGrande, $imgPequena]);

            $mensaje = "<p style='color:green;'>✅ Usuario registrado correctamente con imagen de perfil.</p>";
        }
    } else {
        $mensaje = "<p style='color:red;'>❌ Rellena todos los campos.</p>";
    }
}
